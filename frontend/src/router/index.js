import { createRouter, createWebHistory } from "vue-router"

import Authentication from "../views/Authentication.vue"
import Dashboard from "../views/DashboardLayout.vue"
import Admin from "../components/Admin/addForm.vue"

const routes = [
    {
        path: "/",
        name: "Authentication",
        component: Authentication,
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        path: "/admin",
        name: "Admin",
        component: Admin,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router