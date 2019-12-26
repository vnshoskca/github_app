<template>
  <div>
       
           <div>
                    
                   <div class="c-form-group">
                       <label>User Image3:             
                       <!--<img :src="$emit(user.image)">-->
                       <!--<input type="file" ref="file" class="form-control" accept="image/*" @change="onFileChange($event)">-->
                       <!--<input type="file" ref="file" class="form-control" accept="image/*" @change="$emit('update:onFileChange', $event.target.value)" />-->
                       
                       <!--<input type="file" ref="file" class="form-control" accept="image/*" 
                            @change="$emit('update:onFileChange', $event.target.value)"
                        />-->
                        <input type="file" 
                                ref="file" 
                                class="form-control" 
                                accept="image/*"
                                v-model="value"
                                
                                @change="onFileChange"
                        />
                       <!--<input type="file" ref="file" class="form-control" accept="image/*" @change="onFileChange($event.target.value)" />-->
                       <img :src="imageData" v-if="imageData">
                       <button v-if="imageData" @click="resetFile()">リセット</button>
                       </label>        
                   </div>
                   
           </div>
           
   </div>
</template>

<script>
    export default {
        data() {
           return {
               //user: {},
               //value: {},
               imageData: ''
               //fileInfo: ''
           }
       },
       /*
       model: {
           prop: 'checked',
           event: 'input'
       },
       */
       props: {
           user: {},
            //imageData: ''
            fileInfo: '',
            value: {},
            //checked: {},
            label: { type: String },
            name: { type: String, require: true }
       },
       /*
       created() {//あとで消す？
           const uri = `/user/image_edit`;
           this.axios.get(uri).then((response) => {
              this.user = response.data;
           });
       },
       */
       methods: {
           /*
           updateValue (e) {
               //console.log(e);
               //this.$emit('change', e);
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
                //this.$emit('input', e.target.value)
                //this.$emit('change', e.target.value)
            },
*/
           onFileChange(e){
               //console.log(e);
               //this.$emit('change', e);
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
                //console.log(e.target.value);
                //this.$emit('input', this.fileInfo);
                this.$emit('checked', this.fileInfo);        
           },
           resetFile() {
                const input = this.$refs.file;
                input.type = 'text';
                input.type = 'file';
                this.imageData = '';
            }
            /*
           updateImage() {
               const uri = `/user/image_update`;

               const formData = new FormData();
                formData.append('file',this.fileInfo);

                console.log(formData);
               this.axios.post(uri, formData)
               .then((response) => {
                   console.log('success', response.data);
                    //this.user = response.data;
               //this.$router.push({name: 'steps'});
               //location.href = '/steps';
               }).catch(error => {
                    console.log('エラー', error)
               });
           }*/
        }
    }
</script>