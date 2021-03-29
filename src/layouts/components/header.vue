<template lang="pug">
.title.text-sm.flex.flex-row.justify-between.py-3.px-5 
    .today {{today}}
    .hotline 服务热线：{{hotline}}
.logo



</template>
<script setup lang="ts">
import dayjs from "dayjs"
const today = dayjs().format("YYYY年M月DD日 dddd")
const hotline = "96262 10106262"

</script>
<style lang="stylus" scoped>
.title
    background-color #F7F7F7
</style>