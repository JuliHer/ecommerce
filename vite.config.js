import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: 'ecommerce.com',  // Tu dominio local
        port: 5173,
        cors: true,   
        https: false,           // Usa false si no configuraste HTTPS en local
        hmr: {
            host: 'ecommerce.com',  // Debe coincidir con tu dominio
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
