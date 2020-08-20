<template>
  <div class="present-project-view" v-if="project">
    <div class="content-wrap">
      <div class="text-wrap">
        <p class="subject">제목</p>
        <p class="text">{{ project.title }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">설명</p>
        <p class="text">{{ project.desc }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">블로그 링크</p>
        <p class="text"><a :href="project.link">{{project.link}}</a></p>
      </div>
    </div>
    <div class="front">
      <p>전면 이미지</p>
      <SwapModifiableImage :image="project.frontImg" @modify="onModify"/>
    </div>

    <div class="back">
      <p>후면 이미지</p>
      <div class="content-wrap">
        <p>PC 이미지</p>
        <ModifiableImage
          class="pc-img"
          type="pc"
          :index="project.backImg.index"
          :src="project.backImg.pcPath"
          @modify="onModify"
        />
      </div>
    </div>

    <button
      class="red-button"
      @click="
        () => {
          handleDelete(project.index);
        }
      "
    >
      삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { PresentProject } from "@/utils";

import ModifiableImage from "@/components/Admin/ModifiableImage.vue";
import SwapModifiableImage from "@/components/Admin/SwapModifiableImage.vue";

@Component({
  name: "PresentProjectView",
  components: {
    ModifiableImage,
    SwapModifiableImage
  }
})
export default class PresentProjectView extends Vue {
  @Prop() project!: PresentProject;

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
@include content-wrap;

.present-project-view {
  display: inline-block;
  margin-bottom: 40px;
}
</style>
