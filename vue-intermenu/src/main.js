import './assets/main.css'

import { createApp } from 'vue'
import { createBottomSheet } from 'bottom-sheet-vue3'
// axios
import axios from 'axios'
import VueAxios from 'vue-axios'

// vue bottomm sheet
import 'bottom-sheet-vue3/style.css'
// vue toast
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css"

import i18n from './plugins/i18n'

import App from './App.vue'
const app = createApp(App)


app.use(VueAxios, axios)
app.use(createBottomSheet())
app.use(Toast, {
    transition: "Vue-Toastification__fade",
    maxToasts: 20,
    newestOnTop: true,
})
app.use(i18n)
app.mount('#app')
