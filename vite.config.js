import { resolve, sep } from 'path'
import { defineConfig } from 'vite'
import { VitePWA } from 'vite-plugin-pwa'
import legacy from '@vitejs/plugin-legacy'
import liveReload from 'vite-plugin-live-reload'

// find theme dir name
export function getThemDir() {
  const _path = process.cwd().split(sep)
  return _path[_path.length - 1]
}

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    liveReload([__dirname + '/**/*.php']),
    legacy({
      additionalLegacyPolyfills: ['regenerator-runtime/runtime'],
      polyfills: [],
      modernPolyfills: [],
    }),
    VitePWA({
      registerType: 'autoUpdate',
      workbox: {
        globPatterns: ['**/*.{js,css,html,ico,png,svg}'],
      },
      // manifest: require('./pwa/manifest.json'),
    }),
  ],
  base:
    process.env.APP_ENV === 'development'
      ? `/wp-content/themes/${getThemDir()}/`
      : `/wp-content/themes/${getThemDir()}/dist/`,
  root: '',
  build: {
    // output dir for production build
    outDir: resolve(__dirname, 'dist'),
    emptyOutDir: true,
    manifest: true,
    // target: 'es6',
    rollupOptions: {
      input: resolve(__dirname, 'main.js'),
    },
  },
  server: {
    cors: true,
    strictPort: true,
    port: 3000,
    https: false,
    hmr: {
      protocol: 'ws',
      port: 3000,
      // host: 'localhost',
    },
  },
})
