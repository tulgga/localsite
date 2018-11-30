<template>
    <span>{{formatPrice(value)}}₮</span>
</template>

<script>
    export default {
        props:[
            'value',
        ],
        data(){
            return {
            }
        },
        methods: {
            formatPrice(value) {
                //let val = (value/1).toFixed(2).replace('.', ',')
                if(value){
                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                }else{
                    return 0.00;
                }
            }
        }
    }
</script>