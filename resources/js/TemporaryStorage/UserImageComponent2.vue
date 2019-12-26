<template>
  <div>
       
           <div>
                    
                   <div class="c-form-group">

                       <label>Test:
                            <span v-if="$slots.label"><slot name="label"></slot></span>
                            <span v-else-if="label">{{ label }}</span>
                            <input :type="type"
                                :name="name"
                                :placeholder="placeholder"
                                :value="value"
                                @input="updateValue"
                                @focus="$emit('focus', $event)"
                                @blur="$emit('blur', $event)"
                            >
                        </label><br>

                       <label>User Image2:
                       
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
                                :value="value2"
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
               imageData: '',
               fileInfo: ''
           }
       },
       props: {
           user: {},
            //imageData: ''
            //fileInfo: ''
            value: {},
            value2: {},
            label: { type: String },
            name: { type: String, require: true },
            type: { type: String, default: 'text' },
            placeholder: { type: String }
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
           updateValue (e) {
                this.$emit('input', e.target.value)
                this.$emit('change', e.target.value)
            },

           onFileChange(e){//: function(e){
               //console.log(e);
               //this.$emit('change', e);
               this.$emit('change', e.target.value)
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
           },
           resetFile() {
                const input = this.$refs.file;
                input.type = 'text';
                input.type = 'file';
                this.imageData = '';
            }
        }
    }
</script>