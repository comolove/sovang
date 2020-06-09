<template>
  <header>
    <div class="wrap">
      <div>
        <img src="../assets/images/brand-logo.png" alt="소녀방앗간 로고" />
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
  padding-top: 4.813rem;
  margin-bottom: 4.438rem;
}

.wrap {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  nav {
    display: inline-flex;
    justify-content: space-between;
    flex-basis: 55%;
    flex-shrink: 0;
    padding-top: 1.375rem;
    align-self: flex-end;

    .menu {
      font-size: 1.563rem;
      color: black;
      text-decoration: none;
    }
  }
}
</style>
