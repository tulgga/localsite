<template>
	<div class="toolbar is-white">
		<div class="logo">
            <img v-if="this.$store.getters.drawer!=1" :src="siteUrl+'/images/logo_toolbar.png'" alt="GSB capital">
    		<button class="button navbar-burger" v-on:click="drawerchange">
			  	<span></span>
			  	<span></span>
			  	<span></span>
			</button>
    	</div>
    	<nav class="breadcrumb is-hidden-mobile" aria-label="breadcrumbs">
            <ul>
                <template v-if="$route.meta.bread_crumbs">
                    <li v-for="item in $route.meta.bread_crumbs">
                        <router-link :to="{name: item.rname}">{{ item.title }}</router-link>
                    </li>
                </template>
                <li class="is-active"><a href="#" aria-current="page">{{$route.meta.page_title}}</a></li>
            </ul>
        </nav>
		<div class="login-user" @click="user_nav = !user_nav">
            <article class="media">
                <figure class="media-left" v-if="user.profile_pic">
                    <p class="image is-48x48" :style="'background-image: url('+siteUrl+'/uploads/'+user.profile_pic+');'"></p>
                </figure>
                <figure class="media-left" v-else="">
                    <p class="image is-48x48"><span class="icon"><i class="ion-md-person"></i></span></p>
                </figure>
                <div class="media-content is-hidden-mobile">
                    <div class="content">
                        <p>{{ user.f_name+' '+user.l_name }}</p>
                        <small>
                            <template v-if="user.admin_type == 0">Супер админ</template>
                            <template v-else-if="user.admin_type == 1">нийтлэгч</template>
                            <template v-else-if="user.admin_type == 2">дэд админ</template>
                            <template v-else-if="user.admin_type == 3">дэд нийтлэгч</template>
                            <template v-else="">энгийн админ</template>
                        </small>
                    </div>
                </div>
            </article>
        </div>
        <div class="modal is-active" v-if="user_nav">
            <div class="modal-background" @click="user_nav = !user_nav"></div>
            <div class="modal-content modal-content-small">
                <div class="box">
                    <p><a class="button is-text is-fullwidth" @click="logout">Системээс гарах</a></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    	data(){
    		return {
                siteUrl: window.surl,
                user_menu: false,
                user: false,
                user_nav: false,
    		}
    	},
    	created: function () {
            this.fetchData();
        },
        mounted(){
        },
        methods: {
            fetchData: function() {
                this.user = this.$store.getters.authUser;
            },
            async logout () {
                // Log out the user.
                await this.$store.dispatch('logout');
                // Redirect to login.
                this.$router.push({ name: 'login' })
            },
            drawerchange: function() {
                if (this.$store.getters.drawer == true) {
                    this.$store.commit('changedrawerstore', false)
                } else {
                    this.$store.commit('changedrawerstore', 1)
                }
            },
            user_menu_change: function() {
                this.user_menu = !this.user_menu;
            }
        }
    }

</script>
