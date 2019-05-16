 <!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title"> засах</p>
                    <p v-else class="modal-card-title"> нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">

                        <div class="columns is-mobile is-multiline">
                            <div  class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Сум <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <treeselect v-validate="'required'" v-model="form.site_id" name="site_id"
                                                    placeholder="Сум сонгох" :multiple="false" :options="options" :class="{ 'is-danger': errors.has('site_id') }" />
                                        <p v-show="errors.has('site_id')" class="help is-danger">Заавал сонго</p>
                                    </div>
                                </div>
                            </div>

                            <div v-if="is_admin" class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Төрөл</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="created_type" v-model="form.created_type"  >
                                                <option value="1">Цагдаа</option>
                                                <option value="2">Эрүүл мэнд</option>
                                                <option value="3">Онцгой</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12-tablet">
                                <div class="field">
                                    <label class="label">Агуулга</label>
                                    <textarea name="desc"   v-model="form.desc"  :class="{'textarea': true }"></textarea>
                                </div>
                            </div>

                        </div>
                    </form>
                </section>
                <div v-else class="main-bodoh is-loading"></div>

                <footer class="modal-card-foot">
                    <a class="button is-text" v-on:click="butsah">{{$store.getters.lang.messages.is_back_button}}</a>
                    <button @click="nemeh" class="button is-primary add_button has-text-weight-semibold"
                            :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                        <span>{{$store.getters.lang.messages.is_save_button}}</span>
                    </button>
                </footer>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                options: [],
                siteUrl: window.surl,
                fetched: false,
                is_admin: true,
                is_loading: false,
                m_id: false,
                file: [],
                imageni: false,
                form: {
                    desc: "",
                    created_type: 1,
                    site_id: 0,
                    admin_id: 0,
                },
                aldaanuud: [],
            }
        },
        created: function () {
            this.fetchData();
        },
        computed: {},
        methods: {
            fetchData() {

                this.m_id = this.$route.params.id;
                this.form.site_id= this.$store.getters.domain.id;
                this.form.admin_id= this.$store.getters.authUser.id;

                if(this.$store.getters.authUser.admin_type>9){
                    this.is_admin=false;
                }

                if(this.$store.getters.authUser.admin_type==10){
                    this.form.created_type=1;
                } else if(this.$store.getters.authUser.admin_type==11) {
                    this.form.created_type=2;
                } else if(this.$store.getters.authUser.admin_type==12){
                    this.form.created_type=3;
                }


                axios.get('/site').then((response) => {
                    this.options = response.data.success;
                });

                if (this.m_id) {
                    axios.get('/dashboard_news/' + this.m_id).then((response) => {
                        this.form = response.data.success;
                        this.fetched = true;
                    })
                } else {
                    this.fetched = true;
                }

            },
            // Back
            butsah: function () {
                return this.$nextTick(() => this.$router.back(-1))
            },
            // Нэмэх, Засах
            nemeh: function () {
                this.$validator.validateAll().then((result) => {
                    if(this.form.site_id==0){
                        alert('Та сумаа сонгоно уу');
                        return;
                    }
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));
                        // Create
                        if (this.m_id) {
                            axios.post('/dashboard_news/' + this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_news');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/dashboard_news', formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_news');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

        }
    }
</script>
