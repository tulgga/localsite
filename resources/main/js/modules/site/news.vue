<template>
    <div class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns pb-2">
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

                            <div class="content mt-1 mb-1" v-html="content.content"></div>

                            <div class="buttons">
                                <template v-for="c in content.category">
                                    <a class="button is-light is-small" :href="'#/category/'+c.id" @click="scrollToTop()" ># {{c.name}}</a>
                                </template>
                            </div>
                            <div class="mb-1 unelgee">
                                <div class="unelgee_title">Энэ мэдээнд өгөх таны үнэлгээ?</div>
                                <span class="unelgee_item" v-for="rate in rates">
                                    <span class="count">{{rate.count}}</span>
                                    <span @click="rateSet(rate.id)"><img width="32" :src="siteUrl+'/uploads/emoji/'+rate.image"></span>
                                    <span class="title">{{rate.title}}</span>
                                </span>
                                <div v-if="rate_response == 'error'" class="notification is-danger is-light">
                                    <button class="delete" @click="closeAlert"></button>
                                    {{rate_response_msg}}
                                </div>
                                <div v-if="rate_response == 'success'" class="notification is-success">
                                    <button class="delete"  @click="closeAlert"></button>
                                    {{rate_response_msg}}
                                </div>
                            </div>
                            <div>
                                <a class="button is-primary is-small is-pull-right" style="background: #1753B5" :href="'https://www.facebook.com/sharer/sharer.php?u='+siteUrl+'/!#/news/'+content.id"  rel="nofollow" title="Facebook-д хуваалцах" target="_blank"><i class="fab fa-facebook"></i> Хуваалцах</a>
                                <a class="button is-primary is-small is-pull-right" style="background: rgb(32, 104, 222)" :href="'https://twitter.com/intent/tweet?text='+content.title+' '+siteUrl+'/!#/news/'+content.id"  rel="nofollow" title="Twitter-д жиргэх" target="_blank"><i class="fab fa-twitter"></i> Жиргэх</a>
                            </div>
                        </div>
                        <div class="bg-white p-15 mb-2 shadow">
                            <news-carousel :page="3" color="red" title="Шинэ мэдээ" ></news-carousel>
                        </div>
                        <div class="bg-white p-15 mb-2 shadow">
                            <oran-nutag-carousel :page="3" color="blue" title="Орон нутгийн мэдээ" ></oran-nutag-carousel>
                        </div>
                    </div>
                    <div class="column is-3">
                        <side-bar-more></side-bar-more>
                        <div class="bg-white p-15 mt-1  shadow">
                            <h3 class="bTitle mb-1">Зар</h3>
                            <zar-list  styles="height: 400px;"></zar-list>
                        </div>
                    </div>

                </div>
            </div>
            <!--<not-found v-else></not-found>-->
        </template>
        <loading v-else></loading>
    </div>
</template>
<script>
    import ZarList from '../../components/helpers/ZarList';
    import NewsCarousel from '../../components/helpers/NewsCarousel'
    import OranNutagCarousel from '../../components/helpers/OranNutagCarousel'
    export default {
        components: {NewsCarousel, OranNutagCarousel, ZarList},
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
                rates: [],
                rate_response: null,
                rate_response_msg: null
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
            rateSet: function(item_id){
                let formData = {item_id: item_id};
                axios.post('/set_news_rate/'+this.id, formData).then((res) => {
                    if(res.data.success === 0){
                        this.rate_response_msg = res.data.msg;
                        this.rate_response = 'success';
                        this.getEmoji();
                        setTimeout(function () {
                            console.log('UPDATEDDDDDDDDDDDDDDDDD');
                            this.rate_response = null;
                            this.rate_response_msg = null;
                        },3000);
                    }else{
                        this.rate_response_msg = res.data.msg;
                        this.rate_response = 'error';
                    }
                })
            },
            closeAlert: function(){
                this.rate_response = null;
                this.rate_response_msg = null;
            },
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
                });
                this.getEmoji();
                this.fetched=true;
            },
            getEmoji: function() {
                axios.get('/news_rates/'+this.id).then((response) => {
                    this.rates = response.data.success;
                });
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
