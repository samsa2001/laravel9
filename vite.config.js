import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue({
            input: [
                'resources/js/vue/main.js', 
            ],
            refresh: true,
        }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js', 
            ],
            refresh: true,
        }),
    ],
});
