<template>
  <header>
    <div class="wrap">
      <div>
        <img
          class="logo"
          src="@/assets/images/brand/brand-logo.png"
          alt="소녀방앗간 로고"
        />
        <div class="topBar" @click="openMenu"></div>
      </div>
      <nav ref="menuNavRef" class="bar-top">
        <router-link to="/" class="menu">브랜드</router-link>
        <router-link to="/store" class="menu">식사공간</router-link>
        <router-link to="/mall" class="menu">온라인몰</router-link>
        <router-link to="/catering" class="menu">케이터링</router-link>
        <router-link to="/present" class="menu">명절선물</router-link>
        <router-link to="/community" class="menu">커뮤니티</router-link>
        <img
          class="btn-close"
          src="@/assets/images/icon-close.png"
          @click="closeMenu"
        />
      </nav>
    </div>
  </header>
</template>

<script lang="ts">
import { Component, Vue, Ref, Watch } from "vue-property-decorator";
import Breakpoint from "@/utils/screenSize";

@Component
export default class Header extends Vue {
  @Ref() readonly menuNavRef!: HTMLElement;

  private barBreak = true;

  mounted() {
    if (Breakpoint.tablet > window.innerWidth) {
      this.barBreak = true;
    } else {
      this.barBreak = false;
    }
  }

  openMenu() {
    this.menuNavRef.classList.add("extend");
  }

  closeMenu() {
    this.menuNavRef.classList.remove("extend");
  }

  @Watch("$route")
  routeChanged(/* to: string, from: string */) {
    this.closeMenu();
  }
}
</script>

<style scoped lang="scss">
@import "../assets/styles/layouts";

header {
  width: 100%;
  top: 0;
  position: fixed;
  background-color: white;
  z-index: 10;
  padding: 1.823vw 0 1.823vw 0;

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

    .topBar {
      display: none;
      position: absolute;
      width: 6.389vw;
      height: 2.778vw;
      border-top: 0.633vw solid #727171;
      border-bottom: 0.633vw solid #727171;
      text-align: right;
      @include mobile {
        display: inline-block;
      }
    }
  }

  .logo {
    width: 6.719vw;

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

    .menu {
      font-size: 1.198vw;
      font-weight: 300;
      color: black;
      text-decoration: none;
    }

    .btn-close {
      display: none;
    }

    @include mobile {
      display: flex;
      padding-top: 2.222vw;
      border-top: 0.4vw solid black;

      .menu:nth-child(n + 5) {
        display: none;
      }

      .menu {
        font-size: 3.472vw;
        font-weight: bold;
      }

      &.extend {
        display: flex;

        top: 0;
        left: 0;
        position: fixed;
        min-width: 100%;
        min-height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        z-index: 200;
        border: none;
        padding: unset;

        justify-content: center;
        flex-direction: column;
        text-align: center;

        .menu:nth-child(n + 5) {
          display: block;
        }

        .btn-close {
          position: absolute;
          display: block;
          width: 4.444vw;
          top: 9.722vw;
          right: 9.722vw;
        }

        .menu {
          font-size: 4.167vw;
          margin-bottom: 10.833vw;
        }
      }
    }
  }
}

.mobile-menu {
  display: none;

  top: 0;
  left: 0;
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  background-color: white;

  z-index: 200;
}
</style>
