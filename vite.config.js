import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/admin.css",
                "resources/js/app.js",
                "resources/js/admin.js",
                "resources/js/products.js",
                "resources/js/chart.umd.min.js",
            ],
            refresh: true,
        }),
    ],
});
