
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
import * as VueGoogleMaps from 'vue2-google-maps';
import VeeValidate from 'vee-validate';
import Loading from './components/helpers/loading';
import BImg from './components/helpers/BImg';
import Sum from './components/helpers/Sum';
import Agentlag from './components/helpers/Agentlag';
import SideBar from './components/layouts/SideBar';
import NotFound from './modules/system/NotFound';
import flatPickr from 'vue-flatpickr-component';
import VueSelect from 'vue-select';
import VueCarousel from 'vue-carousel';
import Meta from 'vue-meta';
import VBar from 'v-bar';
// import BCarousel from './components/helpers/carousel';

Vue.use(VueRouter);
Vue.use(Meta)
sync(store, router);

Vue.use(VueCarousel);
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
Vue.use(ClientTable, {}, false, 'bootstrap4');
Vue.use(ServerTable, {}, false, 'bootstrap4');
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
    const { status } = error.response
    if(status === 404){
        router.push({ name: '/admin/404' })
    }

    if (status >= 500) {
        alert(error.response.data);
    }

    if (status === 401) {
        store.dispatch('logout')
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

Vue.use(VeeValidate);
// Vue.use(SlVueTree);

Vue.config.productionTip = false

Vue.component('flatPickr', flatPickr);
Vue.component('SiteApp', require('./App.vue').default);
Vue.component('v-select', VueSelect);
Vue.component('Loading', Loading);
Vue.component('b-img', BImg);
Vue.component('sum', Sum);
Vue.component('agentlag', Agentlag)
Vue.component('SideBar', SideBar);
Vue.component('NotFound', NotFound);
Vue.component('v-bar', VBar);

// Vue.component('BCarousel', BCarousel);

const app = new Vue({
    el: '#app',
    router,
    store,
    Toasted,
});



