<!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div  class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title">Файл засах</p>
                    <p v-else class="modal-card-title">Файл нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">

                        <div class="columns is-mobile is-multiline">

                            <!-- Model-н field-үүд -->

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Ангилал</label>
                                        <div class="control">
                                           <treeselect v-validate="'required'" name="name" v-model="form.cat_id" :flat="true" :default-expand-level="10" placeholder="Ангилал сонгох"  :multiple="true" :options="options" />
                                            <p v-show="errors.has('name')" class="help is-danger">Ангилал сонгоно уу</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Гарчиг</label>
                                        <div class="control">
                                            <input type="text" name="name" v-validate="'required'" v-model="form.name" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                            <p v-show="errors.has('name')" class="help is-danger">Гарчиг оруулна уу</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Тайлбар</label>
                                        <div class="control">
                                            <input class="input" type="text" name="content"  v-model="form.content"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Актын дугаар</label>
                                        <div class="control">
                                            <input class="input" type="text" name="cart_number"  v-model="form.cart_number"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Хүчинтэй эсэх</label>
                                        <div class="control select">
                                           <select class="input"  v-model="form.status" >
                                               <option value="1">Хүчинтэй</option>
                                               <option value="1">Хүчингүй</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Батлагдсан огноо</label>
                                        <div class="control has-icons-right">
                                            <flat-pickr class="input" v-model="form.publish_date" :config="{dateFormat: 'Y-m-d'}" />
                                            <span class="icon is-right">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-6-tablet">
                                    <div class="field">
                                        <label class="label">Дагаж мөрдөх огноо</label>
                                        <div class="control has-icons-right">
                                            <flat-pickr class="input" v-model="form.active_date" :config="{dateFormat: 'Y-m-d'}" />
                                            <span class="icon is-right">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-12-mobile is-12-tablet">
                                    <div class="field">
                                        <label class="label">Файл</label>
                                        <div class="control">
                                            <template v-if="m_id">
                                                <input type="file" name="file" accept="image/*, .doc,.docx,.pdf, .xls, .xlsx, .ppt, .pptx," @change="onFileChange($event.target.name, $event.target.files)"/>
                                            </template>
                                            <template v-else>
                                                <input type="file" name="file"  accept="image/*, .doc,.docx,.pdf, .xls, .xlsx, .ppt, .pptx,"
                                                       v-validate="'required'"
                                                       @change="onFileChange($event.target.name, $event.target.files)"
                                                       :class="{'input': true, 'is-danger': errors.has('file') }"
                                                />
                                                <p v-show="errors.has('file')" class="help is-danger">Файл сонгоно уу</p>
                                            </template>
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
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: false,
                site_id: this.$store.getters.domain.id,
                is_loading: false,
                m_id: false,
                file: [],
                form:{
                    name: '',
                    content: '',
                    status: '',
                    cart_number: '',
                    publish_date: '',
                    active_date: '',
                    cat_id: [],
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
                axios.get('/file_category/'+this.site_id).then((response) => {
                    this.options = response.data.success;
                });

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
                        formData.append('file', this.file);
                        // Create
                        if (this.m_id) {
                            axios.post('/file/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/files');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/file', formData)
                                .then((response) => {
                                    this.$router.push('/files');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

            onFileChange(fieldName, fileList){
                const formData = new FormData();
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });
                this.file = formData.get(fieldName);
            },
        }
    }
</script>
