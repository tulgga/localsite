<!--

CRUD Edit, Create form

 -->

<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card" style="max-width: 623px;">
            <header class="modal-card-head">
                <p class="modal-card-title">Миний профайл</p>
            </header>
            
            <section class="modal-card-body" v-if="fetched">
                <form @submit.prevent="nemeh">
                    <div class="columns is-mobile is-multiline">

                        <!-- Model-н field-үүд -->
                        <div class="column is-12-mobile is-6-tablet">
                            <div class="columns is-mobile is-multiline">

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Зураг</label>
                                        <div class="control has-image">
                                            <div class="file is-boxed is-fullwidth">
                                                <label class="file-label">
                                                    <input class="file-input" type="file" name="image2" @change="onFileChange($event.target.name, $event.target.files)">
                                                    <span class="file-cta">
                                                        <span v-if="imageni" class="file-icon" :style="'background-image: url('+imageni+');'">
                                                            <i class="ion-ios-add-outline"></i>
                                                        </span>
                                                        <span v-else="" class="file-icon no-background">
                                                            <i class="ion-ios-add-outline"></i>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нэр</label>
                                        <div class="control">
                                            <input type="text" name="f_name" v-validate="'required'" v-model="form.f_name" :class="{'input': true, 'is-danger': errors.has('f_name') }" />
                                            <p v-show="errors.has('f_name')" class="help is-danger">{{ errors.first('f_name') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Овог</label>
                                        <div class="control">
                                            <input type="text" name="l_name" v-model="form.l_name" class="input" />
                                        </div>
                                    </div>
                                </div>




                                
                            </div>
                        </div>
                        <div class="column is-12-mobile is-6-tablet">
                            <div class="columns is-mobile is-multiline">

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Утасны дугаар</label>
                                        <div class="control">
                                            <input type="text" name="phone" v-model="form.phone" :class="{'input': true, 'is-danger': errors.has('phone') }" />
                                            <p v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">И-мэйл хаяг</label>
                                        <div class="control">
                                            <input type="text" name="email" v-validate="{'required':true, 'email':true}" v-model="form.email" :class="{'input': true, 'is-danger': errors.has('email') }" />
                                            <p v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</p>
                                        </div>
                                    </div>
                                </div>







                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нэвтрэх нэр</label>
                                        <div class="control">
                                            <input type="text" name="user_name" v-validate="{'required':true}" v-model="form.user_name" :class="{'input': true, 'is-danger': errors.has('user_name') }" />
                                            <p v-show="errors.has('user_name')" class="help is-danger">{{ errors.first('user_name') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нууц үг</label>
                                        <div class="control">
                                            <input  type="password" name="password" v-validate="{ min: 6 }" v-model="form.password" :class="{'input': true, 'is-danger': errors.has('password') }" />
                                            <p v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нууц үг давтаж оруулна уу</label>
                                        <div class="control">
                                            <input type="password" name="password_confirm" v-validate="{ is: form.password }" v-model="password_confirm" :class="{'input': true, 'is-danger': errors.has('password_confirm') }" />
                                            <p v-show="errors.has('password_confirm')" class="help is-danger">{{ errors.first('password_confirm') }}</p>
                                        </div>
                                    </div>
                                </div>


                                
                            </div>
                        </div>

                    </div>
                </form>
            </section>
            <div v-else class="main-bodoh is-loading"></div>
            
            <footer class="modal-card-foot">
                <a class="button is-text" v-on:click="butsah">{{$store.getters.lang.messages.is_back_button}}</a>
                <button @click="nemeh" class="button is-primary add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                    <span>{{$store.getters.lang.messages.is_save_button}}</span>
                </button>
            </footer>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                siteUrl: window.surl,
                fetched: false,
                is_loading: false,
                form:{
                    f_name: '',
                    l_name: '',
                    user_name: '',
                    email: '',
                    phone: '',
                    password: '',
                },
                password_confirm: null,
                imageni:false,
                image: [],
                aldaanuud: [],
            }
        },
        created: function () {
            this.fetchData();
        },
        computed: {
        },
        methods: {
            fetchData: function () {

                axios.get('/admins/'+this.$store.getters.authUser.id).then((response) => {

                    this.form.f_name = response.data.success.f_name;
                    this.form.l_name = response.data.success.l_name;
                    this.form.user_name = response.data.success.user_name;
                    this.form.email = response.data.success.email;
                    this.form.phone = response.data.success.phone;

                    if (response.data.success.profile_pic) {
                        this.imageni = this.siteUrl+'/uploads/'+response.data.success.profile_pic;
                    }
                    this.fetched = true;
                })

            },

            // Back
            butsah: function() {
                return this.$nextTick(() => this.$router.back(-1))
            },
            // Нэмэх, Засах
            nemeh: function() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image)

                        // Update
                        axios.post('/admins/'+this.$store.getters.authUser.id, formData)
                            .then((response) => {
                                this.is_loading = false;
                                this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_updated_text});
                            })
                            .catch(error => {
                                this.aldaanuud = error.response.data.errors;
                                for (var i = 0; i < Object.keys(this.aldaanuud).length; i++) {
                                    let tulhur = Object.keys(this.aldaanuud)[i]
                                    this.errors.add({ field: tulhur, msg: this.aldaanuud[tulhur][0]});
                                }
                                this.is_loading = false;
                         });

                    }
                });
            },
            onFileChange(fieldName, fileList){
                const formData = new FormData();
                // append the files to FormData
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });

                this.image = formData.get(fieldName);


                let reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    this.imageni = reader.result;
                });
                reader.readAsDataURL(fileList[0]);
            },
        }
    }
</script>