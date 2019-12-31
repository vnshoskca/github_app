<template>
  <div>
      <h1>Steps</h1>
        <!--step一覧-->
      <div class="c-table c-table-hover">
           <div class="c-thead">
               <div>
                    <div class="c-tr">
                        <div class="c-th">Title</div>
                        <div class="c-th">Category</div>
                        <div class="c-th">Achievement Time</div>
                        <div class="c-th">To Detail</div>
                    </div>
                </div>
           </div>
            <div class="c-tbody">
                <div v-for="cate in category" :key="cate.id">
                    <div v-for="step in cate.steps" :key="step.id" class="c-tr">
                        <div class="c-td"><span class="sp">title:</span> {{ step.title }} </div>
                        <div class="c-td"><span class="sp">category:</span> {{ cate.name }} </div>
                        <div class="c-td"><span class="sp">achievement time:</span> {{ step.achievement_time }} </div>
                        <div class="c-td"><span class="sp">to detail:</span><router-link :to="{name: 'detail_step', params: { id: step.id }}" class="l-nav-link">Detail STEP</router-link></div>                        
                    </div>   
                </div>    
            </div>
       </div>      
   </div> 
</template>

<script>
import ChallengeButton from './ChallengeButtonComponent.vue'

    export default {
        components: {
            ChallengeButton
        },
        data() {
           return {
               category:{}
           }
       },
       created() {
           const uri = '/steps';
           this.axios.get(uri)
           .then(response => {
               //console.log('success', response.data);
               this.category = response.data;
           })
            .catch(error => {
                console.log('エラー', error)
            });
       }
    }
</script>
