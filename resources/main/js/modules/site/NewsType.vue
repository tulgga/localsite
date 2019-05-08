<template>
    <div  class="container" >
        <template v-if="fetched">
                <div class="columns pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-1">{{metaInfo.title}}</h1>
                            <box-news-list :link="'#/newsType/'+type" :ajax_url="ajax_url" :list_type="list_type" cat_id="" ></box-news-list>
                        </div>

                    </div>

                    <div class="column is-3">
                        <aside class="menu">
                            <side-bar></side-bar>
                            <div class="bg-white p-15 mt-1  shadow">
                                <h3 class="bTitle mb-1">Зар</h3>
                                <zar-list  styles="height: 400px;"></zar-list>
                            </div>
                        </aside>
                        <side-bar></side-bar>
                    </div>
                </div>
        </template>
        <loading v-else></loading>
    </div>
</template>
<script>
    import BoxNewsList from '../../components/helpers/BoxNewsList'
    export default {
        components: {BoxNewsList},
        data() {
            return {
                empty: '',
                type: false,
                link: false,
                fetched:false,
                category: false,
                list_type: 0,
                siteUrl: window.surl,
                content: null,
                metaInfo:{
                    title: '404',
                },
            }
        },
        watch:{
            '$route.params.id': function (id) {
                this.fetched=false;
                this.fetchData()
            }
        },
        created: function () {
            this.fetchData();
            this.getCategory()
        },
        methods: {
            getCategory: function () {
                axios.get('/news_category/0').then((response) => {
                    this.fetched=true;
                    this.category=response.data.success
                })
            },
            fetchData: function () {
                this.type = this.$route.params.id;
                if(this.type=='main'){
                    this.ajax_url='/newsListPrimary/';
                    this.list_type=0;
                    this.metaInfo.title='Онцлох мэдээ';
                }
                else if(this.type=='recent'){
                    this.ajax_url='/newsListRecent/';
                    this.list_type=0;
                    this.metaInfo.title='Шинэ мэдээ';
                }
                else if(this.type=='oronnutag'){
                    this.ajax_url='/newsListOronnutag/';
                    this.list_type=1;
                    this.metaInfo.title='Орон нутаг';
                }
                else if(this.type=='photo'){
                    this.ajax_url='/newsListPhoto/';
                    this.list_type=1;
                    this.metaInfo.title='Фото мэдээ';
                } else if(this.type=='video') {
                    this.ajax_url='/newsListVideo/';
                    this.list_type=1;
                    this.metaInfo.title='Видео мэдээ';
                } else {
                    this.$router.push({path:'/'});
                }
                this.fetched=true;

            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        },
        metaInfo() {
            return {
                title: this.metaInfo.title,
                titleTemplate: '%s | ' + window.title,
            }
        },

    }
</script>
