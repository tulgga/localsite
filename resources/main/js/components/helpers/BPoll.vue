<template>

       <div class="columns  is-multiline mb-2">
           <div class="column  is-9">
               <div class="bg-white p-15 mb-1  shadow">
                   <h3 class="bTitle mb-1">Санал асуулга</h3>
                    <div class="columns">

                    </div>
               </div>
           </div>
           <div class="column is-3 ">
               <side-bar></side-bar>
           </div>
       </div>
</template>

<script>
    export default {
        data() {
            return {
                siteUrl: window.surl,
                poll: false,
            }
        },
        created: function () {
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                axios.get('/homePoll/').then((response) => {
                    this.poll=response.data.success;
                })
            },
        }
    }
</script>