<template>
    <div>
        <!--challenge済みならばclearボタン生成、clear_flg ０→１へ-->
        <div class="c-btn1">

            <div v-for="cate in category" :key="cate.id">
                <div v-for="ste in cate.steps" :key="ste.id">
                    <div v-for="cha in ste.challenge.slice(0,1)" :key="cha.id">
                        <div>
                            <button class="c-button" v-if="(cha.challenge_flg == true)" @click.prevent="clearStep()">
                                Clear
                            </button>              
                        </div>
                    </div>
                </div>
            </div>

            <div v-for="(cate, i) in category" :key="i">
                <div v-for="step in cate.steps" :key="step.id">
                    <div v-for="kostep in step.kosteps" :key="kostep.id">
                        <div v-for="cle in kostep.clear.slice(0,1)" :key="cle.id">
                            <div class="c-btn-group c-btn3">
                                <button class="c-button c-btn" v-if="cle.clear_flg==0" @click.prevent="clearStep()">
                                    Clear
                                </button>
                                <button class="c-button c-btn c-ed" v-else @click.prevent="clearStep()">
                                    Cleared!!
                                </button>
                            </div>
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
        methods: {//clearボタン生成、clear_flg ０→１へ
           clearStep() {
               if(confirm('クリア、非クリアを切り替えますか？')){
                    const uri = `/steps/${this.$route.params.id}/clear_ko_step/${this.$route.params.id2}`;
                    this.axios.post(uri)
                    .then(response => {
                        console.log('success', response.data);
                        this.category = response.data;  
                    }).catch(error => {
                        console.log('エラー', error);
                    });
                    //kostep,mypageのkostep どちらからのアクセスでも元のページに戻れる
                    this.$router.go({path: this.$router.currentRoute.path, force: true});
               }
           },
        }
    }
</script>