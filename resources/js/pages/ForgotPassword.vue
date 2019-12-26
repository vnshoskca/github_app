<template>
  <div class="l-container">
      <h1>Reset Password</h1>
      <div>
        <!--passwordを忘れたことの通知-->
          <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
              <div class="c-form"> 
                <div class="c-form-group">
                    <div class="c-form-data"><label for="email">E-mail</label></div>
                    <div class="c-form-data"><input type="email" id="email" class="c-form-control" placeholder="user@example.com" v-model="email" required></div>
                </div>
              </div>
              <div class="c-form-group">
                  <button class="c-button" type="submit">Send Password Reset Link</button>
              </div>
          </form>
      </div>     
  </div>
</template>
<script>
export default {
    data() {
        return {
            email: null,
            has_error: false
        }
    },
    methods: {
        requestResetPassword() {
            this.$http.post("/auth/reset-password", {email: this.email}).then(result => {
                this.response = result.data;
                console.log(result.data);
                location.href = '/';
            }, error => {
                console.error(error);
            });
        }
    }
}
</script>