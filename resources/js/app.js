/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import store from './store/index'
store.dispatch('auth/me')

import VueRouter from 'vue-router'
window.Vue.use(VueRouter)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from './components/App'
import SignIn from './views/SignIn'
import Home from './views/Home'
import Register from './views/Register'
import Account from './views/Account'
import Property from './views/Property'
import CompleteRegisterGateway from './views/CompleteRegisterGateway'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/property/:property_id',
            name: 'propertyItem',
            component: Property
        },
        {
            path: '/signin',
            name: 'signIn',
            component: SignIn
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/complete-register',
            name: 'completeRegister',
            component: CompleteRegisterGateway
        },

        {
            path: '/account',
            name: 'account',
            component: Account,
            beforeEnter(to, from, next) {
                if (store.getters["auth/authenticated"]) {
                    next()
                } else {
                    next({
                        name: "signin"
                    });
                }
            }
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
