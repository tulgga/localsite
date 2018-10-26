
<template >
    <div class="app" >
        <header-bar></header-bar>
        <router-view></router-view>
        <footer-bar></footer-bar>
        <div class="pageloader" v-if="$store.getters.pageloader">
            <div class="sp sp-wave"></div>
            <p>{{$store.getters.lang.messages.loading}}</p>
        </div>
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
    }
</script>

<style>
    .section-is-expanded {
        margin-top: 4rem;
        padding-top: 0 !important;
    }
</style>