<template>
    <div  v-if="post" >
        <div class="timeline is-centered">

            <template v-for="p in post">
                <header class="timeline-header">
                    <span class="tag is-medium is-primary">{{p.short_content}}</span>
                </header>
                <div class="timeline-item">

                    <div class="timeline-content">
                        <div class="p-2" style="border:1px solid #dbdbdb">
                            <p class="heading is-size-4" ><a @click="Modal=p ">{{p.title}}</a></p>
                            <p v-if="p.image">
                                <img v-if="p.type===2" :src="'https://img.youtube.com/vi/'+p.image+'/0.jpg'"/>
                                <img v-else :src="siteUrl+p.image.replace('images/', '/uploads/medium/')"/>
                            </p>
                            <p v-html="p.content"></p>
                        </div>

                    </div>
                </div>
            </template>



        </div>

        <div class="modal is-active" v-if="Modal">
            <div class="modal-background" v-on:click="Modal = false"></div>

            <div class="modal-card" style="max-width: 610px">
                <div class="has-text-white has-background-primary" style="padding:20px;">{{Modal.title}}</div>
                <section class="modal-card-body pd0">
                    <p v-if="Modal.image">
                        <img v-if="Modal.type===2" :src="'https://img.youtube.com/vi/'+p.image+'/0.jpg'"/>
                        <img v-else :src="siteUrl+Modal.image.replace('images/', '/uploads/medium/')"/>
                    </p>
                    <span class="tag is-primary mt-1 mb-1">{{Modal.short_content}}</span>
                    <p v-html="Modal.content"></p>
                </section>
            </div>
            <button v-on:click="Modal = false" class="modal-close is-large" aria-label="close"></button>
        </div>
    </div>
    <loading v-else></loading>

</template>

<script>
    export default {
        props:[
            'cat_id',
        ],
        data(){
            return {
                Modal:false,
                page: false,
                siteUrl: window.surl,
                subdomain: window.subdomain,
                post: [],
            }
        },
        created: function () {
            this.fetchData();
        },

        methods: {
            fetchData: function () {
                axios.get('CatTimeLine/'+this.cat_id).then((response) => {
                    this.post=response.data.success;
                    this.page=true;
                })
            },
        }
    }
</script>