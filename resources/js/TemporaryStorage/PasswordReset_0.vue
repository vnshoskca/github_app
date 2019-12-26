<template>
  <div class="container--small">

    
    
    <div class="panel">
      <form class="form" @submit.prevent="password_reset">
        <label for="password_reset">Email</label>
        <input type="text" class="form__item" id="password_reset" v-model="passwordReset.email">

        <div class="form__button">
          <button type="submit" class="button button--inverse">Send Password Reset Link</button>
        </div>
      </form>
    </div>

    

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
      passwordReset: {
      }
    }
  },
  methods: {
    password_reset(){
      console.log(this.passwordReset);
      const uri = '/password/email';
      this.axios.post(uri, this.passwordReset)
      .then((response) => {
        console.log(response);
        //location.href = '/steps';
      })
      .catch(error => {
        console.log('エラー', error)
      });
    }
  }
}
</script>