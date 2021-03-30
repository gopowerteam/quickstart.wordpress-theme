import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import copy from 'rollup-plugin-copy'

const production = process.env.NODE_ENV === 'production'
// https://vitejs.dev/config/

export default defineConfig({
  base: production ? '/wp-content/themes/default-theme/' : '/',
  plugins: [vue(), copy({
    targets: [{
      src: ['./theme/*'],
      dest: ['./dist']
    }],
    hook: 'writeBundle' // notice here
  })],
  build: {
    manifest: true
  }
})
