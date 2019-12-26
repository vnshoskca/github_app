<template>
  <div>
       <h1>Edit User</h1>
       <!--error表示-->
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a userdata at the moment. If the problem persists, please contact edit a userdata.</p>
        </div>
       <!--userの編集-->
       <form action="" method="post" @submit.prevent="updateUser" enctype="multipart/form-data">
           <div class="c-form">
               <div>
                   <div class="c-form-group">
                       <div class="c-form-data"><label>User Name</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="user.name"></div>
                    </div>

                    <div class="c-form-group">
                        <div class="c-form-data"><img :src="user.image"></div>
                        <div class="c-form-data"><button class="l-nav-item c-button" v-if="$auth.check()">
                            <router-link to="/user/image_edit" class="l-nav-link">EditUserImage</router-link>
                        </button></div>
                    </div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                       <div class="c-form-data"><label for="email">User Email</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="user.email"></div>
                       <span v-if="has_error && errors.email">{{ errors.email }}</span>
                   </div>

                   <div class="c-form-group">
                       <div class="c-form-data"><label>User Introduction</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="user.introduction"></div>
                   </div>
               </div>
           </div>

           <div class="c-form-group">
               <button class="c-button">Update User</button>
           </div>
       </form>
   </div>
</template>

<script>
    export default {
        data() {
           return {
                user: {},
                has_error: false,
                error: '',
                errors: {},
                success: false
           }
       },
       created() {
           const uri = `/user/prof_edit`;
           this.axios.get(uri)
           .then((response) => {
               console.log('success', response.data);
              this.user = response.data;
           })
           .catch(error => {
                console.log('エラー', error);
            });
       },
       methods: {    
           updateUser() {
               var app = this
               const uri = `/user`;
               console.log(this.user);
               this.axios.post(uri, this.user)
               .then((response) => {
                    console.log('success', response.data);
                    app.success = true
                    this.user = response.data;
                    location.href = '/mypage';
               }).catch(error => {
                    console.log('エラー', error)
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
               });
           }
        }
    }
</script>