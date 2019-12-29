import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import ForgotPassword from './pages/ForgotPassword'
import ResetPasswordForm from './pages/ResetPasswordForm'
// Components
import UserComponent from './components/UserComponent.vue';
import UserImageComponent from './components/UserImageComponent.vue';
import IndexStepComponent from './components/IndexStepComponent.vue';
import MypageComponent from './components/MypageComponent.vue';
import MypageDetailStepComponent from './components/MypageDetailStepComponent.vue';
import MypageKoStepComponent from './components/MypageKoStepComponent.vue';
import CreateStepComponent from './components/CreateStepComponent.vue';
import EditStepComponent from './components/EditStepComponent.vue';
import EditCategoryComponent from './components/EditCategoryComponent.vue';
import DetailStepComponent from './components/DetailStepComponent.vue';
import KoStepComponent from './components/KoStepComponent.vue';
import AddKoStepComponent from './components/AddKoStepComponent.vue';
import EditKoStepComponent from './components/EditKoStepComponent.vue';

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  { 
    path: '/reset-password', 
    name: 'reset-password', 
    component: ForgotPassword, 
    meta: { 
      auth:false 
    } 
  },
  { 
    path: '/reset-password/:token', 
    name: 'reset-password-form', 
    component: ResetPasswordForm, 
    meta: { 
      auth:false 
    } 
  },
  // USER ROUTES
  {
    name: 'mypage',
    path: '/mypage',
    component: MypageComponent,
    meta: {
      auth: true
    }
  },
  {
    name: 'mypage_detail_step',
    path: '/mypage/:id/detail/',
    component: MypageDetailStepComponent,
    meta: {
      auth: true
    }
  },
  {
    name: 'mypage_ko_step',
    path: '/mypage/:id/ko_detail/:id2',
    component: MypageKoStepComponent,
    meta: {
      auth: true
    }
  },
    {
        name: 'edit_user',
        path: '/user/prof_edit',
        component: UserComponent
    },

    {
      name: 'edit_user_image',
      path: '/user/image_edit',
      component: UserImageComponent
    },
    
     {
        name: 'steps',
        path: '/steps',
        component: IndexStepComponent
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
      name: 'edit_category',
      path: '/steps/:id/edit_category',
      component: EditCategoryComponent
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
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router