<template>
	<div>
        <input type="text" class="input" v-model="smodel.category.name" @click="chooseSubs" readonly="readonly"/>
		<div class="modal modal-choose-sub is-active" v-if="chooseModal">
            <div class="modal-background" v-on:click="chooseModal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="title is-5 has-text-weight-bold has-text-black-ter has-text-left">Select {{chooseTitle}}</p>
                    <div class="field" :class="{'has-addons':search.length > 0}">
                        <div class="control has-icons-right">
                            <input type="text" class="input" placeholder="Search value" v-model="search" />
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
                                        <input class="is-checkradio" :id="'subItem'+sub.id" type="radio" :value="sub" v-model="smodel.category">
                                        <label :for="'subItem'+sub.id">{{sub[title_key]}}</label>
                                        <template v-if="sub.code">
                                            <template v-if="sub.parent_id">
                                                <figure class="image is-48x48" :style="'background-image: url('+$store.getters.assetsPath+'img/item/'+sub.parent_id+'/'+sub.code+'.png)'"></figure>
                                            </template>
                                            <template v-else>
                                                <figure class="image is-48x48" :style="'background-image: url('+$store.getters.assetsPath+'img/item/'+sub.code+'.png)'"></figure>
                                            </template>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="button is-text" v-on:click="chooseModal = false">Cancel</div>
                    <div class="button is-primary add_button"  v-on:click="saveSubs">
                        <span>Ok</span>
                    </div>
                </footer>
                <div class="modal-close is-large" aria-label="close" v-on:click="chooseModal = false"></div>
            </div>
        </div>
	</div>
</template>

<script>
    import {EventBus} from '../../utils/eventbus'
    export default {
        props:[
            'label_title',
            'subItems',
            'type',
            'title_key',
            'smodel',
        ],
        data(){
            return {
                subsText:'',
                subsCount:'',
                subs: this.subItems,
                chooseModal: false,
                chooseTitle: this.label_title,
                search:'',
            }
        },
        watch: {
            smodel: {
                handler: function(newValue) {
                },
                deep: true
            },
            chooseModal: function (val) {
                if(!val){
                    this.search = '';
                }
            },
        },
        created: function () {
            if(!this.chooseModal){
                this.search = '';
            }
        },
        computed: {
            filteredItems() {
                return this.subs.filter(item => {
                    return item[this.title_key].toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            },
        },
        methods: {
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
