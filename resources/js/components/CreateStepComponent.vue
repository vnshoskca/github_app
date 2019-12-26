<template>
  
    <div>
       <h1>Create a Step</h1>
        <!--error表示-->
        <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not create a step at the moment. If the problem persists, please contact create a step.</p>
        </div>

       <form @submit.prevent="addStep"><!--step登録-->
           <div class="c-form">
               <div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.title }">
                       <div class="c-form-data"><label for="title">Step Title</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="news.title"></div>
                       <span v-if="has_error && errors.title">{{ errors.title }}</span>
                   </div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.category }">
                       <div class="c-form-data"><label for="category">Step Category</label></div>
                       <div class="c-form-data" v-for="cate in category" :key="cate.id">
                            <input type="radio" class="c-form-control" v-model="news.category" :value="cate.id">
                            {{cate.name}}  
                       </div>
                       <span v-if="has_error && errors.category">{{ errors.category }}</span>
                   </div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.achievement_time }">
                       <div class="c-form-data"><label for="achievement_time">Achievement Time</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="news.achievement_time"></div>
                       <span v-if="has_error && errors.achievement_time">{{ errors.achievement_time }}</span>
                   </div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.content }">
                       <div class="c-form-data"><label for="content">Content</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="news.content"></div>
                       <span v-if="has_error && errors.content">{{ errors.content }}</span>
                   </div>

                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.detail_content }">
                       <div class="c-form-data"><label for="detail_content">Detail</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="news.detail_content"></div>
                       <span v-if="has_error && errors.detail_content">{{ errors.detail_content }}</span>
                   </div>
               </div>
           </div>

           <div class="c-form-group">
               <button class="c-button">Create a Step</button>
           </div>
       </form>
   </div>

</template>

<script>
    export default {
        data(){
            return {
                category:{},
                news:{},
                has_error: false,//以下、バリデーション用
                error: '',
                errors: {},
                success: false
            }
        },
        created() {//新規登録画面表示
            const uri = '/step/new';
            this.axios.get(uri)
            .then(response => {
                console.log('success', response.data);
                this.category = response.data;
            })
            .catch(error => {
                console.log('エラー', error)
            });
        },       
        methods: {
            addStep(){//step新規登録
                var app = this
                console.log(this.news);
                const uri = '/step/create';
                this.axios.post(uri, this.news)
                .then((response) => {
                    console.log('success', response.data);
                    app.success = true
                    location.href = '/steps';
                })
                .catch(error => {
                    console.log('エラー', error)
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
                });
            }
        }
    }
</script>