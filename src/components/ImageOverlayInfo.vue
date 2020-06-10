<template>
  <div class="image-overlay-info">
    <AssetImage
      :src="src"
      :style="{ width: imageWidth, height: imageHeight }"
    />
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
  @Prop() private imageWidth!: string;
  @Prop() private imageHeight!: string;
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
    height: 99.5%;
    top: 0;
    right: 0;
  }
}
</style>
