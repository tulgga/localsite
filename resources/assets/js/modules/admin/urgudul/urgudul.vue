<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Санал хүсэлт, өргөдөл гомдол хүлээн авах</div>
            </div>
            <v-server-table ref="tableni" :url="url"  v-if="fetched" :columns="columns" :options="options">
                <template slot="status" slot-scope="props">
                    <div class="button" :class="[props.row.status === 1?'is-success':'is-light']" >
                        <template v-if="props.row.status === 1">Хариулсан</template>
                        <template v-else="">Хариулаагүй</template>
                    </div>
                </template>
                <div slot="action" slot-scope="props" class="data-action">
                    <div @click="show(props.row)" ><i class="far fa-comments"></i></div>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-server-table>
            <div v-else class="main-bodoh is-loading"></div>
        </div>


        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Санал хүсэлт устгах</p>
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



        <!-- show modal -->
        <div class="modal is-active" v-if="showmodal">
            <div class="modal-background" v-on:click="showmodal = false"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Санал хүсэлтэд хариулах</p>
                </header>
                <section class="modal-card-body">
                    <table class="table  is-striped is-fullwidth">
                        <tr><th width="100" class="has-text-right">Нэр:</th><td>{{showid.name}}</td></tr>
                        <tr><th  class="has-text-right">Имэйл:</th><td>{{showid.email}}</td></tr>
                        <tr><th class="has-text-right">Утас:</th><td>{{showid.phone}}</td></tr>
                        <tr><th class="has-text-right">IP:</th><td>{{showid.ip}}</td></tr>
                        <tr ><th class="has-text-right">Огноо:</th><td>{{showid.created_at}}</td></tr>
                        <tr ><th class="has-text-right">Агуулга:</th><td>{{showid.content}}</td></tr>
                        <tr v-if="showid.image" ><th class="has-text-right">Зураг</th><td><img :src="siteUrl+'/uploads/'+showid.image" class="image"/></td></tr>
                        <tr>
                            <th  class="has-text-right">Төлөв:</th>
                            <td>
                                <div class="tag" style="margin-bottom:15px;" :class="[showid.status === 1?'is-success':'is-light']" >
                                    <template v-if="showid.status === 1">Хариулсан</template>
                                    <template v-else="">Хариулаагүй</template>
                                </div>
                                <textarea class="textarea" v-model="showid.reply"></textarea>
                            </td>
                        </tr>
                    </table>

                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="showmodal = false">Буцах</button>
                    <button class="button is-primary add_button" v-on:click="send()" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>Хариулах</span>
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
                siteUrl: window.surl,
                url: '/urgudul_show/'+this.$store.getters.domain.id,
                deletemodal:false,
                deleteid: false,
                showmodal:false,
                showid: false,
                fetched: true,
                is_loading: false,
                columns: [ 'id',  'type', 'name', 'email', 'phone', 'status',   'created_at', 'action' ],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    headings: {
                        id: '№',
                        type: "Ангилал",
                        name: "Нэр",
                        email: "мэйл",
                        phone: "утас",
                        status: "төлөв",
                        created_at:"Огноо",
                        action: "",
                    },
                    sortable: [ 'name', 'type', 'email', 'phone', 'status',  'created_at',],
                    filterable:[ 'name', 'type', 'email', 'phone', 'status', ],
                    filterByColumn: true,
                    listColumns: {
                        type: [
                            {
                                id: 0,
                                text: "Санал хүсэлт",
                            },
                            {
                                id: 1,
                                text: "Өргөдөл",
                            },
                            {
                                id: 2,
                                text: "Гомдол",
                            },
                        ],
                        status: [
                            {
                              id: 0,
                              text: "Хариулаагүй",
                            },
                            {
                                id: 1,
                                text: "Хариулсан",
                            },
                        ]
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
            // Устгах
            ustga(row){
                this.fetched = false;
                this.is_loading = true;
                axios.delete('/urgudul/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.fetched = true;
                    this.$refs.tableni.refresh();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            send(){
                this.is_loading=true;
                this.fetched = false;
                var yvuulah = { reply: this.showid.reply }

                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/urgudul/'+this.showid.id, formData).then((r) => {
                    this.showmodal = false;
                    this.fetched = true;
                    this.is_loading = false;
                    this.showid=false;
                    this.$refs.tableni.refresh();
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            show(row){
                this.showid = row;
                this.showmodal = true;
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
            },
        }
    }
</script>