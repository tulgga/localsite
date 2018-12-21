<template>
    <div  >
        <!--blog list-->
        <template v-if="list_type==0" v-for="p in post.data">
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

        <!--3 column-->
        <template v-if="list_type==1" >
            <div class="columns is-multiline mb-2">
                <template v-for="p in post.data">
                    <div class="column is-4">
                        <a  v-if="p.domain" target="_blank" :href="'http://'+p.domain+'.'+subdomain+'/news/'+p.id">
                            <b-img :value="p" classes="col3newslist"  size="medium">
                                <div class="title roboto-condensed">  <span class="tag is-warning mb-05">{{p.site}}</span><br>{{p.title}}</div>
                            </b-img>
                        </a>
                        <router-link v-else :to="'/news/'+p.id">
                        <b-img :value="p" classes="col3newslist"  size="medium">
                            <div class="title roboto-condensed">{{p.title}}</div>
                        </b-img>
                        </router-link>
                    </div>
                </template>
            </div>
        </template>
        <template v-if="list_type==2" >
            <div class="columns is-multiline mb-2">
                <template v-for="p in post.data">
                    <div class="column is-3">
                        <a  v-if="p.domain" target="_blank" :href="'http://'+p.domain+'.khongor.gov.mn/news/'+p.id">
                            <b-img :value="p" classes="col3newslist"  size="medium">
                                <div class="title roboto-condensed">  <span class="tag is-warning mb-05">{{p.site}}</span><br>{{p.title}}</div>
                            </b-img>
                        </a>
                        <router-link v-else :to="'/news/'+p.id">
                            <b-img :value="p" classes="col3newslist"  size="medium">
                                <div class="title roboto-condensed">{{p.title}}</div>
                            </b-img>
                        </router-link>
                    </div>
                </template>
            </div>
        </template>
        <nav  class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous" @click="scrollToTop()" v-if="post.current_page!=1" :href="link+'?page='+(post.current_page-1)" >Өмнөх</a>
            <a class="pagination-next" @click="scrollToTop()" v-if="post.current_page!=post.last_page" :href="link+'?page='+(post.current_page+1)" >Дараах</a>
            <ul class="pagination-list">
                <template v-for="i in post.last_page">
                    <li>
                        <a class="pagination-link"  @click="scrollToTop()" :class="{'is-current':post.current_page===i}"  :href="link+'?page='+i" >{{i}}</a>
                    </li>
                </template>
            </ul>
        </nav>
    </div>


</template>

<script>
    export default {
        props:[
            'cat_id',
            'link',
            'ajax_url',
            'list_type',
        ],
        data(){
            return {
                page: false,
                siteUrl: window.surl,
                subdomain: window.subdomain,
                post: {
                    data:[]
                },
                limit: 10,
            }
        },
        watch:{
            '$route.params.id': function () {
                this.fetchData()
            },
            '$route.query.page': function () {
                this.fetchData()
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                this.post=false;
                this.page=this.$route.query.page;
                if(this.list_type==1){ this.limit=15;}
                if(this.list_type==2){ this.limit=16;}
                if(!this.page){
                    axios.get(this.ajax_url+this.limit+'/'+this.cat_id).then((response) => {
                        this.post=response.data.success;
                    })
                } else {
                    axios.get(this.ajax_url+this.limit+'/'+this.cat_id+'?page='+this.page).then((response) => {
                        this.post=response.data.success;
                    })
                }

            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        }
    }
</script>