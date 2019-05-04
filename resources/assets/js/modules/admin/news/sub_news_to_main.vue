<template>

    <div>

        <!-- Data table -->
        <div class="boxed">
            <template v-if="fetched">
            <div class="boxed-title">
                <div class="boxed-item-center title">Орон нутгийн мэдээ</div>
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
                            <figure v-else="" style="border-radius:0px" class="image is-48x48"><i class="far fa-image"></i></figure>
                        </div>
                    </template>

                    <template slot="main_site_publish" slot-scope="props">
                        <div class="button" :class="[props.row.main_site_publish === 2?'is-success':'is-light']" @click="statuschanging(props.row)">
                            <template v-if="props.row.main_site_publish === 2">Нийтлэгдсэн</template>
                            <template v-else="">Нийтлэгдээгүй</template>
                        </div>
                    </template>

                    <div slot="action" slot-scope="props">
                        <a class="button is-primary" target="_blank"  :href="'http://'+props.row.domain+'.'+subdomain+'/news/'+props.row.id" >
                            <span class="icon is-small">
                              <i class="fas fa-eye"></i>
                            </span>
                        </a>
                    </div>
                </v-server-table>
            </template>
            <div v-else class="main-bodoh is-loading"></div>
            <router-view></router-view>

        </div>



        <div class="modal is-active" v-if="statusmodal">
            <div class="modal-background" v-on:click="statusmodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Cайтад нийтлэх төлөв өөрчлөх</p>
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
                subdomain: window.subdomain,
                lists: [],
                url: '/sub_news_publish',
                site_id: 0,
                statusmodal: false,
                statusid:false,
                fetched:false,
                is_loading:false,
                user:false,
                columns: ['id',  'image',  'title', 'site_id',   'created_at',  'action', 'main_site_publish',],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        image: "зураг",
                        cat: "ангилал",
                        title: "Гарчиг",
                        site_id: "Дэд сайт",
                        main_site_publish: "Сайтад нийтлэх",
                        created_at: "огноо",
                        action: "үзэх",
                    },
                    filterByColumn: true,
                    sortable: [  'title',  'site_id',   'main_site_publish',    'created_at'  ],
                    filterable: [   'title',  'site_id',   'main_site_publish',    ],
                    sortIcon: {
                        base:'fas', 
                        up:'fa-sort-up', 
                        down:'fa-sort-down', 
                        is:'fa-sort' 
                    },
                    listColumns: {
                        site_id:[],
                        main_site_publish:[
                            {
                                id:1,
                                text: 'Нийтлэгдээгүй'
                            },
                            {
                                id:2,
                                text: 'Нийтлэгдсэн'
                            },
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
                axios.get('/site').then((response) => {
                    this.options.listColumns.site_id = response.data.success;
                    this.fetched = true;
                })
            },




            change_status(row){
                this.is_loading = true;
                if (row.main_site_publish === 1) {
                    var yvuulah = {
                        flg: 2,
                        id: row.id
                    }
                }else{
                    var yvuulah = {
                        flg: 1,
                        id: row.id
                    }
                }
                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/main_site_publish', formData)
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

