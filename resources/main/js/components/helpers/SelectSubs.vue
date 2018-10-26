<template>
	<div>
		<input type="text" class="input" v-model="subsText" @click="chooseSubs" readonly="readonly"/>
		<div class="modal modal-choose-sub is-active" v-if="chooseModal">
            <div class="modal-background" v-on:click="chooseModal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <div class="field">
                        <input id="chooseAll" type="checkbox" v-model="selectAll" class="switch">
                        <label for="chooseAll">All {{chooseTitle}}</label>
                    </div>
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
                                        <input class="is-checkradio" :id="'subItem'+sub.id" type="checkbox" :value="sub.id" v-model="selected">
                                        <label :for="'subItem'+sub.id">{{sub.title}}</label>
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
        ],
        data(){
            return {
                subsText:'',
                subsCount:'',
                subs: this.subItems,
                chooseModal: false,
                chooseTitle: this.label_title,
                selected: [],
                search:'',
            }
        },
        watch: {
            'selected': 'watchSelects',
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
            selectAll: {
                get: function () {
                    return this.subs ? this.selected.length == this.subs.length : false;
                },
                set: function (value) {
                    var selected = [];
                    if (value) {
                        this.subs.forEach(function (sub) {
                            selected.push(sub.id);
                        });
                    }
                    this.selected = selected;
                }
            },
            filteredItems() {
                return this.subs.filter(item => {
                    return item.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            },
        },
        methods: {
            watchSelects(){
                let selected = _(this.subs).keyBy('id').at(this.selected).value();
                selected = _.pickBy(selected, _.identity);

                let result = _.map(selected, function(obj) {
                    return obj.title;
                });

                let selected_length = result.length;
                let selected_text = '';
                if(selected_length > 5){
                    let dl = result.length - 5;
                    selected_text = result.slice(0,5).join(', ') + ',    ' + dl + '+';
                }else{

                    selected_text = result.join(', ');

                }
                let count_field = selected_length==0?'':selected_length + ' selected';
                this.subsText = count_field;
                this.subsCount = selected_text;
                let is_selectall = (selected_length == this.subs.length)?1:0;

                switch(this.type) {
                    case 'category':{
                        EventBus.$emit('select-categories', {
                            data: {
                                category: this.selected,
                                selectall: is_selectall
                            }
                        });
                        break;
                    }
                }
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
