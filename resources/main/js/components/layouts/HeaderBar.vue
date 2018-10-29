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
                        <form method="get" class="searchform mt-0" action="https://news.mn/search/">
                            <input type="text" value="" name="q" placeholder="Хайх...">
                            <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                        </form>
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
                                <li v-for="m1 in menu">
                                    <a href="">{{m1.name}}</a>
                                     <ul  v-if="m1.children" >
                                         <li v-for="m2 in m1.children">
                                             <a href="">{{m2.name}}</a>
                                             <ul  v-if="m2.children" >
                                                 <li v-for="m3 in m2.children">
                                                     <a href="">{{m3.name}}</a>
                                                     <ul  v-if="m3.children" >
                                                         <li v-for="m4 in m3.children">
                                                             <a href="">{{m4.name}}</a>
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
                                <li><a>Бусад сумдууд</a></li>
                                <li><a>Агентлагууд</a></li>
                                <li><a>Зар</a></li>
                                <li><a>Санар хүсэлт, өргөдөл гомдол</a></li>
                            </ul>
                        </aside>

                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-menu-bg"  v-if="mobile_menu" @click="mobile_menu=false"></div>

        <div v-if="fetched" :style="{'background-color': main.parent_color.hex}">

            <header id="header-mobile" class="is-hidden-tablet">
                <div class="columns is-mobile">
                    <div class="column is-2 ">
                        <a class="button is-text menu" @click="mobile_menu=true" > <span class="icon is-white "><i class="fas fa-bars "></i></span></a>
                    </div>
                    <div class="column is-8">
                        <div class="has-text-centered">
                            <figure class="image ">
                                <img :src="logo" :title="site_title"/>
                            </figure>
                        </div>

                    </div>
                    <div class="column is-2 has-text-right">
                        <a class="button is-text search" @click="mobile_menu=true" > <span class="icon is-white "><i class="fas fa-search "></i></span></a>
                    </div>
                </div>
            </header>

            <header  id="header" class="is-hidden-mobile" >
                <div id="header-top"  :style="{'background-color': !main.main_color.hex}">
                    <div class="container">
                        <nav class="level">
                            <div class="level-left ml-1" >
                                <p v-if="socail.facebook" class="level-item"><a target="_blank" :href="socail.facebook"><i class="fab fa-facebook"></i></a></p>
                                <p v-if="socail.twitter" class="level-item"><a target="_blank" :href="socail.twitter"><i class="fab fa-twitter-square"></i></a></p>
                                <p v-if="socail.messenger" class="level-item"><a target="_blank" :href="socail.messenger"><i class="fab fa-facebook-messenger"></i></a></p>
                                <p v-if="socail.google" class="level-item"><a target="_blank" :href="socail.google"><i class="fab fa-google-plus-g"></i></a></p>
                                <p v-if="socail.youtube" class="level-item"><a target="_blank" :href="socail.youtube"><i class="fab fa-youtube"></i></a></p>
                            </div>
                            <div class="level-right mr-1 ">
                                <p class="level-item"><a>Бусад сумдууд</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item"><a>Агентлагууд</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item"><a>Зар</a></p>
                                <p class="level-item">|</p>
                                <p class="level-item"><a>Санар хүсэлт, өргөдөл гомдол</a></p>
                            </div>
                        </nav>

                    </div>
                </div>
                <div id="header-content" >
                    <div class="container">
                        <div  class="columns">
                            <div  class="column is-8">
                                <figure class="image logo">
                                    <img :src="logo" :title="site_title"/>
                                </figure>
                            </div>
                            <div class="column is-4">
                                <form method="get" class="is-pulled-right searchform" action="https://news.mn/search/">
                                    <input type="text" value="" name="q" placeholder="Хайх...">
                                    <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="header-menu" :style="{'background-color': !main.main_color.hex}">
                    <div class="container">
                        <ul id="menu">
                            <li class="is-active"><a href="/"><img :src="siteUrl+'/images/home.png'"/></a></li>
                            <li v-for="m1 in menu">
                                <a href="">{{m1.name}}</a>
                                <ul  v-if="m1.children" >
                                    <li v-for="m2 in m1.children">
                                        <a href="">{{m2.name}}</a>
                                        <ul  v-if="m2.children" >
                                            <li v-for="m3 in m2.children">
                                                <a href="">{{m3.name}}</a>
                                                <ul  v-if="m3.children" >
                                                    <li v-for="m4 in m3.children">
                                                        <a href="">{{m4.name}}</a>
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

        <template v-else>
            <div class="loading"  style="background-image:url('../../images/loading.gif')"></div>
        </template>


    </div>
</template>

<script>
    export default {
    	data(){
    		return {
    		    socail:  window.socail,
                siteUrl: window.surl,
                main: window.main,
                logo: window.logo,
                icon:window.icon,
                mobile_menu:false,
                fetched: false,
                site_title: window.title,
                menu: [],
                top_menu:[
                    {

                    }
                ],
    		}
    	},
    	created: function () {
            this.fetchData()
        },
        mounted(){
        },
        methods: {
            fetchData: function () {
                axios.get('/menu/'+0).then((response) => {
                    this.menu=response.data.success;
                    this.fetched = true;
                })
                console.log(this.mobile_menu)
            }
        }
    }

</script>
<style>

</style>