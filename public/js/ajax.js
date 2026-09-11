(function () {
    const [$, $$] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
    ];
    initApp();
    const [pagination_holder, pagination, categories] = [
        $$(".pagination"),
        $$(".pagination .page-btn"),
        $$(".shop-sidebar .filter-checkbox"),
    ];

    function store(name, data) {
        localStorage.setItem(name, data);
    }

    function get(name) {
        return localStorage.getItem(name);
    }

    function del(name) {
        localStorage.removeItem(name);
    }

    function priceRange() {
        const slider = $("#price-range");
        const display = $(".price-display .price-max");
        let price;
        if (!slider || !display) return;
        slider.addEventListener("input", () => {
            price = `${slider.value}`;
        });
        slider.addEventListener("mouseup", () => {
            ajax(``, () => {});
        });
    }

    function initCurrentPag() {
        const page = get(`${window.location.hostname}-current-page`);
        if (page == null || page == undefined) {
            store(`${window.location.hostname}-current-page`, 1);
        } else if (page > 1) {
            store(`${window.location.hostname}-current-page`, 1);
        }
    }

    function initCategorySelect() {
        del(`${window.location.hostname}-category`);
    }

    function updatePagination(parent, page, position = false) {
        if (position == false) {
            const pagination = document.createElement("div");
            pagination.setAttribute(
                "class",
                `page-btn page ${page == 1 ? "active" : ""}`
            );
            pagination.setAttribute("data-page", page);
            pagination.textContent = page;
            parent.appendChild(pagination);
        } else {
            const pagination = document.createElement("div");
            pagination.setAttribute(
                "class",
                position == "›" ? "page-btn  next" : "page-btn prev"
            );
            pagination.setAttribute("data-page", page);
            pagination.textContent = position;
            parent.appendChild(pagination);
        }
    }

    categories.forEach((category) => {
        category.addEventListener("click", () => {
            categories.forEach((cat) => {
                cat.classList.remove("checked");
            });
            category.classList.remove("checked");
            initCurrentPag();
            const category_select = category.dataset.category;
            store(`${window.location.hostname}-category`, category_select);
            ajax(`/user/shop/filter/category/${category_select}`, (data) => {
                $$(".pagination .page-btn").forEach((pag) => {
                    pag.remove();
                });
                productUpdate(data);
                pagination_holder.forEach((pag_holder) => {
                    for (let i = 1; i <= data.total_pages; i++) {
                        if (i == 1) {
                            updatePagination(pag_holder, "", "‹");
                        }
                        updatePagination(pag_holder, i);
                        if (i == data.total_pages) {
                            updatePagination(pag_holder, "", "›");
                        }
                    }
                });
                paginationInit(
                    (type = "category"),
                    (category = category_select)
                );
            });
        });
    });

    function paginationInit(type = "general", category = null) {
        $$(".pagination .page-btn.page").forEach((pag) => {
            pag.addEventListener("click", function () {
                $$(".pagination .page-btn").forEach((element) => {
                    element.classList.remove("active");
                });
                pag.classList.add("active");
                const page = pag.dataset.page;
                switch (type) {
                    case "category":
                        ajax(
                            `/user/shop/category/${category}/page/${page}`,
                            (result) => {
                                productUpdate(result);
                            }
                        );
                        break;
                    default:
                        ajax(`/user/shop/page/${page}`, (result) => {
                            productUpdate(result);
                        });
                        break;
                }
                store(`${window.location.hostname}-current-page`, page);
            });
        });
        pagMove(true, type, category);
        pagMove(false, type, category);
    }

    function pagMove(direction, type, category) {
        $$(
            `.pagination ${direction ? ".page-btn.next" : ".page-btn.prev"}`
        ).forEach((dir) => {
            dir.addEventListener("click", () => {
                let [max_page, current_page] = [
                    $$(".pagination .page-btn.page").length / 2,
                    Number(get(`${window.location.hostname}-current-page`)),
                ];

                if (direction) {
                    if (current_page >= max_page) {
                        current_page = max_page;
                    } else {
                        current_page += 1;
                    }
                } else {
                    if (current_page <= 1) {
                        current_page = 1;
                    } else {
                        current_page -= 1;
                    }
                }

                $$(".pagination .page-btn").forEach((element) => {
                    element.classList.remove("active");
                    $$(".pagination .page-btn.page").forEach((pag) => {
                        if (pag.dataset.page == current_page) {
                            pag.classList.add("active");
                        }
                    });
                });

                switch (type) {
                    case "category":
                        ajax(
                            `/user/shop/category/${category}/page/${current_page}`,
                            (result) => {
                                productUpdate(result);
                            }
                        );
                        break;
                    default:
                        ajax(`/user/shop/page/${current_page}`, (result) => {
                            productUpdate(result);
                        });
                        break;
                }
                store(`${window.location.hostname}-current-page`, current_page);
            });
        });
    }

    function productUpdate(data) {
        // console.log(data);
        $$(".shop-toolbar .shop-count").forEach((shop_count) => {
            shop_count.textContent = `Showing ${data.product_cumulative} of ${data.total} products`;
        });
        data.products.forEach((product, index) => {
            const product_card = document.createElement("div");
            product_card.setAttribute("class", "product-card");
            product_card.innerHTML = `
                <div class="product-image-wrap">
                    <a ${
                        product.product_badge == "available"
                            ? "href=/user/product/" + data.products_id[index]
                            : ""
                    } class="product-link">
                        <img src="/assets/images/${
                            product.product_image
                        }" alt="${product.product_image}" loading="lazy">
                    </a>

                    <div class="product-badges">
                        <span class="product-badge badge-${
                            product.product_badge
                        }">
                            ${product.product_badge.toUpperCase()}
                        </span>
                    </div>

                    <div class="product-actions-hover">
                        <button class="btn-add-cart" data-action="add-to-cart" data-id="${
                            data.products_id[index]
                        }" data-name="${product.product_name}" data-price="${
                product.product_price
            }" data-image="/assets/images/${product.product_image}" ${
                product.product_badge == "sold" ? "disabled" : ""
            } >${
                product.product_badge == "sold" ? "sold out" : "add to cart"
            }</button>
                        <button class="btn-wishlist " data-action="toggle-wishlist" data-id="${
                            data.products_id[index]
                        }" data-name="${product.product_name}" data-price="${
                product.product_price
            }" data-image="/assets/images/${
                product.product_image
            }" aria-label="Add to wishlist">♡</button>
                    </div>
                </div>

                <div class="product-info">

                    <div class="product-category">${
                        product.product_category
                    }</div>
                    <a class="product-link" ${
                        product.product_badge == "available"
                            ? "href=/user/product/" + data.products_id[index]
                            : ""
                    }>
                        <h3 class="product-name">${product.product_name}</h3>
                    </a>

                    <div class="product-rating">
                        <span class="stars" title="2 out of 5">★★☆☆☆</span>
                    </div>

                    <div class="product-price">
                        <span class="price-current">Ksh: ${product.product_price.toFixed(
                            2
                        )}</span>
                        <span class="price-old">Ksh: 582.00</span>
                    </div>
                </div>
            `;
            $(".shop-layout .products-grid").appendChild(product_card);
        });
    }

    function initApp() {
        paginationInit();
        initCurrentPag();
        initCategorySelect();
        priceRange();
    }
    function ajax(url, callback) {
        const http = fetch(url, {
            method: "GET",
        })
            .then((response) => {
                if (!response.ok) {
                    // error handler
                } else {
                    return response.json();
                }
            })
            .then((data) => {
                $$(".shop-layout .products-grid .product-card").forEach(
                    (card) => {
                        card.remove();
                    }
                );
                callback(data);
            })
            .catch((error) => {
                // handle error
            });
    }
})();
