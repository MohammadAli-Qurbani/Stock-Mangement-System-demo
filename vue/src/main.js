import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import './assets/vendor//bootstrap/css/bootstrap.min.css'
import './assets/vendor/bootstrap-icons/bootstrap-icons.css'
import './assets/vendor/boxicons/css/boxicons.min.css'
import './assets/vendor/quill/quill.snow.css'
import 'nprogress/nprogress.css'
import './assets/css/style.css'

import './assets/vendor/bootstrap/js/bootstrap.bundle.min.js'
// import './assets/vendor/tinymce/tinymce.min.js'
// import './assets/js/main.js'
const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')





