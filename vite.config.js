import { defineConfig } from 'vite';
import { resolve } from 'path';
import legacy from '@vitejs/plugin-legacy';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  build: {
    outDir: resolve(__dirname, 'public/assets'),
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app: resolve(__dirname, 'resources/js/app.js'),
        styles: resolve(__dirname, 'resources/css/app.css'),
      },
      output: {
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]'
      }
    }
  },
  plugins: [
    tailwindcss(),
    legacy({
      targets: ['defaults', 'not IE 11']
    })
  ],
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources')
    }
  }
});
