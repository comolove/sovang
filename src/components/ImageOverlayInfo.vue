<template>
  <div class="image-overlay-info">
    <AssetImage :src="src" />
    <div class="overlay-info" :style="{ backgroundColor: backgroundColor }">
      <slot></slot>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { AssetImage } from "@/components";

@Component({
  components: {
    AssetImage
  }
})
export default class ImageOverlayInfo extends Vue {
  @Prop() private src!: string;
  @Prop() private backgroundColor!: string;
}
</script>

<style scoped lang="scss">
.image-overlay-info {
  width: 100%;
  position: relative;

  img {
    width: 100%;
  }

  .overlay-info {
    position: absolute;
    width: 31.16%;
    height: 100%;
    top: 0;
    right: 0;
  }
}
</style>
