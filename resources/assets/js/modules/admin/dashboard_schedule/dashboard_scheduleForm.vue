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
                                    <label class="label">Сум</label>
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
                                        <input type="date" name="schedule_date" v-model="form.schedule_date" class="input"/>
                                    </div>
                                </div>
                            </div>

                            <div class="column is-12-mobile is-12-tablet">
                                <div class="field">
                                    <label class="label">Aлбан тушаал сонгох</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="head_id" v-model="form.head_id"  >
                                                <option value="1">засаг дарга</option>
                                                <option value="2">хурлын дарга</option>
                                                <option value="3">тамгийн дарга</option>
                                                <option value="4">ХДТ</option>
                                                <option value="5">Тэмүжин театр</option>
                                                <option value="6">Баганат талбайд</option>
                                                <option value="7">ЗДТГын зааланд</option>
                                                <option value="8">Сумын ЗДТГын зааланд</option>
                                                <option value="9">Бусад</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-tablet">
                                <div class="field">
                                    <label class="label">Нийтэд харуулах</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="is_publish"  v-model="form.is_publish"  >
                                                <option value="0">Удирдлагад</option>
                                                <option value="1">Нийтэд</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-tablet">
                                <div class="field">
                                    <label class="label">Хүний тоо</label>
                                    <div class="control">
                                    <input type="number" name="person_count" v-model="form.person_count" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-tablet">
                                <div class="field">
                                    <label class="label">Эхлэх цаг</label>
                                    <div class="control">
                                    <input type="time" name="start_time" v-model="form.start_time" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-6-tablet">
                                <div class="field">
                                    <label class="label">Дуусах цаг</label>
                                    <div class="control">
                                        <input type="time" name="end_time" v-model="form.end_time" class="input"/>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12-tablet">
                                <div class="field">
                                    <label class="label">Агуулга</label>
                                    <textarea name="description"   v-model="form.description"  :class="{'textarea': true }"></textarea>
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
                    schedule_date: false,
                    head_id: 1,
                    start_time: false,
                    end_time: false,
                    person_count: 0,
                    description: '',
                    is_publish: 0,
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
                    this.options.unshift({ id:0, label:'Аймаг'});

                });

                if (this.m_id) {
                    axios.get('/dashboard_schedule/' + this.m_id).then((response) => {
                        this.form = response.data.success;
                        console.log(this.form);
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
                            axios.post('/dashboard_schedule/' + this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_schedule');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/dashboard_schedule', formData)
                                .then((response) => {
                                    this.$router.push('/dashboard_schedule');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

        }
    }
</script>
