<template>
  <div>
      <h3>MypageChallenged</h3>
        <!--自分がchallengeしたSTEPを表示-->
        <div class="c-table c-table-hover">
           <div class="c-thead">
               <div>
                    <div>
                        <div class="c-tr">
                            <div class="c-th">Title</div>
                            <div class="c-th">Category</div>
                            <div class="c-th">Achievement Time</div>
                            <div class="c-th">To Detail</div>
                        </div>
                    </div>
                </div>
           </div>
            <div class="c-tbody">
                <div v-for="(cate, i) in category" :key="`third-${i}`">
                    <div v-for="step in cate.steps" :key="step.id">
                        <div v-for="chall in step.challenge" :key="chall.id" class="c-tr">        
                            <div class="c-td"><span class="sp">title:</span> {{ step.title }} </div>
                            <div class="c-td"><span class="sp">category:</span> {{ cate.name }} </div>
                            <div class="c-td"><span class="sp">achievement time:</span> {{ step.achievement_time }} </div>
                            <div class="c-td"><span class="sp">to detail:</span><router-link :to="{name: 'detail_step', params: { id: step.id }}" class="l-nav-link">Detail STEP</router-link></div>                       
                        </div>
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
           const uri = `/mypage/challenged`;
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