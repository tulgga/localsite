<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Туслах цэс</div>
            </div>
            <div class="table-responsive">
           <table v-if="fetched" class="category table is-bordered  is-hoverable  table-hover is-fullwidth">
                <thead>
                        <tr>
                            <th >Гарчиг</th>
                            <th width="130"  class="has-text-right"></th>
                        </tr>
                </thead>
               <tbody>
               <template v-for="(list, i) in lists">
                   <tr>
                       <td ><b>{{list.title}}</b></td>
                       <td  class="p-0" >
                           <div class="data-action">
                               <div @click="changePositionMain(i,-1)" ><i class="fas fa-arrow-up"></i></div>
                               <div @click="changePositionMain(i,1)" ><i class="fas fa-arrow-down"></i></div>
                               <router-link :to="'helppages/'+list.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                               <div @click="delete_cat=list; deletemodal=true;"><i class="fas fa-trash"></i></div>
                           </div>
                       </td>
                   </tr>
                   <template v-for="(child, a) in list.children">
                       <tr >

                           <td style="padding-left:25px;" >- {{child.title}}</td>
                           <td  class="p-0">
                               <div class="data-action">
                                   <div @click="changePosition(i, a, -1)"><i class="fas fa-arrow-up"></i></div>
                                   <div @click="changePosition(i, a,1)"><i class="fas fa-arrow-down"></i></div>
                                   <router-link :to="'helppages/'+child.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                                   <div @click="delete_cat=child; deletemodal=true;"><i class="fas fa-trash"></i></div>
                               </div>
                           </td>
                       </tr>
                           <template v-for="(subchild, b) in child.children">
                            <tr>
                               <td style="padding-left:50px;" >-- {{subchild.title}}</td>
                               <td  class="p-0">
                                   <div class="data-action">
                                       <div @click="changePositionSub(i, a, b, -1)"><i class="fas fa-arrow-up"></i></div>
                                       <div @click="changePositionSub(i, a, b,1)"><i class="fas fa-arrow-down"></i></div>
                                       <router-link :to="'helppages/'+subchild.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                                       <div @click="delete_cat=subchild; deletemodal=true;"><i class="fas fa-trash"></i></div>
                                   </div>
                               </td>
                            </tr>
                               <template v-for="(subsubchild, c) in subchild.children">
                                   <tr>
                                       <td style="padding-left:75px;" >--- {{subsubchild.title}}</td>
                                       <td  class="p-0">
                                           <div class="data-action">
                                               <div @click="changePositionSubSub(i, a, b, c, -1)"><i class="fas fa-arrow-up"></i></div>
                                               <div @click="changePositionSubSub(i, a, b, c, 1)"><i class="fas fa-arrow-down"></i></div>
                                               <router-link :to="'helppages/'+subsubchild.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                                               <div @click="delete_cat=subsubchild; deletemodal=true;"><i class="fas fa-trash"></i></div>
                                           </div>
                                       </td>
                                   </tr>
                               </template>
                            </template>
                   </template>
               </template>
               </tbody>
           </table>
                <div class="pageloader" v-else="">
                    <div class="sp sp-wave"></div>
                    <p>{{$store.getters.lang.messages.loading}}</p>
                </div>
            </div>

            <div class="boxed-item-center absolute">
                <router-link :to="{ name: 'help_create_page'}" class="add_button">+</router-link>
            </div>
            <router-view></router-view>


        </div>


        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Хуудас устгах</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">Та итгэлтэй байна уу?</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">Буцах</button>
                    <button class="button is-danger add_button" v-on:click="ustga()" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>Устгах</span>
                    </button>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                siteUrl:window.surl,
                site: window.surl.replace('http://',''),
                site_id: 0,
                deletemodal:false,
                delete_cat: false,
                catmodal: false,
                insert_cat: false,
                imageni:false,
                form:{
                  title: '',
                  id:0,
                  parent_id:0,
                  order_num:0,
                  site_id: this.$store.getters.domain.id,
                },
                fetched: false,
                lists: [],
                is_loading: false,
            }
        },
        created: function () {
            this.fetchData();
        },
        watch: {
            '$route': function(to, from){
                if (from.meta.is_modal) {
                    this.fetchData();
                }
            },
        },
        methods: {
            // api url-аас дата авч байна
            fetchData() {
                this.fetched = false;
                this.site_id=this.$store.getters.domain.id;
                axios.get('/pages/'+this.site_id+'/0').then((response) => {
                    this.lists = response.data.success;
                    this.fetched = true;
                })
            },

            // Устгах
            ustga: function(){
                this.is_loading = true;
                let formData = new FormData();
                formData.append('data', JSON.stringify(this.delete_cat));
                axios.post('/pages_delete', formData).then((response) => {
                    this.deletemodal = false;
                    this.fetchData();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },

            changePositionMain(index, action){
                  if(index==0 && action==-1){
                      return
                  } else if((index+1)==this.lists.length && action==1){
                      return
                  }
                  var send= {
                      id_1:this.lists[index].id,
                      id_1_num :  this.lists[index+action].order_num,
                      id_2: this.lists[index+action].id,
                      id_2_num :  this.lists[index].order_num,
                  }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched = false;
                axios.post('/pages_change', formData).then((response) => {
                    this.fetched = true;
                    this.fetchData();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

            changePosition(index, subindex, action){
                if(subindex==0 && action==-1){
                    return
                } else if((subindex+1)==this.lists[index].children.length && action==1){
                    return
                }
                var send= {
                    id_1:this.lists[index].children[subindex].id,
                    id_1_num :  this.lists[index].children[subindex+action].order_num,
                    id_2: this.lists[index].children[subindex+action].id,
                    id_2_num :  this.lists[index].children[subindex].order_num,
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched=false
                axios.post('/pages_change', formData).then((r) => {
                    this.fetchData();
                    this.fetched=true
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

            changePositionSub(index, childindex, subindex, action){
                if(subindex==0 && action==-1){
                    return
                } else if((subindex+1)==this.lists[index].children[childindex].children.length && action==1){
                    return
                }
                var send= {
                    id_1:this.lists[index].children[childindex].children[subindex].id,
                    id_1_num :  this.lists[index].children[childindex].children[subindex+action].order_num,
                    id_2: this.lists[index].children[childindex].children[subindex+action].id,
                    id_2_num :  this.lists[index].children[childindex].children[subindex].order_num,
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched=false
                axios.post('/pages_change', formData).then((r) => {
                    this.fetchData();
                    this.fetched=true
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

            changePositionSubSub(index, index1, index2, index3, action){
                if(index3==0 && action==-1){
                    return
                } else if((index3+1)==this.lists[index].children[index1].children[index2].children.length && action==1){
                    return
                }
                var send= {
                    id_1:this.lists[index].children[index1].children[index2].children[index3].id,
                    id_1_num :  this.lists[index].children[index1].children[index2].children[index3+action].order_num,
                    id_2: this.lists[index].children[index1].children[index2].children[index3+action].id,
                    id_2_num :  this.lists[index].children[index1].children[index2].children[index3].order_num,
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched=false
                axios.post('/pages_change', formData).then((r) => {
                    this.fetchData();
                    this.fetched=true
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

            onFileChange(fieldName, fileList){
                const formData = new FormData();
                // append the files to FormData
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });

                this.image = formData.get(fieldName);


                let reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    this.imageni = reader.result;
                });
                reader.readAsDataURL(fileList[0]);
            },

        }
    }
</script>
