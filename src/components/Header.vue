<template>
  <header>
    <div class="wrap">
      <div>
        <img src="@/assets/images/brand/brand-logo.png" alt="소녀방앗간 로고" />
        <div class="topBar" v-if="barBreak" @click="handleMenu"></div>
      </div>
      <nav class="bar-top">
        <router-link to="/" class="menu">브랜드</router-link>
        <router-link to="/store" class="menu">식사공간</router-link>
        <router-link to="/mall" class="menu">온라인몰</router-link>
        <router-link to="/catering" class="menu">케이터링</router-link>
        <router-link to="/present" class="menu">명절선물</router-link>
        <router-link to="/community" class="menu">커뮤니티</router-link>
      </nav>
    </div>
    <div ref="mobileMenuRef" class="mobile-menu"><p>fdfd</p></div>
  </header>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Breakpoint from "@/utils/screenSize";

export default class Header extends Vue {
  private barBreak = true;
  

  created() {
    if (Breakpoint.tablet > window.innerWidth) {
      this.barBreak = true;
    } else {
      this.barBreak = false;
    }
  }

  mounted() {
    console.log(this.$refs.mobileMenuRef);
  }

  handleMenu(){
    //
  }
  
};
</script>

<style scoped lang="scss">
@import "../assets/styles/layouts";
header {
  width: 100%;
  top: 0;
  position: fixed;
  background-color: white;
  z-index: 10;
  padding: 2.448vw 0 2.448vw 0;
  @include mobile {
    position: initial;
    padding: 0;
    margin-top: 10.556vw;
    margin-bottom: 6.667vw;
  }
}

.wrap {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  @include mobile {
    margin: 0;
    display: block;
    width: 81.944vw;
    height: 28.889vw;
    padding: 0;
    margin-right: 9.028vw;
    margin-left: 9.028vw;

    .topBar{
      display: inline-block;
      border-top: 0.833vw solid #727171;
      border-bottom: 0.833vw solid #727171;
      border-radius: 15%;
      position: absolute;
      text-align: right;
      width:6.389vw;
      height:2.778vw;
    }
  }

  img {
    width: 7.5vw;
    @include mobile {
      display: inline;
      width: 25.556vw;
      margin-left: 28.194vw;
      margin-right: 21.805vw;
      margin-bottom: 6.5vw;
    }
  }

  nav {
    display: inline-flex;
    justify-content: space-between;
    flex-basis: 51.8%;
    flex-shrink: 0;
    padding-top: 0.729vw;
    align-self: flex-end;

    @include mobile {
      display: flex;
      justify-content: space-between;
      padding-top: 2.222vw;
      border-top: 0.4vw solid black;
      .menu:nth-child(n + 5) {
        display: none;
      }
    }

    .menu {
      font-size: 1.198vw;
      font-weight: 300;
      color: black;
      text-decoration: none;
      @include mobile {
        font-size: 3.472vw;
        font-weight: bold;
      }
    }
  }
}

.mobile-menu {
  top: 0;
  left: 0;
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  background-color: white;

  z-index: 200;
}
</style>
