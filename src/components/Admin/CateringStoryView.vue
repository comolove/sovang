<template>
  <div class="online-mall-view" v-if="story">
    <div class="content-wrap">
      <p>이름 : {{ story.title }}</p>
      <p>설명 : {{ story.desc }}</p>
      <p><a :href="story.link">블로그 링크</a></p>
    </div>
    <div class="mono">
      <div class="content-wrap">
        <p>PC 흑백 이미지</p>
        <ModifiableImage
          class="pc-img"
          type="pc"
          :index="story.frontImg.index"
          :src="story.frontImg.pcPath"
          @modify="onModify"
        />
      </div>
      <div class="content-wrap">
        <p>모바일 흑백 이미지</p>
        <ModifiableImage
          class="mobile-img"
          type="mobile"
          :index="story.frontImg.index"
          :src="story.frontImg.mobilePath"
          @modify="onModify"
        />
      </div>
    </div>

    <div class="color">
      <div class="content-wrap">
        <p>PC 컬러 이미지</p>
        <ModifiableImage
          class="pc-img"
          type="pc"
          :index="story.backImg.index"
          :src="story.backImg.pcPath"
          @modify="onModify"
        />
      </div>
      <div class="content-wrap">
        <p>모바일 컬러 이미지</p>
        <ModifiableImage
          class="mobile-img"
          type="mobile"
          :index="story.backImg.index"
          :src="story.backImg.mobilePath"
          @modify="onModify"
        />
      </div>
    </div>

    <button
      @click="
        () => {
          handleDelete(story.index);
        }
      "
    >
      삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { CateringStory } from "@/utils";

import ModifiableImage from "@/components/Admin/ModifiableImage.vue";

@Component({
  name: "CateringStoryView",
  components: {
    ModifiableImage
  }
})
export default class CateringStoryView extends Vue {
  @Prop() story!: CateringStory;

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
