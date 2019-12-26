<template>
  <div>
      <h1>Mypage</h1>
        <MypageRegisted /><!--自分が作成したSTEPを表示-->
        <MypageChallenged /><!--自分がchallengeしたSTEPを表示-->
   </div> 
</template>

<script>
import MypageRegisted from './MypageRegistedComponent.vue'
import MypageChallenged from './MypageChallengedComponent.vue'

    export default {
        components: {
            MypageRegisted,
            MypageChallenged
        },
        created() {
           const uri = `/mypage`;
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