<template>

    <div class="auth">

        <div class="auth-overlay" :style="'background-image: url('+require('../../../img/auth/overlay_bg.jpg')+');'">
        </div>

        <div class="auth-main">
            <form @submit.prevent="login">
                <div class="authform">

                    <div class="usericon">
                        <span class="icon is-large">
                            <i class="fas fa-user fa-2x has-text-white"></i>
                        </span>
                    </div>

                    <p class="title has-text-centered is-4 is-uppercase has-text-primary has-text-weight-bold mb2">{{$store.getters.lang.auth.forgot_password_title}}</p>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="text" v-model="name" name="name" placeholder="Username" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="ion-md-contact"></i>
                            </span>
                        </div>
                        <p v-if="isError" class="help is-danger">{{ isError }}</p>
                        <p v-if="isSuccess" class="help is-success">{{ isSuccess }}</p>
                        <p v-if="isSuccess" class="help">{{ hidemail }}</p>
                    </div>

                    <button type="submit" class="button is-primary is-fullwidth" :class="{'is-loading':loading}">{{$store.getters.lang.auth.send_password_reset_link}}</button>

                </div>
            </form>
        </div>

    </div>

</template>
<script>
    import { Carousel, Slide } from 'vue-carousel'
    export default {
        components: {
            Carousel,
            Slide
        },
        data(){
            return {
                name:'',
                password:'',
                remember:false,
                isError:false,
                isSuccess:false,
                loading: false,
                hidemail: false,
            }
        },
        methods: {
            login () {
                // Submit the form.
                this.loading = true;
                this.isError = false;
                this.isSuccess = false;
                // const formData = new FormData();
                // formData.append('username',this.name);
                // formData.append('password',this.password);

                let data = {
                    username: this.name
                }
                axios.post('/password/email', data).then((response) => {
                    if(response.data.success){
                        this.loading = false;
                        this.isSuccess = response.data.success;
                        this.hidemail = response.data.email;
                        //TODO login ruu redirect hiine
                        this.name = '';
                    }else{
                        this.loading = false;
                        this.isError = response.data.failure;
                        this.username = '';
                    }
                }).catch(error => {
                    this.loading = false;
                    this.isError = error.response.data.errors;
                    this.username = '';
                });
            }
        },
        created(){
            if(this.$store.getters.authCheck){
                this.$router.push({name: 'home'})
            }
        }
    }
</script>
