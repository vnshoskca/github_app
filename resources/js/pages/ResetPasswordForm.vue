<template>
  <div class="l-container">
      <h1>New Password</h1>
      <div>
          <!--error表示-->
          <div v-if="has_error && !success">
              <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
              <p v-else>Error, can not edit a userdata at the moment. If the problem persists, please contact edit a userdata.</p>
          </div>
          <!--passwordの再発行-->
          <form autocomplete="off" @submit.prevent="resetPassword" method="post">
              <div class="c-form">
                  <div class="c-form-group">
                      <div class="c-form-data"><label for="email">E-mail</label></div>
                      <div class="c-form-data"><input type="email" id="email" class="c-form-control" placeholder="user@example.com" v-model="email" required></div>
                  </div>
                  <div class="c-form-group">
                      <div class="c-form-data"><label for="password">Password</label></div>
                      <div class="c-form-data"><input type="password" id="password" class="c-form-control" placeholder="" v-model="password" required></div>
                  </div>
                  <div class="c-form-group">
                      <div class="c-form-data"><label for="password_confirmation">Confirm Password</label></div>
                      <div class="c-form-data"><input type="password" id="password_confirmation" class="c-form-control" placeholder="" v-model="password_confirmation" required></div>
                  </div>
              </div>
              <div class="c-form-group">
                  <button class="c-button" type="submit">Update Password</button>
              </div>
          </form>
      </div>      
  </div>
</template>
<script>
export default {
    data() {
        return {
            token: null,
            email: null,
            password: null,
            password_confirmation: null,
            has_error: false,
            error: '',
            errors: {},
            success: false
        }
    },
    methods: {
        resetPassword() {
            this.$http.post("/auth/reset/password/", {
                token: this.$route.params.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(result => {
                console.log(result.data);
                this.$router.push({name: 'login'})
            }, error => {
                console.error(error);
            });
        }
    }
}
</script>