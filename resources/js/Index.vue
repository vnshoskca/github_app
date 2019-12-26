<template>
    <div id="l-main">
        <header id="l-header">
            <Menu></Menu>
        </header>
        <main>
          <div id="l-content">
              <router-view></router-view>
          </div>
        </main>      
    </div>
</template>

<script>
  import Menu from './components/Menu.vue'

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      Menu
    }
  }
</script>