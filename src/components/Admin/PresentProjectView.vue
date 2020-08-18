<template>
  <div class="online-mall-view" v-if="project">
    <div class="content-wrap">
      <p>이름 : {{ project.title }}</p>
      <p>설명 : {{ project.desc }}</p>
      <p><a :href="project.link">블로그 링크</a></p>
    </div>
    <div class="front">
      <div class="content-wrap">
        <p>PC 앞 이미지</p>
        <ModifiableImage
          class="pc-img"
          type="pc"
          :index="project.frontImg.index"
          :src="project.frontImg.pcPath"
          @modify="onModify"
        />
      </div>
      <div class="content-wrap">
        <p>PC 뒷 이미지</p>
        <ModifiableImage
          class="pc-img"
          type="pc"
          :index="project.backImg.index"
          :src="project.backImg.pcPath"
          @modify="onModify"
        />
      </div>
    </div>

    <div class="back">
      <div class="content-wrap">
        <p>모바일 이미지</p>
        <ModifiableImage
          class="mobile-img"
          type="mobile"
          :index="project.frontImg.index"
          :src="project.frontImg.mobilePath"
          @modify="onModify"
        />
      </div>
    </div>

    <button
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

@Component({
  name: "PresentProjectView",
  components: {
    ModifiableImage
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

button {
  display: block;
}

@include content-wrap;
</style>
