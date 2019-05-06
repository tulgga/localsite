<template>
    <div  class="container" >
        <template v-if="fetched">
                <div class="columns pt-2 pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-1">{{metaInfo.title}}</h1>
                            <box-news-list :link="'#/newsType/'+type" :ajax_url="ajax_url" :list_type="list_type" cat_id="" ></box-news-list>
                        </div>

                    </div>

                    <div class="column is-3">
                        <aside class="menu">
                            <p class="menu-label">
                                Мэдээ мэдээлэл
                            </p>
                            <ul class="menu-list">
                                <li><a href="#/newsType/main" @click="scrollToTop()">Онцлох мэдээ</a></li>
                                <li><a href="#/newsType/recent" @click="scrollToTop()">Шинэ мэдээ</a></li>
                                <li><a href="#/newsType/oronnutag" @click="scrollToTop()">Орон нутгийн мэдээ</a></li>
                                <li><a href="#/newsType/photo" @click="scrollToTop()">Фото мэдээ</a></li>
                                <li><a href="#/newsType/video" @click="scrollToTop()">Видео мэдээ</a></li>
                            </ul>
                            <p class="menu-label">
                                Мэдээний ангилал
                            </p>
                            <ul v-if="category" class="menu-list">
                                <li v-for="m1 in category">
                                    <a  @click="scrollToTop()" :href="'#/category/'+m1.id">{{m1.name}}</a>
                                    <ul  v-if="m1.children" >
                                        <li v-for="m2 in m1.children">
                                            <a @click="scrollToTop()"  :href="'#/category/'+m2.id">{{m2.name}}</a>
                                            <ul  v-if="m2.children" >
                                                <li v-for="m3 in m2.children">
                                                    <a  @click="scrollToTop()" :href="'#/category/'+m3.id">{{m3.name}}</a>
                                                    <ul  v-if="m3.children" >
                                                        <li v-for="m4 in m3.children">
                                                            <a  @click="scrollToTop()" :href="'#/category/'+m4.id">{{m4.name}}</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <loading v-else=""></loading>
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
