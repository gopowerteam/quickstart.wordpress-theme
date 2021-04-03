
<template lang="pug">
.loan
    .top-image 
        img.h-width(:src="LoadImage")
    .product-container(v-if="dataSource")
        .product-category.text-center.p-10(v-for="(category,index) in dataSource" :style="{ backgroundColor: index % 2 == 1 ? '#f7f7f7' : '#fff' }")
            .title.primary-color {{ category.label }}
            .subTitle.text-sm {{ category?.connectedNode?.node.description }}
            .children-container.flex.flex-row.justify-center.pt-3
                .left-arrow.pt-10(@click="pageIndex[index] -= 1" :style="{ visibility: pageIndex[index] > 0 ? 'visible' : 'hidden' }")
                    img(:src="LeftIcon")
                .content.flex.flex-row
                    .product-item.p-2(v-for="product in category?.children?.slice(0+pageIndex[index]*4,4+pageIndex[index]*4)")
                        img(:src="product?.connectedNode?.node?.featuredImage?.node?.mediaItemUrl")
                        .title.text-xs.w-24.py-2 {{ product.label }}
                .right-arrow.pt-10(@click="pageIndex[index] += 1" :style="{ visibility: (pageIndex[index] * 4 + 4) < category?.children?.length ? 'visible' : 'hidden' }")
                    img(:src="RightIcon")
</template>
<script setup lang="ts">
import { onMounted, watch } from "@vue/runtime-core";
import { ref } from "vue";
import LoadImage from '../assets/loan/loan-image.jpg'
import LeftIcon from '../assets/loan/left.png'
import RightIcon from '../assets/loan/right.png'

const menus = JSON.parse(localStorage.getItem('menus') as string)
const dataSource: any[] = menus.find(x => x.label === '贷款业务').children

const pageIndex = ref(Array.from(Array(dataSource.length), () => 0))

function onChangeProduct(index) {

}

onMounted(() => {
    console.log(pageIndex)
})
</script>

<style lang="stylus" scoped>
.primary-color
    color #219461
.secord-color
    color #F7B200
.product-container
    .children-container
        .left-arrow,.right-arrow
            img 
                height 40px
        .content
            width 480px
            min-height 180px
        .product-item
            img
                width 100px
                height 100px
</style>
