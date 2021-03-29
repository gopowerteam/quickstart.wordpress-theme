
<template lang="pug">
.post
    .content.p-5(
        v-html="post?.content"
    )
</template>
<script setup lang="ts">
import { onMounted, watch } from "@vue/runtime-core";
import { gql } from "graphql-request";
import { ref } from "vue";
import { useRoute } from "vue-router";
import { useRequest } from "../graphql";


const route = useRoute()
const request = useRequest()
const post = ref<any>()

function getPostContent(id) {
    request(gql`
    query($id: ID!) {
        post(id: $id) {
            id
            content
        }
    }`, {
        id
    }).then((data) => {
        post.value = data.post
    })
}

watch(()=>route.params,()=>{
    const { id } = route.params
    getPostContent(id)
})

onMounted(() => {
    const { id } = route.params
    getPostContent(id)
})
</script>
<style lang="stylus" scoped></style>