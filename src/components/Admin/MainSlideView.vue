<template>
  <div class="main-slide" v-if="image">
      <div class="content-wrap">
        <p>PC 이미지</p>
        <ModifiableImage class="pc-img" type="pc" :index="image.img.index" :src="image.img.pcPath" @modify="onModify"/>
      </div>
      <div class="content-wrap">
        <p>모바일 이미지</p>
        <ModifiableImage class="mobile-img" type="mobile" :index="image.img.index" :src="image.img.mobilePath" @modify="onModify"/>
      </div>

      <button
        @click="
          () => {
            handleDelete(image.index);
          }
        "
      >
        삭제
      </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, Watch } from "vue-property-decorator";
import { BaseResImgObj } from "@/utils";

import ModifiableImage from "@/components/Admin/ModifiableImage.vue"

@Component({
  name: "MainSlideView",
  components: {
    ModifiableImage
  }
})
export default class MainSlideView extends Vue {
  @Prop() image!: BaseResImgObj;

  protected handleDelete(index: number) {
    this.$emit("delete", index);
  }

  private onModify() {
    this.$emit("modify");
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";

button {
  display: block;
}

@include content-wrap;
</style>
