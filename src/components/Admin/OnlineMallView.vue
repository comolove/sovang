<template>
  <div class="online-mall-view" v-if="item">
    <div class="content-wrap">
      <div class="text-wrap">
        <p class="subject">물품 이름</p>
        <p class="text">{{ item.itemName }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">물품 설명</p>
        <p class="text">{{ item.itemDesc }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">물품 링크</p>
        <p class="text"><a :href="item.link">{{item.link}}</a></p>
      </div>
    </div>
    <SwapModifiableImage :image="item.img" @modify="onModify"/>
    <button
      class="red-button"
      @click="
        () => {
          onDelete(item.index);
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

import SwapModifiableImage from "@/components/Admin/SwapModifiableImage.vue";

@Component({
  name: "OnlineMallView",
  components: {
    SwapModifiableImage
  }
})
export default class OnlineMallView extends Vue {
  @Prop() item!: OnlineMallItem;

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

.online-mall-view {
  display: inline-block;
  margin-bottom: 40px;
}
</style>
