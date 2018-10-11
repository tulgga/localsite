<template>
    <span>
        <template v-if="$store.getters.version_lang === 'mn'">₮</template>
        <template v-if="$store.getters.version_lang === 'en'">$</template>
    </span>
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
    }
</script>