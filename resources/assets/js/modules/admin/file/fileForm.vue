<!--

CRUD Edit, Create form

 -->

<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p  class="modal-card-title">Файл нэмэх</p>
            </header>
            
            <section class="modal-card-body" v-if="fetched">
                <form @submit.prevent="nemeh">
                    <div class="columns is-mobile is-multiline">

                        <!-- Model-н field-үүд -->
                        <div class="column is-12-mobile is-12-tablet">
                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Ангилал</label>
                                    <div class="control">
                                        <div class="select">
                                            <select class="input" name="cat_id" v-model="form.cat_id"  :class="{'input': true, 'is-danger': errors.has('cat_id') }" >
                                                <option value="0">Бүх хэрэглэгч</option>
                                                <option value="1">Идэвхтэй хэрэглэгч</option>
                                            </select>
                                            <p v-show="errors.has('cat_id')" class="help is-danger">{{ errors.first('cat_id') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Гарчиг</label>
                                    <div class="control">
                                        <input type="text" name="name" v-validate="'required'" v-model="form.name" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                        <p v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Тайлбар</label>
                                    <div class="control">
                                        <input type="text" name="content" v-validate="'required'" v-model="form.content" :class="{'input': true, 'is-danger': errors.has('content') }" />
                                        <p v-show="errors.has('content')" class="help is-danger">{{ errors.first('content') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="column is-12-mobile is-12-tablet">-->
                                <!--<div class="field">-->
                                    <!--<label class="label">Файл</label>-->
                                    <!--<div class="control">-->
                                        <!--<input type="file" name="file" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('file') }" />-->
                                        <!--<p v-show="errors.has('file')" class="help is-danger">{{ errors.first('file') }}</p>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->

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
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: true,
                is_loading: false,
                form:{
                    name: '',
                    content: '',
                    cat_id: '',
                    site_id: this.$store.getters.domain.id,
                },
                aldaanuud: [],
            }
        },
        created: function () {

        },
        computed: {
        },
        methods: {

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

                        // Create
                        axios.post('/file', formData)
                            .then((response) => {
                                this.$router.push('/files');
                                this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                            });

                    }
                });
            },
        }
    }
</script>