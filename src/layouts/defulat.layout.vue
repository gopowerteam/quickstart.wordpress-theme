<template lang="pug">
.app-container
  .app-content
    Header
    router-view
    Footer
</template>
<script setup lang="ts">
import { request, gql } from 'graphql-request'

import Header from './components/header.vue'
import Footer from './components/header.vue'


</script>

<style lang="stylus" scoped></style>