<template>

    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="columns">
                    <div class="column is-8">
                        <div class="boxed-item-center title">Файлын сан</div>
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

			<v-server-table ref="tableni" :url="url" v-if="fetched" :columns="columns" :options="options">
                <div slot="cat" slot-scope="props" >
                    <template v-for="cat in props.row.category">
                        <span class="tag is-primary" style="margin-right: 5px; margin-bottom:5px;">{{cat.name}}</span>
                    </template>
                </div>
                <div slot="type" slot-scope="props" >
                        <span class="tag is-success" >{{fileType(props.row.file)}}</span>
                </div>
                <div slot="action" slot-scope="props" class="data-action">
                    <div @click="showmodal=true file=siteUrl+'/file_viewer/?file='+props.row.file"><i
                        class="fas fa-eye"></i></div>
                    <a :href="siteUrl+'/uploads/'+props.row.file" download><i class="fas fa-download"></i></a>
                    <router-link :to="'files/'+props.row.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-server-table>
            <div v-else class="main-bodoh is-loading"></div>

            <div class="boxed-item-center absolute">
                 <router-link :to="{ name: 'create_file'}" class="add_button">+</router-link>
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

        <!-- show modal -->
        <div class="modal is-active" v-if="showmodal">
            <div class="modal-background" v-on:click="showmodal = false"></div>
            <div class="modal-card" style="width: 100%;">
                <section class="modal-card-body pd0">
                    <iframe :src="file"  style="width: 100%; height: 600px;"></iframe>
                </section>
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
                url: '/file_show/'+this.$store.getters.domain.id,
                showmodal:false,
                categories:[],
                file: false,
                deletemodal:false,
                deleteid: false,
                statuschangemodal:false,
                statuschangingrow: false,
                fetched:true,
                is_loading:false,
                user:false,
                columns: ['id', 'name',  'status', 'cat',  'type',  'action'],
                options: {
                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        name: "Гарчиг",
                        cat: "Ангилал",
                        content: "Агууллага",
                        cart_number: "Актын дугаар",
                        status: "Төлөв",
                        active_date: "Мөрдөх огноо",
                        publish_date: "Батлагдсан огноо",
                        type: "төрөл",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortable: ['id', 'name', 'content',  'status',   ],
                    filterable: ['name', 'content', 'status', ],
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
                                text: 'Хүчингүй'
                            },
                            {
                                id: 1,
                                text: 'Хүчинтэй'
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

            fetchData() {
                this.site_id = this.$store.getters.domain.id;
                axios.get('/file_category/' + this.site_id).then((response) => {
                    this.categories = response.data.success;
                    console.log(this.categories);
                    this.categories.push({'name':'Ангилалгүй файл', 'label':'Ангилалгүй файл', 'id':-1});
                    this.fetched = true;
                })
            },

            fulter_category(){
                this.is_loading = true;
                if(this.selected_cat){
                    this.url= '/file_show/'+this.$store.getters.domain.id+'/'+this.selected_cat
                } else {
                    this.url= '/file_show/'+this.$store.getters.domain.id
                }
                this.$refs.tableni.refresh();
                this.is_loading = false;
            },

            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/file/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.$refs.tableni.refresh();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            fileType(file){
                var pieces = file.split(/[\s.]+/);
              return pieces[pieces.length-1]
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
            },

        }
    }
</script>
