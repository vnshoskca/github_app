/*
import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import StepList from './pages/StepList.vue'
import Login from './pages/Login.vue'
import store from './store' // ★　追加
import SystemError from './pages/errors/System.vue'
import StepDetail from './pages/StepDetail.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: StepList
  },
  /*
  {
    path: '/photos/:id',
    component: PhotoDetail,
    props: true
  },
  */
  /*
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history', // ★ 追加
    routes
  })
  
  // VueRouterインスタンスをエクスポートする
  // app.jsでインポートするため
  export default router

  */