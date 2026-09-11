(function () {
    const [$, $$] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
    ];

    const [pagination_holder, pagination, categories] = [
        $$(".pagination"),
        $$(".pagination .page-btn"),
        $$(".shop-sidebar .filter-checkbox"),
    ];

    function update_pagination(parent, page, position = false) {
        if (position == false) {
            const pagination = document.createElement("div");
            pagination.setAttribute("class", "page-btn page");
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
            const category_select = category.dataset.category;
            ajax(`/user/shop/filter/category/${category_select}`, (data) => {
                $$(".pagination .page-btn").forEach((pag) => {
                    pag.remove();
                });
                product_update(data);
                pagination_holder.forEach((pag_holder) => {
                    for (let i = 1; i <= data.total_pages; i++) {
                        if (i == 1) {
                            update_pagination(pag_holder, "", "‹");
                        }
                        update_pagination(pag_holder, i);
                        if (i == data.total_pages) {
                            update_pagination(pag_holder, "", "›");
                        }
                    }
                });
                pagination_init("category", category_select);
            });
        });
    });

    pagination_init();

    function pagination_init(type = "general", category = null) {
        $$(".pagination .page-btn").forEach((pag) => {
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
                                product_update(result);
                            }
                        );
                        break;
                    default:
                        ajax(`/user/shop/page/${page}`, (result) => {
                            product_update(result);
                        });
                        break;
                }
            });
        });
    }

    function product_update(data) {
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
                console.log(error);
            });
    }
})();
