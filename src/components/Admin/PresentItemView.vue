<template>
  <div class="catering-story-view" v-if="story">
    <div class="content-wrap">
      <div class="text-wrap">
        <p class="subject">제목</p>
        <p class="text">{{ story.title }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">설명</p>
        <p class="text">{{ story.desc }}</p>
      </div>
    </div>
    <div class="mono">
      <p>이미지</p>
      <SwapModifiableImage :image="story.thumbImg" @modify="onModify"/>
    </div>

    <div class="color">
      <p>팝업 이미지</p>
      <SwapModifiableImage :image="story.bodyImg" @modify="onModify"/>
    </div>

    <button
      class="red-button"
      @click="
        () => {
          onDelete(story.index);
        }
      "
    >
      삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { PresentItem } from "@/utils";

import SwapModifiableImage from "@/components/Admin/SwapModifiableImage.vue";

@Component({
  name: "PresentItemView",
  components: {
    SwapModifiableImage
  }
})
export default class PresentItemView extends Vue {
  @Prop() story!: PresentItem;

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

.catering-story-view {
  display: inline-block;
  margin-bottom: 40px;
}
</style>
