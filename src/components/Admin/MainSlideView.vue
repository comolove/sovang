<template>
  <div class="main-slide" v-if="image">
    <SwapModifiableImage :image="image.img" @modify="onModify"/>
  
    <button
      class="red-button"
      @click="
        () => {
          onDelete(image.index);
        }
      "
    >
      삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { MainSlide } from "@/utils";

import SwapModifiableImage from "@/components/Admin/SwapModifiableImage.vue";

@Component({
  name: "MainSlideView",
  components: {
    SwapModifiableImage
  }
})
export default class MainSlideView extends Vue {
  @Prop() image!: MainSlide;

  protected onDelete(index: number) {
    this.$emit("delete", index);
  }

  private onModify() {
    this.$emit("modify");
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";
@include content-wrap;

.main-slide {
  display: inline-block;
  margin-bottom: 40px;
}
</style>
