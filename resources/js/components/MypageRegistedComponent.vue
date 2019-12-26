<template>
  <div>
      <h3>MypageRegisted</h3>
       <!--自分が作成したstepの表示-->
       <div class="c-table c-table-hover">
            <div class="c-thead">
                <div>
                    <div class="c-tr">
                        <div class="c-th">Title</div>
                        <div class="c-th">Category</div>
                        <div class="c-th">Achievement Time</div>
                        <div class="c-th">To Detail</div>
                        <div class="c-th">Edit</div>
                        <div class="c-th">Delete</div>
                    </div>
                </div>
            </div>
            <div class="c-tbody">
                <div v-for="(cate, i) in category" :key="`third-${i}`">
                    <div v-for="step in cate.steps" :key="step.id" class="c-tr">           
                        <div class="c-td"><span class="sp">title:</span> {{ step.title }} </div>
                        <div class="c-td"><span class="sp">category:</span> {{ cate.name }} </div>
                        <div class="c-td"><span class="sp">achievement time:</span> {{ step.achievement_time }} </div>
                        <div class="c-td"><span class="sp">to detail:</span><router-link :to="{name: 'mypage_detail_step', params: { id: step.id }}" class="l-nav-link">My Detail STEP</router-link></div>
                        <div class="c-td"><span class="sp">edit:</span><router-link :to="{name: 'edit_step', params: { id: step.id }}" class="l-nav-link">Edit STEP</router-link></div>
                        <div class="c-td"><span class="sp">delete:</span><button class="c-button" @click.prevent="deleteStep(step.id)">Delete</button></div>                       
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
            const uri = `/mypage/registed`;
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
            deleteStep(id) {
                if(confirm('STEPの削除：本当に削除しますか？')){
                    const uri = `/steps/${id}/delete`;
                    this.axios.delete(uri)
                    .then(response => {
                        this.category.splice(this.category.indexOf(id), 1);
                    }).catch(error => {
                        console.log('エラー', error);
                    });
                    location.href = `/mypage`;
                }
            }
        }
    }
</script>