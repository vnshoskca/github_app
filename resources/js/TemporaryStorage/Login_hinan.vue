<template>
  <div class="container--small">

    <ul class="tab">
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 1 }"
        @click="tab = 1"
      >Login</li>
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 2 }"
        @click="tab = 2"
      >Register</li>
    </ul>
    
    <div class="panel" v-show="tab === 1">
      <form class="form" @submit.prevent="login">
        <label for="login-email">Email</label>
        <input type="text" class="form__item" id="login-email" v-model="loginForm.email">
        <label for="login-password">Password</label>
        <input type="password" class="form__item" id="login-password" v-model="loginForm.password">
        <div class="form__button">
          <button type="submit" class="button button--inverse">login</button>
        </div>
      </form>
    </div>

    <div class="panel" v-show="tab === 2">
      <form class="form" @submit.prevent="register">
        <label for="username">Name</label>
        <input type="text" class="form__item" id="username" v-model="registerForm.name">
        <label for="email">Email</label>
        <input type="text" class="form__item" id="email" v-model="registerForm.email">
        <label for="password">Password</label>
        <input type="password" class="form__item" id="password" v-model="registerForm.password">
        <label for="password-confirmation">Password (confirm)</label>
        <input type="password" class="form__item" id="password-confirmation" v-model="registerForm.password_confirmation">
        <div class="form__button">
          <button type="submit" class="button button--inverse">register</button>
        </div>
      </form>
    </div>

<!--
    <button class="button button--link" @click="password_reset">
      Password_Re
    </button>
    -->

    <RouterLink class="button button--link" to="/password/reset">
      Password_Re
    </RouterLink>

  </div>
</template>

<script>
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter) // VueRouterプラグインを使用する これによって<RouterView />コンポーネントなどを使うことができる
import VueAxios from 'vue-axios';

export default {
  data(){
    return {
      tab: 1,
      loginForm: {
        //params: {}
      },
      registerForm: {
      },
    }
  },
  methods: {
    login(){
      console.log(this.loginForm);
      const url = '/api/login';

        //remember: this.remember
        //this.errors = {};
        //var self = this;

      //const self = this;
      this.axios.post(url, this.loginForm)
        //.then(function(response){
          .then((response) => {
            // ログイン成功
            console.log('success', response.data);
            //this.$router.push('/');
            location.href = '/steps';
        })
        //.catch(function(error){
          .catch(e => {
            // ログイン失敗
            console.log('エラー', e.response.data.errors);
            /*
            var responseErrors = error.response.data.errors;
            var errors = {};

            for(var key in responseErrors) {
              errors[key] = responseErrors[key][0];
            }
            self.errors = errors;
            */
        });
    },  
   
    register(){
      console.log(this.registerForm)
      const url = '/api/register';

      //const self = this;
      this.axios.post(url, this.registerForm)
        //.then(function(response){
          .then((response) => {
            // ログイン成功
            console.log('成功', response.data);
            //this.$router.push('/');
            location.href = '/steps';
        })
        //.catch(function(error){
          .catch(e => {
            // ログイン失敗
            console.log('エラー', e.response.data.errors);
            /*
            var responseErrors = error.response.data.errors;
            var errors = {};

            for(var key in responseErrors) {
              errors[key] = responseErrors[key][0];
            }
            self.errors = errors;
            */
        });
    }

    

  }
}
</script>