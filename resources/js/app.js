/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'vue-loading-overlay/dist/vue-loading.css';
import BootstrapVue from "bootstrap-vue";
import Index from "./components/templates/Index";
import Loading from 'vue-loading-overlay';
import router from "./router/router";
import store from "./storage/store";
import Vue from "vue";

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
    }
});


Vue.config.productionTip = false;
Vue.use(BootstrapVue);
Vue.use(Loading);
// TODO will create PortfolioUtil that handle all functionalities that involved portfolio data
Vue.prototype.$jsVars = JS_VARS;
new Vue({
    router,
    store,
    render: h => h(Index),
    el: "#app"
});

// TODO TO FIX THE REFRESH ERROR
// window.onbeforeunload = function () {
//     if(store.getters.getClient) {
//         $.get({
//             url: 'api/logout',
//             data: store.getters.getClient,
//         })
//         store.commit('setClient', null);
//     }
// }
