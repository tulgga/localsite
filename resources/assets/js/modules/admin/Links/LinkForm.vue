<template>
    <div>
        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title ">Холбоос  засах</p>
                    <p v-else class="modal-card-title">Холбоос  нэмэх</p>
                </header>
                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">
                        <div class="columns is-multiline">
                            <div class="column is-12-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Нэр <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <input type="text" name="name" v-validate="'required'" v-model="form.name" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                        <p v-show="errors.has('name')" class="help is-danger">Заавал бөглө</p>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Ангилал сонгох <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="cat_id" v-model="form.cat_id" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('cat_id') }">
                                                <option value=""></option>
                                                <template v-for="cat in cats">
                                                    <option :value="cat.id">{{cat.name}}</option>
                                                </template>
                                            </select>
                                        </div>
                                        <p v-show="errors.has('cat_id')" class="help is-danger">Ангилал сонго</p>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Линк <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <input type="text" placeholder="http://bayankhongor.gov.mn" name="link" v-validate="'required'" v-model="form.link" :class="{'input': true, 'is-danger': errors.has('link') }" />
                                        <p v-show="errors.has('link')" class="help is-danger">заавал бөглө</p>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Зураг</label>
                                    <div class="control has-image">
                                        <div class="file is-boxed is-fullwidth">
                                            <label class="file-label">
                                                <input class="file-input" accept="image/*" type="file" name="image2" @change="onFileChange($event.target.name, $event.target.files)">
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


                        </div>

                    </form>
                </section>
                <div v-else class="main-bodoh is-loading"></div>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="butsah">{{$store.getters.lang.messages.is_back_button}}</button>
                    <button v-on:click="nemeh" class="button is-primary add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" :disabled="is_loading">
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
                site: window.surl.replace('http://',''),
                siteUrl: window.surl,
                m_id: false, 			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                form:{name: '', site_id: 0, cat_id:'', link: ''},
                aldaanuud: [],
                imageni:false,
                image: [],
                cats:[]
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
                this.form.site_id= this.$store.getters.domain.id
                axios.get('/link_category_show/'+this.form.site_id).then((response) => {
                    this.cats = response.data.success;
                })

                if (this.m_id) {
                    axios.get('/link/'+this.m_id).then((response) => {
                        this.form.name = response.data.success.name;
                        this.form.site_id = response.data.success.site_id;
                        this.form.cat_id = response.data.success.cat_id;
                        this.form.link = response.data.success.link;
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
                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image)

                        this.m_id = this.$route.params.id;
                        if (this.m_id) {
                            // Update
                            axios.post('/link/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/link');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_updated_text});
                                })
                                .catch(error => {
                                    this.aldaanuud = error.response.data;
                                    for (var i = 0; i < Object.keys(this.aldaanuud).length; i++) {
                                        let tulhur = Object.keys(this.aldaanuud)[i];
                                        this.errors.add({ field: tulhur, msg: this.aldaanuud[tulhur][0]});
                                    }
                                    this.is_loading = false;
                                });
                        } else {
                            // Create
                            axios.post('/link', formData)
                                .then((response) => {
                                    this.$router.push('/link');
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