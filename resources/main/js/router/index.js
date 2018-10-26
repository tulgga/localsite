import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

import Dashboard from '../modules/site/index'
import Login from '../modules/auth/Login'

//system routes
import NotFound from '../modules/system/NotFound'

Vue.use(Router)

let routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
    },

    {path: "*", component: NotFound},

    {
        path: '/',
        name: 'home',
        component: Dashboard,
        meta: {
            requiresAuth: true,
            page_title: 'Статистик',
            bread_crumbs: [
                {
                    title: 'Ерөнхий',
                    rname: 'home'
                }
            ]
        },
    },

];

const router = new Router({
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return {x: 0, y: 0}
        }
    }
});



router.afterEach((to, from, next) => {
    setTimeout(() => store.commit('changepageloader', false), 1000)
})

export default router;
