<template>
    <div  v-if="agentlag" >
        <!--blog list-->
        <div class="columns is-multiline pb-1">
             <div v-for="link in agentlag" class="column is-4 pb-0" :class="classes">
                 <a class="agentlaglist" :style="'background-image: url('+siteUrl+'/images/soyombo.png)'" :href="link.link" target="_blank" >
                   {{link.name}}
                 </a>
             </div>
        </div>

    </div>
    <loading v-else></loading>


</template>

<script>
    export default {
        props:[
            'classes'
        ],
        data(){
            return {
                agentlag: false,
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
                axios.get('agentlag').then((response) => {
                    this.agentlag=response.data.success
                })
            },
        }
    }
</script>