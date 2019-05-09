<!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div  class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title">Зар засах</p>
                    <p v-else class="modal-card-title">Зар нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">

                        <div class="columns is-mobile is-multiline">

                            <!-- Model-н field-үүд -->

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Ангилал  <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                           <treeselect  v-validate="'required'" v-model="form.cat_id"  name="cat_id" placeholder="Ангилал сонгох" :class="{ 'is-danger': errors.has('cat_id') }" :multiple="false" :options="options" />
                                            <p v-show="errors.has('cat_id')" class="help is-danger">Заавал сонго</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Сум  <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <treeselect  v-validate="'required'" v-model="form.site_id"  name="cat_id" placeholder="Cум сонгох" :class="{ 'is-danger': errors.has('site_id') }" :multiple="false" :options="sites" />
                                            <p v-show="errors.has('site_id')" class="help is-danger">Заавал сонго</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Онцлох зар  <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="gender" v-model="form.is_pin" v-validate="'required'" >
                                                    <option value="0">үгүй</option>
                                                    <option value="1">Тийм</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="form.is_pin==1" class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Онцлох зар дуусах огноо <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="date" name="pin_date" v-validate="{'required':true, }" v-model="form.pin_date" :class="{'input': true, 'is-danger': errors.has('pin_date') }" />
                                            <p v-show="errors.has('pin_date')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Гарчиг  <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="title" v-validate="'required'" v-model="form.title" :class="{'input': true, 'is-danger': errors.has('title') }" />
                                            <p v-show="errors.has('title')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Тайлбар  <span class="has-text-danger">*</span></label>
                                        <textarea name="content"  v-validate="'required'"  v-model="form.content"  :class="{'textarea': true, 'is-danger': errors.has('content') }"></textarea>
                                        <p v-show="errors.has('content')" class="help is-danger">Заавал бөглө</p>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Зураг</label>
                                        <div class="control has-image">
                                            <div class="file is-boxed is-fullwidth">
                                                <label class="file-label">
                                                    <input class="file-input" accept="image/*"  :class="{'textarea': true, }" type="file" name="image2" @change="onFileChange($event.target.name, $event.target.files)">
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

                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Үнэ  <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="price" v-validate="{'required':true }" v-model="form.price" :class="{'input': true, 'is-danger': errors.has('price') }" />
                                            <p v-show="errors.has('price')" class="help is-danger">Заавал бөглө, зөвхөн тоо байна</p>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Утас  <span class="has-text-danger">*</span></label>
                                        <div class="control ">
                                            <input type="text" name="phone" v-validate="{'required':true}" v-model="form.phone" :class="{'input': true, 'is-danger': errors.has('phone') }" />
                                            <p v-show="errors.has('phone')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control ">
                                            <input type="text" name="email"  v-model="form.email"  :class="{'input': true,  }" />
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

    </div>
</template>

<script>

    export default {
        data(){
            return {
                options: [],
                sites:[],
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: false,
                site_id: this.$store.getters.domain.id,
                is_loading: false,
                m_id: false,
                file: [],
                imageni:false,
                form:{
                    title: '',
                    content: '',
                    price: '',
                    phone: '',
                    email: '',
                    is_pin: 0,
                    pin_date: null,
                    site_id: 49,
                },
                aldaanuud: [],
            }
        },
        created: function () {
            this.fetchData();
        },
        computed: {
        },
        methods: {
            fetchData() {
                this.m_id = this.$route.params.id;
                axios.get('/zar_category/0').then((response) => {
                    this.options = response.data.success;
                    axios.get('site').then((r) => {
                        this.sites=r.data.success;
                        this.fetched = true;
                    })
                });

                if (this.m_id) {
                    axios.get('/zar/'+this.m_id).then((response) => {
                        this.form.title = response.data.success.title;
                        this.form.content = response.data.success.content;
                        this.form.price = response.data.success.price;
                        this.form.phone = response.data.success.phone;
                        this.form.email = response.data.success.email;
                        this.form.cat_id=response.data.success.cat_id;
                        this.form.site_id=response.data.success.site_id;
                        this.form.is_pin=response.data.success.is_pin;
                        this.form.pin_date=response.data.success.pin_date;

                        if (response.data.success.image) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.image;
                        }

                        this.fetched = true;
                    })
                } else {
                    this.fetched = true;
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
                        if(!this.form.cat_id){
                            alert('Зарын ангилал оруулна уу');
                            this.is_loading = false;
                            return;
                        }
                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image);
                        // Create
                        if (this.m_id) {
                            axios.post('/zar/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/zar');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/zar', formData)
                                .then((response) => {
                                    this.$router.push('/zar');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
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
