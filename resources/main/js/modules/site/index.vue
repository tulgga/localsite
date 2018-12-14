<template>
    <div >
        <!--ontslokh medee-->
        <div v-if="ontslokh.length>0" id="ontslokh" class="roboto-condensed shadow">
            <div class="container">
                <div class="tile is-ancestor " >
                    <div class="tile">
                        <div class="tile is-parent is-8 p-0" style="    margin-right: 2px !important;" >
                            <b-img :value="ontslokh[0]" classes="tile is-child notification"  size="full">
                                <div class="bgGrad"></div>
                                <router-link :to="'/news/'+ontslokh[0].id">
                                <div class="content">
                                    <div v-if="ontslokh[0].category.length>0" class="tags has-addons">
                                        <span class="tag is-info">{{ontslokh[0].category[0].name}}</span>
                                        <span v-if="ontslokh[0].category.length!=1" class="tag is-dark">+{{ontslokh[0].category.length-1}}</span>
                                    </div>
                                    <div class="title"><a class="is-size-4-desktop">{{ontslokh[0].title}}</a></div>
                                    <div class="date"><i class="far fa-clock"></i> {{ontslokh[0].created_at.substring(0, 16)}}</div>
                                </div>
                                </router-link>
                            </b-img>
                        </div>
                        <div class="tile is-parent is-vertical is-4 p-0" >
                            <b-img classes="tile is-child notification mb2px" :value="ontslokh[1]" size="large">
                                <div class="bgGrad"></div>
                                <router-link :to="'/news/'+ontslokh[1].id">
                                <div class="content">
                                    <div v-if="ontslokh[1].category.length>0" class="tags has-addons">
                                        <span class="tag is-success">{{ontslokh[1].category[0].name}}</span>
                                        <span v-if="ontslokh[1].category.length!=1" class="tag is-dark">+{{ontslokh[1].category.length-1}}</span>
                                    </div>

                                    <div class="title"><a class="is-size-6">{{ontslokh[1].title.substring(0, 80)}}<span v-if="ontslokh[1].title.length>80">...</span></a></div>
                                    <div class="date"><i class="far fa-clock"></i> {{ontslokh[1].created_at.substring(0, 16)}}</div>
                                </div>
                                </router-link>
                            </b-img>
                            <b-img classes="tile is-child notification" :value="ontslokh[2]" size="large">
                                <div class="bgGrad"></div>
                                <router-link :to="'/news/'+ontslokh[2].id">
                                    <div class="content">
                                        <div v-if="ontslokh[2].category.length>0" class="tags has-addons">
                                            <span class="tag is-warning">{{ontslokh[2].category[0].name}}</span>
                                            <span v-if="ontslokh[2].category.length!=1" class="tag is-dark">+{{ontslokh[2].category.length-1}}</span>
                                        </div>
                                        <div class="title"><a class="is-size-6">{{ontslokh[2].title.substring(0, 80)}}<span v-if="ontslokh[2].title.length>80">...</span></a></div>
                                        <div class="date"><i class="far fa-clock"></i> {{ontslokh[2].created_at.substring(0, 16)}}</div>
                                    </div>
                                </router-link>
                            </b-img>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading v-else></loading>

        <!-- home menu -->
        <div class="homeMenu p-2" >
            <div class="container">

                <!-- desctop -->
                <div class="columns is-mobile is-multiline has-text-centered ">
                    <template v-if="submenu" v-for="sub in submenu">
                        <div class="column is-6-mobile">
                           <p><span class="icon is-large"><i :class="sub.icon"></i></span></p>
                           <a :href="'#/p/'+sub.id"><div  v-html="sub.title"></div></a>
                        </div>
                    </template>
                </div>

            </div>
        </div>
        <!-- content -->
        <div class="container mb-2">
            <div class="columns  is-multiline">
                <div class="column  is-9">
                    <div class="bg-white p-15 mb-2 shadow">
                        <news-carousel :page="3" color="blue" title="Шинэ мэдээ" ></news-carousel>
                    </div>
                    <div class="bg-white p-15 mb-2 shadow">
                        <oran-nutag-carousel :page="3" color="orange" title="Орон нутгийн мэдээ" ></oran-nutag-carousel>
                    </div>
                    <div class="bg-light p-15 mb-2 red shadow">
                        <h3 class="bTitle mb-1">Видео</h3>
                        <video-list></video-list>
                    </div>
                </div>
                <div class="column is-3 ">
                    <div class="bg-white p-15 mb-2  shadow">
                        <h3 class="bTitle mb-1">Ил тод байдал</h3>
                        <v-bar wrapper="wrapper" style="height: 495px;">
                            <news-list  catId="150"  ></news-list>
                        </v-bar>
                    </div>
                    <div class="bg-white p-15 mb-2 green shadow">
                        <h3 class="bTitle mb-1">Тендерийн урилга</h3>
                        <v-bar wrapper="wrapper" style="height: 400px;">
                            <news-list  height catId="151"></news-list>
                        </v-bar>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import NewsCarousel from '../../components/helpers/NewsCarousel'
    import OranNutagCarousel from '../../components/helpers/OranNutagCarousel'
    import NewsList from "../../components/helpers/NewsList";
    import VideoList from "../../components/helpers/VideoList";
    export default {
        components: {NewsList, OranNutagCarousel, NewsCarousel, VideoList},
        data() {
            return {
                siteUrl: window.surl,
                ontslokh: [],
                submenu:[],
                components: {
                    NewsCarousel,
                    OranNutagCarousel,
                    NewsList
                }
            }
        },
        created: function () {
            this.fetchData();
        },
        mounted(){
        },
        methods: {
            fetchData: function () {
                axios.get('/news_ontslokh/'+0).then((response) => {
                    this.ontslokh=response.data.success;

                })
                axios.get('/submenu/'+0).then((response) => {
                    this.submenu=response.data.success;
                })
            },
        }

    }
</script>