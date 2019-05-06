
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import { sync } from 'vuex-router-sync'
import router from './router'
import Vuebar from 'vuebar'
import Toasted from 'vue-toasted';
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
import flatPickr from 'vue-flatpickr-component';
import * as VueGoogleMaps from 'vue2-google-maps';
import VeeValidate from 'vee-validate';
import attributesEn from './components/addons/en';
import VueCroppie from 'vue-croppie';

import ToggleButton from 'vue-js-toggle-button';
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import  { Photoshop, Sketch }  from 'vue-color'


// import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
// import VueCkeditor from 'vue-ckeditor5'
// const options = {
//     editors: {
//         classic: ClassicEditor,
//         editorConfig: {
//
//         }
//     },
//     name: 'ckeditor'
// }
// Vue.use(VueCkeditor.plugin, options);
import VueSelect from 'vue-select'


Vue.use(ToggleButton);


// import SlVueTree from 'sl-vue-tree';

//import Ckeditor from 'Ckeditor.vue';
Vue.use(VueRouter);
sync(store, router);


Vue.use(Vuebar);


Vue.use(Toasted,{
    iconPack : 'fontawesome' // Toast icon package / material or fontawesome
});
// Toast actions
Vue.toasted.register('toast_error',
    (payload) => {
        // if there is no message passed show default message
        if(! payload.message) {
            return "Алдаа гарлаа!"
        }
        // if there is a message show it with the message
        return payload.message;
    },
    {
        type : 'error',
        icon : 'error_outline',
        duration : 5000,
        className : 'is-danger',
        position : 'bottom-right'
    });
Vue.toasted.register('toast_success',
    (payload) => {
        // if there is no message passed show default message
        if(! payload.message) {
            return "Амжилттай"
        }
        // if there is a message show it with the message
        return payload.message;
    },
    {
        type : 'success',
        icon : 'check',
        duration : 5000,
        className : 'is-success',
        position : 'bottom-right'
    });


//Vue.use(ClientTable, {}, false, require('./template.js')('client'));
Vue.use(ClientTable, {}, false, 'bulma');
Vue.use(ServerTable, {}, false, 'bulma');
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyAS6FuOdJsVZ0PTP_oxHqQiwUiX0oq5pVw',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)
    }

});

window.axios.interceptors.request.use(request => {
    if (store.getters.authToken) {
        request.headers.Authorization = `Bearer ${store.getters.authToken}`
    }
    return request
});

window.axios.interceptors.response.use(response => {

    return response;
}, error => {
    const { status } = error.response;
    if(status === 404){
        router.push({ name: '/admin/404' })
    }

    if (status >= 500) {
        alert(error.response.data);
    }

    if (status === 401) {
        //alert('401');
        //store.dispatch('refreshToken');
        store.dispatch('logout');
        router.push({ name: 'login' })
    }

    if(status === 403){
        alert('Хандах эрхгүй нөхөр байна!!!');
    }

    return Promise.reject(error)
});



VeeValidate.Validator.extend('greater_than_zero', {
    getMessage: field => 'The '+field+' field is greater than 0.',
    validate(value, args) {
        if(parseFloat(value) > 0) {
            return true;
        } else {
            return false;
        }
    }
});

Vue.use(VeeValidate,{
    locale: 'en',
        dictionary: {
        en: { attributes: attributesEn,  messages: attributesEn, },
    }
});
Vue.use(VueCroppie);
// Vue.use(SlVueTree);

Vue.config.productionTip = false;

import 'flatpickr/dist/flatpickr.css';

Vue.component('flatPickr', flatPickr);
Vue.component('SiteApp', require('./App.vue').default);
Vue.component('Treeselect', Treeselect);
Vue.component('v-select', VueSelect);
Vue.component('sketch-picker', Sketch);




const app = new Vue({
    el: '#app',
    router,
    store,
    Toasted
});

