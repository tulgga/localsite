import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

import Home from '../modules/site/index'
import Search from '../modules/site/search'
import Category from  '../modules/site/category'
import newsType from  '../modules/site/NewsType'
import File from  '../modules/site/file'
import Link from  '../modules/site/link'
import Files from  '../modules/site/Files'
import News from  '../modules/site/news'
import Page from  '../modules/site/page'
import Report from  '../modules/site/report'
import Able from '../modules/site/able';


import Login from '../modules/auth/Login'

//system routes
import NotFound from '../modules/system/NotFound'

Vue.use(Router);

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
        component: Home,
    },
    {
        path: '/able',
        name: 'able',
        component: Able,
    },
    {
        path: '/report',
        name: 'report',
        component: Report,
    },
    {
        path: '/news/:id',
        name: 'news',
        component: News,
    },
    {
        path: '/newsType/:id',
        name: 'newsType',
        component: newsType,
    },
    {
        path: '/search/:id',
        name: 'search',
        component: Search,
    },
    {
        path: '/p/:id',
        name: 'page',
        component: Page,
    },
    {
        path: '/files/:id',
        name: 'files',
        component: Files,
    },
    {
        path: '/file/:id',
        name: 'file',
        component: File,
    },
    {
        path: '/category/:id',
        name: 'category',
        component: Category,
    },
    {
        path: '/link/:id',
        name: 'link',
        component: Link,
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
});

export default router;
