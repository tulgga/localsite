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
                            <div v-if="admin_type==0" class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Сум <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <treeselect v-validate="'required'" v-model="form.site_id" name="site_id"
                                                    placeholder="Сум сонгох" :multiple="false" :options="options" :class="{ 'is-danger': errors.has('site_id') }" />
                                        <p v-show="errors.has('site_id')" class="help is-danger">Заавал сонго</p>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Хамаарах огноо </label>
                                    <div class="control">
                                        <input type="date" name="hospical_date" v-model="form.hospical_date" class="input"/>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">төрсөн хүний тоо</label>
                                    <div class="control">
                                        <input type="number" name="birth" v-model="form.birth" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">нас барсан хүний тоо</label>
                                    <div class="control">
                                        <input type="number" name="die" v-model="form.die" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">алсын дуудлага</label>
                                    <div class="control">
                                        <input type="number" name="call_remote" v-model="form.call_remote"
                                               class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">ойрын дуудлага</label>
                                    <div class="control">
                                        <input type="number" name="call_near" v-model="form.call_near" class="input"/>
                                    </div>
                                </div>
                            </div>


                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">урьдчилан сэргийлэх үзлэг</label>
                                    <div class="control">
                                        <input type="number" name="inspection" v-model="form.inspection" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">хэвтэн эмчлүүлэгч</label>
                                    <div class="control">
                                        <input type="number" name="ac_healing" v-model="form.inpatient" class="input"/>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">ЯТТ</label>
                                    <div class="control">
                                        <input type="number" name="ytt" v-model="form.ytt" class="input"/>
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
                file: [],
                imageni: false,
                admin_type: false,
                form: {
                    hospical_date: null,
                    birth: false,
                    die: false,
                    call_remote: false,
                    call_near: false,
                    inspection: false,
                    inpatient: false,
                    ytt: false,
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
                    axios.get('/dashboard_hospital/' + this.m_id).then((response) => {
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
                            axios.post('/dashboard_hospital/' + this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_hospital');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/dashboard_hospital', formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_hospital');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

        }
    }
</script>
