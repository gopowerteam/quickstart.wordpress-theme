import Home from '../pages/home.vue'
import Post from '../pages/post.vue'

export const routes = [
    { path: '/', component: Home },
    { name: 'post', path: '/post/:id', component: Post },
]