<template>
    <div  class="container" >
        <template v-if="post">
            <div>
                <div class="columns pt-2 pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-1">Хайлтын үр дүн: {{search}}</h1>

                            <template  v-for="p in post.data">
                                <div  class="boxnewslist  m-1">
                                    <div class="columns shadow">
                                        <div class="column is-3">
                                            <div class="boxnewslist-img">
                                                <router-link :to="'/news/'+p.id">
                                                    <img v-if="p.type===2" :src="'https://img.youtube.com/vi/'+p.image+'/0.jpg'"/>
                                                    <img v-else :src="siteUrl+p.image.replace('images/', '/uploads/medium/')"/>
                                                    <div v-if="p.type===2" class="type">
                                                        <i class="fas fa-play"></i>
                                                    </div>
                                                    <div v-if="p.type===1" class="type">
                                                        <i class="fas fa-camera"></i>
                                                    </div>
                                                </router-link>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                        <div class="column is-9">
                                            <router-link :to="'/news/'+p.id">
                                                <div  class="boxnewslist-title roboto-condensed">{{p.title}}</div>
                                            </router-link>
                                            <div  class="date"><i class="far fa-clock"></i>  {{p.created_at.substring(0, 16)}}</div>
                                            <div class="boxnewslist-content" v-html="p.short_content"> </div>
                                        </div>
                                    </div>
                                    <div  class="is-clearfix"></div>
                                </div>
                            </template>




                            <nav v-if="post.data.length>0"  class="pagination" role="navigation" aria-label="pagination">
                                <a class="pagination-previous" @click="scrollToTop()" :disabled="post.current_page===1" :href="link+'?page='+(post.current_page-1)" >Өмнөх</a>
                                <a class="pagination-next" @click="scrollToTop()" :disabled="post.current_page===post.last_page" :href="link+'?page='+(post.current_page+1)" >Дараах</a>
                                <ul class="pagination-list">
                                    <template v-for="i in post.last_page">
                                        <li>
                                            <a class="pagination-link"  @click="scrollToTop()" :class="{'is-current':post.current_page===i}"  :href="link+'?page='+i" >{{i}}</a>
                                        </li>
                                    </template>
                                </ul>
                            </nav>
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
                        <!--<side-bar></side-bar>-->
                    </div>

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
                search: false,
                post:false,
                showmodal:false,
                category: false,
                siteUrl: window.surl,
                content: null,
                metaInfo:{
                    title: 'Хайлт',
                },
            }
        },
        watch:{
            '$route.params.id': function (id) {
                this.fetchData()
            },
            '$route.query.page': function () {
                this.fetchData()
            }
        },
        created: function () {
            this.fetchData()
            this.getCategory()
        },
        methods: {
            getCategory: function () {
                axios.get('/news_category/0').then((response) => {
                    this.fetched=true
                    this.category=response.data.success
                })
            },
            fetchData: function () {
                this.post=false;
                this.page=this.$route.query.page;
                this.search = this.$route.params.id
                if(!this.page){
                    axios.get('/searchNews?s='+this.search).then((response) => {
                        this.post=response.data.success;

                    })
                } else {
                    axios.get('/searchNews?s='+this.search+'?page='+this.page).then((response) => {
                        this.post=response.data.success;

                    })
                }
            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        },
        metaInfo() {
            return {
                title: 'Хайлт',
                titleTemplate: '%s | ' + window.title,
            }
        },

    }
</script>