<template>

    <div>

        <!-- Data table -->
        <div class="boxed">
            <template v-if="fetched">
            <div class="boxed-title">
                <div class="columns">
                    <div class="column is-8">
                        <div class="boxed-item-center title">Мэдээ</div>
                    </div>
                    <div class="column is-4">
                        <div class="field has-addons has-addons-centered">
                            <p class="control">
                                <treeselect v-model="selected_cat" placeholder="Ангилал сонгох"  :default-expand-level="10"  :options="categories" />
                            </p>
                            <p class="control"><a class="button is-large  is-primary" @click="fulter_category()" :class="{'is-loading':is_loading}" :disabled="is_loading" >шүүх</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>





                <v-server-table ref="tableni" :url="url"  :columns="columns" :options="options">
                    <template slot="image" slot-scope="props">
                        <figure v-if="props.row.type==2" style="border-radius:0px" class="image is-48x48"
                                :style="'background-image: url(https://img.youtube.com/vi/'+props.row.image+'/default.jpg)'">
                        </figure>
                        <div v-else="">
                            <figure v-if="props.row.image" style="border-radius:0px" class="image is-48x48"
                                    :style="'background-image: url('+siteUrl+'/uploads/'+props.row.image.replace('images/', 'small/')+')'">
                            </figure>
                            <figure v-else="" style="border-radius:0px" class="image is-48x48">IMG</figure>
                        </div>
                    </template>

                    <div slot="cat" slot-scope="props" >
                        <template v-for="cat in props.row.category">
                            <span class="tag is-primary" style="margin-right: 5px; margin-bottom:5px;">{{cat.name}}</span>
                        </template>
                    </div>

                    <div slot="site" slot-scope="props" >
                        <template v-for="site in props.row.site">
                            <span class="tag is-primary" style="margin-right: 5px; margin-bottom:5px;">{{site.name}}</span>
                        </template>
                    </div>

                    <div slot="is_primary" slot-scope="props"  >
                        <template v-if="props.row.is_primary==1">
                            <a class="icon has-text-success" @click="primarychanging(props.row)">
                              <i class="fas fa-check-circle fa-lg"></i>
                            </a>
                        </template>
                        <template v-else>
                            <a class="icon has-text-danger"  @click="primarychanging(props.row)">
                                <i class="fas fa-ban fa-lg"></i>
                            </a>
                        </template>
                    </div>

                    <div slot="status" slot-scope="props"  >
                        <template v-if="props.row.status==1">
                            <a class="icon has-text-success"  @click="statuschanging(props.row)">
                              <i class="fas fa-check-circle fa-lg"></i>
                            </a>
                        </template>
                        <template v-else>
                            <a class="icon has-text-danger"  @click="statuschanging(props.row)">
                                <i class="fas fa-ban fa-lg"></i>
                            </a>
                        </template>
                    </div>


                    <div slot="type" slot-scope="props"  >
                          <span class="icon">
                                <template v-if="props.row.type==0">
                                      <i class="fas fa-newspaper fa-lg"></i>
                                </template>
                                <template v-else-if="props.row.type==1">
                                       <i class="fas fa-image fa-lg"></i>
                                </template>
                                <template v-else-if="props.row.type==2">
                                      <i class="fas fa-video fa-lg"></i>
                                </template>
                        </span>
                    </div>



                    <div slot="action" slot-scope="props" class="data-action">
                        <router-link :to="'sub_news/'+props.row.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                        <div @click="deleting(props.row)">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                </v-server-table>
            </template>
            <div v-else class="main-bodoh is-loading"></div>

            <div class="boxed-item-center absolute">
                 <router-link :to="{ name: 'create_sub_news'}" class="add_button">+</router-link>
            </div>

            <router-view></router-view>

        </div>

        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ $store.getters.lang.messages.delete_data }}</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">{{ $store.getters.lang.messages.sure_delete }}</p>
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{deleteid.title}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-danger add_button" v-on:click="ustga(deleteid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>{{ $store.getters.lang.messages.is_delete_button }}</span>
                    </button>
                </footer>
            </div>
        </div>






        <!-- primary modal -->
        <div class="modal is-active" v-if="primarymodal">
            <div class="modal-background" v-on:click="primarymodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Онцлох статус өөрчлөх</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{primaryid.title}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="primarymodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-primary add_button" v-on:click="change_primary(primaryid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>ТИЙМ, СОЛЬЁ</span>
                    </button>
                </footer>
            </div>
        </div>


        <!-- primary modal -->
        <div class="modal is-active" v-if="statusmodal">
            <div class="modal-background" v-on:click="statusmodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Мэдээний статус өөрчлөх</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{statusid.title}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="statusmodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-primary add_button" v-on:click="change_status(statusid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>ТИЙМ, СОЛЬЁ</span>
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
                siteUrl: window.surl,
                lists: [],
                url: '/news_show/'+this.$store.getters.domain.id,
                site_id: 0,
                selected_cat: null,
                categories:[],
                primarymodal:false,
                primaryid:false,
                deletemodal:false,
                deleteid: false,
                statusmodal: false,
                statusid:false,
                fetched:false,
                is_loading:false,
                user:false,
                columns: ['id',  'image',  'title',  'cat', 'main_site_publish',   'type', 'is_primary',   'status',   'created_at', 'view_count', 'action'],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        image: "зураг",
                        cat: "ангилал",
                        title: "Гарчиг",
                        main_site_publish: "Үндсэн сайт",
                        type: "төрөл",
                        is_primary: "онцлох",
                        status: "төлөв",
                        view_count: "үзсэн",
                        created_at: "огноо",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortable: [  'title',    'type',  'main_site_publish', 'status',  'is_primary', 'view_count', 'created_at'  ],
                    filterable: [   'title',    'type',  'main_site_publish', 'status',  'is_primary',  ],
                    sortIcon: {
                        base:'fas', 
                        up:'fa-sort-up', 
                        down:'fa-sort-down', 
                        is:'fa-sort' 
                    },
                    listColumns: {
                        status: [
                            {
                                id: 0,
                                text: 'ноорог'
                            },
                            {
                                id: 1,
                                text: 'нийтлэгдсэн'
                            }
                        ],
                        main_site_publish: [
                            {
                                id: 0,
                                text: 'үгүй'
                            },
                            {
                                id: 1,
                                text: 'хүлээгдэж буй'
                            },
                            {
                                id: 2,
                                text: 'нийтлэгдсэн'
                            }
                        ],
                        type: [
                            {
                                id: 0,
                                text: 'мэдээ'
                            },
                            {
                                id: 1,
                                text: 'фото'
                            },
                            {
                                id: 2,
                                text: 'видео'
                            }
                        ],

                        is_primary: [
                            {
                                id: 0,
                                text: 'энгийн'
                            },
                            {
                                id: 1,
                                text: 'онцлох'
                            }
                        ]
                    },
                    texts:{
                        count : this.$store.getters.lang.table.count,
                        first : this.$store.getters.lang.table.first,
                        last : this.$store.getters.lang.table.last,
                        filter : this.$store.getters.lang.table.filter,
                        filterPlaceholder: this.$store.getters.lang.table.search_query,
                        limit : this.$store.getters.lang.table.records,
                        page : this.$store.getters.lang.table.page,
                        noResults: this.$store.getters.lang.table.no_results,
                        filterBy : 'Хайх',
                        loading : this.$store.getters.lang.table.loading,
                        defaultOption : '',
                        columns : this.$store.getters.lang.table.columns,
                    },
                    templates: {
                        id: function (h, row, index) {
                            return index;
                        },
                    },

                    rowClassCallback: function(row){
                        if (row.admin_id === 0) {
                            return "has-text-link";
                        }
                    },
                    requestFunction: function (data) {
                        return axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            this.dispatch('error', e);
                        }.bind(this));
                    },
                    responseAdapter({data}) {
                        return {
                            data: data.success.data,
                            count: data.success.total
                        };
                    },
                }
            }
        },
        watch: {
            '$route': function(to, from){
                if (from.meta.is_modal) {
                    this.$refs.tableni.refresh();
                }
            },
        },
        created: function () {
            this.fetchData();
        },
        mounted(){

        },
        methods: {



            fetchData() {
                this.site_id = this.$store.getters.domain.id;
                axios.get('/news_category/' + this.site_id).then((response) => {
                    this.categories = response.data.success;
                    this.fetched = true;
                })
            },

            fulter_category(){
                this.is_loading = true;
                if(this.selected_cat){
                    this.url= '/news_show/'+this.$store.getters.domain.id+'/'+this.selected_cat
                } else {
                    this.url= '/news_show/'+this.$store.getters.domain.id
                }
                this.$refs.tableni.refresh();
                this.is_loading = false;
            },

            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/news/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.$refs.tableni.refresh();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
            },

            change_primary(row){
                this.is_loading = true;
                if (row.is_primary === 0) {
                    var yvuulah = {
                        flg: 1,
                        id: row.id
                    }
                }else{
                    var yvuulah = {
                        flg: 0,
                        id: row.id
                    }
                }
                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/news_primary', formData)
                    .then((response) => {
                        this.primarymodal = false;
                        this.$refs.tableni.refresh();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_status_changed_text});
                    });
            },
            primarychanging(row){
                this.primaryid = row;
                this.primarymodal = true;
            },


            change_status(row){
                this.is_loading = true;
                if (row.status === 0) {
                    var yvuulah = {
                        flg: 1,
                        id: row.id
                    }
                }else{
                    var yvuulah = {
                        flg: 0,
                        id: row.id
                    }
                }
                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/news_status', formData)
                    .then((response) => {
                        this.statusmodal = false;
                        this.$refs.tableni.refresh();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_status_changed_text});
                    });
            },
            statuschanging(row){
                this.statusid = row;
                this.statusmodal = true;
            }

        }
    }
</script>
<style>


    tr td:nth-child(0){
        width: 40px;
    }
    tr td:nth-child(1){
        width: 48px;
    }
    tr td:nth-child(6){
        width: 48px;
    }
    tr td:nth-child(7),   tr td:nth-child(8){
        width: 48px;
    }
    tr td:nth-child(9){
        width: 135px;
    }
    tr td:nth-child(10){
        width: 48px;
    }
    tr td:nth-child(11){
        width: 80px;
    }
    tr td:nth-child(0), tr td:nth-child(6), tr td:nth-child(7), tr td:nth-child(8), tr td:nth-child(10){
        text-align:center !important;
    }
</style>
