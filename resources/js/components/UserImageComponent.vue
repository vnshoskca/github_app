<template>
  <div>
       <h1>Edit UserImage</h1>
        <!--user編集画面に戻る-->
        <div class="c-form-group">
            <button class="l-nav-item c-button" v-if="$auth.check()">
                <router-link to="/user/prof_edit" class="l-nav-link">Return EditUser</router-link>
            </button>
        </div>
        <!--error表示-->
        <div v-if="has_error && !success">
            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
            <p v-else>Error, can not edit a kostep at the moment. If the problem persists, please contact edit a kostep.</p>
        </div>
        <!--userimageの編集-->
       <form action="" method="post" @submit.prevent="updateImage" enctype="multipart/form-data">
           <div class="c-form">        
                <div class="c-form-group" v-bind:class="{ 'has-error': has_error && errors.image }">
                    <div class="c-form-data"><label for="image">User Image</label></div>
                    <div class="c-form-data"><img :src="user.image"></div>
                    <div class="c-form-data"><input type="file" ref="file" class="c-form-control" accept="image/*" @change="onFileChange($event)"></div>
                    <span v-if="has_error && errors.image">{{ errors.image }}</span>
                </div>    
                <div class="c-form-group" v-if="imageData">
                    <div class="c-form-data"><label>Selected Image</label></div>
                    <div class="c-form-data"><img :src="imageData" v-if="imageData"></div>
                    <div class="c-form-data"><button class="c-button" v-if="imageData" @click="resetFile()">Reset Image</button></div>
                </div>
           </div>
           <div class="c-form-group">
               <button class="c-button">Update UserImage</button>
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
                success: false
           }
        },
        created() {
            const uri = `/user/image_edit`;
            this.axios.get(uri).then((response) => {
                this.user = response.data;
            });
        },
        methods: {
            onFileChange(e) {//imageが選択されたら表示する
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
            resetFile() {//resetボタンを押したら画像を表示にする
                const input = this.$refs.file;
                input.type = 'text';
                input.type = 'file';
                this.imageData = '';
            },
            updateImage() {//userimageの更新
                const uri = `/user/image_update`;
                const formData = new FormData();
                formData.append('file',this.fileInfo);
                console.log(formData);
                this.axios.post(uri, formData)
                .then((response) => {
                    console.log('success', response.data);
                    location.href = '/user/prof_edit';
                }).catch(error => {
                    console.log('エラー', error)
                });
            }
        }
    }
</script>