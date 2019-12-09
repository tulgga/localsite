<template>
    <div  class="container" >
        <template v-if="fetched">

            <div class="columns">
                <div class="column  is-12 workers">
                    <template v-for="org in list">
                        <h4>{{org.name}}</h4>
                        <div class="d-block">
                            <template v-for="dep in org.json_data">
                                <template v-if="dep.type==1">
                                    <div class="profile_box" v-for="user in dep.users" v-if="user.system_name!='админ'">
                                        <div class="profile" v-if="user.photo"  :style="'background-image: url('+user.photo+')'"></div>
                                        <div class="profile"  v-else  :style="'background-image: url(/main/sub/images/no_profile.png)'"></div>
                                        <div class="name">{{user.system_name}}</div>
                                        <div class="duty">{{user.app_name}}</div>
                                        <div class="contact"><a :href="'mailto:'+user.work_mail" :title="user.work_mail"><i class="fa fa-envelope"></i></a></div>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-for="dep1 in dep.childrenSub">
                                    <div class="profile_box" v-for="user in dep1.users"  >
                                        <div class="profile" v-if="user.photo"  :style="'background-image: url('+user.photo+')'"></div>
                                        <div class="profile"  v-else  :style="'background-image: url(/main/sub/images/no_profile.png)'"></div>
                                        <div class="name">{{user.system_name}}</div>
                                        <div class="duty">{{user.app_name}}</div>
                                        <div class="contact"><a :href="'mailto:'+user.work_mail" :title="user.work_mail"><i class="fa fa-envelope"></i></a></div>
                                    </div>
                                    </template>
                                </template>

                            </template>
                        </div>
                    </template>

                </div>
            </div>
        </template>
        <loading v-else></loading>



    </div>
</template>
<script>
    export default {
        data() {
            return {
                id: false,
                fetched:true,
                page:1,
                list: [],
            }
        },
        watch:{
        },
        created: function () {
            this.fetchData()
        },
        methods: {
            fetchData: function () {
                this.fetched=false;
                this.page=this.$route.query.page;
                axios.get('/workers').then((response) => {
                    this.fetched=true;
                    this.list=response.data.success;
                })
            },
        },
        metaInfo() {
            return {
                title: 'Able',
                titleTemplate: '%s | ' + window.title,
                meta: [
                    {name: 'viewport', content: 'width=device-width, initial-scale=1'},
                    {name: 'description', content: 'Able'},
                    {property: 'og:title', content: 'Able'},
                    {property: 'og:type', content: 'website'},
                    {property: 'og:description', content: 'Able'},
                    {name: 'twitter:card', content: ''},
                    {name: 'twitter:title', content: 'Able'},
                    {name: 'twitter:description', content: 'Able'},
                    {itemprop: 'name', content: 'Able'},
                    {itemprop: 'description', content: 'Able'},
                ],
            }
        },

    }
</script>
<style>
    /** workers **/

    :root{
        --MainColor:  #024789;
        --SecondColor:  #024789;
    }


    .workers{
        text-align: center;
    }
    .workers .profile_box{
        display: inline-grid;
        width: 10%;
        margin: 0 10px 0 12px;
    }
    .workers h4{
        position: relative;
        text-transform: uppercase;
        font-size: 20px;
        font-weight: 600;
        margin: 40px 0;
        color: var(--MainColor);
        padding-bottom: 10px;
    }
    .workers h4:after{
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 60px;
        height: 3px;
        background: var(--SecondColor);
        margin-left: -30px;
    }
    .workers .profile{
        display: block;
        padding: 10px;
        border: 1px dashed #ddd;
        border-radius: 50%;
        margin: 0 0 10px;
        width: 115px;
        height: 115px;
        background-position: top center;
        background-size: cover;
    }
    .workers .profile img{
        opacity: .5;
    }
    .workers .profile profile{
        background-size: cover;
        background-position: center center;
        display: block;
        border-radius: 50%;
        width: 100%;
    }
    .workers .name{
        display: block;
        font-weight: 700;
        margin-bottom: 3px;
        font-size: 12px;
        word-break: break-all;
    }
    .workers .duty{
        display: block;
        color: #777;
        font-size: 11px;
        margin-bottom: 3px;
    }
    .workers .contact{
        margin-bottom: 20px;
    }
    .workers .contact a{
        color: #000;
        display: inline-block;
        font-size: 12px;
    }
    .workers .contact a:hover{
        color:var(--SecondColor);
    }
</style>