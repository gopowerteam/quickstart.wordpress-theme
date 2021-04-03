
<template lang="pug">
.posts
    .post(v-for="post in posts")
        .flex.flex-row.p-5.cursor-pointer
            img.image(:src="post?.featuredImage?.node?.mediaItemUrl")
            .content.pl-5.flex.flex-col.flex-auto
                .title
                    span.catalog.primary-color.font-bold 【{{ post.categories.nodes[0].name }}】
                    span.title.primary-color.font-bold {{ post.title }}
                .excerpt.flex-auto(v-html="post.excerpt") 
                .date.text-right 【{{ dateFormat(post.date, 'YYYY.M.DD') }}】

    .more.text-center(v-if="cursor !== null" @click="getLastPost")
        .text.p-5.cursor-pointer 加载更多
</template>
<script setup lang="ts">
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import { gql } from "graphql-request";
import { useRouter } from "vue-router";
import { useRequest } from "../graphql";
import { dateFormat } from '../shared/utils/common.util'

const request = useRequest()
const router = useRouter()

const posts = ref<any[]>([])
const cursor = ref("")

function getLastPost() {
    request(gql`
    query($cursor:String!) {
        posts(first: 10,after:$cursor) {
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
            },
            pageInfo {
                startCursor
                endCursor
            }
        }
    }`, {
        cursor: cursor.value
    }).then((data) => {
        const nodes = data.posts.nodes
        cursor.value = data.posts.pageInfo.endCursor

        if (nodes.length) {
            posts.value.push(...nodes)
        }

        console.log(data)
    })
}


onMounted(() => {
    getLastPost()
})

</script>

<style lang="stylus" scoped>
.posts
    margin 60px 50px 0 50px
    .post
        margin 20px 0
        min-height 150px
        background #f7f7f7
        img
            width 200px
</style>
    