<template>
    <div  v-if="value.type===2"  :class="classes"  :style="'background-image:url(https://img.youtube.com/vi/'+value.image+'/'+ImgSize(size)+'.jpg);'">
        <slot></slot>
    </div>
    <div v-else  :class="classes"  :style="'background-image:url('+siteUrl+value.image.replace('images', '/uploads/'+size)+');'">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: 'BImg',
        props:[
            'value',
            'classes',
            'size',
        ],
        data() {
            return {
                siteUrl: window.surl,
            }
        },
        methods: {
             ImgSize(size) {
                if(size=='small'){
                    return 'mqdefault';
                }
                 if(size=='medium'){
                     return '0';
                 }

                 if(size=='large'){
                     return 'sddefault';
                 }
                 if(size=='full'){
                     return 'maxresdefault';
                 }
                 return 'mqdefault';
             },
        }
    }
</script>