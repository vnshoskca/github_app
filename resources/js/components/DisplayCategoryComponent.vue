<template>
  <div>
        <!--edit_categoryへのリンクを作るための処理-->
            <div v-for="cate in category" :key="cate.id">
                <div v-for="step in cate.steps" :key="step.id">
                    <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
                            <div class="c-form-group">
                                <div class="c-form-data"><label for="category">Step Category: {{ cate.name }}</label></div>
                                <div class="c-form-data"><button class="l-nav-item c-button" v-if="$auth.check()">
                                    <router-link :to="{name: 'edit_category', params: { id: step.id }}" class="l-nav-link">Edit Category</router-link>
                                </button></div>
                            </div>
                    </div>
                </div>
            </div>
   </div>
</template>

<script>
    export default {
        data() {
           return {
               category:{}
           }
       },
       created() {
           const uri = `/steps/${this.$route.params.id}/detail`;
           this.axios.get(uri)
            .then((response) => {
                console.log('success', response.data);
                this.category = response.data;
            })
            .catch(error => {
                console.log('エラー', error);
            });
       }
    }
</script>