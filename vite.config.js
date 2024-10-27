import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import basicSsl from '@vitejs/plugin-basic-ssl'
import path from 'path'

const host = '127.0.0.1';
const port = '8000';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/css/main.css'],
            refresh: true,
        }),
        vue({
            template: {
                base: null,
                includeAbsolute: false
            }
        }),
        // basicSsl()
    ],
    // server: {
    //     // 005 enabling the HTTPS
    //     https: true,
    //     // 006 setting the proxy with Laravel as target (origin)
    //     proxy: {
    //         '^(?!(\/\@vite|\/resources|\/node_modules))': {
    //             target: `http://${host}:${port}`,
    //         }
    //     },
    //     host,
    //     port: 5173,
    //     // 007 be sure that you have the Hot Module Replacement
    //     hmr: { host },
    // }
    // resolve: {
    //     alias: {
    //         ziggy: path.resolve('vendor/tightenco/ziggy/dist/route.umd.js')
    //     }
    // }
});
