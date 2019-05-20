<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Холбоос</div>
            </div>
            <v-client-table v-if="fetched" :data="lists" :columns="columns" :options="options">
                <template slot="image" slot-scope="props">
                    <figure v-if="props.row.image" style="border-radius:0px" class="image is-48x48" :style="'background-image: url('+siteurl+'/uploads/'+props.row.image+')'"></figure>
                    <figure v-else="" style="border-radius:0px" class="image is-48x48"><i class="far fa-image"></i></figure>
                </template>
                <template slot="link" slot-scope="props">

                    <a v-if="props.row.link!='#'" :href="props.row.link" target="_blank"  class=" button is-primary" >
                        үзэх
                    </a>
                </template>
                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'link/'+props.row.id+'/update'">
                        <i class="fas fa-pencil-alt"></i>
                    </router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-client-table>
            <div v-else class="main-bodoh is-loading"></div>
            <div class="boxed-item-center absolute">
                <router-link :to="{ name: 'link_create'}" class="add_button">+</router-link>
            </div>
            <router-view></router-view>
        </div>


        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Холбоос устгах</p>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                siteurl: window.surl,
                site_id: false,
                deletemodal:false,
                deleteid: false,
                fetched: false,
                is_loading: false,
                columns: [ 'id', 'image', 'name', 'cat_id', 'link',  'action'],
                options: {
                    perPage: 50,
                    perPageValues: [100],
                    headings: {
                        image: "Зураг",
                        id: '№',
                        name: "Нэр",
                        cat_id: "Ангилал",
                        link: "Линк",
                        action: "",
                    },
                    sortable: [ 'name', 'cat_id', ],
                    filterable:[ 'name', 'cat_id',  ],
                    filterByColumn: true,
                    listColumns: {
                        cat_id: []
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
                this.site_id=this.$store.getters.domain.id;

                axios.get('/link_category_show/'+this.site_id).then((response) => {
                    this.options.listColumns.cat_id = response.data.success;
                    // console.log(this.options.listColumns.cat_id)
                });
                axios.get('/link_show/'+this.site_id).then((response) => {
                    this.lists = response.data.success;
                    this.fetched = true;
                })
            },
            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/link/'+row.id).then((response) => {
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
