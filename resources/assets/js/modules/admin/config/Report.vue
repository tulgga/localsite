<template>
    <div>
        <!-- Data table -->
        <div class="boxed" id="report">
            <div class="boxed-title">
                <form @submit.prevent="nemeh">
                <div class="columns is-mobile is-multiline">

                    <div class="column is-2-mobile is-2-tablet">
                        <div class="field">
                            <label class="label">Эхлэх огноо</label>
                            <div class="control has-icons-right">
                                <flat-pickr name="start_date" v-validate="'required'"
                                            :class="{'input': true, 'is-danger': errors.has('start_date') }"
                                            v-model="form.start_date" :config="{dateFormat: 'Y-m-d'}"/>
                                <span class="icon is-right">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                            </div>
                            <p v-show="errors.has('start_date')" class="help is-danger">Заавал бөглө</p>
                        </div>
                    </div>
                    <div class="column is-2-mobile is-2-tablet">
                        <div class="field">
                            <label class="label">Дуусах огноо</label>
                            <div class="control has-icons-right">
                                <flat-pickr name="finish_date" v-validate="'required'"
                                            :class="{'input': true, 'is-danger': errors.has('finish_date') }"
                                            v-model="form.finish_date" :config="{dateFormat: 'Y-m-d'}"/>
                                <span class="icon is-right">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                            </div>
                            <p v-show="errors.has('finish_date')" class="help is-danger">Заавал бөглө</p>
                        </div>
                    </div>
                    <div class="column is-2-mobile is-2-tablet">
                        <label class="label">Төрөл</label>
                        <div class="control">
                            <div class="select" style="width:100%;">
                                <select v-model="form.site_id" class="input">
                                    <option v-for="site in sites" :value="site.id">{{site.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div v-if="form.site_id==0" class="column is-2-mobile is-2-tablet">
                        <label class="label">Хэлтэс</label>
                        <div class="control">
                            <div class="select" style="width:100%;">
                                <select v-model="form.heltes_id" class="input">
                                    <option v-for="h in heltes" :value="h.id">{{h.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="column is-2-mobile is-2-tablet">
                        <label class="label">&nbsp;</label>
                        <div class="control">
                            <button @click="nemeh" class="button  is-fullwidth is-primary add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                                <span>шүүх</span>
                            </button>
                        </div>
                    </div>
                    <div class="column is-2-mobile is-2-tablet">
                        <label class="label">&nbsp;</label>
                        <div class="control">
                            <button @click="print" class="button  is-fullwidth is-success has-text-weight-semibold" >
                                <span>хэвлэх</span>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>


            <v-client-table v-if="fetched" :data="data" :columns="columns" :options="options">



                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'sites/'+props.row.id+'/update'">
                        <i class="fas fa-pencil-alt"></i>
                    </router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-client-table>

        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                siteUrl: window.surl,
                fetched: false,
                is_loading: true,
                sites: [],
                heltes:[],
                form: {
                    start_date: this.formatDate(),
                    finish_date: this.formatDate(),
                    site_id: -1,
                    heltes_id: 0,

                },
                data:[],
                cssText: '',
                columns: ['id', 'title', 'user_name', 'site_id', 'heltes_id', 'view_count',  'created_at'],
                options: {
                    filterable:false,
                    perPage: 10000,
                    perPageValues: [10000],
                    pagination:{
                        chunk: false,
                        dropdown: false,
                        nav: scroll,
                        edge: false,

                    } ,
                    headings: {
                        id: '№',
                        title: "Гарчиг",
                        user_name: "Нэр",
                        site_id: "Сайт",
                        heltes_id: "Хэлтэс",
                        view_count: "Үзсэн",
                        created_at: "Огноо",
                    },
                    sortable: [ 'view_count', 'created_at',],

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
        created: function () {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/site').then((response) => {
                    this.sites.push({id: -1, name: 'Бүх сайт', label: 'Бүх сайт', text: 'Бүх сайт'});
                    this.sites.push({id: 0, name: 'Үндсэн сайт', label: 'Үндсэн сайт', text: 'Үндсэн сайт'});
                    for (var i = 0; i < response.data.success.length; i++) {
                        this.sites.push(response.data.success[i]);
                    }
                });
                axios.get('/heltes').then((response) => {
                    this.heltes.push({id: 0, name: 'Бүх хэлтэс'});
                    for (var i = 0; i < response.data.success.length; i++) {
                        this.heltes.push(response.data.success[i]);
                    }
                });


               this.nemeh();
                this.fetched=true;
            },
            nemeh: function() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.is_loading=true
                        let formData = new FormData();
                        formData.append('data', JSON.stringify(this.form));

                        axios.post('/report', formData)
                            .then((response) => {
                                this.data=response.data.success;
                                this.is_loading=false
                            });
                    }
                });
            },

            print: function() {
                window.print();
            },
            formatDate: function() {
                let d = new Date(),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },
        }
    }
</script>
<style>
    .VueTables__table th:nth-child(2){
        width: 40%;
    }
    @media print {
        .toolbar {
            display:none !important;
        }
        aside.menu {
            display:none !important;
        }
        .section-section {
            padding:0 !important;
        }
        .container.is-fluid {
            margin:0 !important;
        }
        .boxed {
            box-shadow: none !important;
        }
        .boxed-title {
            display: none !important;
        }

        .VueTables__table td, .VueTables__table th {
            color:#000;
            border-color: #000;
            border-left: 1px solid #000;
            padding: 3px;
        }
        .VueTables__table th {
            font-weight: bold;
        }
    }
</style>
