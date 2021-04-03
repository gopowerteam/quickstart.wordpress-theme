<template lang="pug">
.footer
    .content.flex.flex-row.pb-8
        .link.flex-1
            .title.space-x-2.text-center.py-8
                span 友情链接
                span |
                span Friendly Link
            .bank-list.px-10.text-center.flex.flex-col.items-center
                .flex.flex-row.justify-between.py-2.w-96
                    .bank 铜川信合
                    .space |
                    .bank 渭南信合
                    .space |
                    .bank 汉中信合
                    .space |
                    .bank 广东信和
                    .space |
                    .bank 江苏信和
                .flex.flex-row.justify-between.py-2.w-96
                    .bank 北京农商银行
                    .space |
                    .bank 天津农商银行
                    .space |
                    .bank 重庆农商银行
                .flex.flex-row.justify-between.py-2.w-96.mt-10
                    .bank 手机一网通
                    .space |
                    .bank 网站声明
                    .space |
                    .bank 网点查询
                    .space |
                    .bank 网站地图
        .qrcode.flex-1.flex.flex-row.justify-center.space-x-8.items-end
            .wechat
                .image
                    img.m-auto(:src="QrCode1")
                .name.p-2 秦都农商银行微信公众号
            .app
                .image
                    img.m-auto(:src="QrCode1")
                .name.p-2 陕西信合手机APP


    .contact.flex.flex-row.justify-center.space-x-5.py-2.text-sm
        .copyright ©版权所有：秦都农商银行版权所有
        .address 地址：咸阳市渭阳西路8号信合大厦
        .hotline 服务热线：96262 / 10106262
        .support 技术支持：西安灰度广告设计
</template>
<script setup lang="ts">
import QrCode1 from "../../assets/home/qrcode-1.png"
import QrCode2 from "../../assets/home/qrcode-2.png"
</script>
<style lang="stylus" scoped>
.content
    background-color #219461
    color #fff
    .link
        .title 
            font-size 21px
            font-weight bold
    .qrcode
        img 
            width 150px
            height 150px

.contact
    background-color #F7B200

</style>