<!--

CRUD Edit, Create form

 -->

<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card modal-card-large">
            <header class="modal-card-head">
                <p v-if="m_id" class="modal-card-title">Туслах цэс засах</p>
                <p v-else class="modal-card-title">Туслах цэс нэмэх</p>
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
                                                    <input class="file-input" type="file" accept="image/*" name="image2" @change="onFileChange($event.target.name, $event.target.files)">
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
                                        <label class="label">Гарчиг <span class="has-text-danger">*</span></label>
                                        <div class="control">
                                            <input type="text" name="title" v-validate="'required'" v-model="form.title" :class="{'input': true, 'is-danger': errors.has('title') }" />
                                            <p v-show="errors.has('title')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Икон <small>https://fontawesome.com/icons?d=gallery</small> <i :class="form.icon"></i></label>
                                        <div class="control">
                                            <input type="text" name="icon" placeholder="fas fa-gavel fa-2x" class="input" v-model="form.icon"  />
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Төрөл</label>
                                        <div class="control">
                                            <div class="select">
                                                <select  v-model="form.type" @change="changeType">
                                                    <option value="0">Зураг текс</option>
                                                    <option value="1">Линк</option>
                                                    <option value="2">Мэдээний ангилал</option>
                                                    <option value="3">Өөр хуудасны контент болох</option>
                                                    <option value="4">Файлын ангилал</option>
                                                    <option value="5">Холбоос ангилал</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="column is-12-mobile is-12-tablet">
                            <template v-if="form.type==0" class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Дэлгэрэнгүй мэдээлэл</label>
                                    <div class="control has-autoblock">
                                        <Tinymce v-model="form.text" height="400"  ></Tinymce>
                                    </div>
                                </div>
                            </template>
                            <template v-else-if="form.type==1" >
                                <div class="field">
                                    <label class="label">Линк</label>
                                    <div class="control">
                                        <input type="text"  v-model="form.link" class="input"  />
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Шинэ цонхонд харуулах</label>
                                    <div class="control">
                                        <div class="select">
                                            <select  v-model="form.blank">
                                                <option value="0">Үгүй</option>
                                                <option value="1">Тийм</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div  class="field">
                                    <label class="label">Сонгох</label>
                                    <treeselect v-model="form.type_id" placeholder="сонгох"  :default-expand-level="10"  :options="types" />
                                </div>
                                <template v-if="form.type==2">
                                    <div  class="field">
                                        <label class="label">Харагдах байдал</label>
                                        <div class="control">
                                            <div class="select">
                                                <select  v-model="form.list_type">
                                                    <option value="0">Блог жагсаалт</option>
                                                    <option value="1">3 багана</option>
                                                    <option value="2">4 багана</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </template>
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
                types: null,
                site_id: 0,
                m_id: false, 			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                pages: [],
                form:{
                    title: '',
                    parent_id:null,
                    text: '',
                    type: 0,
                    is_main:0,
                    type_id: null,
                    blank: 0,
                    icon: null,
                    link: null,
                    site_id: 0,
                    list_type:0,
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
                this.site_id= this.$store.getters.domain.id;
                axios.get('/pages/'+this.site_id).then((response) => {
                    this.pages = response.data.success;
                });

                if (this.m_id) {
                    axios.get('/page_single/'+this.m_id).then((response) => {
                        this.form.title = response.data.success.title;
                        this.form.parent_id = response.data.success.parent_id;
                        this.form.text = response.data.success.text;
                        this.form.type = response.data.success.type;
                        this.form.icon = response.data.success.icon;
                        this.form.type_id = response.data.success.type_id;
                        this.form.blank = response.data.success.blank;
                        this.form.link = response.data.success.link;
                        this.form.site_id = this.site_id;
                        this.form.list_type= response.data.success.list_type;
                        if (response.data.success.image) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.image.replace('images/', 'small/');
                        }
                        this.changeType();
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

                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image);

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
                                    this.$router.push('/helppages');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_updated_text});
                                })
                                .catch(error => {
                                    this.aldaanuud = error.response.data.errors;
                                    for (var i = 0; i < Object.keys(this.aldaanuud).length; i++) {
                                        let tulhur = Object.keys(this.aldaanuud)[i];
                                        this.errors.add({ field: tulhur, msg: this.aldaanuud[tulhur][0]});
                                    }
                                    this.is_loading = false;
                                });
                        } else {
                            // Create
                            axios.post('/pages', formData)
                                .then((response) => {
                                    this.$router.push('/helppages');
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
            //changeType
            changeType(){

                if(this.form.type==2){
                    axios.get('/news_category/' + this.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }

                if(this.form.type==3){
                    axios.get('/page_select/' + this.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


                if(this.form.type==4){
                    axios.get('/file_category/'+ this.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


                if(this.form.type==5){
                    axios.get('/link_category_show/'+this.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


            },

        }
    }
</script>
