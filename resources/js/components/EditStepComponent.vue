<template>
  <div>
       <h1>Edit STEP</h1>
       <!--error表示-->
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a step at the moment. If the problem persists, please contact edit a step.</p>
        </div>
        <!--stepの編集-->
       <form @submit.prevent="updateStep">
        <div class="c-form">
            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.title }">
                <div class="c-form-data"><label for="title">Step Title: {{ step.title }}</label></div>
                <div class="c-form-data"><input type="text" class="c-form-control" v-model="step.title"></div>
                    <span v-if="has_error && errors.title">{{ errors.title }}</span> 
            </div>
            <DisplayCategory /><!--category編集の表示-->
            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.achievement_time }">
                <div class="c-form-data"><label for="achievement_time">Achievement Time: {{ step.achievement_time }}</label></div>
                <div class="c-form-data"><input type="text" class="c-form-control" v-model="step.achievement_time"></div>
                    <span v-if="has_error && errors.achievement_time">{{ errors.achievement_time }}</span>
            </div>
        </div>
        <div class="c-form-group">
               <button class="c-button" type="submit">Update Step</button>
        </div>
       </form>
   </div>
</template>

<script>
import DisplayCategory from './DisplayCategoryComponent.vue'

    export default {
        components: {
            DisplayCategory
        },
        data() {
           return {
                step:{},
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
                this.step = response.data;
            })
            .catch(error => {
                console.log('エラー', error);
            });
       },
       methods: {
            updateStep: function() {
                var app = this
                console.log(this.step);
                const uri = `/steps/${this.$route.params.id}/update`;
                this.axios.post(uri, this.step)
                .then((response) => {
                    console.log('success', response.data);
                    app.success = true
                    location.href = `/mypage/${this.$route.params.id}/detail`;
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