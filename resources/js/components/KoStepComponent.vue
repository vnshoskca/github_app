<template>
  <div>
      <h1>Ko Step</h1>
        <!--kostep一覧-->
       <div class="c-form">
           <div class="c-form-data"><button class="l-nav-item c-button" v-if="$auth.check()">
                <router-link :to="{ name: 'ko_detail_create_step' }" class="l-nav-link">Add Ko Step</router-link>
            </button></div>
        <!--タイトル、カテゴリー、目安達成時間-->
        <div v-for="(cate, i) in category" :key="i">
                <div v-for="step in cate.steps" :key="step.id">
                    <div v-for="kostep in step.kosteps.slice(0,1)" :key="kostep.id">
                        <div class="c-form-group"><span>Title:</span> {{ step.title }} </div>
                        <div class="c-form-group"><span>Category:</span> {{ cate.name }} </div>
                        <div class="c-form-group"><span>Achievement_time:</span> {{ step.achievement_time }} </div><br>
                    </div>
                </div>
            </div>
        </div>
        <!--kostep詳細-->
        <div class="c-table c-table-hover">
           <div class="c-thead">
                <div class="c-tr">
                    <div>
                        <div>
                            <div class="c-th">Content</div>
                            <div class="c-th">Detail Content</div>
                            <div class="c-th">Return Detail</div>
                        </div>
                    </div>
                </div>
           </div>
            <div class="c-tbody">
                <div v-for="(cate, i) in category" :key="`third-${i}`">
                    <div v-for="step in cate.steps" :key="step.id">
                        <div v-for="kostep in step.kosteps" :key="kostep.id" class="c-tr">        
                            <div class="c-td"><span class="sp">content:</span> {{ kostep.content }} </div>
                            <div class="c-td"><span class="sp">detail_content:</span> {{ kostep.detail_content }} </div>
                            <div class="c-td"><span class="sp">return detail:</span><router-link :to="{name: 'detail_step', params: { id: step.id }}" class="l-nav-link">Return Detail</router-link></div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <!--clearボタン-->
       <ClearButton />
   </div> 
</template>

<script>
import ClearButton from './ClearButtonComponent.vue'

    export default {
        components: {
            ClearButton
        },
        data() {
           return {
               category:{}
           }
       },
        created() {
           const uri = `/steps/${this.$route.params.id}/ko_detail/${this.$route.params.id2}`;
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