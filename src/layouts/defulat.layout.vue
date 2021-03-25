<template lang="pug">
.header
.header-bar
div.aa.bg-gray.bg-pink-700(@click="onclick") 123
</template>
<script setup lang="ts">
import { request, gql } from 'graphql-request'

const query = gql`
query MyQuery {
  categories {
    edges {
      node {
        name
        id
        description
      }
    }
  }
}
`

const a = 1
function onclick() {
    console.log(12312)

    request('http://cms.1zhizu.com/index.php?graphql', query).then((data) => console.log(data))
}
</script>

<style lang="stylus" scoped></style>