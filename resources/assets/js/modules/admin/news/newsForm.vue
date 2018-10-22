<!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div  class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card modal-card-full">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title">Мэдээ засах</p>
                    <p v-else class="modal-card-title">Мэдээ нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">

                        <div class="columns is-mobile is-multiline">


                            <div class="column is-12-mobile is-3-tablet is-2-desktop">
                                <div class="field">
                                    <label class="label">Зураг</label>
                                    <div class="control has-image">
                                        <div class="file is-boxed is-fullwidth">
                                            <label class="file-label">
                                                <input class="file-input" type="file" v-validate="'required'" name="imageni" @change="onFileChange($event.target.name, $event.target.files)">
                                                <span class="file-cta" :class="{ 'is-danger': errors.has('imageni') }">
                                                <span v-if="imageni" class="file-icon" :style="'background-image: url('+imageni+');'">
                                                    <i class="ion-ios-add-outline"></i>
                                                </span>
                                                <span v-else="" class="file-icon no-background">
                                                    <i class="ion-ios-add-outline"></i>
                                                </span>
                                            </span>
                                            </label>
                                            <p v-show="errors.has('imageni')" class="help is-danger">{{ errors.first('imageni') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Товч текст</label>
                                    <textarea  name="short_content" v-validate="'required'"   v-model="form.short_content" :class="{'textarea': true, 'is-danger': errors.has('short_content') }" ></textarea>
                                    <p v-show="errors.has('short_content')" class="help is-danger">{{ errors.first('short_content') }}</p>
                                </div>

                                <div class="field">
                                    <label class="label">Ангилал</label>
                                        <treeselect v-model="form.cat_id" :flat="true"  :default-expand-level="10" :multiple="true" :options="options" />
                                </div>

                                <div class="field">
                                    <label class="label">Онцлох мэлээ</label>
                                    <div class="control select">
                                        <select class="input"  v-model="form.is_primary" >
                                            <option value="0">үгүй</option>
                                            <option value="1">тийм</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Төрөл</label>
                                    <div class="control select">
                                        <select class="input"  v-model="form.type" >
                                            <option value="0">мэдээ</option>
                                            <option value="1">фото</option>
                                            <option value="1">видео</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Төлөв</label>
                                    <div class="control select">
                                        <select class="input"  v-model="form.status" >
                                            <option value="1">Нийтлэсэн</option>
                                            <option value="0">Ноорог</option>
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <div class="column is-12-mobile is-9-tablet is-10-desktop">
                                <div class="field">
                                    <label class="label">Гарчиг</label>
                                    <div class="control">
                                        <input type="text" name="title" v-validate="'required'" v-model="form.title" :class="{'input': true, 'is-danger': errors.has('title') }" />
                                        <p v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</p>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Дэлгэрэнгүй мэдээлэл</label>
                                    <div class="control has-autoblock">
                                        <ckeditor v-model="form.content" name="content" v-validate="'required'" :config="ck_config" :class="{'is-danger': errors.has('content') }"></ckeditor>
                                        <p v-show="errors.has('content')" class="help is-danger">{{ errors.first('content') }}</p>
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
    import Ckeditor from 'vue-ckeditor2'
    export default {
        components: {
            Ckeditor
        },
        data(){
            return {
                options: [],
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: false,
                site_id: this.$store.getters.domain.id,
                is_loading: false,
                m_id: false,
                imageni:false,
                image: [],
                file: [],
                ck_config: {
                    height: 500,
                    filebrowserBrowseUrl: window.surl+'/elfinder/ckeditor',
                },
                form:{
                    title: '',
                    content: '',
                    short_content: '',
                    type: 0,
                    status: 1,
                    is_primary: 0,
                    cat_id: [],
                    admin_id: this.$store.getters.authUser.id,
                    site_id: this.$store.getters.domain.id,
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
                axios.get('/news_category/'+this.site_id).then((response) => {
                    this.options = response.data.success;
                })

                if (this.m_id) {
                    axios.get('/file/'+this.m_id).then((response) => {
                        this.form.name = response.data.success.name;
                        this.form.content = response.data.success.content;
                        this.form.status = response.data.success.status;
                        this.form.cart_number = response.data.success.cart_number;
                        this.form.publish_date = response.data.success.publish_date;
                        this.form.active_date = response.data.success.active_date;
                        this.form.cat_id=response.data.success.cat_id;
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

                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image)
                        // Create
                        if (this.m_id) {
                            axios.post('/news/'+this.m_id, formData)
                                .then((response) => {
                                     this.$router.push('/news');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/news', formData)
                                .then((response) => {
                                     this.$router.push('/news');
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