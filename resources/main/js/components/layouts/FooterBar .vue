<template>
	<div>
        <footer id="footer"  class="roboto-condensed" :style="{'background-color': main.parent_color.hex}">

            <div class="contact">
                <div class="container p-2">
                    <div class="columns">
                        <div class="column is-3">
                            <h3 class="title">Сумдууд</h3>
                        </div>
                        <div class="column is-5">
                            <h3 class="title">Агентлаг</h3>
                        </div>
                        <div class="column is-4">
                            <h3 class="title">Холбоо барих</h3>
                            <div>
                                <i class="fas fa-map-marker-alt"></i>
                                <p class="description" :title="contact.address">{{contact.address}}</p>
                            </div>
                            <div>
                                <i class="fas fa-envelope"></i>
                                <p class="description" :title="contact.email">{{contact.email}}</p>
                            </div>
                            <div>
                                <i class="fas fa-phone"></i>
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
            <div v-html="main.copyright" class="copyright p-1 has-text-centered" :style="{'background-color': main.main_color.hex}"></div>
        </footer>

    </div>
</template>

<script>
    export default {
    	data(){
    		return {
                site_title: window.title,
                socail:  window.socail,
                siteUrl: window.surl,
                main: window.main,
                logo: window.logo,
                icon:window.icon,
                contact: window.contact,
                user_menu: false,
                user: false,
                user_nav: false,
    		}
    	},
    	created: function () {

        },
        mounted(){
        },
        methods: {

        }
    }

</script>
