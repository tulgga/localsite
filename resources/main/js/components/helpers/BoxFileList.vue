<template>
    <div  v-if="files" >
        <!--blog list-->
        <table class="fileTable table is-bordered is-hoverable roboto-condensed is-fullwidth mb-3">
            <thead>
                <tr class="is-primary">

                    <th>Актын</br>дугаар</th>
                    <th>Нэр</th>
                    <th>Батлагдсан <br> огноо</th>
                    <th>Дагаж мөрдөх огноо</th>
                    <th>Хүчинтэй</th>
                    <th>Төрөл</th>
                    <th>Татах</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="file in files.data">
                <tr>
                    <td class="has-text-centered">{{file.cart_number}}</td>
                    <td><a @click="showmodal=true; fileShow=siteUrl+'/file_viewer/?file='+file.file">{{file.name}}</a>
                    </td>
                    <td class="has-text-centered">{{file.publish_date}}</td>
                    <td class="has-text-centered">{{file.active_date}}</td>
                    <td class="has-text-centered">{{file.status}}</td>
                    <td class="has-text-centered"><span class="tag">{{fileType(file.file)}}</span></td>
                    <td class="has-text-centered"> <a :href="siteUrl+'/uploads/'+file.file" download><i class="fas fa-download"></i></a></td>
                </tr>
                </template>
            </tbody>
        </table>


        <nav  class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous" @click="scrollToTop()" :disabled="files.current_page===1" :href="link+'?page='+(files.current_page-1)" >Өмнөх</a>
            <a class="pagination-next" @click="scrollToTop()" :disabled="files.current_page===files.last_page" :href="link+'?page='+(files.current_page+1)" >Дараах</a>
            <ul class="pagination-list">
                <template v-for="i in files.last_page">
                    <li>
                        <a class="pagination-link"  @click="scrollToTop()" :class="{'is-current':files.current_page===i}"  :href="link+'?page='+i" >{{i}}</a>
                    </li>
                </template>
            </ul>
        </nav>

        <!-- show modal -->
        <div class="modal is-active" v-if="showmodal">
            <div class="modal-background" v-on:click="showmodal = false"></div>
            <div class="modal-card">
                <section class="modal-card-body pd0">
                    <iframe :src="fileShow"  style="width: 100%; height: 600px;"></iframe>
                </section>
            </div>

        </div>

    </div>
    <loading v-else></loading>


</template>

<script>
    export default {
        props:[
            'cat_id',
            'link',
        ],
        data(){
            return {
                page: false,
                fileShow: false,
                showmodal:false,
                siteUrl: window.surl,
                files: false
            }
        },
        watch:{
            '$route.params.id': function () {
                this.fetchData()
            },
            '$route.query.page': function () {
                this.fetchData()
            }
        },
        created: function () {
            this.fetchData();
            },
        methods: {
            fetchData: function () {
                this.files=false;
                this.page=this.$route.query.page;
                if(!this.page){
                    axios.get('/boxFileList/'+this.cat_id).then((response) => {
                        this.files=response.data.success;
                    })
                } else {
                    axios.get('/boxFileList/'+this.cat_id+'?page='+this.page).then((response) => {
                        this.files=response.data.success;
                    })
                }

            },
            fileType(file){
                var pieces = file.split(/[\s.]+/);
                return pieces[pieces.length-1]
            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        }
    }
</script>
