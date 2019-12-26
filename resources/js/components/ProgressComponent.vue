<template>
    <!--自分がclearしたkostep数のカウント-->
    <span>   
        子STEPのClear数 : {{progress}}
    </span> 
</template>

<script>
    export default {
        data() {
           return {
               progress: 0
           }
       },
        created() {
           const uri = `/steps/${this.$route.params.id}/progress_ko_step/${this.$route.params.id2}`;//forの外でも可
           this.axios.post(uri)
           .then((response) => {
                console.log('success', response.data);
                this.progress = response.data;
           })
           .catch(error => {
                console.log('エラー', error);
            });
        }
    }
</script>