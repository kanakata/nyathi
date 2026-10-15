(function () {
    function init_app() {
        delegate_pagination_listener();
        init_current_page();
        init_category_select();
        price_range();
    }

    window.addEventListener("load", () => {
        const link = window.location.pathname.split("/").filter((element) => {
            if (element != undefined || element != null) {
                return element;
            }
        });
        const category = link.pop();
        if (link.pop() == "category") {
            init_app();
            store(`${window.location.hostname}-category`, category);
            delegate_pagination_listener("category", category);
        } else {
            init_app();
        }
    });

    const [categories, clear] = [
        $(".shop-layout .shop-sidebar"),
        $$(".clear-filter"),
    ];

    clear.forEach((filter) => {
        filter.addEventListener("click", () => {
            store(`${window.location.hostname}-category`, "all");
            document.querySelectorAll("[data-category]").forEach((cat) => {
                cat.classList.remove("checked");
            });
            ajax(`/user/shop/page/${1}`, (data) => {
                update_pagination(data);
                delegate_pagination_listener();
                update_products(data);
            });
        });
    });

    function price_range() {
        const slider = $("#price-range");
        const display = $(".price-display .price-max");
        if (!slider || !display) return;
        slider.addEventListener("input", () => {
            display.textContent = `Ksh: ${slider.value}`;
        });
        let price;
        if (!slider || !display) return;
        slider.addEventListener("input", () => {
            price = `${slider.value}`;
        });
        slider.addEventListener("mouseup", () => {
            const category = get(`${window.location.hostname}-category`);
            if (category == "all") {
                ajax(`/user/shop/filter/price/${price}`, (data) => {
                    update_pagination(data);
                    delegate_pagination_listener();
                    update_products(data);
                });
            } else {
                ajax(
                    `/user/shop/category/${category}/filter/price/${price}`,
                    (data) => {
                        update_pagination(data);
                        delegate_pagination_listener();
                        update_products(data);
                    }
                );
            }
        });

        if (window.screen.width <= 900) {
            slider.addEventListener("touchend", () => {
                const category = get(`${window.location.hostname}-category`);
                if (category == "all") {
                    ajax(`/user/shop/filter/price/${price}`, (data) => {
                        update_pagination(data);
                        delegate_pagination_listener();
                        update_products(data);
                    });
                } else {
                    ajax(
                        `/user/shop/category/${category}/filter/price/${price}`,
                        (data) => {
                            update_pagination(data);
                            delegate_pagination_listener();
                            update_products(data);
                        }
                    );
                }
            });
        }
    }

    function init_current_page() {
        const page = get(`${window.location.hostname}-current-page`);
        if (page == null || page == undefined) {
            store(`${window.location.hostname}-current-page`, 1);
        } else {
            store(`${window.location.hostname}-current-page`, 1);
        }
    }

    function init_category_select() {
        store(`${window.location.hostname}-category`, "all");
    }

    function paint_pagination(parent, page, position = false) {
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
        const category = event.target.closest("[data-category]");
        if (!category) return;
        document.querySelectorAll("[data-category]").forEach((cat) => {
            cat.classList.remove("checked");
        });
        category.classList.add("checked");
        const category_select = category.dataset.category;
        store(`${window.location.hostname}-category`, category_select);
        ajax(`/user/shop/category/${category_select}/filter`, (data) => {
            update_pagination(data);
            delegate_pagination_listener("category", category_select);
            update_products(data);
        });
    });

    function update_pagination(data) {
        $$(".pagination .page-btn").forEach((pag) => {
            pag.remove();
        });
        $$(".pagination").forEach((pag_holder) => {
            for (let i = 1; i <= data.total_pages; i++) {
                if (i == 1) {
                    paint_pagination(pag_holder, "", "‹");
                }
                paint_pagination(pag_holder, i);
                if (i == data.total_pages) {
                    paint_pagination(pag_holder, "", "›");
                }
            }
        });
    }

    function delegate_pagination_listener(type = "general", category = null) {
        init_current_page();
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
                                update_products(result);
                            }
                        );
                        break;
                    default:
                        ajax(`/user/shop/page/${page}`, (result) => {
                            update_products(result);
                        });
                        break;
                }
                store(`${window.location.hostname}-current-page`, page);
            });
        });
        pagination_move(true, type, category);
        pagination_move(false, type, category);
    }

    function pagination_move(direction, type, category) {
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
                        current_page = 1;
                    } else {
                        current_page += 1;
                    }
                } else {
                    if (current_page <= 1) {
                        current_page = max_page;
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
                                update_products(result);
                            }
                        );
                        break;
                    default:
                        ajax(`/user/shop/page/${current_page}`, (result) => {
                            update_products(result);
                        });
                        break;
                }
                store(`${window.location.hostname}-current-page`, current_page);
            });
        });
    }

    function update_products(data) {
        const products = data.products;
        const grid = $(".shop-layout .products-grid");
        if (!grid) return;
        grid.innerHTML = "";
        if (data == undefined || products.length == 0) {
            $$(".shop-toolbar .shop-count").forEach((shop_count) => {
                shop_count.textContent = "Oops !!! No products found";
            });
            const not_found = document.createElement("div");
            not_found.className = "no-products";
            not_found.textContent = "Oop !!! No products found.";
            grid.appendChild(not_found);
            return;
        } else {
            $$(".shop-toolbar .shop-count").forEach((shop_count) => {
                shop_count.textContent = `Showing ${data.product_cumulative} of ${data.total} products`;
            });

            const templateElement = document.querySelector("#product-template");

            products.forEach((product, index) => {
                const clone = templateElement.content.cloneNode(true);
                const productId = data.products_id[index];
                const isAvailable = product.product_badge === "available";
                const isSold = product.product_badge === "sold";
                const badgeText = product.product_badge.toUpperCase();
                const imagePath = `/assets/images/${product.product_image}`;
                const productUrl = isAvailable
                    ? `/user/product/${productId}`
                    : "";
                const links = clone.querySelectorAll(".product-link");
                const img = clone.querySelector("img");
                const badgeSpan = clone.querySelector(".product-badge");
                const btnCart = clone.querySelector(".btn-add-cart");
                const btnWishlist = clone.querySelector(".btn-wishlist");
                const categoryDiv = clone.querySelector(".product-category");
                const nameH3 = clone.querySelector(".product-name");
                const priceCurrent = clone.querySelector(".price-current");
                const priceOld = clone.querySelector(".price-old");

                links.forEach((link) => link.setAttribute("href", productUrl));

                if (img) {
                    img.src = imagePath;
                    img.alt = product.product_name || product.product_image;
                    img.loading = "lazy";
                }

                if (badgeSpan) {
                    badgeSpan.className = `product-badge badge-${product.product_badge}`;
                    badgeSpan.textContent = badgeText;
                }

                if (btnCart) {
                    btnCart.dataset.action = "add-to-cart";
                    btnCart.dataset.id = productId;
                    btnCart.dataset.name = product.product_name;
                    btnCart.dataset.price = product.product_price;
                    btnCart.dataset.image = imagePath;
                    btnCart.disabled = isSold;
                    btnCart.textContent = isSold ? "sold out" : "add to cart";
                }

                if (btnWishlist) {
                    btnWishlist.dataset.action = "toggle-wishlist";
                    btnWishlist.dataset.id = productId;
                    btnWishlist.dataset.name = product.product_name;
                    btnWishlist.dataset.price = product.product_price;
                    btnWishlist.dataset.image = imagePath;
                    btnWishlist.setAttribute("aria-label", "Add to wishlist");
                }

                if (categoryDiv)
                    categoryDiv.textContent = product.product_category;
                if (nameH3) nameH3.textContent = product.product_name;

                const currentPriceVal = price_format(
                    product.product_price - product.product_discount
                );
                const oldPriceVal = price_format(product.product_price);

                if (priceCurrent)
                    priceCurrent.textContent = `Ksh: ${currentPriceVal}`;
                if (priceOld) priceOld.textContent = `Ksh: ${oldPriceVal}`;

                grid.appendChild(clone);
            });
        }
        pagination_handler();
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
