
<template >
    <div  class="app" >
        <div  v-if="fetched">
            <header-bar></header-bar>
            <div id="body-content" style="margin-top: 20px;">
                <router-view></router-view>
            </div>
            <footer-bar></footer-bar>
            <div class="pageloader" v-if="$store.getters.pageloader">
                <div class="sp sp-wave"></div>
                <p>{{$store.getters.lang.messages.loading}}</p>
            </div>
        </div>
        <loading v-else></loading>
    </div>
</template>

<script>
    import HeaderBar from './components/layouts/HeaderBar.vue'
    import FooterBar from './components/layouts/FooterBar .vue'
    export default {
        name: 'app',
        components: {
            HeaderBar,
            FooterBar,
        },
        data(){
            return {
                fetched: false
            }
        },
        created: function () {
            this.$store.dispatch('loadMenu').then(r=>{ this.fetched=true; });
        }
    }
</script>

