<!--

CRUD Edit, Create form

 -->

<template>

    <div>

        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card modal-card-medium">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title ">Хэлтэс засах</p>
                    <p v-else class="modal-card-title">Хэлтэс нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">
                        <div class="field">
                            <label class="label">Нэр <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input type="text" name="name" v-validate="'required'" v-model="form.name" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                <p v-show="errors.has('name')" class="help is-danger">Та хэлтсийн нэрээ оруулна уу</p>
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
                site: window.subdomain,
                siteUrl: window.surl,
                m_id: false, 			// Edit үед id орж ирнэ
                fetched: false,
                is_loading: false,
                user: false,
                form:{
                    name: '',
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
            fetchData: function () {
                this.m_id = this.$route.params.id;  // route дээр ирж байгаа id-г авч байна / edit үед
                this.user = this.$store.getters.authUser;

                if (this.m_id) {
                    axios.get('/heltes/'+this.m_id).then((response) => {
                        this.form.name = response.data.success.name;
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

                        this.m_id = this.$route.params.id;
                        if (this.m_id) {
                            // Update
                            axios.post('/heltes/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/heltes');
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
                            axios.post('/heltes', formData)
                                .then((response) => {
                                    this.$router.push('/heltes');
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
        }
    }
</script>