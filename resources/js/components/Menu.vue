<template>
  <nav>

    <div id="l-app" v-cloak>
      <!--レスポンシブ：Toggleボタン-->
      <div id="header">
        <menu-btn 
          :class="{ menu_btn: true, open_: menuFlag }" 
          @click.native="menuToggle">Menu
        </menu-btn>
        <span class="l-sp-header-right">
          <ul class="l-sp-user" v-if="$auth.check()">
              <li class="l-sp-userlist"><img :src="user.image"></li>
          </ul>
          <ul class="l-sp-user" v-if="$auth.check()">
              <li class="l-sp-userlist">{{ user.id }}</li>
          </ul>
          <ul class="l-sp-user" v-if="$auth.check()">
              <li class="l-sp-userlist">{{ user.name }}</li>
          </ul>
        </span>
      </div>
      <!--レスポンシブ：メニュー画面-->
      <transition>
        <div id="l-sp_menu" v-show="menuFlag" :style="{ marginTop: headH }">
          <div class="l-menu_wrap">
                  <ul>
                    <li class="l-nav-item">
                       <router-link :to="{name: 'home'}" class="l-nav-link" @click.native="menuToggle">Home</router-link>
                    </li>
                  </ul>
                  <ul>            
                     <li class="l-nav-item">
                      <router-link to="/steps" class="l-nav-link" @click.native="menuToggle">Steps</router-link>
                    </li>
                  </ul>
                  <ul>             
                    <li class="l-nav-item" v-if="$auth.check()">
                      <router-link to="/step/create" class="l-nav-link" @click.native="menuToggle">CreateStep</router-link>
                    </li>
                  </ul>
                  <ul>             
                    <li class="l-nav-item" v-if="$auth.check()">
                      <router-link to="/mypage" class="l-nav-link" @click.native="menuToggle">Mypage</router-link>
                    </li>
                  </ul>
                  <ul>             
                    <li class="l-nav-item" v-if="$auth.check()">
                      <router-link to="/user/prof_edit" class="l-nav-link" @click.native="menuToggle">EditUser</router-link>
                    </li>
                  </ul>
            
                  <ul v-if="$auth.check(1)">
                      <li class="l-nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="l-nav-link" @click.native="menuToggle">{{route.name}}</router-link>
                      </li>
                  </ul>
                  <ul v-if="$auth.check(2)">
                      <li class="l-nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="l-nav-link" @click.native="menuToggle">{{route.name}}</router-link>
                      </li>
                  </ul>
                  <ul v-if="!$auth.check()">
                      <li class="l-nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                        <router-link :to="{ name : route.path }" :key="key" class="l-nav-link" @click.native="menuToggle">{{route.name}}</router-link>
                      </li>
                  </ul>
                  <ul v-if="$auth.check()">
                      <li class="l-nav-item">
                        <div @click.prevent="$auth.logout()">
                          <a href="#" class="l-nav-link" @click.native="menuToggle">
                            Logout
                          </a>
                        </div>
                      </li>
                  </ul>
          </div>
        </div>
      </transition>
    </div>
  <!--PCサイト：NAVbar-->
  <div class="l-navbar">
    <div class="l-navbar-left">
      <ul class="l-navbar-nav">
          <li class="l-nav-item"><!--Home Stepsは部外者の閲覧可能-->
            <router-link :to="{name: 'home'}" class="l-nav-link">Home</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav">
          <li class="l-nav-item"><!--Home Stepsは部外者の閲覧可能-->
            <router-link to="/steps" class="l-nav-link">Steps</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav">
          <li class="l-nav-item" v-if="$auth.check()">
            <router-link to="/step/create" class="l-nav-link">CreateStep</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav">
          <li class="l-nav-item" v-if="$auth.check()">
            <router-link to="/mypage" class="l-nav-link">Mypage</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav">
          <li class="l-nav-item" v-if="$auth.check()">
            <router-link to="/user/prof_edit" class="l-nav-link">EditUser</router-link>
          </li>
      </ul>
    </div>

    <div class="l-navbar-right">
      <ul class="l-navbar-nav" v-if="$auth.check(1)">
          <li class="l-nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="l-nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav" v-if="$auth.check(2)">
          <li class="l-nav-item" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="l-nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="l-navbar-nav" v-if="!$auth.check()">
          <li class="l-nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="l-nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <!--Login中のuserは自分の情報が表示される-->
        <ul class="l-navbar-nav" v-if="$auth.check()">
            <li class="l-nav-item"><img :src="user.image"></li>
        </ul>
        <ul class="l-navbar-nav" v-if="$auth.check()">
            <li class="l-nav-item">{{ user.id }}</li>
        </ul>
        <ul class="l-navbar-nav" v-if="$auth.check()">
            <li class="l-nav-item">{{ user.name }}</li>
        </ul>
      
      <ul class="l-navbar-nav" v-if="$auth.check()">
          <li class="l-nav-item">
            <a class="l-nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
          </li>
      </ul>
    </div>
  
  </div>

  </nav>
</template>
<script>
//menuボタンコンポーネント
const menuBtnComp = {
  template: `
    <div>
        <span class="l-menu_trigger">    
            <span></span><span></span><span></span>
            <span>Menu</span>     
        </span>
    </div>
`
}
  export default {
    components: {
      'menu-btn': menuBtnComp,
    },
    data() {
      return {
        menuFlag: false,
        headH: "0px",
        user: {},
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
          ]
        }
      }
    },
    created() {
        const uri = `/user/prof_edit`;
        this.axios.get(uri)
        .then((response) => {
            this.user = response.data;
        })
        .catch(error => {
            console.log('エラー', error);
        });
    },
    mounted: function() {
    //headerの高さ取得
    let h = document.getElementById("header").offsetHeight;
    this.headH = h + "px";
    },
    methods: {
        menuToggle: function() {
          //menuFlag切り替え
          this.menuFlag = !this.menuFlag;
        },
        logout() {
            location.href = `/login`;
        }
    }
  }
</script>