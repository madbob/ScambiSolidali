import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purge from '@erbelion/vite-plugin-laravel-purgecss';

export default defineConfig({
    build: {
        sourcemap: true,
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/torino.scss',
                'resources/sass/milano.scss',
                'resources/sass/trentino.scss',
                'resources/sass/valsusa.scss',
                'resources/sass/novara.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

        /*
        purge({
            templates: ['blade'],
        })
        */
    ],
});
