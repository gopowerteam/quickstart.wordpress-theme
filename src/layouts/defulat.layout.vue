<template lang="pug">
.app-container.absolute.inset-0
  .app-content.relative.flex.flex-col.m-auto
      Header
      Menu
      .content.flex-auto
        router-view
      Footer
</template>
<script setup lang="ts">
import Header from './components/header.vue'
import Menu from './components/menu.vue'
import Footer from './components/footer.vue'


</script>

<style lang="stylus" scoped>
.app-container
  background-color #f7f7f7
  min-height 100%
  overflow auto
.app-content
  max-width 1280px
  min-width 1024px
  min-height 100%
  background-color #fff
 
</style>