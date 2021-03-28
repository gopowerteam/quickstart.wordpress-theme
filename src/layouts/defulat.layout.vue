<template lang="pug">
.app-container
  .app-content
    Header
    Menu
    .content
      router-view
    Footer
</template>
<script setup lang="ts">
import Header from './components/header.vue'
import Menu from './components/menu.vue'
import Footer from './components/footer.vue'


</script>

<style lang="stylus" scoped></style>