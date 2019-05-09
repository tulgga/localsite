<template>
    <div>
        <!-- Data table -->
        <div class="columns" v-model="fetched">

            <div class="column is-3">
                    <h1>Нүүр хуудас</h1>
                    <textarea  style="min-height:400px;" class="textarea mb1" v-model="sidebar"></textarea>
                    <button @click="saveSideBar" class="button is-primary " :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                        <span>Хадгалах</span>
                    </button>
            </div>
            <div class="column is-3">
                <h1>Мэдээний дэлгэрэнгүй</h1>
                <textarea  style="min-height:400px;" class="textarea mb1" v-model="sidebar1"></textarea>
                <button @click="saveSideBar" class="button is-primary " :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                    <span>Хадгалах</span>
                </button>
            </div>
            <div class="column is-3">
                <h1>Нүүр хуудас</h1>
                <div class="boxed">
                    <div  v-html="sidebar" class="sidebar"></div>
                </div>
            </div>
            <div class="column is-3">
                <h1>Мэдээний дэлгэрэнгүй</h1>
                <div class="boxed">
                    <div  v-html="sidebar1" class="sidebar"></div>
                </div>
            </div>
        </div>






    </div>
</template>
<script>
    export default {
        data(){
            return {
                siteUrl: window.surl,
                fetched:false,
                site_id: false,
                is_loading:false,
                sidebar: '',
                sidebar1: '',
            }
        },
        mounted(){

        },
        created(){
            this.fetchData();
        },
        methods: {
            fetchData(){
                this.site_id=this.$store.getters.domain.id;
                axios.get('/site/'+this.$store.getters.domain.id).then((response) => {
                    this.sidebar = response.data.success.sidebar;
                    this.sidebar1 = response.data.success.sidebar1;
                    this.fetched = true;
                })
            },
            saveSideBar(){
                this.is_loading=true;
                this.fetched = false;
                var yvuulah = { sidebar: this.sidebar, sidebar1: this.sidebar1 };

                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/site_sidebar/'+this.site_id, formData).then((r) => {
                    this.fetched = true;
                    this.is_loading = false;
                    this.fetchData();
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            }
        },
    }
</script>
<style>
    .sidebar {
        border:1px solid #fafafa;
        margin: 1em auto;
        max-width: 320px;

    }
</style>
