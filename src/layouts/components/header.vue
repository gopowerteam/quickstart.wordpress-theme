<template lang="pug">
.title.text-sm.flex.flex-row.justify-between.py-3.px-5 
    .today {{today}}
    .hotline 服务热线：{{hotline}}
.logo.flex.items-center.justify-between.px-20.py-5
    img.w-80(:src="Logo")
    .slogo.primary-color 惠农 · 兴商 · 富秦


</template>
<script setup lang="ts">
import dayjs from "dayjs"
import Logo from '../../assets/logo.jpg'
const today = dayjs().format("YYYY年M月DD日 dddd")
const hotline = "96262 10106262"

</script>
<style lang="stylus" scoped>
.primary-color
    color #0F5033
.title
    background-color #fff
</style>