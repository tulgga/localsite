<template>

    <div class="auth">

        <div class="auth-overlay"></div>

        <div class="auth-main">
            <form @submit.prevent="login">
                <div class="authform">

                    <div class="usericon">
                        <span class="icon is-large">
                            <i class="fas fa-user fa-2x has-text-white"></i>
                        </span>
                    </div>

                    <p class="title has-text-centered is-4 is-uppercase has-text-primary has-text-weight-bold mb2">{{$store.getters.lang.messages.login}}</p>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input" type="text" v-model="name" name="name" placeholder="Username" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="ion-md-contact"></i>
                            </span>
                        </div>
                        <p v-if="isError" class="help is-danger">{{ isError }}</p>
                    </div>
                    <div class="field">
                        <div class="control has-icons-left">
                            <input type="password" name="password" v-model="password" v-validate="{ required: true, is: confirm_password }" placeholder="Password" :class="{'input': true, 'is-danger': errors.has('password') }" />
                            <span class="icon is-small is-left">
                                <i class="ion-md-key"></i>
                            </span>
                            <p v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</p>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control has-icons-left">
                            <input type="password" name="confirm_password" v-model="confirm_password" v-validate="{ required: true }" placeholder="Confirm" :class="{'input': true, 'is-danger': errors.has('confirm_password') }" />
                            <span class="icon is-small is-left">
                                <i class="ion-md-key"></i>
                            </span>
                            <p v-show="errors.has('confirm_password')" class="help is-danger">{{ errors.first('confirm_password') }}</p>
                        </div>
                    </div>

                    <button type="submit" class="button is-primary is-fullwidth" :class="{'is-loading':loading}">Reset Password</button>


                </div>
            </form>
            <p class="foottext has-text-black">2018 © Egulen</p>
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
                confirm_password: ''
            }
        },
        methods: {
            login () {
                // Submit the form.
                this.loading = true;
                // const formData = new FormData();
                // formData.append('username',this.name);
                // formData.append('password',this.password);

                let data = {
                    username: this.name,
                    password: this.password,
                    token: this.$route.query.token
                }
                axios.post('/password/reset', data).then((response) => {
                    if(response.data.success){
                        this.$store.dispatch('saveToken', {
                            token: response.data.success,
                            remember: this.remember
                        })
                        // Fetch the user.
                        this.$store.dispatch('fetchUser')
                        // Redirect home.
                        this.$router.push({ name: 'home' })
                    }else{
                        this.loading = false;
                        this.isError = response.data.failure;
                    }
                }).catch(error => {
                    this.loading = false;
                    this.isError = error.response.data.errors;
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
