<template>
    <div  v-if="sites" >
        <!--blog list-->

        <div class="columns is-multiline pb-1">
             <div v-for="site in sites" class="column is-4  pb-0">
                 <a class="sumlist" :href="'http://'+site.domain+'.'+subdomain" target="_blank" >
                     <img v-if="site.favicon === null" :src="icon"/>
                     <img v-else="site.favicon === null" :src="siteUrl+'/uploads/'+site.favicon"/>
                     {{site.name}}
                 </a>
             </div>
        </div>

    </div>
    <loading v-else></loading>


</template>

<script>
    export default {

        data(){
            return {
                sites: false,
                siteUrl: window.surl,
                subdomain: window.subdomain,
                icon:window.icon,
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                axios.get('sites').then((response) => {
                  this.sites=response.data.success
                })
            },
        }
    }
</script>