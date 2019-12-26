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
//Vue.component('paginate', VuejsPaginate)

//import VuePaginate from 'vue-paginate';
//Vue.use(VuePaginate);

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter) // VueRouterプラグインを使用する これによって<RouterView />コンポーネントなどを使うことができる
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`
Vue.use(VueAuth, auth)
// Load Index
Vue.component('index', Index) // ルートコンポーネントをインポートする
const app = new Vue({
  el: '#app',
  router
});


/*
require('./bootstrap');
window.Vue = require('vue');

/////
import './bootstrap';
import Index from './Index';
// Set Vue globally
window.Vue = Vue;
/////

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter) // VueRouterプラグインを使用する これによって<RouterView />コンポーネントなどを使うことができる

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);
//import vSelect from 'vue-select';
// ルートコンポーネントをインポートする
import App from './App.vue'
// ページコンポーネントをインポートする
import Login from './pages/Login.vue';
import PasswordReset from './pages/PasswordReset.vue'
import HomeComponent from './components/HomeComponent.vue';
import UserComponent from './components/UserComponent.vue';
import IndexStepComponent from './components/IndexStepComponent.vue';
import MypageComponent from './components/MypageComponent.vue';
import CreateStepComponent from './components/CreateStepComponent.vue';
import EditStepComponent from './components/EditStepComponent.vue';
import DetailStepComponent from './components/DetailStepComponent.vue';
import KoStepComponent from './components/KoStepComponent.vue';
import AddKoStepComponent from './components/AddKoStepComponent.vue';
import EditKoStepComponent from './components/EditKoStepComponent.vue';

// Load Index
Vue.component('index', Index)

*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// パスとコンポーネントのマッピング
  //const routes = [
      /*
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
    {
        name: 'login',
        path: '/login',
        component: Login
      },
      
      {
        name: 'password_reset',
        path: '/password/reset',
        component: PasswordReset
      },
      */
     /*
    {
        name: 'edit_user',
        path: '/auth/prof_edit',
        component: UserComponent
    },
     
     {
        name: 'steps',
        path: '/steps',
        component: IndexStepComponent
    },
    {
        name: 'mypage',
        path: '/mypage',
        component: MypageComponent
    },
     {
        name: 'create_step',
        path: '/step/create',
        component: CreateStepComponent
    },
    {
        name: 'edit_step',
        path: '/steps/:id/edit',
        component: EditStepComponent
    },
    {
        name: 'detail_step',
        path: '/steps/:id/detail/',
        component: DetailStepComponent
    },
    {
        name: 'ko_detail_step',
        path: '/steps/:id/ko_detail/:id2',
        component: KoStepComponent
    },
    {
        name: 'ko_detail_create_step',
        path: '/steps/:id/ko_detail_create',
        component: AddKoStepComponent    
    },
    {
        name: 'edit_ko_step',
        path: '/steps/:id/edit_ko_step/:id2',
        component: EditKoStepComponent
    }     
  ];
  
// VueRouterインスタンスを作成する

//const router = new VueRouter({ mode: 'history'});
const router = new VueRouter({ mode: 'history', routes: routes});
//const app = new Vue(Vue.util.extend({ router })).$mount('#app');
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
*/