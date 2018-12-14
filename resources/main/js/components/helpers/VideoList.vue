<template>
    <div v-if="post"  class="columns " >
        <div class="column is-8">
            <iframe width="100%" height="330" :src="'https://www.youtube.com/embed/'+selectPost.image" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div  class="date"><i class="far fa-clock"></i>  {{selectPost.created_at.substring(0,16)}}</div>
            <p class="is-size-6">{{selectPost.title}} </p>
            <p > <a class="button is-small is-danger" :href="'#/news/'+selectPost.id">Дэлгэрэнгүй</a></p>
        </div>
        <div class="column is-4">
            <v-bar wrapper="wrapper roboto-condensed" style="height: 400px;">
                <div class="columns is-multiline is-mobile">
                    <template v-for="p in post">
                        <div class="column is-4 pr-0 pl-0">
                            <a @click="selectPost=p" >
                                <img :src="'https://img.youtube.com/vi/'+p.image+'/default.jpg'" class="image"/>
                            </a>
                        </div>
                        <div class="column is-8 videoList">
                            <a @click="selectPost=p" >{{p.title.substring(0, 40)}}</a>
                            <div  class="date"><i class="far fa-clock"></i>  {{p.created_at.substring(0,16)}}</div>
                        </div>
                    </template>
                </div>
            </v-bar>
        </div>

    </div>
    <loading v-else></loading>

</template>

<script>
    export default {
        data(){
            return {
                siteUrl: window.surl,
                post:false,
                selectPost: false,
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                axios.get('/VideoList/0').then((response) => {
                    this.post=response.data.success.data;
                    this.selectPost=this.post[0];
                })
            },
        }
    }
</script>