<template>
    <div class="box p1">
        

            <div class="column is-12-mobile is-6-tablet">
                <div class="field">
                    <label class="label">Start date</label>
                    <div class="control has-icons-right">
                        <flat-pickr class="input" v-model="form.start_date" ></flat-pickr>
                        <span class="icon is-small is-right has-text-grey">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                </div>
            </div>


    </div>
</template>

<script>
    export default {
        data(){
            return {
                form:{
                    // start_date: '2018-03-07', // default-аар өдөртэй байвал
                },
                timepckr_config: {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",      
                },
            }
        },
    }
</script>