
<template lang="pug">
.home
    .header-image
        img(:src="topImage")
    .load-service
    .page-container.flex.flex-row.p-10
        .recent-post.flex-1
            .title.p-2
                span.px-2.primary-color.font-bold.text-lg 近期要问
                span.secord-color.font-bold.text-lg |
                span.px-2.secord-color.font-bold.text-lg Recent news
        .catalog-post.flex-1
            .catalog-header.flex.flex-row.items-center
                .catalog-header-item.p-2.cursor-pointer(
                    v-for="item in categories"
                    :key="item.id"
                    :class="{ active: currentCategory.id === item.id }"
                    @click="currentCategory=item"
                ) {{ item.name }}
            .catalog-list
</template>
<script setup lang="ts">
import { onMounted, ref } from '@vue/runtime-core';
import { gql } from 'graphql-request';
import topImage from '../assets/home/top-image.jpg'
import { useRequest } from '../graphql';

const request = useRequest()

const categories = ref<any[]>([])
const currentCategory = ref<any>()

function getPostCatalog() {
    request(gql`
    query {
        categories(where: {name: "资讯文章"}) {
            nodes {
                children {
                    nodes {
                        id
                        name
                    }
                }
            }
        }
    }`).then((data) => {
        const [catalog] = data.categories.nodes
        const nodes = catalog.children.nodes
        categories.value = nodes
        currentCategory.value = nodes[0]
    })
}

function getLastPost() {
    request(gql`
    query {
        posts(last: 1) {
            edges {
                node {
                    id
                }
            }
        }
    }`).then((data) => {
        const [catalog] = data.categories.nodes
        const nodes = catalog.children.nodes
        categories.value = nodes
        currentCategory.value = nodes[0]
    })
}


onMounted(() => {
    getPostCatalog()
    getLastPost()
})

</script>
<style lang="stylus" scoped>
.primary-color
    color #219461
.secord-color
    color #F7B200
.catalog-post
    .catalog-header
        .catalog-header-item
            &.active
                color #219461
                font-weight bold


</style>