(function () {
    const [$, $$, on] = [
        (sel) => document.querySelector(sel),
        (sel, ctx = document) => [...ctx.querySelectorAll(sel)],
        (el, ev, fn) => el && el.addEventListener(ev, fn),
    ];

    function announcement() {
        const announcement_bar = $(".announcement-bar");
        announcement_bar.addEventListener("click", () => {
            announcement_bar.remove();
            document.body.setAttribute("style", "overflow: scroll");
        });
    }

    (function initHeader() {
        const header = $(".site-header");
        if (!header) return;
        window.addEventListener(
            "scroll",
            () => {
                header.classList.toggle("scrolled", window.scrollY > 60);
            }
            // { passive: true }
        );
    })();

    (function initMobileMenu() {
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

    (function initSearch() {
        const overlay = $(".search-overlay");
        const openBtns = $$('[data-action="open-search"]');
        const closeBtn = $(".search-close");
        const input = $(".search-input-wrap input");
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
        const [pagination_top, pagination_bottom] = [
            $$(".pagination.top .page"),
            $$(".pagination.bottom .page"),
        ];

        if (window.screen.width <= 750) {
            if (pagination_top.length > 10) {
                pagination_top.forEach((pag) => {
                    pag.remove();
                });
            }
        }
        if (window.screen.width <= 750) {
            if (pagination_bottom.length > 10) {
                pagination_bottom.forEach((pag) => {
                    pag.remove();
                });
            }
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
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span class="toast-icon">${
                icons[type] || icons.info
            }</span><span class="toast-msg">${message}</span>`;
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
            this.updateBadges();
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

        updateBadges() {
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
            this.updateBadges();
        },

        toggle(product) {
            const items = this.getItems();
            const exists = items.find((i) => i.id === product.id);
            if (exists) {
                this.save(items.filter((i) => i.id !== product.id));
                Toast.show(`Removed from wishlist`, "info");
                return false;
            } else {
                items.push(product);
                this.save(items);
                Toast.show(`Added to wishlist`, "success");
                return true;
            }
        },

        has(id) {
            return this.getItems().some((i) => i.id === id);
        },

        getCount() {
            return this.getItems().length;
        },

        updateBadges() {
            const count = this.getCount();
            $$(".wishlist-count").forEach((el) => {
                el.textContent = count;
                el.style.display = count ? "flex" : "none";
            });
        },
    };

    function initAddToCart() {
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

    function initWishlistToggle() {
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
    function initGallery() {
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

    function initSizeSelector() {
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

    function initQtyControl() {
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

    function initCountdown() {
        const el = $(".promo-timer");
        if (!el) return;
        const endDate = new Date(el.dataset.end || Date.now() + 86400000 * 3);

        function update() {
            const diff = endDate - Date.now();
            if (diff <= 0) {
                el.innerHTML = "<p>Offer ended</p>";
                return;
            }
            const d = Math.floor(diff / 86400000);
            const h = Math.floor((diff % 86400000) / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            const pad = (n) => String(n).padStart(2, "0");
            el.innerHTML = `
      <div class="timer-unit"><div class="timer-num">${pad(
          d
      )}</div><div class="timer-label">Days</div></div>
      <div class="timer-unit"><div class="timer-num">${pad(
          h
      )}</div><div class="timer-label">Hours</div></div>
      <div class="timer-unit"><div class="timer-num">${pad(
          m
      )}</div><div class="timer-label">Mins</div></div>
      <div class="timer-unit"><div class="timer-num">${pad(
          s
      )}</div><div class="timer-label">Secs</div></div>
    `;
        }
        update();
        setInterval(update, 1000);
    }

    function initViewToggle() {
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

    function initSort() {
        const sel = $(".sort-select");
        if (!sel) return;
        sel.addEventListener("change", () => {
            // Normally this would trigger a server-side sort via PHP GET param
            const url = new URL(window.location);
            url.searchParams.set("sort", sel.value);
            window.location = url.toString();
        });
    }

    function renderCartPage() {
        const container = $("#cart-items-container");
        if (!container) return;

        const items = Cart.getItems();

        if (!items.length) {
            container.innerHTML = `
      <div style="text-align:center;padding:4rem 0">
        <p style="font-size:3rem;margin-bottom:1rem">🛍️</p>
        <h3>Your cart is empty</h3>
        <p style="margin:1rem 0 2rem">Looks like you haven't added anything yet.</p>
        <a href="/user/shop" class="btn btn-primary">Explore Products</a>
      </div>`;
            return;
        }

        container.innerHTML = items
            .map(
                (item) => `
    <div class="cart-item" data-key="${item.key}">
      <img class="cart-item-img" src="${
          item.image || "/assets/images/placeholder.jpg"
      }" alt="${item.name}">
      <div>
        <div class="cart-item-name">${item.name}</div>
        <div class="cart-item-variant">${[item.size, item.color]
            .filter(Boolean)
            .join(" · ")}</div>
        <div class="cart-item-controls">
          <div class="qty-control">
            <button class="qty-btn" data-action="dec" data-key="${
                item.key
            }">−</button>
            <input class="qty-input" type="number" value="${
                item.qty
            }" min="1" data-key="${item.key}">
            <button class="qty-btn" data-action="inc" data-key="${
                item.key
            }">+</button>
          </div>
          <button class="cart-item-remove" data-key="${
              item.key
          }">Remove</button>
        </div>
      </div>
      <div class="cart-item-price">Ksh: ${(item.price * item.qty).toFixed(
          2
      )}</div>
    </div>
  `
            )
            .join("");

        updateOrderSummary();
    }

    function updateOrderSummary() {
        const items = Cart.getItems();
        const subtotal = Cart.getTotal();
        const total = subtotal;

        const set = (sel, val) => {
            const el = $(sel);
            if (el) el.textContent = val;
        };
        set("#summary-subtotal", `Ksh: ${subtotal.toFixed(2)}`);

        set("#summary-total", `Ksh: ${total.toFixed(2)}`);
    }

    function initCartPage() {
        if (!$("#cart-items-container")) return;
        renderCartPage();
        document.addEventListener("click", (e) => {
            const removeBtn = e.target.closest(".cart-item-remove");
            if (removeBtn) {
                Cart.removeItem(removeBtn.dataset.key);
                renderCartPage();
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
                renderCartPage();
            }
        });
    }

    function initWishlistPage() {
        const container = $("#wishlist-container");
        if (!container) return;
        const items = Wishlist.getItems();
        if (!items.length) {
            container.innerHTML = `<div style="text-align:center;padding:4rem 0"><p style="font-size:3rem;margin-bottom:1rem">♡</p><h3>Your wishlist is empty</h3><p style="margin:1rem 0 2rem">Save items you love for later.</p><a href="/shop" class="btn btn-primary">Shop Now</a></div>`;
            return;
        }
        container.innerHTML = `<div class="wishlist-grid">${items
            .map(
                (item) => `
    <div class="product-card">
      <div class="product-image-wrap">
        <img src="${item.image || "/assets/images/placeholder.jpg"}" alt="${
                    item.name
                }">
        <div class="product-actions-hover">
          <button class="btn-add-cart" data-action="add-to-cart" data-id="${
              item.id
          }" data-name="${item.name}" data-price="${item.price}" data-image="${
                    item.image
                }">Add to Cart</button>
          <button class="btn-wishlist" data-action="toggle-wishlist" data-id="${
              item.id
          }" data-name="${item.name}" data-price="${item.price}">♥</button>
        </div>
      </div>
      <div class="product-info">
        <div class="product-name">${item.name}</div>
        <div class="product-price"><span class="price-current">Ksh: ${item.price.toFixed(
            2
        )}</span></div>
      </div>
    </div>`
            )
            .join("")}</div>`;
    }

    function initCheckoutPage() {
        const container = $("#checkout-items");
        if (!container) return;
        const items = Cart.getItems();
        container.innerHTML = items
            .map(
                (i) => `
    <div class="summary-row">
      <span>${i.name} × ${i.qty}</span>
      <span>$${(i.price * i.qty).toFixed(2)}</span>
    </div>`
            )
            .join("");
        updateOrderSummary();
    }

    function initPasswordToggle() {
        $$("[data-toggle-password]").forEach((btn) => {
            btn.addEventListener("click", () => {
                const input = document.getElementById(
                    btn.dataset.togglePassword
                );
                if (!input) return;
                input.type = input.type === "password" ? "text" : "password";
                btn.textContent = input.type === "password" ? "👁" : "🙈";
            });
        });
    }

    function initScrollReveal() {
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

    document.addEventListener("DOMContentLoaded", () => {
        Toast.init();
        Cart.updateBadges();
        Wishlist.updateBadges();
        announcement();
        initAddToCart();
        initWishlistToggle();
        initGallery();
        initSizeSelector();
        initQtyControl();
        initCountdown();
        initViewToggle();
        initSort();
        initCartPage();
        initWishlistPage();
        initCheckoutPage();
        initPasswordToggle();
        initScrollReveal();
    });
})();
