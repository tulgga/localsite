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
                            <div v-if="admin_type==0"  class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Сум <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <treeselect   v-validate="'required'" v-model="form.site_id" name="site_id"
                                                    placeholder="Сум сонгох" :multiple="false" :options="options" :class="{ 'is-danger': errors.has('site_id') }" />
                                        <p v-show="errors.has('site_id')" class="help is-danger">Заавал сонго</p>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Төсвийн төрөл</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="b_type" v-model="form.b_type"  >
                                                <template v-if="admin_type==0">
                                                    <option value="1">Улсын төсөв</option>
                                                    <option value="2">ОНХ сангийн төсөв</option>
                                                    <option value="3">Замын төсөв</option>
                                                    <option value="4">ЗД ын нөөц хөрөнгө</option>
                                                </template>
                                                <template v-if="admin_type==13 && form.site_id==0">
                                                    <option value="1">Улсын төсөв</option>
                                                    <option value="2">ОНХ сангийн төсөв</option>
                                                    <option value="3">Замын төсөв</option>
                                                </template>
                                                <template v-if="admin_type==13 && form.site_id!=0">
                                                    <option value="1">Улсын төсөв</option>
                                                    <option value="2">ОНХ сангийн төсөв</option>
                                                    <option value="4">ЗД ын нөөц хөрөнгө</option>
                                                </template>
                                                <template v-if="admin_type==14 && form.site_id==0">
                                                    <option value="4">ЗД ын нөөц хөрөнгө</option>
                                                </template>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Батлагдсан төсөв</label>
                                    <div class="control">
                                        <input type="number" name="b_approved" v-model="form.b_approved" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">зарцуулагдсан төсөв</label>
                                    <div class="control">
                                        <input type="number" name="b_done" v-model="form.b_done" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">хэрэгжиж байгаа</label>
                                    <div class="control">
                                        <input type="number" name="b_doing" v-model="form.b_doing"
                                               class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">үлдэгдэл</label>
                                    <div class="control">
                                        <input type="number" name="b_do" v-model="form.b_do"  class="input"/>
                                    </div>
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
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                m_id: false,
                imageni: false,
                admin_type: false,
                form: {
                    b_type: 1,
                    b_approved: false,
                    b_done: false,
                    b_doing: false,
                    b_do: false,
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

                this.admin_type=this.$store.getters.authUser.admin_type;
                axios.get('/site').then((response) => {
                    this.options = response.data.success;

                });

                if (this.m_id) {
                    axios.get('/dashboard_budget/' + this.m_id).then((response) => {
                        this.form = response.data.success;
                        console.log(this.form);
                        this.fetched = true;
                    })
                } else {
                    this.fetched = true;
                }
                console.log(this.form.site_id);
            },
            // Back
            butsah: function () {
                return this.$nextTick(() => this.$router.back(-1))
            },
            // Нэмэх, Засах
            nemeh: function () {
                this.$validator.validateAll().then((result) => {

                    if(this.form.site_id==0 && this.admin_type==0){
                        alert('Та сумаа сонгоно уу');
                        return;
                    }
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));
                        // Create
                        if (this.m_id) {
                            axios.post('/dashboard_budget/' + this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_budget');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/dashboard_budget', formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_budget');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

        }
    }
</script>
