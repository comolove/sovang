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
@import "../assets/styles/layouts";
header {
  padding-top: 3.958vw;
  margin-bottom: 3.646vw;

  @include mobile{
    padding:0;
    margin-top: 10.556vw;
    margin-bottom: 6.667vw;
  }
}

.wrap {
  display: flex;
  flex-direction: row;
  justify-content: space-between;

  @include mobile{
    margin:0;
    display:block;
    width: 81.944vw;
    height:28.889vw;
    padding:0;
    margin-right: 9.028vw;
    margin-left: 9.028vw;
  }

  img {
    width: 9.271vw;
    @include mobile{
      width: 25.556vw;
      margin-left: 28.194vw;
      margin-right: 28.194vw;
      margin-bottom:6.500vw;
    }
  }

  nav {
    display: inline-flex;
    justify-content: space-between;
    flex-basis: 53%;
    flex-shrink: 0;
    padding-top: 1.375rem;
    align-self: flex-end;

    @include mobile{
        display:flex;
        justify-content:space-between;
        padding-top:2.222vw;
        border-top: 0.4vw solid black;
        .menu:nth-child(n+5){
          display:none;
        }
    }

    .menu {
      font-size: 1.302vw;
      color: black;
      text-decoration: none;
      @include mobile{
        font-size:3.472vw;
        font-weight:bold;
      }
    }
  }
}
</style>
