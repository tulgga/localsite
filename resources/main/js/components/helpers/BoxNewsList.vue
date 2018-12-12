<template>
    <div v-if="post"  >
        <template v-for="p in post.data">

            <div class="boxnewslist  m-1">
                <div class="columns shadow">
                    <div class="column is-3">
                        <img v-if="p.type===2" :src="'https://img.youtube.com/vi/'+p.image+'/0.jpg'"/>
                        <img v-else :src="siteUrl+p.image.replace('images/', '/uploads/medium/')"/>
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
                this.page=this.$route.query.page;
                if(!this.page){
                    axios.get('/newsListByCategoryBox/0/12/'+this.cat_id).then((response) => {
                        this.post=response.data.success;
                    })
                } else {
                    axios.get('/newsListByCategoryBox/0/12/'+this.cat_id+'?page='+this.page).then((response) => {
                        this.post=response.data.success;
                    })
                }
                console.log(this.post);

            },
        }
    }
</script>