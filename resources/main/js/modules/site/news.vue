<template>
    <div  class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns pt-2 pb-2">
                    <div class="column is-8">
                        <div class="has-background-white p-1" >
                            <h1 class="is-size-3">{{content.title}}</h1>

                            <figure class="image">
                                <img :src="siteUrl+content.image.replace('images/', '/uploads/full/')">
                            </figure>
                            <div class="content" v-html="content.content">

                            </div>
                        </div>
                    </div>
                    <div class="column is-4">
                        <side-bar></side-bar>
                    </div>
                </div>
            </div>
            <not-found v-else></not-found>
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
        methods: {
            fetchData: function () {
                this.id = this.$route.params.id
                axios.get('/news/0/'+this.id).then((response) => {
                    this.fetched=true
                    this.content=response.data.success
                    console.log(this.content)
                    if(this.content){
                        this.metaInfo.title=this.content.title
                        this.metaInfo.meta[1].content=this.content.short_content.substring(0, 160)
                        this.metaInfo.meta[2].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[4].content=this.siteUrl+'/news/'+this.content.id
                        this.metaInfo.meta[5].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                        this.metaInfo.meta[6].content=this.content.short_content.substring(0, 160)
                        this.metaInfo.meta[8].content=this.siteUrl+'/news/'+this.content.id
                        this.metaInfo.meta[9].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[10].content=this.content.short_content.substring(0, 160)
                        this.metaInfo.meta[11].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                        this.metaInfo.meta[12].content=this.content.title+' ← '+window.title
                        this.metaInfo.meta[13].content=this.content.short_content.substring(0, 160)
                        this.metaInfo.meta[14].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
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