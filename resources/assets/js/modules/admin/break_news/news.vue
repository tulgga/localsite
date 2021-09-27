<template>
    <div>
        <!-- Data table -->
        <div class="boxed">
            <template v-if="fetched">
                <v-server-table ref="tableni" :url="url"  :columns="columns" :options="options">

                    <div slot="public" slot-scope="props"  >
                        <template v-if="props.row.public==1">
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

                    <div slot="action" slot-scope="props" class="data-action">
                        <div @click="editText(props.row)" ><i class="fas fa-pencil-alt"></i></div>
                        <div @click="deleting(props.row)">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>

                </v-server-table>
            </template>
            <div v-else class="main-bodoh is-loading"></div>

            <div class="boxed-item-center absolute">
                 <span @click="showNewModal()" class="add_button">+</span>
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
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{deleteid.content}}</strong></p>
                    Контентийг та устгахдаа итгэлтай байна уу
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-danger add_button" v-on:click="ustga(deleteid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>{{ $store.getters.lang.messages.is_delete_button }}</span>
                    </button>
                </footer>
            </div>
        </div>

        <!-- status modal -->
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

        <!--Break news add-->
        <div class="modal is-active" v-if="newModal">
            <div class="modal-background" v-on:click="closeNewsModal()"></div>
            <div class="modal-card modal-card-medium">
                <header class="modal-card-head">
                    <p class="modal-card-title">Шуурхай мэдээ оруулах</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Төлөв</label>
                        <div class="control select">
                            <select class="input" name="public" v-model="form.public" >
                                <option value="1">Нийтлэсэн</option>
                                <option value="0">Ноорог</option>
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Текст <span class="has-text-danger">*</span></label>
                        <template>
                            <textarea  style="min-height: 80px; "  class="textarea" name="content" v-model="form.content" ></textarea>
                        </template>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="closeNewsModal()">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-primary add_button" v-on:click="add_update_news()" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>ХАДГАЛАХ</span>
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

                url: '/break_news',

                form: {
                    public: '',
                    content: ''
                },
                m_id: null,
                newModal: false,
                deletemodal:false,
                deleteid: false,
                statusmodal: false,
                statusid:false,
                fetched:false,
                is_loading:false,
                user:false,
                columns: ['id', 'content', 'public', 'created_at', 'action'],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Шуурхай мэдээ",
                    headings: {
                        id: '№',
                        content: "Мэдээний утга",
                        public: "төлөв",
                        created_at: "Үүссэн огноо",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortable: ['content', 'public',  'created_at'],
                    filterable: ['content', 'public'],
                    sortIcon: {
                        base:'fas', 
                        up:'fa-sort-up', 
                        down:'fa-sort-down', 
                        is:'fa-sort' 
                    },
                    listColumns: {
                        public: [
                            {
                                id: 0,
                                text: 'ноорог'
                            },
                            {
                                id: 1,
                                text: 'нийтлэгдсэн'
                            }
                        ],
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

        methods: {
            fetchData() {
                this.fetched = true;
            },
            add_update_news() {
                this.is_loading = true;

                if (this.m_id) {
                    axios.put('/break_news/'+this.m_id, this.form)
                    .then((response) => {
                        this.newModal = false;
                        this.$refs.tableni.refresh();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                    });
                }else{
                    axios.post('/break_news', this.form)
                    .then((response) => {
                        this.newModal = false;
                        this.$refs.tableni.refresh();
                        this.is_loading = false;
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                    });
                }
            },
            editText(row){
                this.m_id = row.id;
                this.form.public = row.public;
                this.form.content = row.content;
                this.newModal = true;
            },
            showNewModal() {
                this.form.public = null;
                this.form.content = null;
                this.newModal = true;
            },
            closeNewsModal() {
                this.newModal = false;
            },

            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/break_news/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.$refs.tableni.refresh();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
                // console.log(this.deleteid)
            },

            change_status(row){
                this.is_loading = true;
                if (row.public === 0) {
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
                axios.post('/break_news/news_status', formData)
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
