
<template lang="pug">
.container.flex.flex-row
    .category.p-5
        .category-item.py-5.cursor-pointer(
            v-for="item in categories"
            :key="item.id"
            :class="{ active: currentCategory?.id === item.id }"
            @click="onChangeCategory(item)"
    ) {{ item.name }}
    .posts.flex-auto
        .post(v-for="post in posts" @click="onEnterPost(post.id)")
            .flex.flex-row.p-5.cursor-pointer
                img.image(:src="post?.featuredImage?.node?.mediaItemUrl")
                .content.pl-5.flex.flex-col.flex-auto
                    .title
                        span.catalog.primary-color.font-bold 【{{ post.categories.nodes[0].name }}】
                        span.title.primary-color.font-bold {{ post.title }}
                    .excerpt.flex-auto(v-html="post.excerpt") 
                    .date.text-right 【{{ dateFormat(post.date, 'YYYY.M.DD') }}】

        .more.text-center(v-if="cursor !== null" @click="() => getLastPost()")
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

const categories = ref<any[]>([])
const posts = ref<any[]>([])
const cursor = ref<any>("")

const currentCategory = ref<any>()

function getLastPost(reset = false) {
    request(gql`
    query($cursor:String,$category:String) {
        posts(first: 10,after:$cursor,where: {categoryName: $category}) {
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
        cursor: cursor.value,
        category: currentCategory.value?.name
    }).then((data) => {
        const nodes = data.posts.nodes


        if (reset) {
            posts.value = nodes
        } else {
            nodes.length && posts.value.push(...nodes)
        }

        if (nodes.length && nodes.length < 10) {
            cursor.value = null
        } else {
            cursor.value = data.posts.pageInfo.endCursor
        }

    })
}

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
    })
}

function onChangeCategory(category) {
    currentCategory.value = category
    getLastPost(true)
    cursor.value = null
}

function onEnterPost(id) {
    if (!id) return

    router.push({ path: `/post/${id}` })
}



onMounted(() => {
    getLastPost()
    getPostCatalog()
})

</script>

<style lang="stylus" scoped>
.container
    margin 60px 50px 0 0
.category
  
    flex-basis 200px
    width 200px
    margin-right 10px
    .category-item
        text-align center
        padding 15px
        background-color #f7f7f7
        &.active
            background rgba(0,0,0,0.2)
            font-weight bold
.posts
    .post
        margin 20px 0
        min-height 150px
        background #f7f7f7
        img
            width 200px
</style>
    