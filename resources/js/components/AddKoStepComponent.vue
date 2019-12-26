<template>
  <div>
       <h1>Add Ko STEP</h1>
       <!--error表示-->
       <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not create a kostep at the moment. If the problem persists, please contact create a kostep.</p>
        </div>
        <!--kostep登録-->
       <form @submit.prevent="addKoStep">
        <div class="c-form">
            <div v-for="cate in category" :key="cate.id">
                <div v-for="step in cate.steps" :key="step.id">
                    <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
                        <div>
                            <div class="c-form-group">
                                <div class="c-form-data"><label>Step Title: {{ step.title }}</label></div>
                            </div>

                            <div class="c-form-group">
                                <div class="c-form-data"><label>Step Category: {{ cate.name }}</label></div>
                            </div>

                            <div class="c-form-group">
                                <div class="c-form-data"><label>Achievement Time: {{ step.achievement_time }}</label></div>
                            </div>

                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.content }">
                                <div class="c-form-data"><label for="content">Content</label></div>
                                <div class="c-form-data"><input type="text" class="c-form-control" v-model="add.content"></div>
                                <span v-if="has_error && errors.content">{{ errors.content }}</span>
                            </div>
                            
                            <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.detail_content }">
                                <div class="c-form-data"><label for="detail_content">Detail Content</label></div>
                                <div class="c-form-data"><input type="text" class="c-form-control" v-model="add.detail_content"></div>
                                <span v-if="has_error && errors.detail_content">{{ errors.detail_content }}</span>
                            </div>           
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="c-form-group">
            <button class="c-button">Add Ko Step</button>
        </div>
       </form>
   </div>
</template>

<script>
    export default {
        data() {
           return {
               category:{},
               add:{},
               has_error: false,//以下、バリデーション用
                error: '',
                errors: {},
                success: false
           }
        },
        created() {//新規登録画面表示
            const uri = `/steps/${this.$route.params.id}/ko_detail_new`;
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
            addKoStep() {//kostep新規登録
                var app = this
                const uri = `/steps/${this.$route.params.id}/ko_detail_create`;
                this.axios.post(uri, this.add
                )
                .then((response) => {
                    console.log(this.add);
                    console.log('success', response.data);
                    app.success = true
                    location.href = `/mypage/${this.$route.params.id}/detail`;
                })
                .catch(error => {
                    console.log(this.add);
                    console.log('エラー', error);
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
                });
            }
        }
    }
</script>