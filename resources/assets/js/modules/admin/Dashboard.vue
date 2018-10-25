<template>
    <div>
    </div>
</template>
<script>
    export default {
        created:function(){
            var admin_type=this.$store.getters.authUser.admin_type;
            if(admin_type==0){
                this.$router.push('/sites');
            } else if(admin_type==1){
                this.$router.push('/news');
            } else if(admin_type==2){
                this.$router.push('/sub_config');
            } else if(admin_type==3){
                this.$router.push('/sub_news');
            }
        },
    }
</script>