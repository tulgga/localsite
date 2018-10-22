<template>
    <div>
        <!-- Data table -->
        <div class="boxed">
            <div class="boxed-title">
            	<div class="boxed-item-center title">Cанал асуулга</div>
            </div>
			<v-server-table ref="tableni" :url="url"  v-if="fetched" :columns="columns" :options="options">

                <template slot="status" slot-scope="props">
                    <div class="button" :class="[props.row.status === 1?'is-success':'is-light']" @click="statuschanging(props.row)">
                        <template v-if="props.row.status === 1">Идэвхитэй</template>
                        <template v-else="">Идэвхигүй</template>
                    </div>
                </template>

                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'poll/'+props.row.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-server-table>

            <div v-else class="main-bodoh is-loading"></div>
            <div class="boxed-item-center absolute">
                 <router-link :to="{ name: 'create_poll'}" class="add_button">+</router-link>
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

        <!-- status change modal -->
        <div class="modal is-active" v-if="statuschangemodal">
            <div class="modal-background" v-on:click="statuschangemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ $store.getters.lang.messages.change_status }}</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">{{ $store.getters.lang.messages.sure_change_status }}</p>
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{statuschangingrow.f_name}}</strong></p>
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
        data(){
            return {
                siteUrl: window.surl,
                url: '/poll_show/'+this.$store.getters.domain.id,
                deletemodal:false,
                deleteid: false,
                fetched:true,
                is_loading:false,
                statuschangemodal:false,
                statuschangingrow: false,
                user:false,
                columns: ['id', 'question', 'status', 'finish_date', 'created_at', 'action'],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        question: "Асуулт",
                        status: "Төлөв",
                        finish_date: "Дуусах огноо",
                        created_at: "Огноо",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortable: ['question',   'status',   'finish_date',   'created_at' ],
                    filterable: ['question',   'status',   'finish_date' ],
                    sortIcon: {
                        base:'fas', 
                        up:'fa-sort-up', 
                        down:'fa-sort-down', 
                        is:'fa-sort' 
                    },
                    listColumns: {
                        status:[
                            {
                                id: 0,
                                text: 'идэвхгүй'
                            },
                            {
                                id: 1,
                                text: 'идэвхтэй'
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

        mounted(){

        },
        methods: {
            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/poll/'+row.id).then((response) => {
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
                axios.post('/poll_status', formData)
                    .then((response) => {
                        this.statuschangemodal = false;
                        this.$refs.tableni.refresh();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_status_changed_text});
                    });
            },
            statuschanging(row){
                this.statuschangingrow = row;
                this.statuschangemodal = true;
            }
        }
    }
</script>
