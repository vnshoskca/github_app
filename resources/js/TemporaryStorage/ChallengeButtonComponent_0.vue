<template>
  <div>

        <button v-if="show" @click.prevent="challengeStep()">Challenge</button><!--challengeボタン生成、challenge_flg ０→１へ-->   

        <!--最後に消す、１→０はいらないから-->
        <div v-for="(cate, i) in category" :key="i">
            <div v-for="ste in cate.steps" :key="ste.id">
                <div v-for="cha in ste.challenge.slice(0,1)" :key="cha.id">
                    <div>
                        <button v-if="!((cha.challenge_flg == true) || (cha.challenge_flg == false))" @click.prevent="challengeStep()">Challenge</button>
                        <button class="btn" :class="[cha.challenge_flg ? 'btn-danger' : 'btn-primary']" @click.prevent="challengeStep()">
                            Challenge
                        </button>
                        <div> cha_flg = {{cha.challenge_flg}} </div>
                        <div> step_id = {{ste.id}} </div>                            
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
               category:{},
               show: true
           }
       },
       //props: ['cate_name', 'st_title', 'st_achievement_time'],
       
        created() {//<!--最後に消す、１→０はいらないから-->
           const uri = `/steps/${this.$route.params.id}/detail`;
           this.axios.get(uri)
           .then((response) => {
                console.log('success', response.data);
                this.category = response.data;
           })
           .catch(error => {
                console.log('エラー', error);
            });
        },
        
        methods: {//challengeボタン生成、challenge_flg ０→１へ
            challengeStep() {
                if(confirm('チャレンジしますか？')){
                    const uri = `/steps/${this.$route.params.id}/challenge_step`;
                    this.axios.post(uri)
                    .then(response => {
                        console.log('success', response.data);
                        this.category = response.data;
                    }).catch(error => {
                        console.log('エラー', error);
                    });
                    location.href = `/steps/${this.$route.params.id}/detail`;
                }
           }, 
        }
    }
</script>