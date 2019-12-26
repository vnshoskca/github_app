<template>
  <div class="container--small">

    <div class="panel">
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

    <div>
       <h1>Signup</h1>
       <form @submit.prevent="signup">
          <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Name:</label>
                       <input type="text" class="form-control" v-model="signup.name">
                   </div>
                   <div class="form-group">
                       <label>Email:</label>
                       <input type="date" class="form-control" v-model="signup.email">
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
                   <div class="form-group">
                       <label>Password:</label>
                       <textarea class="form-control" v-model="signup.password" rows="5"></textarea>
                   </div>
               </div>
           </div>
           <div class="form-group">
               <button class="btn btn-primary">Submit</button>
           </div>
       </form>
   </div>



  </div>
</template>

<script>
export default {
  data () {
    return {
      signup: {}
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
    }
  },
  methods: {  
    register () {
      console.log(this.registerForm)
    },
    signup (){
      console.log(this.signup);
      const uri = '/signup';
      this.axios.post(uri, this.signup).then((response) => {
        this.$router.push({name: 'signup'});
      });
    }
  }
}
       
    


</script>

