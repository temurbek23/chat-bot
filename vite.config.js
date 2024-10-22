import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/chat-bot.css', 'resources/js/chat-bot.js'],
            refresh: true,
        }),
    ],
});
