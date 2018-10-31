<template>
    <div >
        <!--ontslokh medee-->
        <div v-if="ontslokh.length>0" id="ontslokh" class="roboto-condensed p-2">
            <div class="container">
                <div class="tile is-ancestor " >
                    <div class="tile">
                        <div class="tile is-parent is-8 p-0" >
                            <article class="tile is-child notification" :style="'background-image:url('+siteUrl+ontslokh[0].image.replace('images', '/uploads/large')+');'">
                                <div class="bgGrad"></div>
                                <div class="content">
                                    <div v-if="ontslokh[0].category.length>0" class="tags has-addons">
                                        <span class="tag is-info">{{ontslokh[0].category[0].name}}</span>
                                        <span v-if="ontslokh[0].category.length!=1" class="tag is-dark">+{{ontslokh[0].category.length-1}}</span>
                                    </div>
                                <div class="title"><a class="is-size-3">{{ontslokh[0].title.substring(0, 60)}}<span v-if="ontslokh[0].title.length>60">...</span></a></div>
                                <div class="date"><i class="far fa-clock"></i> {{ontslokh[0].created_at}}</div>
                                </div>
                            </article>
                        </div>
                        <div class="tile is-parent is-vertical is-4 p-0" >
                            <article class="tile is-child notification" :style="'background-image:url('+siteUrl+ontslokh[1].image.replace('images', '/uploads/medium')+');'">
                                <div class="bgGrad"></div>
                                <div class="content">
                                    <div v-if="ontslokh[1].category.length>0" class="tags has-addons">
                                        <span class="tag is-info">{{ontslokh[1].category[0].name}}</span>
                                        <span v-if="ontslokh[1].category.length!=1" class="tag is-dark">+{{ontslokh[1].category.length-1}}</span>
                                    </div>

                                    <div class="title"><a class="is-size-4">{{ontslokh[1].title.substring(0, 60)}}<span v-if="ontslokh[1].title.length>60">...</span></a></div>
                                    <div class="date"><i class="far fa-clock"></i> {{ontslokh[1].created_at}}</div>
                                </div>
                            </article>
                            <article class="tile is-child notification" :style="'background-image:url('+siteUrl+ontslokh[2].image.replace('images', '/uploads/medium')+');'">
                                <div class="bgGrad"></div>
                                <div class="content">
                                    <div v-if="ontslokh[2].category.length>0" class="tags has-addons">
                                        <span class="tag is-info">{{ontslokh[2].category[0].name}}</span>
                                        <span v-if="ontslokh[2].category.length!=1" class="tag is-dark">+{{ontslokh[2].category.length-1}}</span>
                                    </div>
                                    <div class="title"><a class="is-size-4">{{ontslokh[2].title.substring(0, 60)}}<span v-if="ontslokh[2].title.length>60">...</span></a></div>
                                    <div class="date"><i class="far fa-clock"></i> {{ontslokh[2].created_at}}</div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <loading v-else></loading>

        <!-- home menu -->
        <div class="homeMenu p-2" style="background: url('images/bg-solid.png')">
            <div class="container">

                <!-- desctop -->
                <div class="columns is-mobile is-multiline has-text-centered ">
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-gavel fa-2x"></i></span></p>
                        <p>ИТХурлын <br>тогтоол</p>
                    </div>
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-file-alt fa-2x"></i></span></p>
                        <p>Засаг даргын<br>захирамж</p>
                    </div>
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-list-alt fa-2x"></i></span></p>
                        <p>ЗДТГ-ын даргын<br>тушаал</p>
                    </div>
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-university fa-2x"></i></span></p>
                        <p>Төсөл <br> хөтөлбөр</p>
                    </div>
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-copy fa-2x"></i></span></p>
                        <p>Нээлттэй ажлын<br>байр</p>
                    </div>
                    <div class="column is-6-mobile">
                        <p><span class="icon is-large"><i class="fas fa-phone fa-2x"></i></span></p>
                        <p>Утасны<br>жагсаалт</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                siteUrl: window.surl,
                ontslokh: [],
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
                    console.log(this.ontslokh);
                })


                axios.get('http://tsag-agaar.gov.mn/forecast_xml/287').then((response) => {
                    console.log(response.data);

                })
            }
        }
    }
</script>