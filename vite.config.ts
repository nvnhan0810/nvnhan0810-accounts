import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.ts'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
    ],
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
            }
        }
    },
    resolve: {
        alias: {
            '@': '/resources/js',
            'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
        },
    },

});
