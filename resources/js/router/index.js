import { createRouter, createWebHistory } from "vue-router";

// Admin
import Dashboard from '../components/invoice/index.vue'
// Welcome
import Welcome from '../components/welcome.vue'

// Login
import Login from '../components/auth/login.vue'

const routes = [
    {
        path: '/',
        component: Welcome,
    },
    {
        path: '/login',
        component: Login,
    },
    {
        path: '/admin/invoice',
        component: Dashboard,
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

// router.beforeEach((to, from) => {
//     if (to.meta.requiresAuth && !localStorage.getItem('token')) {
//        return {name:'Login'}
//     }
//     if (to.meta.requiresAuth == false && localStorage.getItem('token')) {
//         return { name: 'adminHome' }
//     }
// })

export default router
