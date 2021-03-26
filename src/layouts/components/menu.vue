<template lang="pug"></template>
<script setup lang="ts">
import { gql, request } from "graphql-request";


function onclick() {
    console.log(12312)

    request('http://cms.1zhizu.com/index.php?graphql', query).then((data) => console.log(data))
}

// 查询所有菜单
const query = gql`
query MyQuery {
  menuItems {
    nodes {
      label
      parentId
      id
      menuItemId
      order
      path
    }
  }
}
`
    
      
</script>
<style lang="stylus" scoped>

    
</style>