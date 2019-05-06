<template>
    <div>
        <input type="text" class="input" v-model="subsText" @click="chooseSubs" :placeholder="$store.getters.lang.form_text.title" readonly="readonly"/>
        <div class="modal modal-choose-sub is-active" v-if="chooseModal">
            <div class="modal-background" v-on:click="chooseModal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="title is-5 has-text-weight-bold has-text-black-ter has-text-left">{{ $store.getters.lang.form_text.select_product }}</p>
                    <div class="field" :class="{'has-addons':search.length > 0}">
                        <div class="control has-icons-right">
                            <input type="text" class="input" :placeholder="$store.getters.lang.form_text.search_value" v-model="search" />
                            <span class="icon is-small is-right">
                                <i class="fa fa-search" :class="{'has-text-grey':search.length > 0}"></i>
                            </span>
                        </div>
                        <div class="control" v-if="search.length > 0">
                            <div class="button is-dark" @click="search = ''">
                                <span class="icon">
                                    <i class="ion-md-close"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="modal-card-body">
                    <div class="formni">
                        <div class="columns is-mobile is-multiline">
                            <div class="column is-12-mobile is-12-tablet">
                                <template v-for="sub in filteredItems">
                                    <div class="field">
                                        <input class="is-checkradio" :id="'sub'+sub.id" type="radio" :value="sub" v-model="smodel.id">
                                        <label :for="'sub'+sub.id" @click="subsText = sub.title">{{sub.title}}</label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="button is-text" v-on:click="chooseModal = false">{{ $store.getters.lang.messages.is_back_button }}</div>
                    <div class="button is-primary add_button"  v-on:click="saveSubs">
                        <span>{{ $store.getters.lang.messages.is_ok_button }}</span>
                    </div>
                </footer>
                <div class="modal-close is-large" aria-label="close" v-on:click="chooseModal = false"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'subItems',
            'smodel',
        ],
        data(){
            return {
                subsText:'',
                subs: this.subItems,
                chooseModal: false,
                search:'',
            }
        },
        watch: {
            smodel: {
                handler: function(newValue) {
                },
                deep: true
            },
            subItems: function(newValue){
                this.subs = newValue;
                if (newValue.length > 0) {
                    let indexni = this.getIndexIfObjWithOwnAttr(newValue, 'id', this.smodel.id);
                    this.subsText = newValue[indexni].title;
                }
            },
            chooseModal: function (val) {
                if(!val){
                    this.search = '';
                }
            },
        },
        created: function () {
            if (this.subItems.length > 0) {
                    let indexni = this.getIndexIfObjWithOwnAttr(this.subItems, 'id', this.smodel.id);
                    this.subsText = this.subItems[indexni].title;
                }
            if(!this.chooseModal){
                this.search = '';
            }
        },
        computed: {
            filteredItems() {
                return this.subs.filter(item => {
                    return item.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            },
        },
        methods: {
            getIndexIfObjWithOwnAttr: function(array, attr, value) {
                for(var i = 0; i < array.length; i++) {
                    if(array[i].hasOwnProperty(attr) && array[i][attr] === value) {
                        return i;
                    }
                }
                return -1;
            },
            // Нэмэх, Засах
            saveSubs: function() {
                this.chooseModal = false
            },
            chooseSubs() {
                this.chooseModal = true;
            }
        }
    }
</script>
