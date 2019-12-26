<template>
  <div>
      <h1>Steps</h1>

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
                            <div class="c-td"><span class="sp">title:</span> user:{{step.user_id}}{{ step.title }} </div>
                            <div class="c-td"><span class="sp">category:</span> {{ cate.name }} </div>
                            <div class="c-td"><span class="sp">achievement time:</span> {{ step.achievement_time }} </div>
                            <div class="c-td"><span class="sp">to detail:</span><router-link :to="{name: 'detail_step', params: { id: step.id }}" class="l-nav-link">Detail STEP</router-link></div>                        
                    </div>
                    
                </div>
                
            </div>
       </div>
<!--
        <Paginate></Paginate>
        <ul>
            <li v-for="item in getItems">{{item}}</li>
        </ul>
-->
<!--
        <paginate
            :page-count="getPageCount"
            :page-range="3"
            :margin-pages="2"
            :click-handler="clickCallback"
            :prev-text="'＜'"
            :next-text="'＞'"
            :container-class="'pagination'"
            :page-class="'page-item'">
        </paginate>   
        -->          

   </div> 
</template>

<script>
//import Paginate from './Paginate.vue'
import ChallengeButton from './ChallengeButtonComponent.vue'
//import DetailStep from './DetailStepComponent.vue'

    export default {
        components: {
            ChallengeButton
            //Paginate
            //Paginate
            //DetailStep
            //ClearButton,
            //Progress,
            //Jikken
        },
        data() {
           return {
               category:{},

               parPage: 3,
                currentPage: 1
           }
       },
       created() {
           const uri = '/steps';
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
            /*
            clickCallback: function (pageNum) {
                this.currentPage = Number(pageNum);
            },
*/
       }/*,

       computed: {
            getItems: function() {
                let current = this.currentPage * this.parPage;
                let start = current - this.parPage;
                //if(category || category.length){
                    return this.category.slice(start, current);
                //}
            },
            getPageCount: function() {
                return Math.ceil(this.category.length / this.parPage);
            }
        }
        */
    }

</script>
