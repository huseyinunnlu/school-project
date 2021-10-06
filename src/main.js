import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { appAxios } from "@/utils/appAxios"
import Notifications from '@kyvg/vue3-notification'
const app = createApp(App);
app.config.globalProperties.$appAxios = appAxios;
app.use(store)
app.use(router)
app.use(Notifications)
app.mount('#app')
