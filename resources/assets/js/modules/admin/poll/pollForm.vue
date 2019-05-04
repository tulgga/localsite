<!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div  class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title">Санал асуулга засах</p>
                    <p v-else class="modal-card-title">Санал асуулга нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">
                        <div class="columns is-mobile is-multiline">

                            <!-- Model-н field-үүд -->
                            <div class="column is-12-mobile is-3-tablet">
                                <div class="field">
                                    <label class="label">Зураг</label>
                                    <div class="control has-image">
                                        <div class="file is-boxed is-fullwidth">
                                            <label class="file-label">
                                                <input  type="file" accept="image/*"  v-validate="'required'" name="imageni" :class="{'file-input': true, 'is-danger': errors.has('imageni') }"  @change="onFileChange($event.target.name, $event.target.files)">
                                                <span class="file-cta" >
                                                    <span v-if="imageni" class="file-icon" :style="'background-image: url('+imageni+');'">
                                                        <i class="ion-ios-add-outline"></i>
                                                    </span>
                                                    <span v-else="" class="file-icon no-background">
                                                        <i class="ion-ios-add-outline"></i>
                                                    </span>
                                                </span>
                                            </label>
                                            <p v-show="errors.has('imageni')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="column is-12-mobile is-9-tablet">
                                    <div class="field">
                                        <label class="label">Асуулт</label>
                                        <div class="control">
                                            <input type="text" name="question" v-validate="'required'" v-model="form.question" :class="{'input': true, 'is-danger': errors.has('question') }" />
                                            <p v-show="errors.has('question')" class="help is-danger">Заавал бөглө</p>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Дуусах огноо</label>
                                        <div class="control has-icons-right">
                                            <flat-pickr name="finish_date" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('finish_date') }" v-model="form.finish_date" :config="{dateFormat: 'Y-m-d'}" />
                                            <span class="icon is-right">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <p v-show="errors.has('finish_date')" class="help is-danger">Заавал бөглө</p>
                                    </div>
                                </div>


                                <template v-for="(answer, i) in form.answer">
                                    <div class="column is-10">
                                        <div class="field">
                                            <label class="label">Хариулт {{i+1}}</label>
                                            <div class="control">
                                                <input type="text" name="text" v-validate="'required'" v-model="form.answer[i].answer" :class="{'input': true, 'is-danger': errors.has('text') }" />
                                                <p v-show="errors.has('text')" class="help is-danger">Заавал бөглө</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-2">
                                        <p v-if="i>2" class="buttons" style="margin-top:22px;">
                                            <a @click="removeAnswer(i)"  class="button is-large is-danger">
                                                <span class="icon ">
                                                  <i class="fas fa-trash"></i>
                                                </span>
                                             </a>
                                        </p>
                                    </div>
                                </template>
                            <div class="column is-12-mobile is-12-tablet">
                                <a @click="addAnswer" class="button is-success" >Хариулт нэмэх</a>
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
                image: [],
                imageni: false,
                form:{
                    question: '',
                    site_id: this.$store.getters.domain.id,
                    answer: [
                        { id:0, answer:''},
                        { id:0, answer:''},
                        { id:0, answer:''},
                    ],
                    finish_date: null,
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
                if (this.m_id) {
                    axios.get('/poll/'+this.m_id).then((response) => {
                        console.log(response.data.success);
                        this.form.question = response.data.success.question;
                        this.form.site_id = response.data.success.site_id;
                        this.form.finish_date = response.data.success.finish_date;
                        this.form.answer = response.data.success.answer;

                        if (response.data.success.image) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.image.replace('images/', 'medium/');
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
                        formData.append('data', JSON.stringify(this.form))
                        formData.append('image', this.image)
                        // Create
                        if (this.m_id) {
                            axios.post('/poll/'+this.m_id, formData)
                                .then((response) => {
                                    this.$router.push('/poll');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                            });
                        } else {
                            axios.post('/poll', formData)
                                .then((response) => {
                                    this.$router.push('/poll');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

            removeAnswer(i){
                this.form.answer.splice(i, 1);
            },
            addAnswer(){
                this.form.answer.push({id:0, text:''});
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