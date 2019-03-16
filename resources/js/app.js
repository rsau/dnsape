
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const DNS = Vue.component('dns-response', require('./components/DNSResponse.vue'));

const router = new VueRouter({
    mode: 'history',
    routes: [{ 
        path: '/:query/:host',
        name: 'dns',
        component: DNS.default
    }]
});

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    router
});

