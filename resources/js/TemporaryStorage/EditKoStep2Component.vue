<template>
  <div>
       <h1>Edit Ko STEP2</h1>
       <form @submit.prevent="updateKoStep()">
        <div>
        <div v-for="cate in category" :key="cate.id">
        <div v-for="step in cate.steps" :key="step.id">
        <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
           <div>
               <div>
                    <div class="c-form-group">
                       <label>Content: {{ kostep.content }}</label>
                       <input type="text" class="c-form-control" v-model="kostep.content">
                   </div>
                   <div class="c-form-group">
                       <label>Detail Content: {{ kostep.detail_content }}</label>
                       <input type="text" class="c-form-control" v-model="kostep.detail_content">
                   </div>
               </div>
           </div>         
           <div class="c-form-group">
               <button>Update Ko Step</button>
           </div>
        </div>
        </div>
        </div>
        </div>
       </form>
   </div>
</template>

<script>
    export default {
        data() {
           return {
               category_id:'',
               //category:{},
               //steps:{},
               //step:{},
               kosteps:{},
               kostep:{},
               update: {}
           }
       },
       created() {
           const uri = `/steps/${this.$route.params.id}/edit_ko_step/${this.$route.params.id2}`;
           this.axios.get(uri)
            .then((response) => {
                console.log('success', response.data);
                this.category = response.data;
                //console.log(this.category.name);
            })
            .catch(error => {
                console.log('エラー', error);
            });
       },
       methods: {
           updateKoStep() {
               console.log(this.kostep);
               const uri = `/steps/${this.$route.params.id}/update_ko_step/${this.$route.params.id2}`;
               this.axios.post(uri, this.kostep)
               .then((response) => {
                   console.log(this.kostep);
                   console.log('success', response.data);
                   location.href = `/steps/${this.$route.params.id}/detail`;
               })
               .catch(error => {
                console.log(this.kostep);         
                console.log('エラー', error);
            });
           }
        }
    }
</script>