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

                            <!-- Model-н field-үүд -->
                            <div class="column is-12">
                                <h3 class="has-text-primary subtitle is-3" >Цагдаагийн мэдээ</h3>
                            </div>
                            <div class="column is-12-mobile is-12-tablet">
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
                                        <input type="date" name="police_date" v-model="form.police_date" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <h3 class="has-text-primary subtitle is-3">Гэмт хэрэг</h3>
                            </div>


                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Хүн амь</label>
                                    <div class="control">
                                        <input type="number" name="crime_kill" v-model="form.crime_kill" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Хулгай</label>
                                    <div class="control">
                                        <input type="number" name="crime_theft" v-model="form.crime_theft" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">хөдөлгөөний аюулгүй байдлын хэрэг</label>
                                    <div class="control">
                                        <input type="number" name="crime_movement" v-model="form.crime_movement"
                                               class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Бусад</label>
                                    <div class="control">
                                        <input type="number" name="crime_other" v-model="form.crime_other" class="input"/>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12">
                                <h3 class="has-text-primary subtitle is-3 " >Захиргааны зөрчил</h3>
                            </div>

                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">гэр бүлийн хүчирхийлэл</label>
                                    <div class="control">
                                        <input type="number" name="ac_family" v-model="form.ac_family" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">эрүүлжүүлэх</label>
                                    <div class="control">
                                        <input type="number" name="ac_healing" v-model="form.ac_healing" class="input"/>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">баривчлагдсан</label>
                                    <div class="control">
                                        <input type="number" name="ac_arrest" v-model="form.ac_arrest" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">торгууль</label>
                                    <div class="control">
                                        <input type="number" name="ac_fine" v-model="form.ac_fine" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-mobile is-6-tablet">
                                <div class="field">
                                    <label class="label">Бусад</label>
                                    <div class="control">
                                        <input type="number" name="ac_other" v-model="form.ac_other" class="input"/>
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
                form: {
                    police_date: null,
                    crime_kill: false,
                    crime_theft: false,
                    crime_movement: false,
                    crime_other: false,
                    ac_family: false,
                    ac_healing: false,
                    ac_arrest: false,
                    ac_fine: false,
                    ac_other: false,
                    site_id: this.$store.getters.domain.id,
                    admin_id: this.$store.getters.authUser.id,
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

                axios.get('/site').then((response) => {
                    this.options = response.data.success;
                });

                if (this.m_id) {
                    axios.get('/dashboard_police/' + this.m_id).then((response) => {
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
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));
                        // Create
                        if (this.m_id) {
                            axios.post('/dashboard_police/' + this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_police');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/dashboard_police', formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_police');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

        }
    }
</script>
