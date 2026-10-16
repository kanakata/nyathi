(function () {
    document.addEventListener("DOMContentLoaded", () => {
        Toast.init();
        Cart.update_badges();
        Wishlist.update_badges();
        add_to_cart();
        wishlist_toggle();
        gallery();
        size_selector();
        qty_control();
        countdown();
        view_toggle();
        sort();
        cart_page();
        wishlist_page();
        checkout_page();
        scroll_reveal();
        pagination_handler();
        scroll_top();
        window.scrollTo({ top: 0 });
    });

    (function () {
        document
            .querySelector(".theme-toggle")
            .addEventListener("click", () => {
                let theme = get(`nyathi-theme`);
                if (!theme) {
                    store(`nyathi-theme`, "dark");
                    document.body.classList.toggle("dark");
                } else {
                    if (theme == "dark") {
                        store(`nyathi-theme`, "light");
                        document.body.classList.toggle("light");
                    } else {
                        store(`nyathi-theme`, "dark");
                        document.body.classList.toggle("dark");
                    }
                }
            });
    })();

    function price_format(price) {
        let price_string = String(price);
        let formatted_price = [];
        for (let i = 1; i <= price_string.length; i++) {
            if (i % 3 == 0) {
                formatted_price.unshift(
                    ",",
                    price_string[price_string.length - i]
                );
            } else {
                formatted_price.unshift(price_string[price_string.length - i]);
            }
        }
        return `${formatted_price.join("")}.00`;
    }
    const [$, $$, on] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
        (el, ev, fn) => el && el.addEventListener(ev, fn),
    ];
    function store(name, data) {
        localStorage.setItem(name, data);
    }

    function get(name) {
        return localStorage.getItem(name) ?? null;
    }

    function del(name) {
        localStorage.removeItem(name);
    }
    (function () {
        const header = $(".site-header");
        if (!header) return;
        window.addEventListener("scroll", () => {
            header.classList.toggle("scrolled", window.scrollY > 60);
        });
    })();

    function scroll_top() {
        const scroll_top_btn = document.createElement("div");
        scroll_top_btn.className = "scroll-top";
        scroll_top_btn.textContent = "↑";
        scroll_top_btn.addEventListener("click", () => {
            window.scrollTo({ top: 0 });
        });
        document.body.appendChild(scroll_top_btn);
    }

    (function () {
        const announcement_bar = $(".announcement-bar");
        announcement_bar.addEventListener("click", () => {
            announcement_bar.remove();
            document.body.setAttribute("style", "overflow: scroll");
        });

        setTimeout(() => {
            announcement_bar.remove();
            announcement_bar.removeEventListener("click", () => {});
            document.body.setAttribute("style", "overflow: scroll");
        }, 3000);
    })();

    function pagination_handler() {
        if (window.location.pathname != "/user/shop") return;
        const paginations = Array.from($$(".pagination .page"));
        const totalPages = Math.ceil(paginations.length / 2);
        if (totalPages > 5) {
            const activePageEl = document.querySelector(
                ".pagination .page.active"
            );
            console.log(activePageEl);

            const currentPage = activePageEl
                ? parseInt(
                      activePageEl.dataset.page || activePageEl.textContent,
                      10
                  )
                : 1;

            console.log(currentPage);

            paginations.forEach((pageEl) => {
                const pageNum = parseInt(
                    pageEl.dataset.page || pageEl.textContent,
                    10
                );

                if (isNaN(pageNum)) return;

                const isFirstPage = pageNum === 1;
                const isLastPage = pageNum === totalPages;
                const isNearCurrent = Math.abs(pageNum - currentPage) <= 1;

                if (isFirstPage || isLastPage || isNearCurrent) {
                    pageEl.style.display = ""; // Show element
                    if (pageEl.classList.contains("has-ellipsis")) {
                        pageEl.classList.remove("has-ellipsis");
                    }
                } else {
                    pageEl.style.display = "none"; // Hide element
                }
            });

            render_ellipses();
        }
    }

    function render_ellipses() {
        if (window.location.pathname != "/user/shop") return;
        document
            .querySelectorAll(".pagination .ellipsis")
            .forEach((el) => el.remove());

        const visiblePages = Array.from(
            document.querySelectorAll(".pagination .page")
        ).filter(
            (el) =>
                el.style.display !== "none" &&
                !isNaN(parseInt(el.textContent, 10))
        );

        for (let i = 0; i < visiblePages.length - 1; i++) {
            const currentNum = parseInt(visiblePages[i].textContent, 10);
            const nextNum = parseInt(visiblePages[i + 1].textContent, 10);

            if (nextNum - currentNum > 1) {
                const ellipsis = document.createElement("span");
                ellipsis.className = "page ellipsis";
                ellipsis.textContent = "...";
                ellipsis.style.pointerEvents = "none"; // Prevent clicks

                visiblePages[i].after(ellipsis);
            }
        }
    }

    (function () {
        const hamburger = $(".hamburger");
        const navMenu = $(".nav-menu");
        if (!hamburger || !navMenu) return;
        hamburger.addEventListener("click", () => {
            const open = navMenu.classList.toggle("mobile-open");
            hamburger.setAttribute("aria-expanded", open);
            navMenu.style.cssText = open
                ? "display:flex;flex-direction:column;position:fixed;top:72px;left:0;right:0;background:var(--surface);padding:2rem;gap:1.5rem;border-bottom:1px solid var(--border);z-index:999"
                : "";
        });
    })();

    (function () {
        const [overlay, openBtns, closeBtn, input] = [
            $(".search-overlay"),
            $$('[data-action="open-search"]'),
            $(".search-close"),
            $(".search-input-wrap input"),
        ];

        if (!overlay) return;

        openBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                overlay.classList.add("open");
                input?.focus();
            });
        });

        closeBtn?.addEventListener("click", () =>
            overlay.classList.remove("open")
        );

        overlay.addEventListener("click", (e) => {
            if (e.target === overlay) overlay.classList.remove("open");
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") overlay.classList.remove("open");
        });
    })();

    (function () {
        const show_password = $("#show-password") ?? null;
        if (show_password) {
            $("#show-password").addEventListener("click", () => {
                if ($("#password").getAttribute("type") == "password") {
                    $("#password").setAttribute("type", "text");
                    $("#show-password").textContent = "^_^";
                } else {
                    $("#password").setAttribute("type", "password");
                    $("#show-password").textContent = "~_~";
                }
            });
        }
    })();

    const Toast = {
        container: null,
        init() {
            this.container = document.createElement("div");
            this.container.className = "toast-container";
            document.body.appendChild(this.container);
        },
        show(message, type = "info", duration = 1500) {
            const icons = { success: "✓", error: "✕", info: "→", warning: "!" };
            const toast = document.createElement("div");
            const icon = document.createElement("span");
            const mess = document.createElement("span");
            toast.className = `toast ${type}`;
            icon.classList.add("toast-icon");
            icon.textContent = icons[type] || icons.info;
            mess.className = "toast-icon";
            mess.textContent = message;
            const toast_children = [icon, mess];
            for (let i = 0; i < toast_children.length; i++) {
                toast.appendChild(toast_children[i]);
            }
            this.container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = "0";
                toast.style.transform = "translateX(100%)";
                toast.style.transition = "all 0.3s ease";
                setTimeout(() => toast.remove(), 300);
            }, duration);
        },
    };

    const Cart = {
        key: "nyathi_cart",

        getItems() {
            try {
                return JSON.parse(localStorage.getItem(this.key)) || [];
            } catch {
                return [];
            }
        },

        save(items) {
            localStorage.setItem(this.key, JSON.stringify(items));
            this.update_badges();
            document.dispatchEvent(
                new CustomEvent("cart:updated", { detail: items })
            );
        },

        addItem(product) {
            const items = this.getItems();
            const key = `${product.id}_${product.size || ""}_${
                product.color || ""
            }`;
            const exist = items.find((i) => i.key === key);
            if (exist) {
                exist.qty += product.qty || 1;
            } else {
                items.push({ ...product, key, qty: product.qty || 1 });
            }
            this.save(items);
            Toast.show(`"${product.name}" added to cart`, "success");
        },

        removeItem(key) {
            this.save(this.getItems().filter((i) => i.key !== key));
        },

        updateQty(key, qty) {
            const items = this.getItems().map((i) =>
                i.key === key ? { ...i, qty: Math.max(1, qty) } : i
            );
            this.save(items);
        },

        clear() {
            this.save([]);
        },

        getTotal() {
            return this.getItems().reduce((sum, i) => sum + i.price * i.qty, 0);
        },

        getCount() {
            return this.getItems().reduce((sum, i) => sum + i.qty, 0);
        },

        update_badges() {
            const count = this.getCount();
            $$(".cart-count").forEach((el) => {
                el.textContent = count;
                el.style.display = count ? "flex" : "none";
            });
        },
    };

    const Wishlist = {
        key: "nyathi_wishlist",

        getItems() {
            try {
                return JSON.parse(localStorage.getItem(this.key)) || [];
            } catch {
                return [];
            }
        },

        save(items) {
            localStorage.setItem(this.key, JSON.stringify(items));
            this.update_badges();
        },

        toggle(product) {
            const items = this.getItems();
            const exists = items.find((i) => i.id === product.id);
            if (exists) {
                this.save(items.filter((i) => i.id !== product.id));
                Toast.show(`Removed from wishlist`, "info");
                wishlist_page();
                return false;
            } else {
                items.push(product);
                this.save(items);
                Toast.show(`Added to wishlist`, "success");
                wishlist_page();
                return true;
            }
        },

        has(id) {
            return this.getItems().some((i) => i.id === id);
        },

        getCount() {
            return this.getItems().length;
        },

        update_badges() {
            const count = this.getCount();
            $$(".wishlist-count").forEach((el) => {
                el.textContent = count;
                el.style.display = count ? "flex" : "none";
            });
        },
    };

    function add_to_cart() {
        document.addEventListener("click", (e) => {
            const btn = e.target.closest('[data-action="add-to-cart"]');
            if (!btn) return;
            e.preventDefault();
            const product = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: parseFloat(btn.dataset.price),
                image: btn.dataset.image || "",
                size: btn.dataset.size || "",
                color: btn.dataset.color || "",
                qty: 1,
            };
            Cart.addItem(product);
            btn.classList.add("added");
            setTimeout(() => btn.classList.remove("added"), 1500);
        });
    }

    function wishlist_toggle() {
        document.addEventListener("click", (e) => {
            const btn = e.target.closest('[data-action="toggle-wishlist"]');
            if (!btn) return;
            e.preventDefault();
            const product = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: parseFloat(btn.dataset.price),
                image: btn.dataset.image || "",
            };
            const added = Wishlist.toggle(product);
            btn.classList.toggle("active", added);
            btn.innerHTML = added ? "♥" : "♡";
        });
    }

    function gallery() {
        const thumbs = $$(".gallery-thumb");
        const main = $(".gallery-main img");
        if (!thumbs.length || !main) return;
        thumbs.forEach((thumb) => {
            thumb.addEventListener("click", () => {
                thumbs.forEach((t) => t.classList.remove("active"));
                thumb.classList.add("active");
                const src = thumb.querySelector("img")?.src;
                if (src) {
                    main.style.opacity = "0";
                    setTimeout(() => {
                        main.src = src;
                        main.style.opacity = "1";
                    }, 200);
                    main.style.transition = "opacity 0.2s ease";
                }
            });
        });
    }

    function size_selector() {
        const sizeBtns = $$(".size-btn:not(.unavailable)");
        sizeBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                const group = btn.closest(".size-options");
                $$(".size-btn", group).forEach((b) =>
                    b.classList.remove("active")
                );
                btn.classList.add("active");
                const addBtn = document.querySelector(
                    '[data-action="add-to-cart"]'
                );
                if (addBtn) addBtn.dataset.size = btn.dataset.size;
            });
        });
    }

    function qty_control() {
        document.addEventListener("click", (e) => {
            const btn = e.target.closest(".qty-btn");
            if (!btn) return;
            const wrap = btn.closest(".qty-control");
            const input = wrap?.querySelector(".qty-input");
            if (!input) return;
            let val = parseInt(input.value) || 1;
            if (btn.dataset.action === "inc") val++;
            if (btn.dataset.action === "dec") val = Math.max(1, val - 1);
            input.value = val;
            input.dispatchEvent(new Event("change"));
        });
    }

    function countdown() {
        if (window.location.pathname != "/") return;
        const promo_timer = $(".promo-timer");
        const promo_template = $("#promo-timer").content.cloneNode(true);
        const end = document.createElement("p");
        const timer_units = promo_template.querySelectorAll(
            ".timer-unit .timer-num"
        );
        if (!promo_timer) return;
        const endDate = new Date(
            promo_timer.dataset.end || Date.now() + 86400000 * 3
        );

        function update() {
            const diff = endDate - Date.now();
            if (diff <= 0) {
                end.textContent = "Offer ended";
                promo_timer.appendChild(end);
                return;
            }
            let clock = [
                Math.floor(diff / 86400000),
                Math.floor((diff % 86400000) / 3600000),
                Math.floor((diff % 3600000) / 60000),
                Math.floor((diff % 60000) / 1000),
            ];
            const pad = (n) => String(n).padStart(2, "0");
            for (let i = 0; i < timer_units.length; i++) {
                timer_units[i].textContent = pad(clock[i]);
            }
            promo_timer.appendChild(promo_template);
        }
        update();
        setInterval(update, 1000);
    }

    function view_toggle() {
        const grid = $(".products-grid");
        const btns = $$(".view-btn");
        if (!grid) return;
        btns.forEach((btn) => {
            btn.addEventListener("click", () => {
                btns.forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
                if (btn.dataset.view === "list") {
                    grid.style.gridTemplateColumns = "1fr";
                } else {
                    grid.style.gridTemplateColumns = "";
                }
            });
        });
    }

    function sort() {
        const sel = $(".sort-select");
        if (!sel) return;
        sel.addEventListener("change", () => {
            const url = new URL(window.location);
            url.searchParams.set("sort", sel.value);
            window.location = url.toString();
        });
    }

    function render_cart_page() {
        if (window.location.pathname != "/user/cart") return;
        const container = $("#cart-items-container");
        container.innerHTML = "";
        if (!container) return;

        const items = Cart.getItems();

        if (!items.length) {
            container.appendChild(
                $("#empty-cart-template").content.cloneNode(true)
            );
            return;
        }

        items.forEach((item) => {
            const cart_template = $("#cart-template").content.cloneNode(true);
            cart_template.querySelector(".cart-item").dataset.key = item.key;
            cart_template.querySelector(
                ".cart-item .cart-item-remove"
            ).dataset.key = item.key;
            cart_template.querySelector(".cart-item img").src =
                item.image || "/assets/images/placeholder.jpg";
            cart_template.querySelector(".cart-item img").alt = item.image;
            cart_template.querySelector(
                ".cart-item .cart-item-name"
            ).textContent = item.name;
            cart_template.querySelector(
                ".cart-item .cart-item-variant"
            ).textContent = [item.name, item.color].join(" -.- ");
            cart_template.querySelector(
                ".cart-item .cart-item-price"
            ).textContent = `Ksh: ${price_format(item.price)}`;
            cart_template.querySelector(
                ".cart-item .qty-control .qty-btn.dec"
            ).dataset.key = item.key;
            cart_template.querySelector(
                ".cart-item .qty-control .qty-btn.inc"
            ).dataset.key = item.key;
            cart_template.querySelector(
                ".cart-item .qty-control .qty-input"
            ).dataset.key = item.key;
            cart_template.querySelector(
                ".cart-item .qty-control .qty-input"
            ).value = item.qty;
            container.appendChild(cart_template);
        });

        update_order_summary();
    }

    function update_order_summary() {
        const subtotal = Cart.getTotal();
        const total = subtotal;
        const set = (sel, val) => {
            const el = $(sel);
            if (el) el.textContent = val;
        };
        set("#summary-subtotal", `Ksh: ${price_format(subtotal)}`);
        set("#summary-total", `Ksh: ${price_format(total)}`);
    }

    function cart_page() {
        if (!$("#cart-items-container")) return;
        render_cart_page();
        document.addEventListener("click", (e) => {
            const removeBtn = e.target.closest(".cart-item-remove");
            if (removeBtn) {
                Cart.removeItem(removeBtn.dataset.key);
                render_cart_page();
            }
            const qtyBtn = e.target.closest(".qty-btn[data-key]");
            if (qtyBtn) {
                const input = document.querySelector(
                    `.qty-input[data-key="${qtyBtn.dataset.key}"]`
                );
                if (!input) return;
                let val = parseInt(input.value) || 1;
                if (qtyBtn.dataset.action === "inc") val++;
                if (qtyBtn.dataset.action === "dec") val = Math.max(1, val - 1);
                Cart.updateQty(qtyBtn.dataset.key, val);
                render_cart_page();
            }
        });
    }

    function wishlist_page() {
        if (window.location.pathname != "/user/wishlist") return;
        const container = $("#wishlist-container");
        container.innerHTML = "";
        const wishlist_grid = document.createElement("div");
        wishlist_grid.className = "wishlist-grid";
        container.appendChild(wishlist_grid);
        if (!container) return;
        const items = Wishlist.getItems();
        if (!items.length) {
            container.appendChild($("#empty-wishlist").content.cloneNode(true));
            return;
        }
        items.forEach((item, index) => {
            const wishlist_template =
                $("#wishlist-template").content.cloneNode(true);
            wishlist_template.querySelector(".product-image-wrap img").src =
                item.image || "/assets/images/placeholder.jpg";
            wishlist_template.querySelector(".product-image-wrap img").alt =
                item.image ?? "";
            wishlist_template.querySelector(
                ".product-image-wrap .btn-add-cart"
            ).dataset.id = item.id;
            wishlist_template.querySelector(
                ".product-image-wrap .btn-add-cart"
            ).dataset.name = item.name;
            wishlist_template.querySelector(
                ".product-image-wrap .btn-add-cart"
            ).dataset.price = item.price;
            wishlist_template.querySelector(
                ".product-image-wrap .btn-wishlist"
            ).dataset.id = item.id;
            wishlist_template.querySelector(
                ".product-image-wrap .btn-wishlist"
            ).dataset.name = item.name;
            wishlist_template.querySelector(
                ".product-image-wrap .btn-wishlist"
            ).dataset.price = item.price;
            wishlist_template.querySelector(
                ".product-info .product-price"
            ).textContent = `Ksh: ${price_format(item.price)}`;
            wishlist_template.querySelector(
                ".product-info .product-name"
            ).textContent = `Wish ${++index}: ${item.name}`;

            $("#wishlist-container .wishlist-grid").appendChild(
                wishlist_template
            );
        });
    }

    function checkout_page() {
        if (window.location.pathname != "/user/checkout") return;
        const container = $("#checkout-items");
        if (!container) return;
        const items = Cart.getItems();
        items.forEach((item) => {
            const summary_template =
                $("#summary-template").content.cloneNode(true);
            summary_template.querySelector(
                "#name"
            ).textContent = `${item.name} × ${item.qty}`;
            summary_template.querySelector("#price").textContent = `Ksh: ${(
                item.price * item.qty
            ).toFixed(2)}`;
            container.appendChild(summary_template);
        });
        update_order_summary();
    }

    function scroll_reveal() {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = "1";
                        entry.target.style.transform = "translateY(0)";
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1, rootMargin: "0px 0px -50px 0px" }
        );

        $$(
            ".product-card, .category-card, .feature-item, .testimonial-card"
        ).forEach((el) => {
            el.style.opacity = "0";
            el.style.transform = "translateY(24px)";
            el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            observer.observe(el);
        });
    }
})();
