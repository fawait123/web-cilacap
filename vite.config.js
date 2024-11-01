import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import autoprefixer from 'autoprefixer';
import tailwind from 'tailwindcss';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url'
import path from 'node:path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['frontend/assets/css/app.css', 'frontend/app.js'],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./frontend', import.meta.url)),
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js'),
        }
    },
    css: {
        postcss: {
            plugins: [tailwind(), autoprefixer()],
        },
    },
});
