<template lang="pug">
.app-container 
  .app-content.h-full.flex.flex-col.m-auto
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
.app-content
  max-width 1440px
  background-color #fff
</style>