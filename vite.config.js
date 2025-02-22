import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        rollupOptions: {
            preserveEntrySignatures: 'strict',
            input: [
                'resources/css/fonts.css',
                'resources/css/zinq.css',
                'resources/js/zinq.js',
            ]
        },
        outDir: 'dist',
        emptyOutDir: true,
    },
    optimizeDeps: {
        entries: [
            'resources/css/fonts.css',
            'resources/css/zinq.css',
        ],
        include: ['tailwindcss', 'autoprefixer']
    },
    css: {
        postcss: './postcss.config.js',
    },
});
