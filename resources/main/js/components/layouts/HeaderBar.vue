<template>
	<div >
        <div  id="mobile-menu" class="is-hidden-tablet" :class="{'active':mobile_menu}">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title ">
                        <img style="max-height:32px;" :src="icon" :title="site_title"/>
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                      <span class="icon" @click="mobile_menu=false">
                        <i class="fas fa-times" aria-hidden="true"></i>
                      </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="searchform mt-0" >
                            <input type="text"  v-model="search" placeholder="Хайх...">
                            <button type="button" @click="searchClick()" class="button-search"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>

                <footer class="card-footer">
                    <a  v-if="socail.facebook" style="color: rgb(66, 103, 178);" class="card-footer-item" target="_blank" :href="socail.facebook"><i class="fab fa-facebook"></i></a>
                    <a  v-if="socail.twitter" style="color: rgb(29, 161, 242);"  class="card-footer-item" target="_blank" :href="socail.twitter"><i class="fab fa-twitter-square"></i></a>
                    <a  v-if="socail.messenger" style="color: rgb(0, 132, 255);"  class="card-footer-item" target="_blank" :href="socail.messenger"><i class="fab fa-facebook-messenger"></i></a>
                    <a  v-if="socail.google" style="color: rgb(255, 82, 82);"  class="card-footer-item" target="_blank" :href="socail.google"><i class="fab fa-google-plus-g"></i></a>
                    <a  v-if="socail.youtube" style="color: rgb(255, 0, 0);"  class="card-footer-item" target="_blank" :href="socail.youtube"><i class="fab fa-youtube"></i></a>
                </footer>

                <div class="card-content">
                    <div class="content">

                        <aside class="menu">
                            <ul class="menu-list">
                                <li :class="{'is-active': $route.path=='/'}"><a v-on:click="changeRoute('/')">Нүүр</a></li>
                                <template v-for="(m1, i1) in menu">
                                    <li  :class="{'is-active': $route.path==m1.link}">
                                        <a  v-on:click="changeRoute(m1, i1, -1, -1, -1)">{{m1.name}}</a>
                                         <ul  v-if="m1.children" >
                                             <template v-for="(m2, i2) in m1.children">
                                                 <li  :class="{'is-active': $route.path==m2.link}">
                                                     <a  v-on:click="changeRoute(m2, i1, i2, -1, -1)">{{m2.name}}</a>
                                                     <ul  v-if="m2.children" >
                                                         <template v-for="(m3, i3) in m2.children">
                                                             <li  :class="{'is-active': $route.path==m3.link}">
                                                                 <a  v-on:click="changeRoute(m3, i1, i2, i3, -1)">{{m3.name}}</a>
                                                                 <ul  v-if="m3.children" >
                                                                     <template v-for="(m4, i4) in m3.children">
                                                                         <li  :class="{'is-active': $route.path==m4.link}">
                                                                             <a  v-on:click="changeRoute(m4, i1, i2, i3, i4)">{{m4.name}}</a>
                                                                         </li>
                                                                     </template>
                                                                 </ul>
                                                             </li>
                                                         </template>
                                                     </ul>
                                                 </li>
                                             </template>
                                         </ul>
                                    </li>
                                </template>

                                    <li v-if="topmenu" v-for="(m1, i1) in topmenu" :class="{'is-active': i1==si1}">
                                        <a  v-on:click="changeRoute(m1, i1, -1, -1, -1)" >{{m1.name}}</a>
                                        <ul  v-if="m1.children" >
                                            <li v-for="(m2, i2) in m1.children" >
                                                <a v-on:click="changeRoute(m2, i1, i2, -1, -1)" >{{m2.name}}</a>
                                                <ul  v-if="m2.children" >
                                                    <li v-for="(m3, i3) in m2.children">
                                                        <a v-on:click="changeRoute(m3, i1, i2, i3, -1)" >{{m3.name}}</a>
                                                        <ul  v-if="m3.children" >
                                                            <li v-for="(m4, i4) in m3.children" >
                                                                <a v-on:click="changeRoute(m4, i1, i2, i3, i4)" >{{m4.name}}</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                            </ul>
                            <p class="menu-label"></p>
                            <p class="menu-label">Туслах цэс</p>
                            <ul class="menu-list">
                                <li><a href="http://zar.bayankhongor.gov.mn" target="_blank">Зар</a></li>
                                <li ><a href="!#/report">Санал хүсэлт, өргөдөл гомдол</a></li>
                            </ul>
                        </aside>

                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-menu-bg"  v-if="mobile_menu" @click="mobile_menu=false"></div>

        <div v-if="fetched" :style="{'background-color': main.main_color.hex}">

            <header id="header-mobile" class="is-hidden-tablet">
                <div class="columns is-mobile">
                    <div class="column is-2 ">
                        <a class="button is-text menu" @click="mobile_menu=true" > <span class="icon is-white "><i class="fas fa-bars "></i></span></a>
                    </div>
                    <div class="column is-8">
                        <div class="has-text-centered">
                            <router-link to="/">
                                <figure class="image ">
                                    <img :src="logo" :title="site_title"/>
                                </figure>
                            </router-link>

                        </div>

                    </div>
                    <div class="column is-2 has-text-right">
                        <a class="button is-text search" @click="mobile_menu=true" > <span class="icon is-white "><i class="fas fa-search "></i></span></a>
                    </div>
                </div>
            </header>

            <header  id="header" :class="{'fixed':scrollPosition>215}" class="is-hidden-mobile" >
                <div id="header-top"  :style="{'background-color': !main.parent_color.hex}">
                    <div class="container">
                        <nav class="level mb-0">
                            <div class="level-left ml-1" >
                                <p class="level-item"><i class="far fa-calendar-alt" style="margin-right: 10px;"></i> {{date}}</p>

                            </div>
                            <div class="level-right mr-1">
                                <p class="level-item" ><a @click="SumModal=true">Сумдууд</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item" ><a @click="AgentlagModal=true">Агентлагууд</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item"><a href="http://zar.bayankhongor.gov.mn" target="_blank">Зар</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item"><a href="!#/report">Санал хүсэлт, өргөдөл гомдол</a></p>
                                <p class="level-item">|</p>

                                <p class="level-item"><a href="http://intranet.gov.mn" style="padding: 1px 5px; background: rgb(226, 59, 59);" target="_blank" ><img :src="siteUrl+'/images/able.png'" style="height: 12px; margin-top: 5px;" /></a></p>
                            </div>
                        </nav>
                        <div class="is-clearfix"></div>
                    </div>

                </div>
                <div id="header-content"  :style="'background-image:url('+siteUrl+'/images/header_bg1.png), url('+siteUrl+'/images/header_bg2.png) ;'">
                    <div class="container" >
                        <div  class="columns">
                            <div  class="column is-6">

                                <figure class="image logo">
                                    <img :src="logo" :title="site_title"/>
                                </figure>
                            </div>
                            <div class="column is-6">
                                <div  class="is-pulled-right searchform" >
                                    <input type="text" v-model="search" placeholder="Хайх утгаа оруулна уу...">
                                    <button type="button" @click="searchClick" class="button-search"><i class="fa fa-search"></i></button>
                                </div>
                                        <div  v-if="topmenu" id="header-topmenu">
                                        <ul id="topmenu">
                                            <li v-for="(m1, i1) in topmenu" :class="{'is-active': i1==si1}">
                                                <a  v-on:click="changeRoute(m1, i1, -1, -1, -1)" >{{m1.name}} <i class="fas fa-caret-down"></i></a>
                                                <ul  v-if="m1.children" >
                                                    <li v-for="(m2, i2) in m1.children" >
                                                        <a v-on:click="changeRoute(m2, i1, i2, -1, -1)" >{{m2.name}}</a>
                                                        <ul  v-if="m2.children" >
                                                            <li v-for="(m3, i3) in m2.children">
                                                                <a v-on:click="changeRoute(m3, i1, i2, i3, -1)" >{{m3.name}}</a>
                                                                <ul  v-if="m3.children" >
                                                                    <li v-for="(m4, i4) in m3.children" >
                                                                        <a v-on:click="changeRoute(m4, i1, i2, i3, i4)" >{{m4.name}}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="header-menu" :style="{'background-color': '#e23b3b'}">
                    <div class="container">
                        <ul id="menu">
                            <li :class="{'is-active': $route.path=='/'}"><a style="padding: 10px 12px 7px;" v-on:click="changeRoute('/')"><img :src="siteUrl+'/images/home.png'"/></a></li>
                            <li v-for="(m1, i1) in menu" :class="{'is-active': i1==si1}">
                                <a  v-on:click="changeRoute(m1, i1, -1, -1, -1)" >{{m1.name}}</a>
                                <ul  v-if="m1.children" >
                                    <li v-for="(m2, i2) in m1.children" >
                                        <a v-on:click="changeRoute(m2, i1, i2, -1, -1)" >{{m2.name}}</a>
                                        <ul  v-if="m2.children" >
                                            <li v-for="(m3, i3) in m2.children">
                                                <a v-on:click="changeRoute(m3, i1, i2, i3, -1)" >{{m3.name}}</a>
                                                <ul  v-if="m3.children" >
                                                    <li v-for="(m4, i4) in m3.children" >
                                                        <a v-on:click="changeRoute(m4, i1, i2, i3, i4)" >{{m4.name}}</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
        </div>
        <loading v-else></loading>

        <!-- show modal -->
        <div class="modal is-active" v-if="SumModal">
            <div class="modal-background" v-on:click="SumModal = false"></div>

            <div class="modal-card" style="max-width: 610px">
                <div class="has-text-white has-background-primary" style="padding:20px;">Сумдын холбоос</div>
                <section class="modal-card-body pd0">
                  <sum></sum>
                </section>
            </div>
            <button v-on:click="SumModal = false" class="modal-close is-large" aria-label="close"></button>
        </div>


        <!-- show modal -->
        <div class="modal is-active" v-if="AgentlagModal">
            <div class="modal-background" v-on:click="AgentlagModal = false"></div>
            <div class="modal-card" style="max-width: 1040px">
                <div class="has-text-white has-background-primary" style="padding:20px;">Аймгийн хэлтэс агентлагууд</div>
                <section class="modal-card-body pd0">
                   <agentlag></agentlag>
                </section>
            </div>
            <button v-on:click="AgentlagModal = false" class="modal-close is-large" aria-label="close"></button>
        </div>

    </div>
</template>

<script>
    export default {
    	data(){
    		return {
                siteUrl: window.surl,
    		    date:window.sdate,
                scrollPosition: null,
                subdomain: window.subdomain,
    		    si1:-1,
                si2:-1,
                si3:-1,
                si4:-1,
                SumModal: false,
                AgentlagModal: false,
                search:'',
                site_title: window.title,
    		    socail:  window.socail,
                siteUrl: window.surl,
                main: window.main,
                logo: window.logo,
                icon:window.icon,
                mobile_menu:false,

                fetched: false,
                menu: [],
                topmenu:[],
    		}
    	},
        watch:{
            '$route.name': function (id) {
                this.checkSearch()
            }
        },
    	created: function () {
            this.checkSearch();
            this.fetchData()
        },
        mounted(){
            window.addEventListener('scroll', this.updateScroll);
        },
        methods: {
            updateScroll() {
                this.scrollPosition = window.scrollY
            },
            searchClick(){
                if(this.search.length<2){
                   alert('Хамгийн багадаа 2 тэмдэгт оруулна');
                   return;
                }
                this.$router.push({path:'/search/'+this.search});
                this.mobile_menu=false;
            },
            checkSearch(){
                if(this.$route.name!='search'){
                    this.search='';
                } else {
                    this.search=this.$route.params.id;
                }
            },
            fetchData: function () {
                this.menu=this.$store.getters.menu;
                axios.get('/menu/0/2').then((response) => {
                    this.topmenu=response.data.success
                    this.fetched = true;
                })
            },

            changeRoute: function(menu, i1,i2,i3,i4){
                this.si1=i1;
                this.si2=i2;
                this.si3=i3;
                this.si4=i4;
                this.mobile_menu=false;
                if(menu=='/'){
                    this.$router.push({path:'/'});
                    window.scrollTo(0,0);
                    return
                }
                if(menu.type==1){
                    window.open(menu.link, '_blank')
                } else {
                    this.$router.push({path:'/p/'+menu.id});
                    window.scrollTo(0,0);
                }



            },
        }
    }

</script>
<style>

</style>
