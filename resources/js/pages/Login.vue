<template>
  <div class="l-container">
      <h1>Login</h1>
      <div>
          <!--error表示-->
          <div v-if="has_error && !success">
              <p v-if="error == 'login_error'">Validation Errors.</p>
              <p v-else>Error, unable to connect with these credentials.</p>
          </div>
          <!--loginform-->
          <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="c-form"> 
                  <div class="c-form-group">
                    <div class="c-form-data"><label for="email">E-mail</label></div>
                    <div class="c-form-data"><input type="email" id="email" class="c-form-control" placeholder="user@example.com" v-model="email" required></div>
                  </div>
                  <div class="c-form-group">
                    <div class="c-form-data"><label for="password">Password</label></div>
                    <div class="c-form-data"><input type="password" id="password" class="c-form-control" v-model="password" required></div>
                  </div>
              </div>
              <div class="c-form-group">
                  <button class="c-button" type="submit">Login</button>
              </div>
          </form>
      </div>
      <div>
        <router-link :to="{ name : 'reset-password' }" class="l-nav-link l-forgot-password">
            Forgot Password!
        </router-link>
      </div>  
  </div>
</template>

<script>
export default {
    data() {
        return {
          email: null,
          password: null,
          success: false,
          has_error: false,
          error: ''
        }
    },
    methods: {
        login() {
            var redirect = this.$auth.redirect()
            var app = this
            this.$auth.login({
                data: {
                    email: app.email,
                    password: app.password
                },
                success: function() {
                    app.success = true
                    location.href = '/mypage';
                },
                error: function(res) {
                    app.has_error = true
                    app.error = res.response.data.error
                },
                rememberMe: true,
                fetchUser: true
            })
        }
    }
}
</script>