import { createRouter, createWebHistory } from "vue-router";
import Main from '../vue/app'

const routes = [
    {
        path: '/',
        name: 'main',
        component: Main
    },

    // { path: '/:pathMatch(.*)*', component: PathNotFound },
    // { path: '/:catchAll(.*)', component: PathNotFound },


]

export default createRouter({
   history: createWebHistory(),
    routes
})
