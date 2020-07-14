<template>
  <div class="scaling-img-list">
    <div class="slide" v-for="(value, index) in images" :key="index">
      <div class="content-wrap">
        <p>상품 이름 : {{ value.itemName }}</p>
        <p>상품 설명 : {{ value.itemDesc }}</p>
        <p><a :href="value.link">상품 링크</a></p>
      </div>
      <div class="content-wrap">
        <p>모바일 이미지</p>
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

@include content-wrap;

button {
  display: block;
}
</style>
