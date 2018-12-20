<template>
    <div  class="container" >
        <template v-if="fetched">

            <div class="columns   mt-1">

                <div class="column  is-8">
                    <div class="bg-white p-15 mb-1  shadow">
                        <h3 class="bTitle mb-1">САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДЛЫН ХАРИУЛТ</h3>

                    </div>
                </div>
                <div class="column  is-4">
                    <div class="bg-white p-15 mb-1  shadow">
                        <h3 class="bTitle mb-1">Санал хүсэлт, өргөдөл гомдол</h3>

                    </div>
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
                category: false,
                siteUrl: window.surl,
                content: null,
            }
        },
        created: function () {
            this.fetchData()
        },
        methods: {
            fetchData: function () {
                // this.fetched=false;
                // axios.get('/urgudul/'+this.id).then((response) => {
                //     this.fetched=true
                //     this.content=response.data.success
                //     if(this.content){
                //
                //     }
                // })
            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        },
        metaInfo() {
            return {
                title: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ',
                titleTemplate: '%s | ' + window.title,
                meta: [
                    {name: 'viewport', content: 'width=device-width, initial-scale=1'},
                    {name: 'description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {property: 'og:title', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {property: 'og:type', content: 'website'},
                    {property: 'og:description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {name: 'twitter:card', content: ''},
                    {name: 'twitter:title', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {name: 'twitter:description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {itemprop: 'name', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                    {itemprop: 'description', content: 'САНАЛ ХҮСЭЛТ, ӨРГӨДӨЛ ГОМДОЛ'},
                ],
            }
        },

    }
</script>