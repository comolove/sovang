<template>
  <div class="scaling-img-list">
    <div class="slide" v-for="(value, index) in images" :key="index">
      <h3 class="name">{{ value.itemName }}</h3>
      <p class="desc">{{ value.itemDesc }}</p>
      <p class="link">{{ value.link }}</p>
      <img class="pc-img" :src="value.img.pcPath" />
      <img class="mobile-img" :src="value.img.mobilePath" />
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
.scaling-img-list {
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;

  .slide {
    margin-right: 15px;

    & > * {
      margin-bottom: 10px;
    }

    img {
      display: block;
    }

    .pc-img {
      width: 460px;
      height: auto;
      object-fit: cover;
    }

    .mobile-img {
      width: 290px;
      height: auto;
      object-fit: cover;
    }
  }
}

button {
  display: block;
}
</style>
