import Home from '../pages/home.vue'
import Page from '../pages/page.vue'
import Post from '../pages/post.vue'
import Loan from '../pages/loan.vue'

export const routes = [
    { path: '/', component: Home },
    { name: 'loan', path: '/page', component: Loan },
    { name: 'page', path: '/page/:name', component: Page },
    { name: 'post', path: '/post/:id', component: Post },
]