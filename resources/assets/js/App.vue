
<template >
    <div class="app" v-bind:class="{'aside-mini':$store.getters.drawer}" v-if="$store.getters.authCheck">
        <navigation-drawer></navigation-drawer>
        <tool-bar></tool-bar>
        <section class="section section-section section-is-expanded" v-if="$route.meta.is_expanded">
            <router-view></router-view>
        </section>
        <section class="section section-section" v-else="">
            <div class="container is-fluid">
                <router-view></router-view>
            </div>
        </section>
        <div class="pageloader" v-if="$store.getters.pageloader">
            <div class="sp sp-wave"></div>
            <p>{{$store.getters.lang.messages.loading}}</p>
        </div>
    </div>
    <div class="app" v-else="">
        <router-view></router-view>
    </div>
</template>

<script>
    import NavigationDrawer from './components/layouts/NavigationDrawer.vue'
    import ToolBar from './components/layouts/ToolBar.vue'
    export default {
        name: 'app',
        components: {
            NavigationDrawer,
            ToolBar,
        },
        data () {
            return {
                drawer: false,
            }
        },
        watch: {
            '$route': 'shalgah',
        },
        created: function () {
            this.shalgah();
        },
        mounted(){
        },
        methods: {
            shalgah: function(){
                if (this.$route.meta.is_modal === true) {
                    document.querySelector('html').classList.add('is-clipped');
                } else {
                    document.querySelector('html').classList.remove('is-clipped');
                }
            }
        },
    }
</script>

<style>
    .section-is-expanded {
        margin-top: 4rem;
        padding-top: 0 !important;
    }
</style>