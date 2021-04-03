
<template lang="pug">
.loan
    .top-image 
        img.h-width(:src="LoadImage")
    .product-container
        .product-category.text-center.p-10(v-for="(category,index) in dataSource" :style="{ backgroundColor: index % 2 == 1 ? '#f7f7f7' : '#fff' }")
            .title.primary-color {{ category.label }}
            .subTitle.text-sm {{ category?.connectedNode?.node.description }}
            .children-container.flex.flex-row.justify-center.pt-3
                .left-arrow
                .content.flex.flex-row
                    .product-item.p-2(v-for="product in category.children")
                        img(:src="product?.connectedNode?.node?.featuredImage?.node?.mediaItemUrl")
                        .title.text-xs.w-24.py-2 {{product.label}}
                .right-arrow
</template>
<script setup lang="ts">
import { onMounted, watch } from "@vue/runtime-core";
import LoadImage from '../assets/loan/loan-image.jpg'


const menus = JSON.parse(localStorage.getItem('menus') as string)
const dataSource: any[] = menus.find(x => x.label === '贷款业务').children




onMounted(() => {
    console.log(dataSource)
})
</script>

<style lang="stylus" scoped>
.primary-color
    color #219461
.secord-color
    color #F7B200
.product-container
    .children-container
        .product-item
            img
                width 100px
                height 100px
</style>
