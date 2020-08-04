<template>
  <div class="scaling-img-list">
    <div class="slide" v-for="(value, index) in projects" :key="index">
      <div class="content-wrap">
        <p>이름 : {{ value.title }}</p>
        <p>설명 : {{ value.desc }}</p>
      </div>
      <div class="front">
        <div class="content-wrap">
          <p>PC 앞 이미지</p>
          <img class="pc-img" :src="value.frontImg.pcPath" />
        </div>
        <div class="content-wrap">
          <p>PC 뒷 이미지</p>
          <img class="pc-img" :src="value.backImg.pcPath" />
        </div>
      </div>
      <div class="back">
        <div class="content-wrap">
          <p>모바일 이미지</p>
          <img class="mobile-img" :src="value.frontImg.mobilePath" />
        </div>
      </div>

      <!-- <button @click="() => {handleModify(value.index)}">이미지 수정</button> -->
      <button
        @click="
          () => {
            handleDelete(value.index);
          }
        "
      >
        삭제
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { PresentProject } from "@/utils";

@Component
export default class PresentProjectList extends Vue {
  @Prop() projects!: PresentProject[];

  protected handleModify(index: number) {
    this.$emit("modify", index);
  }

  protected handleDelete(index: number) {
    this.$emit("delete", index);
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";

.scaling-img-list {
  display: flex;
  flex-direction: row;
  margin-top: 10px;
}

.slide {
  margin-right: 20px;
}

@include content-wrap;

button {
  display: block;
}
</style>
