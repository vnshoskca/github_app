<template>
  <div>
        <div class="c-btn1">
            <button class="c-button" @click.prevent="challengeStep()">Challenge</button><!--challengeボタン生成、challenge_flg ０→１へ-->
        
            <div v-for="(cate, i) in category" :key="i">
                <div v-for="ste in cate.steps" :key="ste.id"> 
                    <div v-for="cha in ste.challenge.slice(0,1)" :key="cha.id">
                        <div class="c-btn-group c-btn2"> 
                            <button class="c-button" v-if="cha.challenge_flg==0" @click.prevent="challengeStep()">
                                Challenge
                            </button>
                            <button class="c-button c-ed" v-else @click.prevent="challengeStep()">
                                Challenged!!
                            </button>                      
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
        methods: {
            challengeStep() {//challengeボタン生成、challenge_flg ０→１へ
                if(confirm('チャレンジ、非チャレンジを切り替えますか？')){
                    const uri = `/steps/${this.$route.params.id}/challenge_step`;
                    this.axios.post(uri)
                    .then(response => {
                        console.log('success', response.data);
                        this.category = response.data;
                    }).catch(error => {
                        console.log('エラー', error);
                    });
                    //detail,mypageのdetail どちらからのアクセスでも元のページに戻れる
                    this.$router.go({path: this.$router.currentRoute.path, force: true});
                }
           }, 
        }
    }
</script>