<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script lang="ts">
export default {};
</script>

<style lang="scss">
@import "./assets/styles/variables";
@import "./assets/styles/reset";
@import "./assets/styles/fonts";
@import "./assets/styles/layouts";

#app {
  width: 100%;
  height: 100%;

  font-family: "Noto Sans KR", sans-serif;
}
</style>
