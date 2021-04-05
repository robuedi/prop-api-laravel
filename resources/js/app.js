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
import PassThrough from './components/PassThrough'
import SignIn from './views/SignIn'
import Home from './views/Home'
import Register from './views/Register'
import Account from './views/Account'
import Profile from './views/account/sections/Profile'
import AddProperty from './views/account/sections/AddProperty'
import Applications from './views/account/sections/Applications'
import MyProperties from './views/account/sections/MyProperties'
import Property from './views/Property'
import CompleteRoleGateway from './views/account/CompleteRoleGateway'
import RolesGateway from "./views/account/RolesGateway";

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
            component: SignIn,
            beforeEnter(to, from, next) {
                if (store.getters["auth/authenticated"]) {
                    next({
                        name: "account"
                    });
                }
                else {
                    next()
                }
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        // {
        //     path: '/complete-register',
        //     name: 'completeRegister',
        //     component: CompleteRegisterGateway
        // },
        {
            path: '/choose-roles',
            name: 'chooseRoles',
            component: RolesGateway
        },
        {
            path: '/complete-role/:userRoleId',
            name: 'completeRole',
            component: CompleteRoleGateway
        },
        {
            path: '/account',
            name: 'account',
            component: Account,
            // beforeEnter(to, from, next) {
            //     setTimeout(() => {
            //         if (!store.getters["auth/authenticated"]) {
            //             next({
            //                 name: "signIn"
            //             });
            //         } if (!store.getters["auth/profileCompleted"]) {
            //             next({
            //                 name: "completeRegister"
            //             });
            //         } else {
            //             next()
            //         }
            //     }, 1000)
            // },
            children:[
                {
                    path: '',
                    name: 'accountProfile',
                    component: Profile,
                },
                {
                    path: 'my-properties',
                    name: 'userProperties',
                    component: MyProperties
                },
                {
                    path: 'applications',
                    name: 'userApplications',
                    component: Applications
                },
                {
                    path: 'add-property',
                    name: 'addProperty',
                    component: AddProperty
                }
            ]
        },
        // {
        //     path: '/account',
        //     name: 'account',
        //     component: Account,
        //     beforeEnter(to, from, next) {
        //         setTimeout(() => {
        //             if (!store.getters["auth/authenticated"]) {
        //                 next({
        //                     name: "signIn"
        //                 });
        //             } if (!store.getters["auth/profileCompleted"]) {
        //                 next({
        //                     name: "completeRegister"
        //                 });
        //             } else {
        //                 next()
        //             }
        //         }, 1000)
        //     }
        // }
    ],
});

Vue.filter('capitalize', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

const app = new Vue({
    el: '#app',
    components: { App },
    store,
    router
});
