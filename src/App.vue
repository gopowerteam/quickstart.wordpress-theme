<template lang="pug">
DefaultLayout
</template>

<script setup lang="ts">
import DefaultLayout from "./layouts/defulat.layout.vue";
</script>

<style>
@import "./style.css";

@tailwind base;
@tailwind components;
@tailwind utilities;

h1 {
    @apply text-3xl;
}
h2 {
    @apply text-2xl;
}
h3 {
    @apply text-xl;
}

html,
body {
    height: 100%;
    width: 100%;
}
</style>