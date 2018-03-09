
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router'
import router from  './router'
import store from  './store/index'
import App from './components/App'
import jwtToken from './helpers/jwt'
import zh_CN from 'vee-validate/dist/locale/zh_CN';
import VeeValidate, { Validator } from 'vee-validate';

// Localize takes the locale object as the second argument (optional) and merges it.
Validator.localize('ar', zh_CN);


// Install the Plugin.

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'


window.Vue = require('vue');
Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.component('app', App)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.interceptors.request.use(function (config) {
    if(jwtToken.getToken()){
        config.headers['Authorization'] = 'Bearer' +' '+ jwtToken.getToken(); //负责jwt验证
    }
    return config;
},function (error) {
    return Promise.reject(error )
})

new Vue({
    el: '#app',
    router, //路由
    store  //vuex状态管理
});
