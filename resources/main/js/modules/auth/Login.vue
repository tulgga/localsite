<template>

    <div class="auth" :style="'background-image: url(\''+siteUrl+'/images/overlay_bg.jpg\');'">

        <div class="auth-main">
            <div class="auth-logo">
                <img :src="siteUrl+'/images/logo-admin-login.png'" >
            </div>
            <div class="auth-form">
                <form @submit.prevent="login">
                    <div class="usericon">
                        <span class="icon is-large">
                            <i class="ion-md-person has-text-white"></i>
                        </span>
                    </div>
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="text" v-model="user_name" name="user_name" placeholder="Нэвтрэх нэр" autofocus>
                            <span class="icon is-small is-left">
                                <i class="ion-md-contact"></i>
                            </span>
                        </div>

                    </div>
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="password" v-model="password" placeholder="Нууц үг" name="password">
                            <span class="icon is-small is-left">
                                <i class="ion-md-key"></i>
                            </span>
                        </div>
                    </div>
                    <p v-if="isError" class="help is-danger">{{ isError }}</p>
                    <button type="submit" class="button is-primary is-fullwidth" :class="{'is-loading':is_loading}" :disabled="is_loading">{{$store.getters.lang.auth.login}}</button>
                </form>
            </div>
            <div class="auth-footer">
                <p class="has-text-white has-text-centered">
                    {{ new Date().getFullYear() }} © ОН. БАЯНХОНГОР АЙМАГ.
                </p>
                <p class="has-text-white has-text-centered">
                    Developed by TowerSoft LLC
                </p>
            </div>
        </div>

    </div>

</template>
<script>
    export default {
        data(){
            return {
                user_name: null,
                password: null,
                isError:false,
                is_loading: false,
                verify:false,
                siteUrl:window.surl,
            }
        },
        methods: {
            async login () {
                // Submit the form.
                this.is_loading = true;
                let data = {
                    user_name: this.user_name,
                    password: this.password,
                };
                axios.post('/login', data).then((response) => {
                    if(response.data.success){
                        this.$store.dispatch('saveToken', {
                            token: response.data.success,
                            remember: this.remember
                        }).then((response) => {
                            this.$router.push({ name: 'home' })
                        })

                    }else{
                        this.is_loading = false;
                        this.isError = response.data.error;
                        this.password = null;
                    }
                }).catch(error => {
                    this.is_loading = false;
                    this.isError = error.response.data.error;
                    this.password = '';
                });
            }
        },
        created(){
            if(this.$store.getters.authCheck){
                this.$router.push({name: 'home'})
            }
            this.verify = this.$route.query.verify;
        }
    }
</script>
