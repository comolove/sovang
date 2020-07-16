<template>
  <div class="scaling-img-list">
    <div class="slide" v-for="(value, index) in images" :key="index">
      <div class="content-wrap">
        <p>슬라이드 이름 : {{ value.img.name }}</p>
      </div>
      <div class="content-wrap">
        <p>PC 이미지</p>
        <img class="pc-img" :src="value.img.pcPath" />
      </div>
      <div class="content-wrap">
        <p>모바일 이미지</p>
        <img class="mobile-img" :src="value.img.mobilePath" />
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
import { BaseResImgObj } from "@/utils";

@Component
export default class ScalingImgList extends Vue {
  @Prop() images!: BaseResImgObj[];

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

button {
  display: block;
}

@include content-wrap;
</style>
