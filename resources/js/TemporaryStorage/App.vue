<template>
    <div>

       <header>
           <Navbar />
       </header>

        <main>
            <div class="l-container">
                <router-view></router-view>
            </div>
        </main>

        <Footer />

    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

export default {
  components: {
    Navbar,
    Footer
  }
}
</script>