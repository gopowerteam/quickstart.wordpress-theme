<template lang="pug">
.menu.flex.flex-row
  .menu-item.font-bold.py-5.px-5(
    v-for="item in menus"
    :key="item.id"
    @click="onEnterPage(item)"
    @mouseenter="onEnterMenu(item)"
    @mouseleave="onLeaveMenu(item)"
  ) {{item.label}}
.menu-children-panel.absolute.w-full.flex.flex-row.py-5(
  v-if="menuChildren"
)
  .menu-children-node.px-5(
    v-for="item in menuChildren"
    :key="item.id"
  )
    .title.font-bold {{item.label}}
    .sub-title.text-sm
      span |  
      span.pl-2 {{item.connectedNode?.node?.description}}
    ul.node-list.pt-3
      li.node-item.text-xs.pb-1.cursor-pointer(
        v-for="node in item.children"
        :key="node.id"
      ) {{node.label}}



</template>
<script setup lang="ts">
import { onMounted, ref } from "@vue/runtime-core";
import { gql } from "graphql-request";
import { useRequest } from "../../graphql";
import { convertToTree } from "../../shared/utils/common.util";

const menus = ref<any[]>([])
const menuChildren = ref<any[]>([])
const request = useRequest()

/**
 * 获取菜单项目
 */
function getMenuItems() {
  request(gql`
    query {
      menuItems {
        nodes {
          label
          parentId
          id
          menuItemId
          order
          path
          connectedNode {
            node {
              ... on Category {
                description
              }
            }
          }
        }
      }
    }`
  ).then((data) => {
    menus.value = convertToTree(data.menuItems.nodes, { key: 'id', parentKey: 'parentId' })
  })
}

function onEnterPage(item){
  switch(item.label){
    case '首页':
      window.location.href = '/'
  }
}

function onEnterMenu(item){
  if( item.children){
    menuChildren.value = item.children
  }
}

function onLeaveMenu(item){

}

onMounted(() => {
  getMenuItems()
})



</script>
<style lang="stylus" scoped>
.menu
  background-color rgb(30,141,96)
  .menu-item
    color #fff
    cursor pointer
    &:hover
      color #F7B200

.menu-children-panel
  background rgba(255,255,255,1)
  .menu-children-node
    .title 
      font-size 18px
      color #349C6E
    .node-list
      list-style inside
</style>