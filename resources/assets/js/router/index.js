import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

import Dashboard from '../modules/admin/Dashboard'


import Sites from '../modules/admin/sites/index'
import siteForm from '../modules/admin/sites/siteForm'

import Employees from '../modules/admin/employee/Employees'
import EmployeesForm from '../modules/admin/employee/EmployeesForm'


import newsCategory from '../modules/admin/newsCategory/newsCategory'
import zarCategory from '../modules/admin/zarCategory/zarCategory'
import fileCategory from '../modules/admin/fileCategory/fileCategoryNew'

import Pages from '../modules/admin/pages/Pages'
import PagesForm from '../modules/admin/pages/PagesForm'


import LinkCategory from '../modules/admin/linkCategory/LinkCategory'
import LinkCategoryForm from '../modules/admin/linkCategory/LinkCategoryForm'

import Files from '../modules/admin/file/file';
import fileForm from '../modules/admin/file/fileForm';

import News from '../modules/admin/news/news';
import newsForm from '../modules/admin/news/newsForm';


import subNewsPublish from '../modules/admin/news/sub_news_to_main';


import subNews from '../modules/admin/news/sub_news';
import subNewsForm from '../modules/admin/news/sub_newsForm';

import Urgudul from '../modules/admin/urgudul/urgudul';
import Sidebar from '../modules/admin/sidebar/sidebar';

import Poll from '../modules/admin/poll/poll';
import pollForm from '../modules/admin/poll/pollForm';

import Zar from '../modules/admin/zar/zar';
import zarForm from '../modules/admin/zar/zarForm';

import Link from '../modules/admin/Links/Link'
import LinkForm from '../modules/admin/Links/LinkForm'

import Profile from '../modules/admin/employee/Profile';

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

    {
        path: '/news_category',
        name: 'newsCategory',
        component: newsCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Мэдээний ангилал',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: 'news'
                }
            ]
        },
    },

    {
        path: '/zar_category',
        name: 'zarCategory',
        component: zarCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Зарын ангилал',
            bread_crumbs: [
                {
                    title: 'Зар',
                    rname: 'zar'
                }
            ]
        },
    },




    {
        path: '/file_category',
        name: 'fileCategory',
        component: fileCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Файлын ангилал',
            bread_crumbs: [
                {
                    title: 'файлын сан',
                    rname: 'files'
                }
            ]
        },
    },


    {
        path: '/sub_news_publish',
        name: 'subNewsPublish',
        component: subNewsPublish,
        meta: {
            requiresAuth: true,
            page_title: 'Орон нутгийн мэдээ',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: ''
                }
            ]
        },
    },

    {
        path: '/profile',
        name: 'profile',
        component: Profile,
        meta: {
            requiresAuth: true,
            page_title: 'Миний профайл',
            bread_crumbs: [
            ]
        },
    },



    {
        path: '/pages',
        name: 'pages',
        component: Pages,
        meta: {
            requiresAuth: true,
            page_title: 'Хуудас',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: PagesForm,
                name: 'create_page',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: PagesForm,
                name: 'update_page',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },




    {
        path: '/files',
        name: 'files',
        component: Files,
        meta: {
            requiresAuth: true,
            page_title: 'Файлын сан',
            bread_crumbs: [
                {
                    title: 'Файлын сан',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: fileForm,
                name: 'create_file',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Файлын сан',
                            rname: 'files'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: fileForm,
                name: 'update_file',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Файлын сан',
                            rname: 'files'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },




    {
        path: '/news',
        name: 'news',
        component: News,
        meta: {
            requiresAuth: true,
            page_title: 'Мэдээ',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: newsForm,
                name: 'create_news',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Мэдээ',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: newsForm,
                name: 'update_news',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Мэдээ',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/sub_news',
        name: 'sub_news',
        component: subNews,
        meta: {
            requiresAuth: true,
            page_title: 'Мэдээ',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: subNewsForm,
                name: 'create_sub_news',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Мэдээ',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: subNewsForm,
                name: 'update_sub_news',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Мэдээ',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },


    {
        path: '/poll',
        name: 'poll',
        component: Poll,
        meta: {
            requiresAuth: true,
            page_title: 'Санал асуулга',
            bread_crumbs: [
                {
                    title: 'Бусад',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: pollForm,
                name: 'create_poll',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Бусад',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: pollForm,
                name: 'update_poll',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Бусад',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/urgudul',
        name: 'urgudul',
        component: Urgudul,
        meta: {
            requiresAuth: true,
            page_title: 'Санал хүсэлт',
            bread_crumbs: [
                {
                    title: 'Бусад',
                    rname: ''
                }
            ]
        }
    },


    {
        path: '/sidebar',
        name: 'sidebar',
        component: Sidebar,
        meta: {
            requiresAuth: true,
            page_title: 'Сурталчилгаа',
            bread_crumbs: [
                {
                    title: 'Тохиргоо',
                    rname: ''
                }
            ]
        }
    },

    {
        path: '/zar',
        name: 'zar',
        component: Zar,
        meta: {
            requiresAuth: true,
            page_title: 'Зар',
            bread_crumbs: [
                {
                    title: 'Зар',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: zarForm,
                name: 'create_zar',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Зар',
                            rname: 'zar'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: zarForm,
                name: 'update_zar',
                meta: {
                    page_title: 'Зар засах',
                    bread_crumbs: [
                        {
                            title: 'Зар',
                            rname: 'zar'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },



    {
        path: '/sites',
        name: 'sites',
        component: Sites,
        meta: {
            requiresAuth: true,
            page_title: 'Дэд сайтууд',
            bread_crumbs: [
                {
                    title: 'ЕРӨНХИЙ',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: siteForm,
                name: 'create_site',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: siteForm,
                name: 'update_site',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Дэд сайтууд',
                            rname: 'sites'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/link_category',
        name: 'link_category',
        component: LinkCategory,
        meta: {
            requiresAuth: true,
            page_title: 'Холбоос ангилал',
            bread_crumbs: [
                {
                    title: 'Холбоос',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: LinkCategoryForm,
                name: 'link_category_create',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос ангилал',
                            rname: 'link_category'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: LinkCategoryForm,
                name: 'link_category_update',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Холбоос',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос ангилал',
                            rname: 'link_category'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/link',
        name: 'link',
        component: Link,
        meta: {
            requiresAuth: true,
            page_title: 'Холбоос',
            bread_crumbs: [
                {
                    title: 'Холбоос',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: LinkForm,
                name: 'link_create',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос',
                            rname: 'link'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: LinkForm,
                name: 'link_update',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Холбоос',
                            rname: 'home'
                        },
                        {
                            title: 'Холбоос',
                            rname: 'link'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/employees',
        name: 'employees',
        component: Employees,
        meta: {
            requiresAuth: true,
            page_title: 'Админ / ажилтан',
            bread_crumbs: [
                {
                    title: 'Ерөнхий',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: EmployeesForm,
                name: 'create_employee',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'Админ',
                            rname: 'employees'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: EmployeesForm,
                name: 'update_employee',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'Админ',
                            rname: 'employees'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
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

router.beforeEach((to, from, next) => {
    if (window.innerWidth < 1025) {
        store.commit('changedrawerstore', 1)
    }
    if (from.meta.notloading !== true) {
        if (to.meta.notloading !== true) {
            store.commit('changepageloader', true)
        }
    }
    if (store.getters.authToken && !store.getters.authCheck) {
        store.dispatch('fetchUser').then(response => next());
    } else if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.authCheck) {
        next({
            name: 'login'
        })
    } else {
        next()
    }
});

router.afterEach((to, from, next) => {
    setTimeout(() => store.commit('changepageloader', false), 1000)
})

export default router;
