<template>
  <div class="online-mall-view" v-if="item">
    <div class="content-wrap">
      <p>상품 이름 : {{ item.itemName }}</p>
      <p>상품 설명 : {{ item.itemDesc }}</p>
      <p><a :href="item.link">상품 링크</a></p>
    </div>
    <div class="content-wrap">
      <p>PC 이미지</p>
      <ModifiableImage
        class="pc-img"
        type="pc"
        :index="item.img.index"
        :src="item.img.pcPath"
        @modify="onModify"
      />
    </div>
    <div class="content-wrap">
      <p>모바일 이미지</p>
      <ModifiableImage
        class="mobile-img"
        type="mobile"
        :index="item.img.index"
        :src="item.img.mobilePath"
        @modify="onModify"
      />
    </div>

    <button
      @click="
        () => {
          handleDelete(item.index);
        }
      "
    >
      삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { OnlineMallItem } from "@/utils";

import ModifiableImage from "@/components/Admin/ModifiableImage.vue";

@Component({
  name: "OnlineMallView",
  components: {
    ModifiableImage
  }
})
export default class OnlineMallView extends Vue {
  @Prop() item!: OnlineMallItem;

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
