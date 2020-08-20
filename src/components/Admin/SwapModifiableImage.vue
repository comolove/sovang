<template>
  <div class="swap-modifiable-image content-wrap">
    <div class="info">
      <span>{{platformText}} 이미지</span>
      <button class="blue-button" @click="onSwapClick">{{inversePlatformText}} 이미지 보기</button>
    </div>
    <ModifiableImage 
      v-if="showPCImage"
      type="pc"
      :index="image.index"
      :src="image.pcPath"
      class="pc-img"  
      @modify="onModify"
      />
    <ModifiableImage 
      v-else
      type="mobile"
      :index="image.index"
      :src="image.mobilePath"
      class="mobile-img" 
      @modify="onModify"
      />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, Ref } from "vue-property-decorator";
import ModifiableImage from "@/components/Admin/ModifiableImage.vue";
import { AxiosHelper, ImgPath } from "@/utils";

@Component({
  name: "AdminSwapModifiableImage",
  components : {
    ModifiableImage
  }
})
export default class SwapModifiableImage extends Vue {
  private showPCImage = true;

  @Prop() image!: ImgPath;

  private get platformText() {
    return this.showPCImage ? "PC" : "모바일";
  }

  private get inversePlatformText() {
    return !this.showPCImage ? "PC" : "모바일";
  }

  private onSwapClick() {
    this.showPCImage = !this.showPCImage;
  }

  private onModify() {
    this.$emit("modify");
  }

}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";
@include content-wrap;

.swap-modifiable-image {
  .info {
    position: relative;
    margin-bottom: 10px;
    padding-bottom: 20px;

    span {
      position: relative;
      bottom: -10px;
    }

    button {
      display: block;
      float: right;
      padding: 4px 32px;
    }
  }
}
</style>
