<template>
  <div>
        <h1>Edit Ko STEP</h1>
        <!--error表示-->
        <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a kostep at the moment. If the problem persists, please contact edit a kostep.</p>
        </div>
        <!--kostepの編集-->
        <form action="" method="post" @submit.prevent="updateKoStep">
            <div class="c-form">    
                    <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.content }">
                       <div class="c-form-data"><label for="content">Content: {{ kosteps.content }}</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="kosteps.content"></div>
                       <span v-if="has_error && errors.content">{{ errors.content }}</span>
                   </div>
                   <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.detail_content }">
                       <div class="c-form-data"><label for="detail_content">Detail Content: {{ kosteps.detail_content }}</label></div>
                       <div class="c-form-data"><input type="text" class="c-form-control" v-model="kosteps.detail_content"></div>
                       <span v-if="has_error && errors.detail_content">{{ errors.detail_content }}</span>
                   </div>     
            </div>
            <div class="c-form-group">
                <button class="c-button">Update Ko Step</button>
            </div>
        </form>
       
   </div>
</template>

<script>
    export default {   
        data() {
            return {
                kosteps: {},
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },
        created() {
            const uri = `/steps/${this.$route.params.id}/edit_ko_step/${this.$route.params.id2}`;
            this.axios.get(uri)
            .then((response) => {
                console.log('success', response.data);
                this.kosteps = response.data;
            })
            .catch(error => {
                console.log('エラー', error);
            });
        },
        methods: {
            updateKoStep() {//kostepの編集
                var app = this
                const uri = `/steps/${this.$route.params.id}/update_ko_step/${this.$route.params.id2}`;
                console.log(this.kosteps);
                this.axios.post(uri, this.kosteps)
                .then((response) => {
                    console.log('success', response.data);
                    app.success = true
                    this.kosteps = response.data;
                    location.href = `/mypage/${this.$route.params.id}/ko_detail/${this.$route.params.id2}`;
                })
                .catch(error => {
                    console.log(this.kosteps);         
                    console.log('エラー', error);
                    app.has_error = true
                    app.error = error.response.data.error
                    app.errors = error.response.data.errors || {}
                });
            }
        }
    }
</script>