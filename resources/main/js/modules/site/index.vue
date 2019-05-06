<template>
    <div >
        <div v-if="ontslokh.length>0" class="container" id="ontslokh">
            <carousel
                    :per-page="1"
                    :navigationEnabled="true"
                    :paginationEnabled="true"
                    navigationNextLabel="<i class='fas fa-chevron-right'></i>"
                    navigationPrevLabel="<i class='fas fa-chevron-left'></i>">
                <template v-for="p in ontslokh">
                    <slide>
                        <b-img classes="bcarousel-list-ontslokh" :value="p" size="full">
                            <router-link :to="'/news/'+p.id">
                                <div  class="ontslokhTitle roboto-condensed ">{{p.title}}</div>
                            </router-link>
                        </b-img>
                    </slide>
                </template>
            </carousel>
        </div>
        <loading v-else></loading>
        <div class="container">
            <div class="columns  is-multiline mb-0">
                <div class="column  is-9">
                    <div class="bg-white p-15 mb-2 shadow carList">
                        <news-carousel :page="3" color="blue" title="Шинэ мэдээ" ></news-carousel>
                    </div>
                    <div class="bg-white p-15  shadow carList">
                        <oran-nutag-carousel :page="3" color="orange" title="Орон нутгийн мэдээ" ></oran-nutag-carousel>
                    </div>
                </div>
                <div class="column is-3 ">
                    <div class="bg-white p-15   shadow">
                        <h3 class="bTitle mb-1">Ил тод байдал</h3>
                        <news-list  catId="150" styles="height: 490px;"></news-list>
                    </div>
                </div>
            </div>
        </div>

        <!-- home menu -->
        <div class="homeMenu mb-2 mt-1 p-2" >
            <div class="container">

                <!-- desctop -->
                <div class="columns is-mobile is-multiline has-text-centered ">
                    <template v-if="submenu" v-for="sub in submenu">
                        <div class="column is-6-mobile">
                            <p><span class="icon is-large"><i :class="sub.icon"></i></span></p>
                            <a v-if="sub.type==1" @click="scrollToTop" :href="sub.link"><div  v-html="sub.title"></div></a>
                            <a v-else @click="scrollToTop" :href="'#'+sub.link"><div  v-html="sub.title"></div></a>
                        </div>
                    </template>
                </div>

            </div>
        </div>
        <!-- content -->
        <div class="container">
            <div class="columns  is-multiline mb-0">
                <div class="column  is-9">
                    <div class="bg-light p-15 mb-1 red shadow">
                        <h3 class="bTitle mb-1">Видео</h3>
                        <video-list></video-list>
                    </div>
                </div>
                <div class="column is-3 ">
                    <div class="bg-white p-15 mb-1 green shadow">
                        <h3 class="bTitle mb-1">Тендерийн урилга</h3>
                        <news-list  catId="182" styles="height: 401px;"></news-list>
                    </div>
                </div>
            </div>
            <!--poll-->
            <b-poll></b-poll>

        </div>
    </div>
</template>
<script>

    import NewsCarousel from '../../components/helpers/NewsCarousel'
    import OranNutagCarousel from '../../components/helpers/OranNutagCarousel'
    import NewsList from "../../components/helpers/NewsList";
    import VideoList from "../../components/helpers/VideoList";
    import BPoll from '../../components/helpers/BPoll'
    export default {
        components: {NewsList, OranNutagCarousel, NewsCarousel, VideoList, BPoll},
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
            scrollToTop() {
                window.scrollTo(0,0);
            }
        }

    }
</script>