<template>
  <header>
    <div class="wrap">
      <div>
        <img src="@/assets/images/brand/brand-logo.png" alt="소녀방앗간 로고" />
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
  </header>
</template>

<script lang="ts">
export default {};
</script>

<style scoped lang="scss">
header {
  width: 100%;
  top: 0;
  position: fixed;
  background-color: white;
  z-index: 10;
  padding: 2.448vw 0 2.448vw 0;
}

.wrap {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  img {
    width: 7.5vw;
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
  }
}
</style>
