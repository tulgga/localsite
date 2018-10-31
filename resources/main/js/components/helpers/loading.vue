<template>
    <div>
        <div class="loading"  >
            <img :src="siteUrl+'/images/loading.gif'"/>
            <p>уншиж байна</p>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'Loading',
        props:[],
        data(){
            return {
                siteUrl: window.surl,
            }
        },
    }
</script>