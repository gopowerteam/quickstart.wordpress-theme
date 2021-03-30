
<template lang="pug">
.home
    .header-image
        img(:src="topImage")
    .load-service
    .page-container.flex.flex-row.p-10.space-x-5
        .recent-post.flex-1
            .title.py-5.space-x-2
                span.primary-color.font-bold.text-lg 近期要问
                span.secord-color.font-bold.text-lg |
                span.secord-color.font-bold.text-lg Recent news
            .card.relative(
                v-if="recent"
                :style="{ backgroundImage: `url(${recent.featuredImage.node.mediaItemUrl})` }"
            )
                .card-panel.absolute
                    .post.flex.flex-row.p-5.cursor-pointer(
                        @click="onEnterPost(recent.id)"
                    )
                        .catalog.primary-color.font-bold 【{{ recent.categories.nodes[0].name }}】
                        .title.flex-auto.primary-color.font-bold {{ recent.title }}
                        .date 【{{ dateFormat(recent.date, 'YYYY.M.DD') }}】
                    .more.space-x-1.absolute.right-0.bottom-0.p-5
                        .text.cursor-pointer.text-sm
                            span 阅读更多
                            span |
                            span more
                            span >


        .catalog-post.flex-1
            .catalog-header.flex.flex-row.items-center.space-x-4
                .catalog-header-item.py-5.cursor-pointer(
                    v-for="item in categories"
                    :key="item.id"
                    :class="{ active: currentCategory.id === item.id }"
                    @click="onChangeCategory(item)"
                ) {{ item.name }}
            .post-list
                .post(
                    v-for="post in posts"
                    :key="post.id"
                    @click="onEnterPost(post.id)"
                )
                    .no-image.flex.flex-row.p-5.cursor-pointer(v-if="true")
                        .catalog.primary-color.font-bold 【{{ recent.categories.nodes[0].name }}】
                        .title.flex-auto.primary-color.font-bold {{ recent.title }}
                        .date 【{{ dateFormat(recent.date, 'YYYY.M.DD') }}】
</template>
<script setup lang="ts">
import { onMounted, ref } from '@vue/runtime-core';
import { gql } from 'graphql-request';
import { useRouter } from 'vue-router';
import topImage from '../assets/home/top-image.jpg'
import { useRequest } from '../graphql';
import { dateFormat } from '../shared/utils/common.util'
const request = useRequest()

const categories = ref<any[]>([])
const currentCategory = ref<any>()
const recent = ref<any>()
const posts = ref<any[]>([])
const router = useRouter()

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
        getPostByCategory(currentCategory.value.name)
    })
}

function getLastPost() {
    request(gql`
    query {
        posts(first: 1) {
            nodes {
                id,
                date
                title
                excerpt
                featuredImage {
                    node {
                        mediaItemUrl
                    }
                }
                categories {
                    nodes {
                        name
                    }
                }
            }
        }
    }`).then((data) => {
        const nodes = data.posts.nodes
        if (nodes.length) {
            recent.value = nodes[0]
        }
    })
}


function getPostByCategory(category) {
    request(gql`
    query($category:String!) {
        posts(first: 5,where: {categoryName: $category}) {
            nodes {
                id,
                date
                title
                excerpt
                featuredImage {
                    node {
                        mediaItemUrl
                    }
                }
                categories {
                    nodes {
                        name
                    }
                }
            }
        }
    }`,{
        category
    }).then((data) => {
        if(currentCategory.value.name === category){
            posts.value = data.posts.nodes
            console.log(posts.value)
        }
    })
}


function onChangeCategory(category) {
    currentCategory.value = category
    getPostByCategory(category.name)
}



function onEnterPost(id) {
    if (!id) return

    router.push({ path: `/post/${id}` })
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
.recent-post
    .card
        background-size 100% 100%
        height 400px
        .card-panel
            bottom 0
            left 0
            right 0
            height 150px
            background-color rgba(255,255,255,0.7)

.catalog-post
    .catalog-header
        .catalog-header-item
            &.active
                color #219461
                font-weight bold
                font-size 20px
    .post-list
        height 400px


</style>