<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Групп</div>
            </div>

            <v-server-table ref="tableni" :url="url"  v-if="fetched" :columns="columns" :options="options">
                <template slot="profile_pic" slot-scope="props">
                    <figure v-if="props.row.profile_pic" class="image is-48x48" :style="'background-image: url('+siteUrl+'/uploads/'+props.row.profile_pic+')'"></figure>
                    <figure v-else="" class="image is-48x48"><i class="fa fa-user is-size-3"></i></figure>
                </template>
                <template slot="status" slot-scope="props">
                    <template  v-if="props.row.status === 0">
                        <div class="button is-success" @click="status_yes(props.row)">
                            Зөвшөөрнө
                        </div>
                        <div class="button is-danger"  @click="status_no(props.row)">
                            Зөвшөөрөхгүй
                        </div>
                    </template>
                    <template v-if="props.row.status === 1">
                        <div class="button is-danger" @click="status_no(props.row)">
                            Чатаас хасах
                        </div>
                    </template>


                </template>
            </v-server-table>
            <div v-else class="main-bodoh is-loading"></div>

        </div>





    </div>
</template>

<script>
    export default {
        data() {
            return {
                m_id: false,
                siteUrl: window.surl,
                url: '/group/users/'+this.$route.params.id,
                statuschangemodal:false,
                statuschangingrow: false,
                fetched: true,
                is_loading: false,
                columns: ['id', 'profile_pic', 'name',  'firstname', 'lastname','created_at',  'status'],
                options: {

                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id:'№',
                        profile_pic: 'зураг',
                        name:'Нэвтрэх нэр',
                        lastname:'Овог',
                        firstname:'Нэр',
                        created_at:'огноо',
                        status:'',

                    },
                    filterByColumn: true,
                    sortable: [ 'name', 'lastname', 'firstname', ],
                    filterable: ['name', 'lastname',   'firstname',  ],
                    columnsDisplay:{
                        content: 'desktop',
                        phone: 'desktop',
                        email: 'desktop',
                        price: 'desktop',
                        created_at: 'desktop',
                    },
                    sortIcon: {
                        base:'fas',
                        up:'fa-sort-up',
                        down:'fa-sort-down',
                        is:'fa-sort'
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
        },
        methods: {
            status_yes(row){
                axios.get('/group/user_change_yes/'+row.id)
                    .then((response) => {
                        this.is_loading = false;
                        this.$refs.tableni.refresh();
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_status_changed_text});
                    });
            },
            status_no(row){
                axios.get('/group/user_change_no/'+row.id)
                    .then((response) => {
                        this.is_loading = false;
                        this.$refs.tableni.refresh();
                        this.$toasted.global.toast_danger({message: this.$store.getters.lang.messages.is_status_changed_text});
                    });
            },
        }
    }

</script>
<style>
    .Vuetables  th:last-child {
        width: 120px !important;
    }
    .VueTables  th:first-child {
        width: 80px;
    }

</style>