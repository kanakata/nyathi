(function () {
    const [$, $$] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
    ];

    const pagination = $$(".pagination .page-btn");

    pagination.forEach((pag) => {
        pag.addEventListener("click", function () {
            pagination.forEach((element) => {
                element.classList.remove("active");
            });
            pag.classList.add("active");
            const page = pag.getAttribute("data-page");
            ajax(`/user/shop/page/${page}`, (result) => {
                const data = result;

                const [
                    product_images,
                    product_badges,
                    product_links,
                    product_cart,
                    product_wishlist,
                    product_category,
                    product_name,
                    product_name_link,
                    product_price,
                    products_count,
                ] = [
                    $$(".product-card .product-image-wrap img"),
                    $$(".product-card .product-image-wrap .product-badge"),
                    $$(".product-card .product-image-wrap .product-link"),
                    $$(".product-card .product-image-wrap .btn-add-cart"),
                    $$(".product-card .product-image-wrap .btn-wishlist"),
                    $$(".product-card .product-info .product-category"),
                    $$(".product-card .product-info .product-name"),
                    $$(".product-card .product-info .product-link"),
                    $$(
                        ".product-card .product-info .product-price .price-current"
                    ),
                    $(".shop-layout .shop-count"),
                ];

                products_count.textContent = `Showing ${data.product_cumulative} of ${data.total} products`;

                data.products.forEach((product, index) => {
                    if (product.product_badge == "available") {
                        if (product_links[index].href != undefined) {
                            delete product_links[index].href;
                        }
                        product_links[index].setAttribute(
                            "href",
                            `/user/product/${data.products_id[index]}`
                        );
                        product_cart[index].textContent = "add to cart";
                        product_cart[index].disabled = false;
                        product_name_link[
                            index
                        ].href = `/users/product/${data.products_id[index]}`;
                    } else {
                        if (product_links[index].href != undefined) {
                            product_links[index].removeAttribute("href");
                            product_name_link[index].removeAttribute("href");
                        }
                        product_cart[index].textContent = "sold out";
                        product_cart[index].disabled = true;
                    }

                    [
                        product_images[index].src,
                        product_badges[index].textContent,
                        product_name[index].textContent,
                        product_category[index].textContent,
                        product_price[index].textContent,
                    ] = [
                        `/assets/images/${product.product_image}`,
                        product.product_badge,
                        product.product_name,
                        product.product_category,
                        `Ksh: ${product.product_price.toFixed(2)}`,
                    ];

                    product_badges[index].setAttribute(
                        "class",
                        `product-badge badge-${product.product_badge}`
                    );

                    product_badges[index].setAttribute(
                        "alt",
                        product.product_name
                    );

                    const product_meta = [
                        product.product_id,
                        product.product_name,
                        product.product_image,
                        product.product_price,
                    ];

                    const data_id = ["id", "name", "image", "price"];
                    product_meta.forEach((meta, i) => {
                        if (`data-${data_id[i]}` == "data-image") {
                            product_cart[index].setAttribute(
                                `data-${data_id[i]}`,
                                `/assets/images/${meta}`
                            );
                            product_wishlist[index].setAttribute(
                                `data-${data_id[i]}`,
                                `/assets/images/${meta}`
                            );
                        } else {
                            product_cart[index].setAttribute(
                                `data-${data_id[i]}`,
                                meta
                            );
                            product_wishlist[index].setAttribute(
                                `data-${data_id[i]}`,
                                meta
                            );
                        }
                    });
                });
            });
        });
    });

    function ajax(url, callback) {
        const http = fetch(url, {
            method: "GET",
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("bad");
                } else {
                    return response.json();
                }
            })
            .then((data) => {
                callback(data);
            })
            .catch((error) => {
                console.log(error);
            });
    }
})();
