<template>
  <div>
      <h1>Mypage KoStep</h1>
        <!--自分が作成したkostepの表示-->
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
                        <div class="c-form-group"><span>Achievement_time:</span> {{ step.achievement_time }} </div>
                    </div>
                </div>
            </div>
        </div>
        <!--自分が作成したkostepの表示-->
        <div class="c-kostep-attention">kostepの削除：<span class="c-br"><br></span>１つのみの時は、kostepを削除できません!</div>
        <div class="c-table c-table-hover">
           <div class="c-thead">
                <div class="c-tr">
                    <div>
                        <div>
                            <div class="c-th">Content</div>
                            <div class="c-th">Detail Content</div>
                            <div class="c-th">Return My Detail</div>
                            <div class="c-th">Ko Edit</div>
                            <div class="c-th">Ko Delete</div>
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
                            <div class="c-td"><span class="sp">return my detail:</span><router-link :to="{name: 'mypage_detail_step', params: { id: step.id }}" class="l-nav-link">Return Detail</router-link></div>
                            <div class="c-td"><span class="sp">ko edit:</span><router-link :to="{name: 'edit_ko_step', params: { id: step.id, id2: kostep.id }}" class="l-nav-link">Edit Ko STEP</router-link></div>
                            <div class="c-td"><span class="sp">ko delete:</span><button class="c-button" @click.prevent="deleteKoStep(step.id, kostep.id)">Ko Delete</button></div>                       
                        </div>
                    </div>
                </div>
            </div>
       </div>
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
        },
        methods: {
            deleteKoStep(id, id2) {
                if(confirm('子STEPの削除：本当に削除しますか？')){
                    const uri = `/steps/${id}/delete_ko_step/${id2}`;
                    this.axios.delete(uri)
                    .then(response => {
                        this.category.splice(this.category.indexOf(id), 1);
                    }).catch(error => {
                        console.log('エラー', error);
                    });
                    location.href = `/mypage/${this.$route.params.id}/detail`;
                }
            }
        }
    }
</script>