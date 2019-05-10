<template>
    <div  class="container" >
        <template v-if="fetched">
            <div v-if="content">
                <div class="columns  pb-2">

                    <div  class="column is-9" :class="{'is-12': content.type==2 && content.list_type==3}" >

                        <div class="has-background-white p-15 mb-2" style="min-height: 400px;" >
                            <h1 class="is-size-4-tablet is-size-6-mobile mb-1">{{content.title}}</h1>

                            <template v-if="content.type==0">
                                <figure v-if="content.image" class="image">
                                    <img :src="siteUrl+content.image.replace('images/', '/uploads/full/')">
                                </figure>
                                <div class="content mt-1 mb-1" v-html="content.text"></div>
                            </template>
                            <template v-else-if="content.type==2 && content.list_type<3">
                                <box-news-list :link="'#/p/'+id" :list_type="content.list_type" :ajax_url="'/newsListByCategoryBox/0/'" :cat_id="content.type_id"></box-news-list>
                            </template>
                            <template v-else-if="content.type==2 && content.list_type==3">
                                <time-line :cat_id="content.type_id"></time-line>
                            </template>
                            <template v-else-if="content.type==4">
                                <box-file-list :link="'#/p/'+id"  :cat_id="content.type_id"></box-file-list>
                            </template>
                        </div>
                    </div>
                    <div  v-if="(content.type==2 && content.list_type==3)===false"   class="column is-3">
                        <template  v-if="content.is_main==1" >
                        <aside class="menu mb-2">
                                <p class="menu-label">
                                   {{selectedMenu.name}}
                                </p>
                                <ul v-if="selectedMenu.children" class="menu-list">
                                    <li v-for="m1 in selectedMenu.children">
                                        <span v-html="echoLink(m1)" @click="scrollToTop"></span>
                                        <ul  v-if="m1.children && menu_ids[1]==m1.id" >
                                            <li v-for="m2 in m1.children" >
                                                <span v-html="echoLink(m2)" @click="scrollToTop"></span>
                                                <ul  v-if="m2.children  && menu_ids[2]==m2.id" >
                                                    <li v-for="m3 in m2.children  "  >
                                                        <span v-html="echoLink(m3)" @click="scrollToTop"></span>
                                                        <ul  v-if="m3.children && menu_ids[3]==m3.id" >
                                                            <li v-for="m4 in m3.children">
                                                                <span v-html="echoLink(m4)" @click="scrollToTop"></span>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                        </aside>
                        <side-bar></side-bar>
                        </template>
                        <template v-else>
                            <side-bar-more></side-bar-more>
                            <div class="bg-white p-15 mt-1  shadow">
                                <h3 class="bTitle mb-1">Зар</h3>
                                <zar-list  styles="height: 400px;"></zar-list>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
            <loading v-else></loading>
        </template>
        <loading v-else></loading>
    </div>
</template>
<script>
    import ZarList from '../../components/helpers/ZarList';
    import BoxNewsList from "../../components/helpers/BoxNewsList";
    import BoxFileList from "../../components/helpers/BoxFileList";
    import TimeLine from '../../components/helpers/TimeLine';
    export default {
        components: {BoxNewsList, BoxFileList, ZarList, TimeLine},
        data() {
            return {
                id: false,
                fetched:false,
                siteUrl: window.surl,
                content: null,
                is_full: true,
                selectedMenu:false,
                menu_ids: false,
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
                this.content=false;
                this.id = this.$route.params.id;
                axios.get('/selected_menus/'+this.id).then((response) => {
                    this.menu_ids=response.data.success;
                }),
                axios.get('/page/0/'+this.id).then((response) => {
                    this.fetched=true;
                    this.content=response.data.success;

                    if(this.content){
                        if(this.content.type==3) {
                            this.$router.push({path:'/p/'+this.content.type_id});
                        }

                        for (var i=0; i<this.$store.getters.menu.length; i++){
                            if(this.$store.getters.menu[i].id==this.content.menu){
                                if(this.$store.getters.menu[i].children){
                                    this.is_full=false
                                } else {
                                    this.is_full=true
                                }
                                this.selectedMenu=this.$store.getters.menu[i];
                            }
                        }

                        this.metaInfo.title=this.content.title;
                        this.metaInfo.meta[1].content=this.content.shortContent;
                        this.metaInfo.meta[2].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[4].content=this.siteUrl+'/news/'+this.content.id;
                        if(this.content.image){
                            this.metaInfo.meta[5].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/');
                            this.metaInfo.meta[11].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/');
                            this.metaInfo.meta[14].content=this.siteUrl+this.content.image.replace('images/', '/uploads/medium/')
                        } else {
                            this.metaInfo.meta[5].content='';
                            this.metaInfo.meta[11].content='';
                            this.metaInfo.meta[14].content=''
                        }

                        this.metaInfo.meta[6].content=this.content.shortContent;
                        this.metaInfo.meta[8].content=this.siteUrl+'/news/'+this.content.id;
                        this.metaInfo.meta[9].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[10].content=this.content.shortContent;

                        this.metaInfo.meta[12].content=this.content.title+' ← '+window.title;
                        this.metaInfo.meta[13].content=this.content.shortContent

                    }
                })
            },
            echoLink(menu){
                var active="";
                if(this.id==menu.id){ active='class="is-active"' }

                var blank='';
                if(menu.blank==1){
                    blank ='target="_blank"';
                }
                var href;
                if(menu.type==1){
                    href='href="'+menu.link+'"'
                } else {
                    href='href="#'+menu.link+'"'
                }
                return '<a '+active+' '+blank+' '+href+'>'+menu.name+'</a>'
            },
            scrollToTop() {
                window.scrollTo(0,0);
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
