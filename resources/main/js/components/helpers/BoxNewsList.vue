<template>
    <div v-if="post"  >
        <div class="columns is-mobile is-multiline">
            <template v-for="p in post.data">

                    <div class="column is-3">
                        <img v-if="p.type===2" :src="'https://img.youtube.com/vi/'+p.image+'/0.jpg'"/>
                        <img v-else :src="siteUrl+p.image.replace('images/', '/uploads/medium/')"/>
                    </div>
                    <div class="column is-9">
                        <router-link :to="'/news/'+p.id">
                            <div  class="newslist-title">{{p.title}}</div>
                        </router-link>
                        <div  class="date"><i class="far fa-clock"></i>  {{p.created_at}}</div>
                        <p v-html="p.short_content"> </p>
                    </div>


            </template>
        </div>

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