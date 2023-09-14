import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './styles/app.css'
// import ElementPlus from 'element-plus'
// import 'element-plus/dist/index.css'
import VueInstagram from 'vue-instagram'

let app = createApp(App)

app
  .use(VueInstagram)
  .use(store)
  // .use(ElementPlus)
  .use(router)
  .mount('#app')
