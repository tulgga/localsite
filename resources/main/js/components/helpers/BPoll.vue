<template>

       <div v-if="poll" class="columns  is-multiline mb-2">
           <div class="column  is-12">
               <div class="bg-white p-15 mb-1  shadow">
                   <h3 class="bTitle mb-1">Санал асуулга</h3>
                    <div class="columns">
                        <div class="column is-3 is-hidden-mobile">
                            <img :src="siteUrl+poll.image.replace('images', '/uploads/medium')"/>
                        </div>
                        <div class="column is-9">
                                <h3>{{poll.question}}</h3>
                                <br>
                                <strong>(Нийт санал: {{poll.cnt}})</strong>
                                <table border="0" cellpadding="0" cellspacing="0" class="pollanswers" width="100%">
                                    <tr><td  colspan="4"></td></tr>
                                    <tr v-for="a in poll.answer" >
                                        <td width="25" ><div @click="sendPoll(poll.id, a.id, poll.finished)" class="round"></div></td>
                                        <td @click="sendPoll(poll.id, a.id, poll.finished)" style="cursor:pointer">{{a.answer}}</td>
                                        <td width="40%">
                                            <progress v-if="poll.cnt>0" class="progress mb-0 is-success" :value="a.cnt*100/poll.cnt" max="100">{{(a.cnt*100/poll.cnt).toFixed(1)}}%</progress>

                                        </td>
                                        <td  class="has-text-right">
                                            <strong v-if="poll.cnt>0">{{(a.cnt*100/poll.cnt).toFixed(1)}}%</strong>
                                            <strong v-else>0.0%</strong>
                                        </td>
                                    </tr>
                                    <tr v-if="poll.finished">
                                        <td colspan="4" class="has-text-centered" style="color:#999">Санал асуулгын хугацаа дууссан байна</td>
                                    </tr>
                                </table>
                        </div>
                    </div>
               </div>
           </div>
       </div>
        <loading v-else></loading>
</template>

<script>
    export default {
        data() {
            return {
                siteUrl: window.surl,
                poll: false,
            }
        },
        created: function () {
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                axios.get('/homePoll/').then((response) => {
                    this.poll=response.data.success;
                    console.log(this.poll);
                })
            },
            sendPoll(pollId, answerId, finished){
                if(finished === false){
                    let formData = new FormData();
                    var form = { pollId: pollId, answerId: answerId}
                    formData.append('data', JSON.stringify(form));
                    axios.post('/sendPoll', formData).then((response) => {
                        if(response.data.success.type===1){
                            this.fetchData();
                            this.$toasted.global.toast_success({message: response.data.success.text});
                        } else {
                            this.$toasted.global.toast_error({message: response.data.success.text});
                        }

                    });
                } else {
                    this.$toasted.global.toast_error({message: 'Санал асуулгын хугацаа дууссан байна'});
                }

            }
        }
    }
</script>