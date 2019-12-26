<template>
  <div>
       <h1>Edit Category</h1>
       <!--error表示-->
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a step at the moment. If the problem persists, please contact edit a step.</p>
        </div>
        <!--categoryの編集-->
       <form @submit.prevent="updateCategory">
        <div class="c-form">
            <div v-for="cate in category" :key="cate.id">
                 <div v-for="step in cate.steps" :key="step.id">
                   <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
                        <!--step編集画面に戻る-->
                       <div>
                            <button class="l-nav-item c-button" v-if="$auth.check()">
                                <router-link :to="{name: 'edit_step', params: { id: step.id }}" class="l-nav-link">Return EditStep</router-link>
                            </button>
                        </div>
                            <!--category編集のラジオボタン-->
                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.category_id }">
                                <div class="c-form-data"><label for="category_id">Step Category: {{ cate.name }}</label></div>
                                <div class="c-form-data" v-for="cate in category" :key="`third-${cate.id}`">
                                    <input type="radio" class="c-form-control" v-model="steps.category_id" :value="cate.id">
                                        {{cate.name}}
                                </div>
                                <span v-if="has_error && errors.category_id">{{ errors.category_id }}</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-form-group">
               <button class="c-button" type="submit">Update Category</button>
        </div>
       </form>

   </div>
</template>

<script>
    export default {
        data() {
           return {
               category:{},
               steps:{},
               has_error: false,
                error: '',
                errors: {},
                success: false
           }
       },
       created() {
           const uri = `/steps/${this.$route.params.id}/edit_category`;
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
           updateCategory() {//categoryの編集
               var app = this
                console.log(this.steps);
             const uri = `/steps/${this.$route.params.id}/update_category`;
                this.axios.post(uri, this.steps)
               .then((response) => {
                   console.log('success', response.data);
                   app.success = true
                   location.href = `/steps/${this.$route.params.id}/edit`;
               })
               .catch(error => {
                    console.log('エラー', error);
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
                });
           }
        }
    }
</script>