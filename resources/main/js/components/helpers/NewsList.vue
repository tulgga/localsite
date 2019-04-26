<template>
    <div v-if="post"  >
        <v-bar wrapper="wrapper roboto-condensed" :style="styles">
            <template v-for="p in post">
                <div class="newslist roboto-condensed ">
                    <router-link :to="'/news/'+p.id">
                        <div  class="newslist-title">{{p.title}}</div>
                    </router-link>
                    <div  class="date"><i class="far fa-clock"></i>  {{p.created_at.substring(0, 16)}}</div>
                </div>
            </template>
        </v-bar>
    </div>
    <loading v-else></loading>

</template>

<script>
    export default {
        props:[
            'catId',
            'styles'
        ],
        data(){
            return {
                siteUrl: window.surl,
                post:false
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                axios.get('/newsListByCategory/0/'+this.catId).then((response) => {
                    this.post=response.data.success;
                })
            },
        }
    }
</script>