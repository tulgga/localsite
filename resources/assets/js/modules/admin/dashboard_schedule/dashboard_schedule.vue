<template>
    <div>
        <!-- Data table -->
        <div class="boxed">
            <div class="boxed-title">
                <div class="boxed-item-center title">Цагийн хуваарь</div>
            </div>
            <v-server-table ref="tableni" :url="url"  v-if="fetched" :columns="columns" :options="options">
                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'dashboard_schedule/'+props.row.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-server-table>

            <div v-else class="main-bodoh is-loading"></div>
            <div class="boxed-item-center absolute">
                <router-link :to="{ name: 'create_dashboard_schedule'}" class="add_button">+</router-link>
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
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{deleteid.f_name}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-danger add_button" v-on:click="ustga(deleteid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>{{ $store.getters.lang.messages.is_delete_button }}</span>
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
                url: '/dashboard_schedule',
                deletemodal:false,
                deleteid: false,
                fetched:false,
                is_loading:false,
                user:false,
                columns: ['id', 'schedule_date', 'head_id',  'site_id', 'user_name', 'start_time', 'end_time',  'person_count',  'description', 'is_publish',  'created_at', 'action'],
                options: {

                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        schedule_date: "Хамрах огноо",
                        head_id: "Албан тушаал",
                        site_id: "Сум",
                        user_name: "Админ",
                        start_time: "Эхлэх",
                        end_time: "Дуусах",
                        person_count: "Хүн",
                        description: "Агуулга",
                        is_publish: "Нийтэд",
                        created_at: "огноо",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortIcon: {
                        base:'fas',
                        up:'fa-sort-up',
                        down:'fa-sort-down',
                        is:'fa-sort'
                    },
                    sortable: [ 'schedule_date', 'site_id', 'head_id', 'is_publish',  'created_at'],
                    filterable: ['schedule_date', 'site_id', 'head_id', 'is_publish', ],
                    listColumns: {
                        head_id: [
                            {
                                id: 1,
                                text: "засаг дарга"
                            },
                            {
                                id: 2,
                                text: "хурлын дарга"
                            },
                            {
                                id: 3,
                                text: "тамгийн дарга"
                            },
                            {
                                id: 4,
                                text: "ХДТ"
                            },
                            {
                                id: 5,
                                text: "Тэмүжин театр"
                            },
                            {
                                id: 6,
                                text: "Баганат талбайд"
                            },
                            {
                                id: 7,
                                text: "ЗДТГын зааланд"
                            },
                            {
                                id: 8,
                                text: "Сумын ЗДТГын зааланд"
                            },
                            {
                                id: 9,
                                text: "Бусад"
                            },
                        ],
                        is_publish: [
                            {
                                id: 0,
                                text: "удирдлагад"
                            },
                            {
                                id: 1,
                                text: "нийтэд"
                            },
                        ],
                        site_id:[],
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
                        defaultOption : 'Бүгд',
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
            fetchData(){
                axios.get('site').then((r) => {
                    this.options.listColumns.site_id=r.data.success;
                    this.options.listColumns.site_id.unshift({ id:0, text:'Аймаг', });
                    this.fetched = true;
                })
            },
            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/dashboard_schedule/'+row.id).then((response) => {
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

        }
    }
</script>
