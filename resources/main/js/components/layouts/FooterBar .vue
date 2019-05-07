<template>
        <footer id="footer"  class="roboto-condensed" :style="{'background-color': main.parent_color.hex}">


            <div :style="{'background-color': main.parent_color.hex}">
                <div class="container pt-2 pb-2" >
                    <div class="columns">
                        <div class="column is-3  footer-menu" >
                            <h3>СУМД</h3>
                            <div class="columns is-multiline pb-1 m-0">
                                <div v-for="site in sites" class="column is-6 p-0 " >
                                    <a  :href="'http://'+site.domain+'.'+subdomain" target="_blank" >
                                        {{site.name}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="column is-6  footer-menu" >
                            <h3>ХЭЛТЭС АГЕНТЛАГ</h3>
                            <div  v-if="agentlag" >
                                <!--blog list-->
                                <div class="columns is-multiline pb-1 m-0">
                                    <div v-for="link in agentlag" class="column is-6 p-0 ">
                                        <a  :href="link.link" target="_blank"  >
                                            {{link.name}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-3 ">
                            <h3>ХОЛБОО БАРИХ</h3>
                            <div class="columns is-multiline">
                                <div class="column is-1 pt-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="column is-11 ">
                                    <p class="description " :title="contact.address" v-html="contact.address"></p>
                                </div>
                                <div class="column is-1 pt-1">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="column is-11">
                                    <p class="description " :title="contact.email" v-html="contact.email"></p>
                                </div>
                                <div class="column is-1 pt-1">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="column is-11">
                                    <p class="description " :title="contact.phone" v-html="contact.phone"></p>
                                </div>
                            </div>


                            <a class="footer-socail-menu" v-if="socail.facebook" target="_blank" :href="socail.facebook"><i class="fab fa-facebook fa-lg"></i></a>
                            <a class="footer-socail-menu" v-if="socail.twitter" target="_blank" :href="socail.twitter"><i class="fab fa-twitter-square fa-lg"></i></a>
                            <a class="footer-socail-menu" v-if="socail.messenger" target="_blank" :href="socail.messenger"><i class="fab fa-facebook-messenger fa-lg"></i></a>
                            <a class="footer-socail-menu" v-if="socail.youtube" target="_blank" :href="socail.youtube"><i class="fab fa-youtube fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-html="main.copyright"  style="font-size:13px" class="copyright p-15 has-text-centered"></div>
        </footer>
</template>

<script>
    export default {
    	data(){
    		return {
                site_title: window.title,
                socail:  window.socail,
                subdomain: window.subdomain,
                siteUrl: window.surl,
                main: window.main,
                logo: window.logo,
                icon:window.icon,
                contact: window.contact,
                user_menu: false,
                user: false,
                user_nav: false,
                sites: false,
                agentlag: false,
    		}
    	},
    	created: function () {
            this.fetchData();
        },
        mounted(){
        },
        methods: {
            fetchData(){
                axios.get('sites').then((response) => {
                    this.sites=response.data.success
                });
                axios.get('agentlag').then((response) => {
                    this.agentlag=response.data.success
                })
            }
        }
    }

</script>
