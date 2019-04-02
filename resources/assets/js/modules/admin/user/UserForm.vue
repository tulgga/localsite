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
                                        <label class="label">Нэвтрэх нэр <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="name" v-validate="{'required':true, 'min':6}" v-model="form.name" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                            <p v-show="errors.has('name')" class="help is-danger">Заавал бөглө, хамгийн багадаа 6 тэмдэгт байна.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Овог</label>
                                        <div class="control">
                                            <input type="text" name="lastname" v-model="form.lastname" class="input" />
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Нэр</label>
                                        <div class="control">
                                            <input type="text" name="firstname" v-model="form.firstname" class="input" />
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
                                        <label class="label">Төрсөн огноо <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="date" name="birth_date" v-validate="{'required':true, }" v-model="form.birth_date" :class="{'input': true, 'is-danger': errors.has('birth_date') }" />
                                            <p v-show="errors.has('birth_date')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                </div>

                                <div  class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Хүйс</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="gender" v-model="form.gender" v-validate="'required'" >
                                                    <option value="1">эрэгтэй</option>
                                                    <option value="0">эмэгтэй</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div  class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Төлөв</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="status" v-model="form.status" v-validate="'required'" >
                                                    <option value="0">0-Шинэ хэрэглэгч</option>
                                                    <option value="1">1-Баталгаажсан байх</option>
                                                    <option value="2">2-Өөрийн хүсэлтээр хандах эрх хаалгасан хэрэглэгч</option>
                                                    <option value="3">3-Системээс хандах эрх хаагдсан хэрэглэгч ban</option>
                                                    <option value="4">4-Нууц үгээ сэргээх хүсэлт явуулсан</option>
                                                </select>
                                            </div>
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
                    name:'',
                    lastname:'',
                    firstname:'',
                    email:'',
                    phone:'',
                    gender:0,
                    birth_date:'',
                    registration_no:'',
                    status:0,
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


                this.m_id = this.$route.params.id;  // route дээр ирж байгаа id-г авч байна / edit үед
                if (this.m_id) {
                    axios.get('/users/'+this.m_id).then((response) => {

                        this.form.name = response.data.success.name;
                        this.form.lastname = response.data.success.lastname;
                        this.form.firstname = response.data.success.firstname;
                        this.form.email = response.data.success.email;
                        this.form.phone = response.data.success.phone;
                        this.form.gender = response.data.success.gender;
                        this.form.birth_date = response.data.success.birth_date;
                        this.form.registration_no = response.data.success.registration_no;
                        this.form.status = response.data.success.status;

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
                            axios.post('/users/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/users');
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
                            axios.post('/users', formData)
                                .then((response) => {
                                    this.$router.push('/users');
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