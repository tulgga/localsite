<template>
    <div>

        <!-- Data table -->
        <div class="boxed">

            <div class="boxed-title">
                <div class="boxed-item-center title">Файлын ангилал</div>
            </div>
            <div class="table-responsive">
           <table v-if="fetched" class="category table is-bordered  is-hoverable  is-fullwidth">
                <thead>
                        <tr>
                            <th colspan="2">Нэр</th>
                            <th width="130"  class="has-text-right"></th>
                        </tr>
                </thead>
               <tbody>
               <template v-for="(list, i) in lists">
                   <tr>
                       <td colspan="2"><b>{{list.name}}</b></td>
                       <td  class="p-0" >
                           <div class="data-action">
                               <div @click="changePositionMain(i,1)" ><i class="fas fa-arrow-up"></i></div>
                               <div @click="changePositionMain(i,-1)" ><i class="fas fa-arrow-down"></i></div>
                               <div @click="insert_cat=list; catmodal=true;"><i class="fas fa-pencil-alt"></i></div>
                               <div @click="delete_cat=list; deletemodal=true;"><i class="fas fa-trash"></i></div>
                           </div>
                       </td>
                   </tr>
                   <template v-for="(child, a) in list.children">
                       <tr class="is-grey">
                           <td width="20" class="is-default">-</td>
                           <td > {{child.name}}</td>
                           <td  class="p-0">
                               <div class="data-action">
                                   <div @click="changePosition(i, a, 1)"><i class="fas fa-arrow-up"></i></div>
                                   <div @click="changePosition(i, a,-1)"><i class="fas fa-arrow-down"></i></div>
                                   <div @click="insert_cat=child; catmodal=true;" ><i class="fas fa-pencil-alt"></i></div>
                                   <div @click="delete_cat=child; deletemodal=true;"><i class="fas fa-trash"></i></div>
                               </div>
                           </td>
                       </tr>
                   </template>
               </template>
               </tbody>
           </table>
           <div v-else class="main-bodoh is-loading"></div>
            </div>

            <div class="boxed-item-center absolute">
                <a  @click="insert_cat=form; catmodal=true; " class="add_button">+</a>
            </div>

        </div>


        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Файлын ангилал устгах</p>
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


        <!-- edit insert -->
        <div class="modal is-active" v-if="catmodal">
            <div class="modal-background" ></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p  class="modal-card-title ">
                        <template v-if="insert_cat.id==0">Файлын ангилал нэмэх</template>
                        <template v-else>Файлын ангилал засах</template>
                    </p>
                </header>
                <section class="modal-card-body">
                    <div class="field" >
                        <label class="label">Эх ангилал</label>
                        <div class="control select">
                            <select class="input" v-model="insert_cat.parent_id">
                                <option value="0">-------</option>
                                <template v-for="list in lists">

                                    <option v-if="insert_cat.id!=list.id" :value="list.id">{{list.name}}</option>
                                </template>
                            </select>
                        </div>
                    </div>
                        <div class="field">
                            <label class="label">Нэр</label>
                            <div class="control">
                                <input class="input"  v-model="insert_cat.name"  />
                            </div>
                        </div>
                </section>

                <footer class="modal-card-foot">
                    <button class="button is-text"  @click="catmodal = false">Буцах</button>
                    <button @click="nemeh()" class="button is-primary add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>Хадгалах</span>
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
                site: window.surl.replace('http://',''),
                site_id: 0,
                deletemodal:false,
                delete_cat: false,
                catmodal: false,
                insert_cat: false,
                form:{
                  name: '',
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
        methods: {
            // api url-аас дата авч байна
            fetchData() {
                this.fetched = false;
                this.site_id=this.$store.getters.domain.id;
                axios.get('/file_category/'+this.site_id).then((response) => {
                    this.lists = response.data.success;
                    this.fetched = true;
                })
            },

            nemeh: function(){
                if(this.insert_cat.name===''){
                    alert('Мэдээний ангиллын нэр хоосон байна')
                    return
                }

                this.is_loading=true;
                let formData = new FormData();
                formData.append('data', JSON.stringify(this.insert_cat));

                axios.post('/file_category', formData)
                    .then((response) => {
                        if(response.data.success===0){
                            alert('дэд ангилалтай файлын ангилал байна. эх ангилал харьяалагдах боломжгүй');
                            this.is_loading = false;
                            return;
                        }
                        this.is_loading = false;
                        this.catmodal=false;
                        this.form ={name: '', id:0, parent_id:0, order_num:0, site_id: this.site_id};
                        this.fetchData();
                        this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_updated_text});
                    });
            },

            // Устгах
            ustga: function(){
                this.is_loading = true;
                let formData = new FormData();
                formData.append('data', JSON.stringify(this.delete_cat));
                axios.post('/file_category/delete', formData).then((response) => {
                    this.deletemodal = false;
                    this.fetchData();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },

            changePositionMain(index, action){
                  if(index==0 && action==1){
                      return
                  } else if((index+1)==this.lists.length && action==-1){
                      return
                  }
                  var send= {
                      id_1:this.lists[index].id,
                      id_1_num :  this.lists[index-action].order_num,
                      id_2: this.lists[index-action].id,
                      id_2_num :  this.lists[index].order_num,
                  }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched = false;
                axios.post('/file_category/change', formData).then((response) => {
                    this.fetched = true;
                    this.fetchData();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

            changePosition(index, subindex, action){
                if(subindex==0 && action==1){
                    return
                } else if((subindex+1)==this.lists[index].children.length && action==-1){
                    return
                }
                var send= {
                    id_1:this.lists[index].children[subindex].id,
                    id_1_num :  this.lists[index].children[subindex-action].order_num,
                    id_2: this.lists[index].children[subindex-action].id,
                    id_2_num :  this.lists[index].children[subindex].order_num,
                }

                let formData = new FormData();
                formData.append('data', JSON.stringify(send));
                this.fetched=false
                axios.post('/file_category/change', formData).then((r) => {
                    this.fetchData();
                    this.fetched=true
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: 'Амжилттай хадгаллаа'}); // delete success toast
                })
            },

        }
    }
</script>
