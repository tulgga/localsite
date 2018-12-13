<template>
    <div v-if="post"  >
        <template v-for="p in post.data">

            <div class="boxnewslist  m-1">
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

        <nav class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous" :disabled="post.current_page===1" :href="'#/p/'+page_id+'?page='+(post.current_page-1)" >Өмнөх</a>
            <a class="pagination-next" :disabled="post.current_page===post.last_page" :href="'#/p/'+page_id+'?page='+(post.current_page+1)" >Дараах</a>
            <ul class="pagination-list">
                <template v-for="i in post.last_page">
                    <li>
                        <a class="pagination-link"  :class="{'is-current':post.current_page===i}"  :href="'#/p/'+page_id+'?page='+i" >{{i}}</a>
                    </li>
                </template>
            </ul>
        </nav>
    </div>
    <loading v-else></loading>

</template>

<script>
    export default {
        props:[
            'cat_id',
            'page_id',
        ],
        data(){
            return {
                page: false,
                siteUrl: window.surl,
                post:false
            }
        },
        watch:{
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
                if(!this.page){
                    axios.get('/newsListByCategoryBox/0/10/'+this.cat_id).then((response) => {
                        this.post=response.data.success;
                    })
                } else {
                    axios.get('/newsListByCategoryBox/0/10/'+this.cat_id+'?page='+this.page).then((response) => {
                        this.post=response.data.success;
                    })
                }

            },
        }
    }
</script>