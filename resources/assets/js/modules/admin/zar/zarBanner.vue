<template>
    <div>
        <!-- Data table -->
        <div class="columns" v-model="fetched">

            <div class="column is-4">
                    <h1>Толгой баннер</h1>
                    <textarea  style="min-height:400px;" class="textarea mb1" v-model="top_banner"></textarea>
                    <button @click="saveSideBar" class="button is-primary " :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                        <span>Хадгалах</span>
                    </button>
            </div>
            <div class="column is-4">
                <h1>Зүүн баннер</h1>
                <textarea  style="min-height:400px;" class="textarea mb1" v-model="left_banner"></textarea>
                <button @click="saveSideBar" class="button is-primary " :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                    <span>Хадгалах</span>
                </button>
            </div>
            <div class="column is-4">
                <h1>Гол баннер</h1>
                <textarea  style="min-height:400px;" class="textarea mb1" v-model="center_banner"></textarea>
                <button @click="saveSideBar" class="button is-primary " :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                    <span>Хадгалах</span>
                </button>
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
                left_banner: '',
                center_banner: '',
                top_banner: '',
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
                axios.get('/zarBanner').then((response) => {
                    this.top_banner = response.data.success.top_banner;
                    this.left_banner = response.data.success.left_banner;
                    this.center_banner = response.data.success.center_banner;
                    this.fetched = true;
                })
            },
            saveSideBar(){
                this.is_loading=true;
                this.fetched = false;
                var yvuulah = { top_banner: this.top_banner, left_banner: this.left_banner, center_banner: this.center_banner };

                let formData = new FormData();
                formData.append('data', JSON.stringify(yvuulah));
                axios.post('/zarBanner', formData).then((r) => {
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
