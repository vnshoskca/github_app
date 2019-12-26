<template>
  <div>

      <button v-if="show" @click.prevent="challengeStep()">Challenge</button>

      <p>{{ message }}</p>
      <p>{{ st_title }}</p>
      <p>{{ cate_name }}</p>
      <p>{{ st_achievement_time }}</p>

<!--
        <div v-for="(cate, i) in category" :key="i">
            <div v-for="ste in cate.steps" :key="ste.id">
                <div v-for="cha in ste.challenge.slice(0,1)" :key="cha.id">
                    <div>
                        <button class="btn" :class="[cha.challenge_flg ? 'btn-danger' : 'btn-primary']" @click.prevent="challengeStep()">
                            Challenge
                        </button>  
                        <div> step.id = {{ste.id}} </div>
                        <div> challenge.id = {{cha.id}} </div>
                        <div> challenge_flg = {{cha.challenge_flg}} </div>              
                    </div>
                </div>
            </div>
        </div>
        -->

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
       props: ['message', 'st_title', 'cate_name', 'st_achievement_time'],
       
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
        },
        methods: {
            challengeStep() {
                //this.show = !this.show;
               //const uri = `/steps/${id}/challenge_step`;
               const uri = `/steps/${this.$route.params.id}/challenge_step`;
               this.axios.post(uri)
               .then(response => {
                   console.log('success', response.data);
                   this.category = response.data;
               }).catch(error => {
                console.log('エラー', error);
                });
                location.href = `/steps/${this.$route.params.id}/detail`;
           }, 
        }
    }
</script>