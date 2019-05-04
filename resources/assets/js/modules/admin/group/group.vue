<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Групп</div>
            </div>

            <v-client-table v-if="fetched" :data="lists" :columns="columns" :options="options">

                <template slot="status" slot-scope="props">
                    <template v-if="props.row.status==1">
                        <a class="icon has-text-success" @click="statuschanging(props.row)">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </a>
                    </template>
                    <template v-else>
                        <a class="icon has-text-danger"  @click="statuschanging(props.row)">
                            <i class="fas fa-ban fa-lg"></i>
                        </a>
                    </template>
                </template>
                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'group_user_request/'+props.row.id">
                        <i class="fas fa-bars"></i>
                    </router-link>
                    <router-link :to="'group/'+props.row.id+'/update'">
                        <i class="fas fa-pencil-alt"></i>
                    </router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-client-table>
            <div v-else class="main-bodoh is-loading"></div>

            <div class="boxed-item-center absolute">
                <router-link :to="{ name: 'create_group'}" class="add_button">+</router-link>
            </div>

            <router-view></router-view>

        </div>


        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{deleteid.name}}  групп устгах уу ?</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">Та итгэлтэй байна уу?</p>
                    <p class="has-text-centered"><strong class="has-text-black">{{deleteid.name}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">Буцах</button>
                    <button class="button is-danger add_button" v-on:click="ustga(deleteid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>Устгах</span>
                    </button>
                </footer>
            </div>
        </div>


        <!-- status change modal -->
        <div class="modal is-active" v-if="statuschangemodal">
            <div class="modal-background" v-on:click="statuschangemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ $store.getters.lang.messages.change_status }}</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">{{ $store.getters.lang.messages.sure_change_status }}</p>
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{statuschangingrow.name}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="statuschangemodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-primary add_button" v-on:click="soli(statuschangingrow)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>{{ $store.getters.lang.messages.is_change_status_button }}</span>
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
                site: window.subdomain,
                deletemodal:false,
                deleteid: false,
                statuschangemodal:false,
                statuschangingrow: false,
                fetched: false,
                is_loading: false,
                columns: ['id','name', 'request_cnt', 'joined_cnt',  'status', 'action'],
                options: {
                    perPage: 10,
                    perPageValues: [10,25,50,100],
                    headings: {
                        id: '№',
                        name: "Нэр",
                        request_cnt: "Хүсэлт илгээсэн",
                        joined_cnt: "Гишүүд",
                        status: "Статус",
                        action: "",
                    },
                    sortable: [ 'name'],
                    filterable: [ 'name' ],
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
                }
            }
        },
        watch: {
            '$route': function(to, from){
                if (from.meta.is_modal) {
                    this.fetchData();
                }
            },
        },
        created: function () {
            this.fetchData();
        },
        methods: {
            // api url-аас дата авч байна
            fetchData() {
                this.fetched = false;
                axios.get('/group').then((response) => {
                    this.lists = response.data.success;
                    this.fetched = true;
                })
            },
            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/group/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.fetched = false;
                    this.fetchData();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
            },

            statuschanging(row){
                this.statuschangingrow = row;
                this.statuschangemodal = true;
            },
            soli(row){
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
                axios.post('/group/change_status', formData)
                    .then((response) => {
                        this.statuschangemodal = false;
                        this.fetchData();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_status_changed_text});
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