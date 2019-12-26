<template>

  <nav>

    <ul class="navbar-nav">
      <li class="nav-item">
        <router-link to="/" class="nav-link">Home</router-link>
      </li>

      <li class="nav-item">
        <router-link to="/steps" class="nav-link">Steps</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/step/create" class="nav-link">CreateStep</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/mypage" class="nav-link">Mypage</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/auth/prof_edit" class="nav-link">EditUser</router-link>
      </li>
    </ul>
       
    <div class="navbar__menu">
      
      <div class="navbar__item" v-model="user.name">
        {{user.id}}
        {{user.name}}
      </div>

      <div class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login / Register
        </RouterLink>
        <button class="button button--link" @click="logout">
          Logout
        </button>
      </div>
      
    </div>

<!--  
    <button class="button" @click="showForm = ! showForm">
      <i class="icon ion-md-add"></i>
      Submit a New
    </button>

    <New v-model="showForm" />

    <RouterLink class="button button--link" to="/step">
          STEP_Register
    </RouterLink>
-->

  </nav>
</template>

<script>
//import New from './New.vue'

export default {
  data() {
    return {
      //user: {}
    }
  },
  /*
  created() {
    const uri = `/auth/prof_edit`;
    this.axios.get(uri).then((response) => {
      this.user = response.data;
    });
  },
  */
  methods: {
    logout(){
      axios.post('/logout');
      location.href = '/';
    }
  }
}

</script>


  
