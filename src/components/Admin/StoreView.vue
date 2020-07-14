<template>
  <div class="store">
    <h3 class="store-name">{{ store.storeName }}</h3>
    <p class="store-link">{{ store.itemDesc }}</p>
    <img class="home-pc-img" :src="store.img.pcPath" />
    <img class="home-mobile-img" :src="store.img.mobilePath" />
    <div class="store-imgs">
      <div class="image" v-for="(value, index) in store.imgList" :key="index">
        <img class="pc-img" :src="value.pcPath" />
        <img class="mobile-img" :src="value.mobilePath" />
      </div>

      <form
        class="form-main-slide"
        action="/uploadStoreImage.php"
        enctype="multipart/form-data"
        method="POST"
      >
        <h3>식사공간 페이지 이미지 추가</h3>
        <input type="hidden" name="storeIndex" :value="store.index" />
        <label for="pcImage">PC 이미지</label>
        <input name="pcImage" id="pcImage" type="file" accept="image/*" />
        <label for="mobileImage">모바일 이미지</label>
        <input
          name="mobileImage"
          id="mobileImage"
          type="file"
          accept="image/*"
        />
        <button type="submit">업로드</button>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { Store } from "@/utils";

@Component
export default class StoreView extends Vue {
  @Prop() store!: Store;

  protected handleModify(index: number) {
    this.$emit("modify", index);
  }

  protected handleDelete(index: number) {
    this.$emit("delete", index);
  }
}
</script>

<style scoped lang="scss">
button,
img {
  display: block;
}

.store-imgs {
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
}
</style>
