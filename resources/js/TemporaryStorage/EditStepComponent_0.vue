<template>
  <div>
       <h1>Edit STEP</h1>
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a step at the moment. If the problem persists, please contact edit a step.</p>
        </div>
       <form @submit.prevent="updateStep">
        <div class="c-form">
            <div v-for="cate in category" :key="cate.id">
                <div v-for="step in cate.steps" :key="step.id">
                    <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
                        
                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.title }">
                                <div class="c-form-data"><label for="title">Step Title: {{ step.title }}</label></div>
                                <div class="c-form-data"><input type="text" class="c-form-control" v-model="step.title"></div>
                                <span v-if="has_error && errors.title">{{ errors.title }}</span> 
                            </div>

                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.category }">
                                <div class="c-form-data"><label for="category">Step Category: {{ cate.name }}</label></div>
                                <div class="c-form-data"><button class="l-nav-item" v-if="$auth.check()">
                                    <router-link :to="{name: 'edit_category', params: { id: step.id }}" class="l-nav-link">Edit Category</router-link>
                                    
                                </button></div>
                                 <!--
                                <div  class="c-form-data" v-for="cate in category" :key="`third-${cate.id}`">
                                    <input type="radio" class="c-form-control" v-model="step.category" :value="cate.id">
                                        {{cate.name}}  
                                </div>
                                <span v-if="has_error && errors.category">{{ errors.category }}</span>
                            -->
                            </div>

                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.achievement_time }">
                                <div class="c-form-data"><label for="achievement_time">Achievement Time: {{ step.achievement_time }}</label></div>
                                <div class="c-form-data"><input type="text" class="c-form-control" v-model="step.achievement_time"></div>
                                <span v-if="has_error && errors.achievement_time">{{ errors.achievement_time }}</span>
                            </div>
           
                    </div>
                </div>
            </div>
        </div>
        <div class="c-form-group">
               <button type="submit">Update Step</button>
        </div>
       </form>
   </div>
</template>

<script>
    export default {
        data() {
           return {
               category_id:'',
               category:{},
               steps:{},
               step:{},
               kosteps:{},
               kostep:{},
               update: {},

               has_error: false,
                error: '',
                errors: {},
                success: false
           }
       },
       created() {
           const uri = `/steps/${this.$route.params.id}/edit`;
           this.axios.get(uri)
            .then((response) => {
                console.log('success', response.data);
                this.category = response.data;
            })
            .catch(error => {
                console.log('エラー', error);
            });
       },
       methods: {

           updateStep() {
               var app = this
               const uri = `/steps/${this.$route.params.id}/update`;
               //this.$set(this.update, 'category', this.##);///////////////////試す価値あり

                //var convert = Object.assign({},this.step)

                //this.axios.post(uri, this.step)
                /*
                this.axios.post(uri, {
                    key1: 'fuga',
                    key2: convert
                })
                */
               this.axios.post(uri, this.update)
               /*
               this.axios.post(uri, {
                   title: this.step.title,
                   category_id: this.cate.category_id,
                    achievement_time: this.step.achievement_time
                })
                */
               .then((response) => {
                   //console.log(this.update);
                   //console.log(this.params);
                   console.log(this.step);
                   console.log('success', response.data);
                   app.success = true
                   //location.href = '/steps';
               })
               .catch(error => {
                    console.log(this.step);
                    console.log('エラー', error);
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
                });
           }
        }
    }
</script>