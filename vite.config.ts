import { defineConfig } from "vite";
import eslint from "vite-plugin-eslint";
import laravel from "vite-plugin-laravel";
import tailwindcss from "tailwindcss"
import autoprefixer from "autoprefixer"

export default defineConfig({
    plugins: [
        eslint(),
        laravel({
            postcss: [tailwindcss(), autoprefixer()],
        }),
    ],
});
