import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/tiny-slider.css",
                "resources/js/tiny-slider.js",
                "resources/css/vendor/filament.css",
            ],
            refresh: true,
        }),
    ],
});
