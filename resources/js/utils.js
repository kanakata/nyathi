window.addEventListener("load", () => {
    scroll_top();
    window.scrollTo({ top: 0 });
});
function price_format(price) {
    let price_string = String(price);
    let formatted_price = [];
    for (let i = 1; i <= price_string.length; i++) {
        if (i % 3 == 0) {
            formatted_price.unshift(",", price_string[price_string.length - i]);
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
    return localStorage.getItem(name);
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
        const activePageEl = document.querySelector(".pagination .page.active");
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
            el.style.display !== "none" && !isNaN(parseInt(el.textContent, 10))
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
