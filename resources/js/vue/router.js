import { createRouter,createWebHistory } from 'vue-router'

import List from './components/List.vue'
import Save from './components/Save.vue'

const routes = [
    {
        name:'list',
        path:'/vue',
        component: List
    },
    {
        name:'save',
        path:'/vue/save/:url_clean?',
        component: Save
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router