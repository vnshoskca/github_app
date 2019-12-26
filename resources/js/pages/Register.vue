<template>
  <div class="l-container">
      <h1>Register</h1>
          <div>
              <!--error表示-->
              <div v-if="has_error && !success">
                  <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                  <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
              </div>
              <!--新規登録form-->
              <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                  <div class="c-form">
                      <!--名前入力なくても新規登録を可能にする
                      <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                          <label for="name">Name</label>
                          <input type="text" id="name" class="form-control" placeholder="Full Name" v-model="name">
                          <span v-if="has_error && errors.name">{{ errors.name }}</span>
                      </div>
                      -->
                      <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                          <div class="c-form-data"><label for="email">E-mail</label></div>
                          <div class="c-form-data"><input type="email" id="email" class="c-form-control" placeholder="user@example.com" v-model="email"></div>
                          <span v-if="has_error && errors.email">{{ errors.email }}</span>
                      </div>
                      <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                          <div class="c-form-data"><label for="password">Password</label></div>
                          <div class="c-form-data"><input type="password" id="password" class="c-form-control" v-model="password"></div>
                          <span v-if="has_error && errors.password">{{ errors.password }}</span>
                      </div>
                      <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                          <div class="c-form-data"><label for="password_confirmation">Password confirmation</label></div>
                          <div class="c-form-data"><input type="password" id="password_confirmation" class="c-form-control" v-model="password_confirmation"></div>
                      </div>
                  </div>
                  <div class="c-form-group">
                      <button class="c-button" type="submit">Register</button>
                  </div>
              </form>
          </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            has_error: false,
            error: '',
            errors: {},
            success: false
        }
    },
    methods: {
        register() {
            var app = this
            this.$auth.register({
                data: {
                    name: app.name,
                    email: app.email,
                    password: app.password,
                    password_confirmation: app.password_confirmation
                },
                success: function () {
                    app.success = true
                    location.href = '/login';
                },
                error: function (res) {
                    app.has_error = true
                    app.error = res.response.data.error
                    app.errors = res.response.data.errors || {}
                }
            })
        }
    }
}
</script>