import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/**
 * Arven Parfum — Vite Configuration
 *
 * Entry points yang di-bundle:
 *   CSS → resources/css/arven.css  (mengimport 7 file dari public/css/)
 *   JS  → resources/js/app.js      (mengimport auth, animation, navbar, cart)
 *
 * Output ke: public/build/assets/
 * Digunakan di Blade layout: @vite(['resources/css/arven.css', 'resources/js/app.js'])
 */
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/arven.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        watch: {
            ignored: ['**/storage/framework/views/**', '**/vendor/**'],
        },
    },
});
