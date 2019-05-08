<template>
    <div v-if="post"  >
        <v-bar wrapper="wrapper roboto-condensed" :style="styles">
            <template v-for="p in post.data">
                <div class="newslist roboto-condensed ">
                    <a :href="'http://zar.'+subdomain+'/p/'+p.id" target="_blank">
                        <div  class="newslist-title">{{p.title}}</div>
                    </a>
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
                subdomain: window.subdomain,
                post:false
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                axios.get('/zar/').then((response) => {
                    this.post=response.data.success;
                })
            },
        }
    }
</script>