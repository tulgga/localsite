<template>
    <div>
        <div v-if="fetched" v-html="fetched"></div>
        <template v-else>
            <div class="bg-white p-15   shadow">
                <h3 class="bTitle mb-1">Зар</h3>
                <zar-list   styles="height: 490px;"></zar-list>
            </div>
        </template>
    </div>

</template>

<script>
    import ZarList from '../../components/helpers/ZarList';
    export default {
        components: {ZarList},
        name: 'SideBar',
        props:[],
    	data(){
    		return {
                fetched: false,
    		}
    	},
    	created: function () {
            this.fetchData();
        },
        mounted(){
        },
        methods: {
            fetchData: function () {
                axios.get('/sidebar/'+0).then((response) => {
                    this.fetched=response.data.success;
                })
            }
        }
    }

</script>
