/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueRouter from "vue-router";

require('./bootstrap');

window.Vue = require('vue').default;
window.Vue.use(VueRouter)

//libs
import Moment from "moment";

// vuex
import store from './store/index'
store.dispatch('auth/me')

//router
import router from './router';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import App from './layout/App'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//mixin
import './extra/mixin'

//filters
import './extra/filters'

//make app
const app = new Vue({
    el: '#app',
    components: { App, Moment },
    store,
    router
});
