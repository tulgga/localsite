<!--

CRUD Edit, Create form

 -->

<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p v-if="m_id" class="modal-card-title">Ажилтан засах</p>
                <p v-else class="modal-card-title">Ажилтан нэмэх</p>
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
                                                    <input class="file-input" type="file" name="image2" accept="image/*" @change="onFileChange($event.target.name, $event.target.files)">
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
                                        <label class="label">Нэр <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="f_name" v-validate="{'required':true, 'min':2}" v-model="form.f_name" :class="{'input': true, 'is-danger': errors.has('f_name') }" />
                                            <p v-show="errors.has('f_name')" class="help is-danger">Заавал бөглө, хамгийн багадаа 2 тэмдэгт байна.</p>
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
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Утасны дугаар</label>
                                        <div class="control">
                                            <input type="text" name="phone" v-model="form.phone" :class="{'input': true, 'is-danger': errors.has('phone') }" />
                                            <p v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-12-mobile is-6-tablet">
                            <div class="columns is-mobile is-multiline">

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">И-мэйл хаяг <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="email" v-validate="{'required':true, 'email':true}" v-model="form.email" :class="{'input': true, 'is-danger': errors.has('email') }" />
                                            <p v-show="errors.has('email')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Төрөл</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="admin_type" v-model="form.admin_type" v-validate="'required'" v-on:change="changeAdminType">
                                                    <option value="0">супер админ</option>
                                                    <option value="1">нийтлэгч</option>
                                                    <option value="2">дэд админ</option>
                                                    <option value="3">дэд нийтлэгч</option>
                                                </select>
                                            </div>
                                            <p v-show="errors.has('admin_type')" class="help is-danger">{{ errors.first('admin_type') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.admin_type<2" class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Хэлтэс</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="heltes_id" v-model="form.heltes_id" v-validate="'required'" >
                                                    <option value="0"></option>
                                                    <template v-for="h in heltes">
                                                        <option :value="h.id">{{h.name}}</option>
                                                    </template>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div v-if="form.admin_type>1" class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Дэд сайт</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="site_id" v-model="form.site_id" v-validate="'required'" >
                                                    <option value="">дэд сайт сонгох</option>
                                                    <template v-for="site in sites">
                                                        <option :value="site.id">{{site.name}}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <p v-show="errors.has('site_id')" class="help is-danger">{{ errors.first('site_id') }}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нэвтрэх нэр <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="user_name" v-validate="{'required':true, 'min':6}" v-model="form.user_name" :class="{'input': true, 'is-danger': errors.has('user_name') }" />
                                            <p v-show="errors.has('user_name')" class="help is-danger">Заавал бөглө, хамгийн багадаа 6 тэмдэгт байна.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нууц үг <span v-if="!m_id" class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input v-if="m_id" type="password" name="password" v-validate="{ min: 6 }" v-model="form.password" :class="{'input': true, 'is-danger': errors.has('password') }" />
                                            <input v-else type="password" name="password" v-validate="{ required:true, min: 6 }" v-model="form.password" :class="{'input': true, 'is-danger': errors.has('password') }" />
                                            <p v-show="errors.has('password')" class="help is-danger">Заавал бөглө, хамгийн багадаа 6 тэмдэгт байна.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нууц үг давтаж оруулна уу</label>
                                        <div class="control">
                                            <input v-if=" form.password.length>0" type="password" name="password_confirm" v-validate="{'required':true, 'is': form.password }" v-model="password_confirm" :class="{'input': true, 'is-danger': errors.has('password_confirm') }" />
                                            <input v-else type="password" name="password_confirm" v-validate="{ 'confirmed': password }" v-model="password_confirm" :class="{'input': true, 'is-danger': errors.has('password_confirm') }" />
                                            <p v-show="errors.has('password_confirm')" class="help is-danger">Нууц үгтэй зөрж байна</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Төлөв</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="status" v-model="form.status" v-validate="'required'">
                                                    <option value="1">Идэвхитэй</option>
                                                    <option value="0">Идэвхигүй</option>
                                                </select>
                                            </div>
                                            <p v-show="errors.has('status')" class="help is-danger">{{ errors.first('status') }}</p>
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
                m_id: false, 			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                sites: [],
                heltes:[],
                form:{
                    f_name: '',
                    l_name: '',
                    user_name: '',
                    email: '',
                    phone: '',
                    admin_type: 0,
                    status: 1,
                    site_id: 0,
                    heltes_id:0,
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

                axios.get('/site').then((response) => {
                    this.sites = response.data.success;
                    console.log(this.sites);
                })
                axios.get('/heltes').then((response) => {
                    this.heltes = response.data.success;
                    console.log(this.heltes);
                })
                this.m_id = this.$route.params.id;  // route дээр ирж байгаа id-г авч байна / edit үед
                if (this.m_id) {
                    axios.get('/admins/'+this.m_id).then((response) => {

                        this.form.f_name = response.data.success.f_name;
                        this.form.l_name = response.data.success.l_name;
                        this.form.user_name = response.data.success.user_name;
                        this.form.email = response.data.success.email;
                        this.form.phone = response.data.success.phone;
                        this.form.admin_type = response.data.success.admin_type;
                        this.form.status = response.data.success.status;
                        this.form.site_id = response.data.success.site_id;
                        this.form.heltes_id = response.data.success.heltes_id;

                        if (response.data.success.profile_pic) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.profile_pic;
                        }
                        this.fetched = true;
                    })

                } else {
                    this.fetched = true;
                }
            },
            changeAdminType: function(){
               if(this.form.admin_type>1){
                   this.form.site_id='';
               }  else {
                   this.form.site_id=0;
               }
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

                        this.m_id = this.$route.params.id;
                        if (this.m_id) {
                            // Update
                            axios.post('/admins/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/employees');
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
                        } else {
                            // Create
                            axios.post('/admins', formData)
                                .then((response) => {
                                    this.$router.push('/employees');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                })
                                .catch(error => {
                                    this.aldaanuud = error.response.data;
                                    for (var i = 0; i < Object.keys(this.aldaanuud).length; i++) {
                                        let tulhur = Object.keys(this.aldaanuud)[i];
                                        this.errors.add({ field: tulhur, msg: this.aldaanuud[tulhur][0]});
                                    }
                                    this.is_loading = false;
                                });
                        }
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