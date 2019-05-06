<template>
    <div  class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns pt-2 pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-05">{{content.title}}</h1>
                            <div class="date mb-1 ">
                                <i class="far fa-clock"></i> нийтэлсэн:  {{content.created_at}}
                                <i class="far fa-eye" style="margin-left:5px;"></i> үзсэн:  {{content.view_count}}
                            </div>
                            <template v-if="content.type==2">
                                <iframe id="youtubeFrame"  :src="'https://www.youtube.com/embed/'+content.image"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                            </template>
                            <figure v-else class="image">
                                <img :src="siteUrl+content.image.replace('images/', '/uploads/full/')">
                            </figure>

                            <div class="content mt-1 mb-1" v-html="content.content">
                            </div>

                            <div class="buttons mb-1">
                                <template v-for="c in content.category">
                                    <a class="button is-light is-small" :href="'#/category/'+c.id" @click="scrollToTop()" ># {{c.name}}</a>
                                </template>

                            </div>
                            <div>
                                <a class="button is-primary is-small is-pull-right" style="background: #1753B5" :href="'https://www.facebook.com/sharer/sharer.php?u='+siteUrl+'/!?id='+content.id+'#/news/'+content.id"  rel="nofollow" title="Facebook-д хуваалцах" target="_blank"><i class="fab fa-facebook"></i> Хуваалцах</a>
                                <a class="button is-primary is-small is-pull-right" style="background: rgb(32, 104, 222)" :href="'https://twitter.com/intent/tweet?text='+content.title+' '+siteUrl+'/!#/news/'+content.id"  rel="nofollow" title="Twitter-д хуваалцах" target="_blank"><i class="fab fa-twitter"></i> Жиргэх</a>

                            </div>
                        </div>

                        <div class="bg-white p-15 mb-2 shadow">
                            <news-carousel :page="3" color="blue" title="Шинэ мэдээ" ></news-carousel>
                        </div>


                        <div class="bg-white p-15 mb-2 shadow">
                            <oran-nutag-carousel :page="3" color="orange" title="Орон нутгийн мэдээ" ></oran-nutag-carousel>
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
                                    <a @click="scrollToTop()" :href="'#/category/'+m1.id">{{m1.name}}</a>
                                    <ul  v-if="m1.children" >
                                        <li v-for="m2 in m1.children">
                                            <a @click="scrollToTop()" :href="'#/category/'+m2.id">{{m2.name}}</a>
                                            <ul  v-if="m2.children" >
                                                <li v-for="m3 in m2.children">
                                                    <a @click="scrollToTop()" :href="'#/category/'+m3.id">{{m3.name}}</a>
                                                    <ul  v-if="m3.children" >
                                                        <li v-for="m4 in m3.children">
                                                            <a @click="scrollToTop()" :href="'#/category/'+m4.id">{{m4.name}}</a>
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
    import NewsCarousel from '../../components/helpers/NewsCarousel'
    import OranNutagCarousel from '../../components/helpers/OranNutagCarousel'
    export default {
        components: {NewsCarousel, OranNutagCarousel},
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
                axios.get('/news/0/'+this.id).then((response) => {
                    this.fetched=true;
                    this.content=response.data.success;
                    if(this.content){
                        this.metaInfo.title=this.content.title;
                        this.metaInfo.meta[1].content=this.content.short_content.substring(0, 160);
                        this.metaInfo.meta[2].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[4].content=this.siteUrl+'/news/'+this.content.id;
                        this.metaInfo.meta[5].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/');
                        this.metaInfo.meta[6].content=this.content.short_content.substring(0, 160);
                        this.metaInfo.meta[8].content=this.siteUrl+'/news/'+this.content.id;
                        this.metaInfo.meta[9].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[10].content=this.content.short_content.substring(0, 160);
                        this.metaInfo.meta[11].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/');
                        this.metaInfo.meta[12].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[13].content=this.content.short_content.substring(0, 160);
                        this.metaInfo.meta[14].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
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
                    {name:  this.metaInfo.meta[0].name, content: this.metaInfo.meta[0].content},
                    {name:  this.metaInfo.meta[1].name, content: this.metaInfo.meta[1].content},
                    {property:  this.metaInfo.meta[2].property, content: this.metaInfo.meta[2].content},
                    {property:  this.metaInfo.meta[3].property, content: this.metaInfo.meta[3].content},
                    {property:  this.metaInfo.meta[4].property, content: this.metaInfo.meta[4].content},
                    {property:  this.metaInfo.meta[5].property, content: this.metaInfo.meta[5].content},
                    {property:  this.metaInfo.meta[6].property, content: this.metaInfo.meta[6].content},
                    {name:  this.metaInfo.meta[7].name, content: this.metaInfo.meta[7].content},
                    {name:  this.metaInfo.meta[8].name, content: this.metaInfo.meta[8].content},
                    {name:  this.metaInfo.meta[9].name, content: this.metaInfo.meta[9].content},
                    {name:  this.metaInfo.meta[10].name, content: this.metaInfo.meta[10].content},
                    {name:  this.metaInfo.meta[11].name, content: this.metaInfo.meta[11].content},
                    {itemprop:  this.metaInfo.meta[12].itemprop, content: this.metaInfo.meta[12].content},
                    {itemprop:  this.metaInfo.meta[13].itemprop, content: this.metaInfo.meta[13].content},
                    {itemprop:  this.metaInfo.meta[14].itemprop, content: this.metaInfo.meta[14].content},
                ],
            }
        },

    }
</script>
