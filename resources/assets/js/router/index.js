import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

import Dashboard from '../modules/admin/Dashboard'

import Sites from '../modules/admin/sites/index'
import siteForm from '../modules/admin/sites/siteForm'

import Heltes from '../modules/admin/heltes/index'
import heltesForm from '../modules/admin/heltes/heltesForm'

import Employees from '../modules/admin/employee/Employees'
import EmployeesForm from '../modules/admin/employee/EmployeesForm'

import Users from '../modules/admin/user/Users'
import UserForm from '../modules/admin/user/UserForm'

import newsCategory from '../modules/admin/newsCategory/newsCategory'
import zarCategory from '../modules/admin/zarCategory/zarCategory'
import fileCategory from '../modules/admin/fileCategory/fileCategoryNew'

import Pages from '../modules/admin/pages/Pages'
import PagesForm from '../modules/admin/pages/PagesForm'

import HelpPages from '../modules/admin/pages/HelpPages'
import HelpPagesForm from '../modules/admin/pages/HelpPagesForm'


import TopPages from '../modules/admin/pages/TopPages'
import TopPagesForm from '../modules/admin/pages/TopPagesForm'

import Lavlagaa from '../modules/admin/lavlagaa/lavlagaa'
import LavlagaaForm from '../modules/admin/lavlagaa/lavlagaaForm'

import LinkCategory from '../modules/admin/linkCategory/LinkCategory'
import LinkCategoryForm from '../modules/admin/linkCategory/LinkCategoryForm'

import Files from '../modules/admin/file/file';
import fileForm from '../modules/admin/file/fileForm';

import News from '../modules/admin/news/news';
import newsForm from '../modules/admin/news/newsForm';

import BreakNews from '../modules/admin/break_news/news';

import subNewsPublish from '../modules/admin/news/sub_news_to_main';

import subNews from '../modules/admin/news/sub_news';
import subNewsForm from '../modules/admin/news/sub_newsForm';

import menu from '../modules/admin/menu/menu';

import Urgudul from '../modules/admin/urgudul/urgudul';
import Sidebar from '../modules/admin/sidebar/sidebar';
import zarBanner from '../modules/admin/zar/zarBanner';

import Poll from '../modules/admin/poll/poll';
import pollForm from '../modules/admin/poll/pollForm';

import Zar from '../modules/admin/zar/zar';
import zarForm from '../modules/admin/zar/zarForm';

import Link from '../modules/admin/Links/Link'
import LinkForm from '../modules/admin/Links/LinkForm'

import Profile from '../modules/admin/employee/Profile';
import Config from '../modules/admin/config/Config';
import Report from '../modules/admin/config/report';

import Login from '../modules/auth/Login'

//system routes
import NotFound from '../modules/system/NotFound'

import Group from '../modules/admin/group/group';
import GroupFrom from '../modules/admin/group/groupForm';
import group_user_request from '../modules/admin/group/group_user_request';

import dashboard_police from '../modules/admin/dashboard_police/dashboard_police';
import dashboard_policeForm from '../modules/admin/dashboard_police/dashboard_policeForm';

import dashboard_hospital from '../modules/admin/dashboard_hospital/dashboard_hospital';
import dashboard_hospitalForm from '../modules/admin/dashboard_hospital/dashboard_hospitalForm';

import dashboard_nema from '../modules/admin/dashboard_nema/dashboard_nema';
import dashboard_nemaForm from '../modules/admin/dashboard_nema/dashboard_nemaForm';

import dashboard_schedule from '../modules/admin/dashboard_schedule/dashboard_schedule';
import dashboard_scheduleForm from '../modules/admin/dashboard_schedule/dashboard_scheduleForm';

import dashboard_budget from '../modules/admin/dashboard_budget/dashboard_budget';
import dashboard_budgetForm from '../modules/admin/dashboard_budget/dashboard_budgetForm';

import dashboard_news from '../modules/admin/dashboard_news/dashboard_news';
import dashboard_newsForm from '../modules/admin/dashboard_news/dashboard_newsForm';

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
        path: '/config',
        name: 'config',
        component: Config,
        meta: {
            requiresAuth: true,
            page_title: 'Тохиргоо',
            bread_crumbs: [
                {
                    title: 'Тохиргоо',
                    rname: ''
                }
            ]
        },
    },

    {
        path: '/report',
        name: 'report',
        component: Report,
        meta: {
            requiresAuth: true,
            page_title: 'Тайлан',
            bread_crumbs: [
                {
                    title: 'Мэдээ',
                    rname: ''
                }
            ]
        },
    },

    {
        path: '/menu',
        name: 'menu',
        component: menu,
        meta: {
            requiresAuth: true,
            page_title: 'Цэс',
            bread_crumbs: [
                {
                    title: 'Тохиргоо',
                    rname: ''
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
        path: '/toppages',
        name: 'toppages',
        component: TopPages,
        meta: {
            requiresAuth: true,
            page_title: 'Толгой цэс',
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
                component: TopPagesForm,
                name: 'create_toppages',
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
                component: TopPagesForm,
                name: 'update_toppages',
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
        path: '/lavlagaa',
        name: 'lavlagaa',
        component: Lavlagaa,
        meta: {
            requiresAuth: true,
            page_title: 'Лавлагаа мэдээлэл',
            bread_crumbs: [
                {
                    title: 'Лавлагаа мэдээлэл',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: LavlagaaForm,
                name: 'create_lavlagaa',
                meta: {
                    page_title: 'Лавлагаа мэдээлэл',
                    bread_crumbs: [
                        {
                            title: 'Лавлагаа мэдээлэл',
                            rname: 'home'
                        },
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: LavlagaaForm,
                name: 'update_lavlagaa',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Лавлагаа мэдээлэл',
                            rname: 'home'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },


    {
        path: '/pages',
        name: 'pages',
        component: Pages,
        meta: {
            requiresAuth: true,
            page_title: 'Үндсэн цэс',
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
        path: '/helppages',
        name: 'helppages',
        component: HelpPages,
        meta: {
            requiresAuth: true,
            page_title: 'Туслах цэс',
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
                component: HelpPagesForm,
                name: 'help_create_page',
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
                component: HelpPagesForm,
                name: 'help_update_page',
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
        path: '/break_news',
        name: 'break_news',
        component: BreakNews,
        meta: {
            requiresAuth: true,
            page_title: 'Шуурхай мэдээ',
            bread_crumbs: [
                {
                    title: 'Шуурхай мэдээ',
                    rname: ''
                }
            ]
        }
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
        path: '/zarBanner',
        name: 'zarBanner',
        component: zarBanner,
        meta: {
            requiresAuth: true,
            page_title: 'Зарын баннер',
            bread_crumbs: [
                {
                    title: 'Зар',
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
        path: '/heltes',
        name: 'heltes',
        component: Heltes,
        meta: {
            requiresAuth: true,
            page_title: 'Хэлтэс',
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
                component: heltesForm,
                name: 'create_heltes',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Хэлтэс үүсгэх',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: heltesForm,
                name: 'update_heltes',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'ЕРӨНХИЙ',
                            rname: 'home'
                        },
                        {
                            title: 'Хэлтэс засах',
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


    {
        path: '/users',
        name: 'users',
        component: Users,
        meta: {
            requiresAuth: true,
            page_title: 'Админ / хэрэглэгч',
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
                component: UserForm,
                name: 'create_user',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'Админ',
                            rname: 'users'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: UserForm,
                name: 'update_user',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Ерөнхий',
                            rname: 'home'
                        },
                        {
                            title: 'хэрэглэгч',
                            rname: 'users'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },

    {
        path: '/group_user_request/:id',
        name: 'group_user_request',
        component: group_user_request,
        meta: {
            requiresAuth: true,
            page_title: 'Хүсэлтүүд',
            bread_crumbs: [
                {
                    title: 'Чат',
                    rname: 'home'
                },
                {
                    title: 'Групп',
                    rname: 'group'
                }
            ],
        }
    },

    {
        path: '/group',
        name: 'group',
        component: Group,
        meta: {
            requiresAuth: true,
            page_title: 'Групп',
            bread_crumbs: [
                {
                    title: 'Чат',
                    rname: 'home'
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: GroupFrom,
                name: 'create_group',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Чат',
                            rname: 'home'
                        },
                        {
                            title: 'Групп үүсгэх',
                            rname: ''
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: GroupFrom,
                name: 'update_group',
                meta: {
                    page_title: 'Засах',
                    bread_crumbs: [
                        {
                            title: 'Чат',
                            rname: 'home'
                        },
                        {
                            title: 'Групп засах',
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
        path: '/dashboard_police',
        name: 'dashboard_police',
        component: dashboard_police,
        meta: {
            requiresAuth: true,
            page_title: 'Цагдаа',
            bread_crumbs: [
                {
                    title: 'Цагдаа',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_policeForm,
                name: 'create_dashboard_police',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Цагдаа',
                            rname: 'dashboard_police'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_policeForm,
                name: 'update_dashboard_police',
                meta: {
                    page_title: 'Цагдаа засах',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_police'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/dashboard_hospital',
        name: 'dashboard_hospital',
        component: dashboard_hospital,
        meta: {
            requiresAuth: true,
            page_title: 'Эрүүл мэнд',
            bread_crumbs: [
                {
                    title: 'Эрүүл мэнд',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_hospitalForm,
                name: 'create_dashboard_hospital',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Эрүүл мэнд',
                            rname: 'dashboard_hospital'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_hospitalForm,
                name: 'update_dashboard_hospital',
                meta: {
                    page_title: 'Эрүүл мэнд',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_hospital'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/dashboard_nema',
        name: 'dashboard_nema',
        component: dashboard_nema,
        meta: {
            requiresAuth: true,
            page_title: 'Онцгой байдал',
            bread_crumbs: [
                {
                    title: 'Онцгой байдал',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_nemaForm,
                name: 'create_dashboard_nema',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Онцгой байдал',
                            rname: 'dashboard_nema'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_nemaForm,
                name: 'update_dashboard_nema',
                meta: {
                    page_title: 'Онцгой байдал',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_nema'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/dashboard_schedule',
        name: 'dashboard_schedule',
        component: dashboard_schedule,
        meta: {
            requiresAuth: true,
            page_title: 'Цагийн хуваарь',
            bread_crumbs: [
                {
                    title: 'Цагийн хуваарь',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_scheduleForm,
                name: 'create_dashboard_schedule',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Цагийн хуваарь',
                            rname: 'dashboard_schedule'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_scheduleForm,
                name: 'update_dashboard_schedule',
                meta: {
                    page_title: 'Цагийн хуваарь',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_schedule'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/dashboard_budget',
        name: 'dashboard_budget',
        component: dashboard_budget,
        meta: {
            requiresAuth: true,
            page_title: 'Төсөв',
            bread_crumbs: [
                {
                    title: 'Төсөв',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_budgetForm,
                name: 'create_dashboard_budget',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Төсөв',
                            rname: 'dashboard_budget'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_budgetForm,
                name: 'update_dashboard_budget',
                meta: {
                    page_title: 'Төсөв',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_budget'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    },
    {
        path: '/dashboard_news',
        name: 'dashboard_news',
        component: dashboard_news,
        meta: {
            requiresAuth: true,
            page_title: 'Цаг үеийн асуудал',
            bread_crumbs: [
                {
                    title: 'Цаг үеийн асуудал',
                    rname: ''
                }
            ]
        },
        children: [
            {
                path: 'create',
                component: dashboard_newsForm,
                name: 'create_dashboard_news',
                meta: {
                    page_title: 'Нэмэх',
                    bread_crumbs: [
                        {
                            title: 'Цаг үеийн асуудал',
                            rname: 'dashboard_news'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
            {
                path: ':id/update',
                component: dashboard_newsForm,
                name: 'update_dashboard_news',
                meta: {
                    page_title: 'Цаг үеийн асуудал',
                    bread_crumbs: [
                        {
                            title: 'Дашбоард',
                            rname: 'dashboard_news'
                        }
                    ],
                    notloading: true,
                    is_modal: true,
                }
            },
        ]
    }

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
});

export default router;
