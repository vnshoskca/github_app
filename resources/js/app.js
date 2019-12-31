/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'

import Paginate from 'vuejs-paginate'
Vue.component('paginate', Paginate)

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter) // VueRouterプラグインを使用する これによって<RouterView />コンポーネントなどを使うことができる
// Set Vue authentication
Vue.use(VueAxios, axios)
//axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`
axios.defaults.baseURL = `${process.env.API_BASE_URL}/api/v1`;
//axios.defaults.baseURL = `${window.location.origin}/api/v1`;

Vue.use(VueAuth, auth)
// Load Index
Vue.component('index', Index) // ルートコンポーネントをインポートする
const app = new Vue({
  el: '#app',
  router
});