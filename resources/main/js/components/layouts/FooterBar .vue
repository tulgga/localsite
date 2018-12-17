<template>
	<div>
        <footer id="footer"  class="roboto-condensed" :style="{'background-color': main.parent_color.hex}">

            <div class="contact">
                <div class="container p-2">
                    <div class="columns">
                        <div class="column is-3">
                            <h3 class="title mb-3">Сумдууд</h3>
                            <div v-if="sites" class="columns sumduud is-multiline">
                                <div v-for="site in sites" class="column is-6">
                                    <a target="_blank" :href="'http://'+site.domain+'.'+subdomain" >
                                        <img v-if="site.favicon===null" :src="icon" >
                                        <img v-else :src="siteUrl+'/uploads/'+site.favicon"/>
                                            {{site.name}}
                                    </a>
                                </div>
                            </div>
                            <loading v-else></loading>
                        </div>
                        <div class="column is-6">
                            <h3 class="title mb-3">Агентлаг</h3>
                            <div v-if="agentlag" class="columns sumduud is-multiline">
                                <div v-for="link in agentlag" class="column is-6 footer-link">
                                    <a :href="link.link" target="_blank" >
                                        {{link.name}}
                                    </a>
                                </div>
                            </div>
                            <loading v-else></loading>
                        </div>
                        <div class="column is-3">
                            <h3 class="title mb-3">Холбоо барих</h3>
                            <div class="mb-05">
                                <i class="fas fa-map-marker-alt list"></i>
                                <p class="description" :title="contact.address">{{contact.address}}</p>
                            </div>
                            <div class="mb-05">
                                <i class="fas fa-envelope list"></i>
                                <p class="description" :title="contact.email">{{contact.email}}</p>
                            </div>
                            <div class="mb-05">
                                <i class="fas fa-phone list"></i>
                                <p class="description" :title="contact.phone">{{contact.phone}}</p>
                            </div>
                            <div class="footer-menu has-text-centered-mobile">
                                <a v-if="socail.facebook" target="_blank" :href="socail.facebook"><i class="fab fa-facebook fa-lg"></i></a>
                                <a v-if="socail.twitter" target="_blank" :href="socail.twitter"><i class="fab fa-twitter-square fa-lg"></i></a>
                                <a v-if="socail.messenger" target="_blank" :href="socail.messenger"><i class="fab fa-facebook-messenger fa-lg"></i></a>
                                <a v-if="socail.google" target="_blank" :href="socail.google"><i class="fab fa-google-plus-g fa-lg"></i></a>
                                <a v-if="socail.youtube" target="_blank" :href="socail.youtube"><i class="fab fa-youtube fa-lg"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </footer>
        <div v-html="main.copyright" class="copyright p-2 has-text-centered has-text-white" :style="{'background-color': main.main_color.hex}"></div>
    </div>
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
                })
                axios.get('agentlag').then((response) => {
                    this.agentlag=response.data.success
                })
            }
        }
    }

</script>
