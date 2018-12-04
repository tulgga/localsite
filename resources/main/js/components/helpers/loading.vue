<template>
    <div>
        <div class="loading"  >
            <img  :src="siteUrl+'/images/load.png'"/>
            <!--<p>уншиж байна</p>-->
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