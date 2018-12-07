<template>
    <div  class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns pt-2 pb-2">
                    <div class="column is-9">
                        <div class="has-background-white p-15 mb-2" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-1">{{content.title}}</h1>

                            <figure v-if="content.image" class="image">
                                <img :src="siteUrl+content.image.replace('images/', '/uploads/full/')">
                            </figure>

                            <div class="content mt-1 mb-1" v-html="content.text">
                            </div>


                            <div>
                                <a class="button is-primary is-small is-pull-right" style="background: #1753B5" :href="'https://www.facebook.com/sharer/sharer.php?u='+siteUrl+'/p/'+content.id"  rel="nofollow" title="Facebook-д хуваалцах" target="_blank"><i class="fab fa-facebook"></i> Хуваалцах</a>
                                <a class="button is-primary is-small is-pull-right" style="background: rgb(32, 104, 222)" :href="'https://twitter.com/intent/tweet?text='+content.title+' '+siteUrl+'/p/'+content.id"  rel="nofollow" title="Twitter-д хуваалцах" target="_blank"><i class="fab fa-twitter"></i> Жиргэх</a>
                            </div>
                        </div>

                    </div>

                    <div class="column is-3">
                        <aside class="menu mb-2">
                            <template v-for="menu in $store.getters.menu">
                                <template v-if="menu.id==content.menu">
                                    <p class="menu-label">
                                       {{menu.name}}
                                    </p>
                                    <ul v-if="menu.children" class="menu-list">
                                        <li v-for="m1 in menu.children">
                                            <a :class="{'is-active': m1.link=='/p/'+id}" :href="'#'+m1.link">{{m1.name}}</a>
                                            <ul  v-if="m1.children" >
                                                <li v-for="m2 in m1.children">
                                                    <a  :class="{'is-active':   m2.link=='/p/'+id}" :href="'#'+m2.link">{{m2.name}}</a>
                                                    <ul  v-if="m2.children" >
                                                        <li v-for="m3 in m2.children">
                                                            <a :class="{'is-active':   m3.link=='/p/'+id}" :href="'#'+m3.link">{{m3.name}}</a>
                                                            <ul  v-if="m3.children" >
                                                                <li v-for="m4 in m3.children">
                                                                    <a :class="{'is-active':   m4.link=='/p/'+id}" :href="'#'+m4.link">{{m4.name}}</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </template>
                            </template>
                        </aside>
                        <side-bar></side-bar>
                    </div>
                </div>
            </div>
            <loading v-else></loading>
        </template>
        <loading v-else></loading>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                id: false,
                fetched:false,
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
        created: function () {
            this.fetchData()
        },
        watch:{
            '$route.params.id': function (id) {
                this.fetchData()
            }
        },
        mounted(){
        },
        methods: {
            fetchData: function () {
                this.id = this.$route.params.id
                axios.get('/page/0/'+this.id).then((response) => {
                    this.fetched=true
                    this.content=response.data.success
                    if(this.content){
                        this.metaInfo.title=this.content.title
                        this.metaInfo.meta[1].content=this.content.shortContent
                        this.metaInfo.meta[2].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[4].content=this.siteUrl+'/news/'+this.content.id
                        if(this.content.image){
                            this.metaInfo.meta[5].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                            this.metaInfo.meta[11].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                            this.metaInfo.meta[14].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                        } else {
                            this.metaInfo.meta[5].content=''
                            this.metaInfo.meta[11].content=''
                            this.metaInfo.meta[14].content=''
                        }

                        this.metaInfo.meta[6].content=this.content.shortContent
                        this.metaInfo.meta[8].content=this.siteUrl+'/news/'+this.content.id
                        this.metaInfo.meta[9].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[10].content=this.content.shortContent

                        this.metaInfo.meta[12].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[13].content=this.content.shortContent

                    }
                })
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