<template>
    <aside class="menu" >
        <div class="overlay" v-on:click="drawerchange"></div>
        <div class="menu-inside" v-bar="{preventParentScroll: true, scrollThrottle: 30}">
            <ul class="menu-list">
                <li v-if="user.admin_type==0" class="branchselect"><p>{{domain.name}}
                    <span @click="changeDomain" class="tag is-primary is-uppercase">өөрчлөх</span></p>
                </li>

                <p  class="main-text has-text-centered is-size-6 p2">
                    {{domain.domain}}<span v-if="domain.domain!=''">.</span>{{site}}
                </p>
            <template v-for="item in items" >
                    <!--admin default-->
                    <template v-if="user.admin_type==0 && domain.id==0 && item.role<2">
                        <p v-if="item.subheader" class="menu-label">{{item.subheader}}</p>
                        <li v-else="" :class="{'is-active':item.path == $route.path}">
                             <div :class="{'is-active':item.path == $route.path}" v-on:click="changeRoute(item.path)">
                                 <span><i :class="item.icon" aria-hidden="true"></i></span>
                                 <p>{{item.title}}</p>
                             </div>
                        </li>
                    </template>
                    <!--admin ded site default-->
                    <template v-else-if="user.admin_type==0 && domain.id!=0 && item.role>1">
                        <p v-if="item.subheader" class="menu-label">{{item.subheader}}</p>
                        <li v-else="" :class="{'is-active':item.path == $route.path}">
                            <div :class="{'is-active':item.path == $route.path}" v-on:click="changeRoute(item.path)">
                                <span><i :class="item.icon" aria-hidden="true"></i></span>
                                <p>{{item.title}}</p>
                            </div>
                        </li>
                    </template>
                    <!--admin ded niitlegch default-->
                    <template v-else-if="user.admin_type==1 && item.role==1">
                        <p v-if="item.subheader" class="menu-label">{{item.subheader}}</p>
                        <li v-else="" :class="{'is-active':item.path == $route.path}">
                            <div :class="{'is-active':item.path == $route.path}" v-on:click="changeRoute(item.path)">
                                <span><i :class="item.icon" aria-hidden="true"></i></span>
                                <p>{{item.title}}</p>
                            </div>
                        </li>
                    </template>
                    <!--ded admin default-->
                    <template v-else-if="user.admin_type==2 && item.role>1">
                        <p v-if="item.subheader" class="menu-label">{{item.subheader}}</p>
                        <li v-else="" :class="{'is-active':item.path == $route.path}">
                            <div :class="{'is-active':item.path == $route.path}" v-on:click="changeRoute(item.path)">
                                <span><i :class="item.icon" aria-hidden="true"></i></span>
                                <p>{{item.title}}</p>
                            </div>
                        </li>
                    </template>
                    <!--ded niitlegch default-->
                    <template v-else-if="user.admin_type==3 && item.role>2">
                        <p v-if="item.subheader" class="menu-label">{{item.subheader}}</p>
                        <li v-else="" :class="{'is-active':item.path == $route.path}">
                            <div :class="{'is-active':item.path == $route.path}" v-on:click="changeRoute(item.path)">
                                <span><i :class="item.icon" aria-hidden="true"></i></span>
                                <p>{{item.title}}</p>
                            </div>
                        </li>
                    </template>


            </template>
            </ul>
        </div>

        <!-- domain modal -->
        <div class="modal is-active" v-if="domainmodal">
            <div class="modal-background" v-on:click="domainmodal = false"></div>
            <div class="modal-card modal-card-small" style="max-height: 75%;">

                <section class="modal-card-body pd0">
                    <a class="panel-block" :class="{'is-active': domainMain.id===domain.id}"  @click="setDomain(domainMain)">
                        <span class="panel-icon"><i class="fas fa-circle" aria-hidden="true"></i></span>
                        {{domainMain.name}}
                    </a>

                    <template v-for="d in domains">
                        <a class="panel-block " :class="{'is-active': d.id===domain.id}"  @click="setDomain(d)">
                            <span class="panel-icon"><i class="fas fa-circle" aria-hidden="true"></i></span>
                            {{d.name}}
                        </a>
                    </template>

                </section>

            </div>
        </div>
    </aside>
</template>

<script>
    export default {
        data () {
            return {
                site: window.surl.replace('http://',''),
                modal: false,
                domainMain:{
                    id:0,
                    name: 'Үндсэн сайт',
                    domain: ''
                },
                domains:[],
                domain:[],
                domainmodal: false,
                user: false,
                items: [
                    { subheader: 'Ерөнхий', role:0,},
                        { title: 'Статистик', icon: 'fas fa-chart-pie', path: '/', role:0, },
                        { title: 'Дэд сайтууд', icon: 'fas fa-th', path: '/sites', role:0,},
                        { title: 'Админ / ажилтан', icon: 'fas fa-users', path: '/employees', role:0,},
                        { title: 'Тохиргоо', icon: 'fas fa-sliders-h', path: '/setting',  role:0,},
                    { subheader: 'Мэдээ',  role:1 },
                        { title: 'Мэдээний ангилал', icon: 'fas fa-code-branch', path: '/news_category' ,  role:1 },
                        { title: "Мэдээ", icon: 'fas fa-newspaper', path: '/news' ,  role:1},
                        { title: 'Хуудас', icon: 'far fa-file-alt', path: '/pages' ,  role:1},
                    { subheader: 'Файлын сан',  role:1},
                        { title: "Файлын ангилал", icon: 'fas fa-code-branch', path: '/file_category',  role:1 },
                        { title: "Файлын сан", icon: 'fas fa-folder', path: '/files',  role:1 },
                    { subheader: 'Холбоос',  role:1},
                        { title: "Холбоос ангилал", icon: 'fas fa-code-branch', path: '/link_category',  role:1 },
                        { title: "Холбоос", icon: 'fas fa-link', path: '/link' ,  role:1},
                    { subheader: 'Зар',  role:1},
                        { title: "Зарийн ангилал", icon: 'fas fa-code-branch', path: '/zar_category' ,  role:1},
                        { title: "Зар", icon: 'fas fa-chart-bar', path: '/zar' ,  role:1},
                    { subheader: 'Бусад',  role:1},
                        { title: "Санал асуулга", icon: 'fas fa-code-branch', path: '/poll_category' ,  role:1},
                        { title: "Сутралчилгаа", icon: 'fab fa-goodreads', path: '/ads' ,  role:1},


                    // ded site
                    { subheader: 'Ерөнхий', role:2,},
                    { title: 'Статистик', icon: 'fas fa-chart-pie', path: '/sub_home', role:2, },
                    { title: 'Дэд Админ / ажилтан', icon: 'fas fa-users', path: '/sub_admins', role:2,},
                    { title: 'Тохиргоо', icon: 'fas fa-sliders-h', path: '/sub_setting',  role:2,},
                    { subheader: 'Мэдээ',  role:2 },
                    { title: 'Мэдээний ангилал', icon: 'fas fa-code-branch', path: '/sub_news_category' ,  role:3 },
                    { title: "Мэдээ", icon: 'fas fa-newspaper', path: '/sub_news' ,  role:3},
                    { title: 'Хуудас', icon: 'far fa-file-alt', path: '/sub_pages' ,  role:3},
                    { subheader: 'Файлын сан',  role:3},
                    { title: "Файлын ангилал", icon: 'fas fa-code-branch', path: '/file_category',  role:3 },
                    { title: "Файлын сан", icon: 'fas fa-folder', path: '/sub_files',  role:3 },
                    { subheader: 'Холбоос',  role:3},
                    { title: "Холбоос ангилал", icon: 'fas fa-code-branch', path: '/sub_link_category',  role:3 },
                    { title: "Холбоос", icon: 'fas fa-link', path: '/sub_link' ,  role:3},
                    { subheader: 'Зар'},
                    { title: "Зарийн ангилал", icon: 'fas fa-code-branch', path: '/sub_zar_category' ,  role:3},
                    { title: "Зар", icon: 'fas fa-chart-bar', path: '/sub_zar' ,  role:3},
                    { subheader: 'Бусад',  role:3},
                    { title: "Санал асуулга", icon: 'fas fa-code-branch', path: '/sub_poll_category' ,  role:3},
                    { title: "Сутралчилгаа", icon: 'fab fa-goodreads', path: '/sub_ads' ,  role:3},
                ],
                badge_show: false,
            }
        },
        created: function () {
            // this.checkAdminType();
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.user = this.$store.getters.authUser;
                this.domain=this.$store.getters.domain;
            },
            checkAdminType() {
                var admin_type=this.$store.getters.authUser.admin_type;
                if(admin_type==0){
                    this.$router.push('/');
                } else if(admin_type==1){
                    this.$router.push('/news');
                } else if(admin_type==2){
                    this.$router.push('/sub_home');
                } else if(admin_type==3){
                    this.$router.push('/sub_news');
                }
            },
            drawerchange: function() {
                if (this.$store.getters.drawer === true) {
                    this.$store.commit('changedrawerstore', false)
                } else {
                    this.$store.commit('changedrawerstore', 1)
                }
            },
            changeNavgroup: function(group) {
                this.$store.commit('changenavgroup', group)
            },
            changeNavgroup_sub: function(group) {
                this.$store.commit('changenavgroup_sub', group)
            },
            changeDomain: function(){
                axios.get('/site').then((response) => {
                    this.domains = response.data.success;
                    this.domainmodal=true;
                })
            },
            setDomain: function(domain){
                this.domain=domain;
                this.domainmodal=false;

                this.$store.dispatch('saveDomain', {
                    domain: domain,
                })


                if(this.domain.id==0){
                    this.$router.push('/');
                } else {
                    this.$router.push('/sub_home');
                }

            },
            changeRoute: function(path){
                this.$store.commit('changenavgroup', false)
                this.$store.commit('changenavgroup_sub', false)

                // if (this.$route.path === path) {
                //     this.$router.go({path:path});
                // } else {
                    this.$router.push({path:path});
                // }
            },

        }
    }

</script>
