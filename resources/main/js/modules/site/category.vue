<template>
    <div  class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile ">{{content.name}}</h1>
                            <box-news-list :link="'#/category/'+id" :ajax_url="'/newsListByCategoryBox/0/'" :list_type="0" :cat_id="id"></box-news-list>
                        </div>

                    </div>

                    <div class="column is-3">
                        <aside class="menu">
                            <p class="menu-label">
                                Мэдээ мэдээлэл
                            </p>
                            <ul class="menu-list">
                                <li><a href="#/newsType/main">Онцлох мэдээ</a></li>
                                <li><a href="#/newsType/recent">Шинэ мэдээ</a></li>
                                <li><a href="#/newsType/oronnutag">Орон нутгийн мэдээ</a></li>
                                <li><a href="#/newsType/photo">Фото мэдээ</a></li>
                                <li><a href="#/newsType/video">Видео мэдээ</a></li>
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
            </div>
            <not-found v-else></not-found>
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
                id: false,
                fetched:false,
                category: false,
                siteUrl: window.surl,
                content: null,
                metaInfo:{
                    title: '404',
                    meta: [
                        {name: 'viewport', content: 'width=device-width, initial-scale=1'},
                        {name: 'description', content: ''},
                        {property: 'og:title', content: ''},
                        {property: 'og:type', content: 'website'},
                        {property: 'og:url', content: ''},
                        {property: 'og:image', content: ''},
                        {property: 'og:description', content: ''},
                        {name: 'twitter:card', content: ''},
                        {name: 'twitter:site', content: ''},
                        {name: 'twitter:title', content: ''},
                        {name: 'twitter:description', content: ''},
                        {name: 'twitter:image:src', content: ''},
                        {itemprop: 'name', content: ''},
                        {itemprop: 'description', content: ''},
                        {itemprop: 'image', content: ''}
                    ],
                },
            }
        },
        watch:{
            '$route.params.id': function (id) {
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
                this.fetched=false;
                this.id = this.$route.params.id;
                axios.get('/categoryInfo/'+this.id).then((response) => {
                    this.fetched=true;
                    this.content=response.data.success;
                    if(this.content){
                        this.metaInfo.title=this.content.name;
                        this.metaInfo.meta[2].content=this.content.name+' ← '+window.title;
                        this.metaInfo.meta[4].content=this.siteUrl+'/category/'+this.content.id;
                        this.metaInfo.meta[8].content=this.siteUrl+'/category/'+this.content.id;
                        this.metaInfo.meta[9].content=this.content.name+' ← '+window.title;
                        this.metaInfo.meta[12].content=this.content.name+' ← '+window.title
                    }
                })
            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        },
        metaInfo() {
            return {
                title: this.metaInfo.title,
                titleTemplate: '%s | ' + window.title,
                meta: [
                    {property:  this.metaInfo.meta[2].property, content: this.metaInfo.meta[2].content},
                    {property:  this.metaInfo.meta[4].property, content: this.metaInfo.meta[4].content},
                    {name:  this.metaInfo.meta[8].name, content: this.metaInfo.meta[8].content},
                    {name:  this.metaInfo.meta[9].name, content: this.metaInfo.meta[9].content},
                    {itemprop:  this.metaInfo.meta[12].itemprop, content: this.metaInfo.meta[12].content},
                ],
            }
        },

    }
</script>
