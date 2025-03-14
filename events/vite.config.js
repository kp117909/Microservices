import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            clientPort: 5175,
            host: 'localhost',
        },
        port: 5175,
        watch: {
            usePolling: true,
            pollInterval: 1000  
        }
    },
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    assetsInclude: ['**/*.ico', '**/*.png', '**/*.jpg'], // Dodaj obsługę favicon
});