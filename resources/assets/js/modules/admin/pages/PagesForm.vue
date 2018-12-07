<!--

CRUD Edit, Create form

 -->

<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card modal-card-large">
            <header class="modal-card-head">
                <p v-if="m_id" class="modal-card-title">Хуудас засах</p>
                <p v-else class="modal-card-title">Хуудас нэмэх</p>
            </header>
            
            <section class="modal-card-body" v-if="fetched">
                <form @submit.prevent="nemeh">
                    <div class="columns is-mobile is-multiline">

                        <!-- Model-н field-үүд -->
                                <div class="column is-12-mobile is-2-tablet">
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
                                
                                <div class="column is-12-mobile is-10-tablet">
                                    <div class="field">
                                        <label class="label">Гарчиг</label>
                                        <div class="control">
                                            <input type="text" name="title" v-validate="'required'" v-model="form.title" :class="{'input': true, 'is-danger': errors.has('title') }" />
                                            <p v-show="errors.has('title')" class="help is-danger">{{ errors.first('title') }}</p>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Эх хуудас</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="parent_id" v-model="form.parent_id" v-validate="'required'">
                                                    <option value="0"></option>
                                                    <template v-for="page in pages">
                                                        <option :value="page.id">{{page.title}}</option>
                                                        <template v-for="child in page.child">
                                                            <option :value="child.id">||=={{child.title}}</option>
                                                            <template v-for="subchild in child.child">
                                                                <option :value="subchild.id">||==||=={{subchild.title}}</option>
                                                            </template>
                                                        </template>
                                                    </template>
                                                </select>
                                            </div>
                                            <p v-show="errors.has('parent_id')" class="help is-danger">{{ errors.first('parent_id') }}</p>
                                        </div>
                                    </div>
                                </div>



                        <div class="column is-12-mobile is-12-tablet">
                            <div class="field">
                                <label class="label">Дэлгэрэнгүй мэдээлэл</label>
                                <div class="control has-autoblock">
                                    <ckeditor v-model="form.text" name="text" type="classic" :config="ck_config"  ></ckeditor>

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
    import Ckeditor from 'vue-ckeditor2'
    export default {
        components: {
            Ckeditor
        },
        data(){
            return {
                ck_config: {
                    height: 500,
                    filebrowserBrowseUrl: window.surl+'/elfinder/ckeditor',
                },
                siteUrl: window.surl,
                site_id: 0,
                m_id: false, 			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                pages: [],
                form:{
                    title: '',
                    parent_id:0,
                    text: '',
                    site_id: 0,
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
                // pages_min
                this.m_id = this.$route.params.id;
                this.site_id= this.$store.getters.domain.id
                axios.get('/pages_min/'+this.site_id+'/'+this.m_id).then((response) => {
                    this.pages = response.data.success;
                })

                if (this.m_id) {
                    axios.get('/page_single/'+this.m_id).then((response) => {
                        this.form.title = response.data.success.title;
                        this.form.parent_id = response.data.success.parent_id;
                        this.form.text = response.data.success.text;
                        this.form.site_id = response.data.success.site_id;

                        if (response.data.success.image) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.image.replace('images/', 'small/');
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
                        this.form.site_id=this.site_id;

                        let formData = new FormData()
                        formData.append('data', JSON.stringify(this.form))
                        formData.append('image', this.image)

                        this.m_id = this.$route.params.id;
                        if (this.m_id) {
                            // Update
                            axios.post('/pages/'+this.m_id, formData)
                                .then((response) => {
                                    if(response.data.success===0){
                                        alert('дэд ангилалтай хуудас байна. эх хуудаст харьяалагдах боломжгүй');
                                        this.is_loading = false;
                                        return;
                                    }
                                    this.$router.push('/pages');
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
                            axios.post('/pages', formData)
                                .then((response) => {
                                    this.$router.push('/pages');
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