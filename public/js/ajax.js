(function () {
    const [$, $$] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
    ];
    initApp();
    const [pagination_holder, pagination, categories] = [
        $$(".pagination"),
        $$(".pagination .page-btn"),
        $(".shop-sidebar"),
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

    categories.addEventListener("click", (event) => {
        // Check if the clicked element (or its parent) is a category item
        const category = event.target.closest("[data-category]");
        if (!category) return;
        // Remove 'checked' from all categories and add to the clicked one
        document.querySelectorAll("[data-category]").forEach((cat) => {
            cat.classList.remove("checked");
        });
        category.classList.add("checked");
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
            paginationInit((type = "category"), (category = category_select));
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
            
        const grid = $(".shop-layout .products-grid");
        if (!grid) return;
        grid.innerHTML = "";

        if (products.length === 0) {
            const not_found = document.createElement("div");
            not_found.className = "no-products";
            not_found.textContent = "Oop !!! No products found.";
            grid.appendChild(not_found);
            return;
        } else {
            $$(".shop-toolbar .shop-count").forEach((shop_count) => {
                shop_count.textContent = `Showing ${data.product_cumulative} of ${data.total} products`;
            });

            products.forEach((product, index) => {
                const productId = data.products_id[index];
                const isAvailable = product.product_badge === "available";
                const isSold = product.product_badge === "sold";
                const badgeText = product.product_badge.toUpperCase();

                // Create main card container
                const productCard = document.createElement("div");
                productCard.className = "product-card";

                // Image wrap structure
                const imageWrap = document.createElement("div");
                imageWrap.className = "product-image-wrap";

                const link1 = document.createElement("a");
                link1.className = "product-link";
                if (isAvailable) {
                    link1.setAttribute("href", `/user/product/${productId}`);
                }

                const img = document.createElement("img");
                img.src = `/assets/images/${product.product_image}`;
                img.alt = product.product_image;
                img.loading = "lazy";
                link1.appendChild(img);
                imageWrap.appendChild(link1);

                // Badges
                const badgesDiv = document.createElement("div");
                badgesDiv.className = "product-badges";
                const badgeSpan = document.createElement("span");
                badgeSpan.className = `product-badge badge-${product.product_badge}`;
                badgeSpan.textContent = badgeText;
                badgesDiv.appendChild(badgeSpan);
                imageWrap.appendChild(badgesDiv);

                // Actions hover
                const actionsDiv = document.createElement("div");
                actionsDiv.className = "product-actions-hover";

                const btnCart = document.createElement("button");
                btnCart.className = "btn-add-cart";
                btnCart.dataset.action = "add-to-cart";
                btnCart.dataset.id = productId;
                btnCart.dataset.name = product.product_name;
                btnCart.dataset.price = product.product_price;
                btnCart.dataset.image = `/assets/images/${product.product_image}`;
                if (isSold) btnCart.disabled = true;
                btnCart.textContent = isSold ? "sold out" : "add to cart";

                const btnWishlist = document.createElement("button");
                btnWishlist.className = "btn-wishlist";
                btnWishlist.dataset.action = "toggle-wishlist";
                btnWishlist.dataset.id = productId;
                btnWishlist.dataset.name = product.product_name;
                btnWishlist.dataset.price = product.product_price;
                btnWishlist.dataset.image = `/assets/images/${product.product_image}`;
                btnWishlist.setAttribute("aria-label", "Add to wishlist");
                btnWishlist.textContent = "♡";

                actionsDiv.appendChild(btnCart);
                actionsDiv.appendChild(btnWishlist);
                imageWrap.appendChild(actionsDiv);
                productCard.appendChild(imageWrap);

                // Product info
                const infoDiv = document.createElement("div");
                infoDiv.className = "product-info";

                const categoryDiv = document.createElement("div");
                categoryDiv.className = "product-category";
                categoryDiv.textContent = product.product_category;
                infoDiv.appendChild(categoryDiv);

                const link2 = document.createElement("a");
                link2.className = "product-link";
                if (isAvailable) {
                    link2.setAttribute("href", `/user/product/${productId}`);
                }

                const h3 = document.createElement("h3");
                h3.className = "product-name";
                h3.textContent = product.product_name;
                link2.appendChild(h3);
                infoDiv.appendChild(link2);

                const ratingDiv = document.createElement("div");
                ratingDiv.className = "product-rating";
                const starsSpan = document.createElement("span");
                starsSpan.className = "stars";
                starsSpan.title = "2 out of 5";
                starsSpan.textContent = "★★☆☆☆";
                ratingDiv.appendChild(starsSpan);
                infoDiv.appendChild(ratingDiv);

                const priceDiv = document.createElement("div");
                priceDiv.className = "product-price";

                const priceCurrent = document.createElement("span");
                priceCurrent.className = "price-current";
                priceCurrent.textContent = `Ksh: ${Number(
                    product.product_price
                ).toFixed(2)}`;

                const priceOld = document.createElement("span");
                priceOld.className = "price-old";
                priceOld.textContent = "Ksh: 582.00";

                priceDiv.appendChild(priceCurrent);
                priceDiv.appendChild(priceOld);
                infoDiv.appendChild(priceDiv);

                productCard.appendChild(infoDiv);
                grid.appendChild(productCard);
            });
        }


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
                    return "Not Found.";
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
                callback("Not Found");
            });
    }
})();
