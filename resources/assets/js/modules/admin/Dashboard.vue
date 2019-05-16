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
                this.$router.push('/config');
            } else if(admin_type==3){
                this.$router.push('/sub_news');
            } else if(admin_type==10){
                this.$router.push('/dashboard_police');
            } else if(admin_type==11){
                this.$router.push('/dashboard_hospital');
            } else if(admin_type==12){
                this.$router.push('/dashboard_nema');
            } else if(admin_type==13){
                this.$router.push('/dashboard_budget');
            } else if(admin_type==14){
                this.$router.push('/dashboard_budget');
            } else if(admin_type>14){
                this.$router.push('/dashboard_schedule');
            }
        },
    }
</script>