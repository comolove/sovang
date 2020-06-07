<template>
  <div id="app">
    <Header />
    <router-view/>
    <Footer />
  </div>
</template>

<script lang="ts">
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

export default {
  components: {
    Header,
    Footer
  }
};
</script>

<style lang="scss">
@import "./assets/styles/reset";
@import "./assets/styles/fonts";
@import "./assets/styles/layouts";

#app {
  width: 100%;
  height: 100%;

  font-family: 'Noto Sans KR', sans-serif;
}
</style>
