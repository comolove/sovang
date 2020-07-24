<template>
  <div class="store-map-link">
    <a class="searchIcon" :href="link">
      <span>지도보기</span>
      <img src="@/assets/images/icon-searching.png" />
    </a>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component
export default class MapLink extends Vue {
  @Prop() link!: string;
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";

.searchIcon {
  position: absolute;
  top: 0;
  right: 0;
  text-decoration: none;

  img {
    width: 1.719vw;
  }

  span {
    position: relative;
    font-size: 0.99vw;
    color: #001845;
    right: 0.234vw;
    bottom: 0.39vw;
  }

  @include mobile {
    img {
      width: 4.444vw;
    }
  }
}
</style>
