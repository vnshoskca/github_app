<template>
  <footer class="l-footer">

    <button @click="logout">
      Logout
    </button>

    <RouterLink to="/login">
      Login / Register
    </RouterLink>

  </footer>
</template>

<script>
//import { mapState, mapGetters } from 'vuex'

export default {
  /*
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
  *?
    /*
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    ...mapGetters({
      isLogin: 'auth/check'
    })
  },
  */
 
  methods: {
    logout(){
      axios.post('/logout');
      location.href = '/';
    }
    /*
    async logout () {
      await this.$store.dispatch('auth/logout')

      //if (this.apiStatus) {
        this.$router.push('/login')
      //}
    }
    */
  }
  
}

</script>