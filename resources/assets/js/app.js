
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router'
import router from  './router'
import App from './components/App'

import zh_CN from 'vee-validate/dist/locale/zh_CN';
import VeeValidate, { Validator } from 'vee-validate';

// Localize takes the locale object as the second argument (optional) and merges it.
Validator.localize('ar', zh_CN);

// Install the Plugin.


window.Vue = require('vue');
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.component('app', App)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/pages/Home.vue'));

const app = new Vue({
    el: '#app',
    router
});
