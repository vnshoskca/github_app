<template>
  <div>
      <h1>Detail Step</h1>   
       <div class="c-form">
           <div class="c-form-data"><button class="l-nav-item c-button" v-if="$auth.check()">
                <router-link :to="{ name: 'ko_detail_create_step' }" class="l-nav-link">Add Ko Step</router-link>
            </button></div>
       <!--タイトル、カテゴリー、目安達成時間-->
       <div v-for="(cate, i) in category" :key="i">
            <div v-for="st in cate.steps" :key="st.id">
                <div v-for="ko in st.kosteps.slice(0,1)" :key="ko.id">
                    <div class="c-form-group"><span>Title:</span> {{ st.title }} </div>
                    <div class="c-form-group"><span>Category:</span> {{ cate.name }} </div>
                    <div class="c-form-group"><span>Achievement_time:</span> {{ st.achievement_time }} </div>
                    <div class="c-form-group"><Progress /><span>/ {{ Object.keys(st.kosteps).length }}</span></div>
                </div>
            </div>
        </div>
        <!--challenge-->
        <ChallengeButton />
        <!--twitter-->
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" data-show-count="false"
            :data-url="`http://127.0.0.1:8000/steps/:id/detail/`">
            <i class="fab fa-twitter fa-lg"></i>
        </a>

        </div>
        <!--kostep一覧-->
        <div class="c-table c-table-hover">
           <div class="c-thead">
               <div>
                    <div>
                        <div class="c-tr">
                            <div class="c-th">Content</div>
                            <div class="c-th">To Ko Detail</div>
                        </div>
                    </div>
                </div>
           </div>
            <div class="c-tbody">
                <div v-for="(cate, i) in category" :key="`third-${i}`">
                    <div v-for="step in cate.steps" :key="step.id">
                        <div v-for="kostep in step.kosteps" :key="kostep.id" class="c-tr">        
                            <div class="c-td"><span class="sp">content:</span> {{ kostep.content }} </div>
                            <div class="c-td"><span class="sp">to kostep:</span><router-link :to="{name: 'ko_detail_step', params: { id: step.id, id2: kostep.id }}" class="l-nav-link">Ko STEP</router-link></div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
         
   </div> 
</template>

<script>
import ChallengeButton from './ChallengeButtonComponent.vue'
import Progress from './ProgressComponent.vue'

    export default {
        components: {
            ChallengeButton,
            Progress
        },
        data() {
           return {
               category:{},
               show: true
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