<template>
  <div>
       <h1>Edit User</h1>
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a userdata at the moment. If the problem persists, please contact edit a userdata.</p>
        </div>
       {{user}}
       {{user.name}}
       {{user.email}}
       <form action="" method="post" @submit.prevent="updateUser" enctype="multipart/form-data">
           <div>
               <div>

                   <div class="c-form-group">
                       <label>User Name:</label>
                       <input type="text" class="c-form-control" v-model="user.name">
                        <img :src="user.image">
                        <button class="l-nav-item" v-if="$auth.check()">
                            <router-link to="/user/image_edit" class="l-nav-link">EditUserImage</router-link>
                        </button>
                    </div>
   
                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                       <label for="email">User Email:</label>
                       <input type="text" class="c-form-control" v-model="user.email">
                       <span v-if="has_error && errors.email">{{ errors.email }}</span>
                   </div>
                   <div class="c-form-group">
                       <label>User Introduction:</label>
                       <input type="text" class="c-form-control" v-model="user.introduction">
                   </div>

               </div>
           </div>
           
           <div class="c-form-group">
               <button>Update User</button>
           </div>
       </form>
   </div>
</template>

<script>
    export default {
        data() {
           return {
               user: {},
               imageData: '',
               fileInfo: '',
               has_error: false,
                error: '',
                errors: {},
                success: false,
               form: {
                   input: 'test',
                   image: ''
                }
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
           /*
           onFileChange(e){
               
               console.log(e);
                this.fileInfo = e.target.files[0];
                console.log(this.fileInfo);

               const files = e.target.files;
                if(files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    console.log(file);
                }    
                
                //this.$emit();
           },
           resetFile() {
                const input = this.$refs.file;
                input.type = 'text';
                input.type = 'file';
                this.imageData = '';
            },
            */
           updateUser() {
               var app = this
               const uri = `/user`;
               //this.$set(this.user, 'file', this.fileInfo);
               //this.$set(this.user, 'image', this.fileInfo);
               //this.user.append('file',this.fileInfo);
               //console.log(this.fileInfo);
               console.log(this.user);
               this.axios.post(uri, this.user)
               .then((response) => {
                   console.log('success', response.data);
                   app.success = true
                    this.user = response.data;
               //this.$router.push({name: 'steps'});
               //location.href = '/steps';
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