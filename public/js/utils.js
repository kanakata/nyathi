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
    }, 5000);
})();
