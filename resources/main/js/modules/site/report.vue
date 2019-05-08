<template>
    <div  class="container" >
        <template v-if="fetched">

            <div class="columns   ">

                <div class="column  is-9">
                        <ul class="feedlist">
                            <li v-for="(u,i) in urgudul.data" :class="{'row_odd': i%2==0, 'row_even':i%2==1}">
                                <div class="sanal">
                                    <div class="is-pulled-left mb-0 tags are-medium">
                                        <span class="tag is-primary"><i class="fab fa-internet-explorer"></i> </span>
                                        <span class="tag is-info">
                                            <template v-if="u.type==0">Санал хүсэлт</template>
                                            <template v-else-if="u.type==1">Өргөдөл</template>
                                            <template v-else-if="u.type==2">Гомдол</template>
                                            <template v-else>Бусад</template>
                                        </span>
                                    </div>
                                    <div v-if="u.status==1" class="is-pulled-right tag is-success"><i class="fa fa-check"></i>   &nbsp;Хариулсан </div>
                                    <div v-else class="is-pulled-right tag"><i class="fa fa-sync-alt fa-spin"></i> &nbsp;Хүлээж авсан </div>
                                </div>
                                <div class="is-clearfix"></div>
                                <p v-if="u.image===null"  class="has-text-justified"><strong>{{u.name}}:</strong> &nbsp; {{u.content}}</p>
                                <div v-else class="has-text-justified columns" style="margin-top:0px;">
                                    <div class="column is-11"><strong>{{u.name}}:</strong> &nbsp; {{u.content}}</div>
                                    <div class="column is-1"><img :src="siteUrl+u.image.replace('images', '/uploads/small')"/></div>
                                </div>
                                <div class="is-clearfix"></div>
                                <div  v-if="u.status==1" class="columns" style="margin: 10px 0px 10px 0px;" >
                                    <div class="column is-1 is-hidden-mobile has-text-right" style="background: rgba(71, 177, 255, 0.1);"><i class="fa fa-retweet"></i> </div>
                                    <div class="column is-11" style="background: rgba(71, 177, 255, 0.1);">{{u.reply}}</div>
                                </div>
                                <span class="cdate"><i class="far fa-calendar-alt"></i> {{u.created_at}}</span>
                                <span class="ips"><i class="fa fa-map-pin"></i> {{u.ip}}</span>
                            </li>
                        </ul>


                        <nav  class="pagination mt-2 mb-2" role="navigation" aria-label="pagination">
                            <a class="pagination-previous" @click="scrollToTop()" v-if="urgudul.current_page!=1" :href="'!#/report?page='+(urgudul.current_page-1)" >Өмнөх</a>
                            <a class="pagination-next" @click="scrollToTop()" v-if="urgudul.current_page!=urgudul.last_page" :href="'!#/report?page='+(urgudul.current_page+1)" >Дараах</a>
                            <ul v-if="urgudul.last_page>1" class="pagination-list">
                                <template v-for="i in urgudul.last_page">
                                    <li>
                                        <a class="pagination-link"  @click="scrollToTop()" :class="{'is-current':urgudul.current_page===i}"  :href="'!#/report?page='+i" >{{i}}</a>
                                    </li>
                                </template>
                            </ul>
                        </nav>

                </div>
                <div class="column  is-3">
                    <div class="bg-white p-15 mb-1 green shadow">
                        <h3 class="bTitle mb-1">Шүүлтүүр</h3>
                            <div class="field">
                                <label class="label">Төрөл</label>
                                <div class="control select is-fullwidth">
                                    <select class="input" name="type"  v-model="fulter.type"  >
                                        <option value="-1">Бүх төрөл</option>
                                        <option value="0">Санал хүсэлт</option>
                                        <option value="1">Өргөдөл</option>
                                        <option value="2">Гомдол</option>
                                        <option value="3">Бусад</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Төлөв</label>
                                <div class="control select is-fullwidth">
                                    <select class="input" name="type"  v-model="fulter.status"  >
                                        <option value="-1">Бүх төлөв</option>
                                        <option value="0">Хүлээж авсан</option>
                                        <option value="1">Хариулсан</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Хэлтэс</label>
                                <div class="control select is-fullwidth">
                                    <select  name="heltes_id"  v-model="fulter.heltes_id"   >
                                        <option  value="0">Бүх хэлтэс</option>
                                        <template v-for="h in heltes">
                                            <option  :value="h.id">{{h.name}}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Эхлэх огноо</label>
                                <div class="control">
                                    <input type="date"  class="input"  v-model="fulter.sdate"  />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Дуусах огноо</label>
                                <div class="control">
                                    <input type="date"  class="input"  v-model="fulter.fdate"  />
                                </div>
                            </div>
                            <div >
                                <button @click="shuuh" class="button is-success" >
                                    <span>Шүүх</span>
                                </button>
                            </div>
                    </div>
                    <div class="bg-light p-15 mb-1 blue  shadow">
                        <h3 class="bTitle mb-1">Санал хүсэлт, өргөдөл гомдол</h3>
                        <form @submit.prevent="nemeh">
                            <div class="field">
                                <label class="label">Төрөл</label>
                                <div class="control select is-fullwidth">
                                    <select class="input" name="type"  v-model="form.type"  >
                                        <option value="0">Санал хүсэлт</option>
                                        <option value="1">Өргөдөл</option>
                                        <option value="2">Гомдол</option>
                                        <option value="3">Бусад</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Хэлтэс</label>
                                <div class="control select is-fullwidth">
                                    <select  name="heltes_id"  v-model="form.heltes_id" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('heltes_id') }"  >
                                        <template v-for="h in heltes">
                                            <option  :value="h.id">{{h.name}}</option>
                                        </template>
                                    </select>

                                </div>
                                <p v-show="errors.has('heltes_id')" class="help is-danger">Та хэлтэс сонгоно уу</p>
                            </div>
                            <div class="field">
                                <label class="label">Таны нэр</label>
                                <div class="control">
                                    <input type="text" name="name" v-model="form.name" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('name') }" />
                                    <p v-show="errors.has('name')" class="help is-danger">Та нэрээ оруулна уу</p>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Утас</label>
                                <div class="control">
                                    <input type="text" name="phone" v-model="form.phone" v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('phone') }" />
                                    <p v-show="errors.has('phone')" class="help is-danger">Та утсаа оруулна уу</p>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Цахим шуудан</label>
                                <div class="control">
                                    <input type="text" name="email" v-model="form.email"  :class="{'input': true, }" />

                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Текст</label>
                                <textarea style="min-height: 80px;" v-model="form.content"  class="textarea" name="content"  v-validate="'required'" :class="{'input': true, 'is-danger': errors.has('content') }" ></textarea>
                                <p v-show="errors.has('content')" class="help is-danger">Та текст  оруулна уу</p>
                            </div>
                            <div class="field">
                                <label class="label">Нэмэлт зураг хавсаргах</label>
                                <div class="control">
                                    <input type="file" accept="image/*" name="image" @change="onFileChange($event.target.name, $event.target.files)"  />
                                </div>
                            </div>
                            <div >
                        <button type="submit" class="button is-primary" :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                            <span>Илгээх</span>
                        </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
        <loading v-else></loading>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                id: false,
                fetched:true,
                category: false,
                siteUrl: window.surl,
                is_loading: false,
                is_loading_shuuh: false,
                urgudul: null,
                imageni:false,
                heltes:[],
                image: [],
                fulter: {
                  type: -1,
                  status: -1,
                  heltes_id: 0,
                  sdate: null,
                  fdate: null,
                },
                form: {
                    type:0,
                    name:'',
                    heltest_id:0,
                    email:'',
                    phone:'',
                    content:'',
                }
            }
        },
        watch:{

            '$route.query.page': function () {
                this.fetchData()
            }
        },
        created: function () {
            this.fetchData()
        },
        methods: {
            fetchData: function () {
                this.fetched=false;

                axios.get('/urgudul/0').then((response) => {
                    this.fetched=true;
                    this.urgudul=response.data.success;
                    axios.get('/heltes').then((r) => {
                        this.heltes=r.data.success
                    })
                })
            },
            nemeh: function() {
                this.$validator.validateAll().then((result) => {
                    console.log('add');
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();

                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image);

                        axios.post('/sendUrgudul', formData)
                            .then((response) => {
                                this.is_loading = false;
                                this.fetchData();
                                this.form = {type:0, name:'', email:'', phone:'', content:''};
                                this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                        });

                    }
                });
            },
            shuuh() {
                this.fetched=false;
                let formData = new FormData();
                formData.append('data', JSON.stringify(this.fulter));
                axios.post('/filterUrgudul', formData)
                    .then((response) => {
                        this.fetched=true;
                        this.urgudul=response.data.success
                    });
            },
            scrollToTop() {
                window.scrollTo(0,0);
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
        },
        metaInfo() {
            return {
                title: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ',
                titleTemplate: '%s | ' + window.title,
                meta: [
                    {name: 'viewport', content: 'width=device-width, initial-scale=1'},
                    {name: 'description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {property: 'og:title', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {property: 'og:type', content: 'website'},
                    {property: 'og:description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {name: 'twitter:card', content: ''},
                    {name: 'twitter:title', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {name: 'twitter:description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {itemprop: 'name', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {itemprop: 'description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                ],
            }
        },

    }
</script>
