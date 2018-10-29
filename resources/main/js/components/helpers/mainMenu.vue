

<template v-if="menu">
   <div> {{menu}}</div>

</template>



<script>
    export default {
        name: 'mainMenu', // as a recursive component
        props: {
            props: ['menu'],
        },
    }
</script>
