import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import { createApp } from "vue";

import App from "./App.vue"
import axios from 'axios'
// oruga
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'

// material design
import "@mdi/font/css/materialdesignicons.min.css"

const app = createApp(App).use(Oruga)
app.config.globalProperties.$axios = axios
window.axios = axios
app.mount('#app')
//createApp(App).use(Oruga).mount("#app")
