import { createApp } from 'vue'
import { createPinia } from 'pinia'


import App from './App.vue'
import router from './router'

import './assets/main.css'


const app = createApp(App)

app.use(createPinia())

app.use(router)

// adding some global variable
app.config.globalProperties.api_url = window.location.origin


router.isReady().then( ()=>{
app.mount('#app')
})

