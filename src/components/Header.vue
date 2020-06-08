<template>
  <header>
    <div class="wrap">
      <img src="../assets/images/brand-logo.png" alt="소녀방앗간 로고" />
      <nav class="bar-top">
        <span class="menu">브랜드</span>
        <span class="menu">식사공간</span>
        <span class="menu">온라인몰</span>
        <span class="menu">케이터링</span>
        <span class="menu">명절선물</span>
        <span class="menu">커뮤니티</span>
      </nav>
    </div>
  </header>
</template>

<script lang="ts">
export default {};
</script>

<style scoped lang="scss">
header {
  padding-top: 6.75rem;
  margin-bottom: 3.125rem;
}

.wrap {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  nav {
    display: inline-flex;
    justify-content: space-between;
    width: 50%;
    padding-top: 1.375rem;
    align-self: flex-end;

    .menu {
      font-size: 1.625rem;
    }
  }
}
</style>
