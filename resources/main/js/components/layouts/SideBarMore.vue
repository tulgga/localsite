<template>
    <div>
        <div v-if="fetched" v-html="fetched"></div>
        <loading v-else></loading>
    </div>

</template>

<script>
    export default {
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
                axios.get('/sidebar1/'+0).then((response) => {
                    this.fetched=response.data.success;
                })
            }
        }
    }

</script>
