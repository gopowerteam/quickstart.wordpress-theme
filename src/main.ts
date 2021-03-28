import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import dayjs from 'dayjs'
import zhCN from 'dayjs/locale/zh-cn'
import { createGraphQL } from './graphql'
const app = createApp(App)

dayjs.locale(zhCN)

const graphQL = createGraphQL()

app.use(graphQL)
app.use(router)
app.mount('#app')
