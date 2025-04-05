import { defineConfig } from 'vite';
import { resolve } from 'path';
import legacy from '@vitejs/plugin-legacy';

const projectRoot = resolve(__dirname, '..');

export default defineConfig({
  build: {
    outDir: resolve(projectRoot, 'public/assets'),
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app: resolve(projectRoot, 'resources/js/app.js'),
        styles: resolve(projectRoot, 'resources/css/input.css'),
      },
      output: {
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]'
      }
    }
  },
  plugins: [
    legacy({
      targets: ['defaults', 'not IE 11']
    })
  ],
  resolve: {
    alias: {
      '@': resolve(projectRoot, 'resources')
    }
  }
});
