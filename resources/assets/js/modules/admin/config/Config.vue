<template>
    <div>
        <!-- Data table -->
        <div v-if="fetched">
            <div class="tabs is-medium is-boxed mb0">
                <ul >
                    <li  v-for="(tab,i) in tabs" @click="is_active=i" :class="{'is-active':i==is_active}"><a>{{tab}}</a></li>
                </ul>
            </div>
            <div  class="tab-content p-2">

                <!--undsen medeelel-->
                <div :style="{ 'display': is_active==0 ? 'block':'none' }">
                    <div class="columns ">
                        <div class="column is-12-mobile is-6-tablet">
                            <div class="field">
                                <label class="label">Лого /360x90/</label>
                                <div class="control">
                                    <input type="file"  @change="onFileChangeLogo($event.target.name, $event.target.files)"  />
                                </div>
                            </div>
                            <figure class="image" style="max-width: 360px" v-if="logoini"><img  :src="logoini" > </figure>
                            <div class="field">
                                <label class="label">АЙКОН /64x64/</label>
                                <div class="control">
                                    <input type="file" @change="onFileChangeIcon($event.target.name, $event.target.files)"   />
                                </div>
                            </div>
                            <figure class="image is-64x64" v-if="faviconini"><img  :src="faviconini" > </figure>
                            <div class="field">
                                <label class="label">Харьяаллийн код /tsag-agaar.mn/</label>
                                <div class="control">
                                    <input type="text"  class="input" v-model="form.main.weahter_code"  />
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Хөл текст</label>
                                <div class="control">
                                    <input type="text"  class="input" v-model="form.main.copyright"  />
                                </div>
                            </div>
                        </div>
                        <div class="column is-12-mobile is-6-tablet">
                            <div class="columns ">
                                <div class="column is-6">
                                    <div class="field">
                                        <label class="label">Үндсэн өнгө</label>
                                        <div class="control">
                                            <sketch-picker v-model="form.main.main_color" />
                                        </div>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="field">
                                        <label class="label">Туслах өнгө </label>
                                        <div class="control">
                                            <sketch-picker v-model="form.main.parent_color" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--meta-->
                <div :style="{ 'display': is_active==1 ? 'block':'none' }">
                    <div class="field">
                        <label class="label">Сайтын гарчиг</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.meta.title"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Түлхүүр үгс</label>
                        <div class="control">
                            <textarea class="textarea" style="min-height: 80px;" v-model="form.meta.keywords" ></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Тайлбар текст</label>
                        <div class="control">
                            <textarea class="textarea" style="min-height: 80px;" v-model="form.meta.description" ></textarea>
                        </div>
                    </div>
                </div>


                <!--socail-->
                <div :style="{ 'display': is_active==2 ? 'block':'none' }">
                    <div class="field">
                        <p class="control has-icons-left">
                            <span class="icon is-small is-left" style="color:#4267b2"><i class="fab fa-facebook"></i></span>
                            <input class="input" type="text"   v-model="form.socail.facebook"  >
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <span class="icon is-small is-left" style="color:#1da1f2"><i class="fab fa-twitter-square"></i></span>
                            <input class="input" type="text"   v-model="form.socail.twitter"  >
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <span class="icon is-small is-left" style="color: #0084ff;"><i class="fab fa-facebook-messenger"></i></span>
                            <input class="input" type="text"   v-model="form.socail.messenger"  >
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <span class="icon is-small is-left" style="color: #ff5252;"><i class="fab fa-google-plus-g"></i></span>
                            <input class="input" type="text"   v-model="form.socail.google"  >
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <span class="icon is-small is-left" style="color: #ff0000;"><i class="fab fa-youtube"></i></span>
                            <input class="input" type="text"   v-model="form.socail.youtube"  >
                        </p>
                    </div>
                </div>

                <!--contact-->
                <div :style="{ 'display': is_active==3 ? 'block':'none' }">
                    <div class="field">
                        <label class="label">Утас</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.phone"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">И-мэйл</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.email"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Вэб сайт</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.website"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Хаяг</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.address"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Google map харуулах</label>
                            <div class="select " style="width:100%">
                                <select   v-model="form.contact.googlemap" >
                                    <option value="0">үгүй</option>
                                    <option value="1">тийм</option>
                                </select>
                            </div>
                    </div>
                    <div class="field">
                        <label class="label">Өргөрөг /latitude/</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.latitude"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Уртраг /longitude/</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="form.contact.longitude"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Google map zoom</label>
                        <div class="control">
                            <input type="number"  class="input" v-model="form.contact.zoom"  />
                        </div>
                    </div>
                </div>



            <!--nemelt config-->

                <div v-if="site_id==0" :style="{ 'display': is_active==4 ? 'block':'none' }">
                    <div class="field">
                        <label class="label">Google analytics</label>
                        <div class="control">
                            <textarea class="textarea" style="min-height: 80px;" v-model="config.google_analytics" ></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Google API KEY</label>
                        <div class="control">
                            <input type="text"  class="input" v-model="config.google_api_key"  />
                        </div>
                    </div>
                </div>
            </div>


            <div class="has-background-primary p-2 has-text-right">
                <button @click="save" class="button  add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" >
                    <span>ХАДГАЛАХ</span>
                </button>
            </div>
        </div>
        <div v-else class="main-bodoh is-loading"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                is_active:0,
                tabs:['Үндсэн тохиргоо', 'Түлхүүр үг', 'Нийтийн сүлжээ', 'Холбоо барих',],
                site_id: this.$store.getters.domain.id,
                logoini:false,
                faviconini:false,
                logo:[],
                favicon:[],
                config: {
                  google_analytics:"",
                  google_api_key:"",
                },
                form:
                    {
                     main:  {
                            weahter_code: 287,
                            copyright: "",
                            main_color: "#024789",
                            parent_color: "#024789",
                        },
                     meta: {
                            title: "",
                            keywords: "",
                            description: "",
                        },
                     socail:  {
                            facebook: "",
                            messenger: "",
                            google: "",
                            youtube: "",
                            twitter: "",
                        },
                     contact:   {
                            phone: "",
                            address: "",
                            email: "",
                            website:"",
                             googlemap:1,
                            latitude:"",
                            longitude:"",
                            zoom:12,
                        },
                    },

                fetched: false,
                is_loading: false,
            }
        },
        created: function () {
            this.fetchData();
        },
        methods: {
            // api url-аас дата авч байна
            fetchData() {
                this.fetched = false;
                if(this.site_id==0 && this.tabs.length==4){
                    this.tabs.push("Нэмэлт тохиргоо")
                }
                axios.get('/get_config/'+this.site_id).then((response) => {
                    if(response.data.success.config) {
                        this.form = response.data.success.config
                    };
                    if(response.data.success.mainConfig) {
                        this.config = response.data.success.mainConfig
                    };
                    this.logoini = response.data.success.logo
                    this.faviconini = response.data.success.favicon
                    this.fetched = true;
                })
            },

            save(){
                this.is_loading= true

                let formData = new FormData()
                formData.append('data', JSON.stringify(this.form))
                formData.append('config', JSON.stringify(this.config))
                formData.append('logo', this.logo)
                formData.append('favicon', this.favicon)
                axios.post('/site_config/'+this.site_id, formData)
                    .then((response) => {
                        this.fetchData()
                        this.is_loading= false
                        this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'})
                    });
            },
            onFileChangeLogo(fieldName, fileList){
                const formData = new FormData();
                // append the files to FormData
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });

                this.logo = formData.get(fieldName);


                let reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    this.logoini = reader.result;
                });
                reader.readAsDataURL(fileList[0]);
            },
            onFileChangeIcon(fieldName, fileList){
                const formData = new FormData();
                // append the files to FormData
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });

                this.favicon = formData.get(fieldName);


                let reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    this.faviconini = reader.result;
                });
                reader.readAsDataURL(fileList[0]);
            },
        }
    }
</script>