<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import ChannelService from "@/utils/ChannelService";

@Component
export default class App extends Vue {
  mounted()
  {
    
    ChannelService.boot({
      "pluginKey": "ab20f262-1468-41fc-b5b7-bc5052356d2a" //please fill with your plugin key
    });
  }

  destroyed()
  {
    ChannelService.shutdown();
  }
};
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

  strong {
    font-weight: bold;
  }

  em {
    font-style: italic;
  }
}
</style>
