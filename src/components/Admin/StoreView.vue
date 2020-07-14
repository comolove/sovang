<template>
  <div class="store">
    <div class="content-wrap">
      <p>매장 이름 : {{ store.storeName }}</p>
      <p><a :href="store.link">매장 링크</a></p>
    </div>
    <div class="content-wrap">
      <p>메인 페이지 매장 이미지</p>
      <div class="content-wrap">
        <p>PC 이미지</p>
        <img class="pc-img" :src="store.img.pcPath" />
      </div>
      <div class="content-wrap">
        <p>모바일 이미지</p>
        <img class="mobile-img" :src="store.img.mobilePath" />
      </div>
    </div>
    <p>식사 공간 페이지 매장 이미지 목록</p>
    <div class="store-imgs">
      <div
        class="content-wrap image"
        v-for="(value, index) in store.imgList"
        :key="index"
      >
        <p>PC 이미지</p>
        <img class="pc-img" :src="value.pcPath" />
        <p>모바일 이미지</p>
        <img class="mobile-img" :src="value.mobilePath" />
        <button
          @click="
            () => {
              handleDeleteImage(store.index, index);
            }
          "
        >
          이미지 삭제
        </button>
      </div>

      <form
        class="form"
        action="/uploadStoreImage.php"
        enctype="multipart/form-data"
        method="POST"
      >
        <h3>식사공간 페이지 이미지 추가</h3>
        <input type="hidden" name="storeIndex" :value="store.index" />
        <div class="input-wrap">
          <label for="pcImage">PC 이미지</label>
          <input name="pcImage" id="pcImage" type="file" accept="image/*" />
        </div>
        <div class="input-wrap">
          <label for="mobileImage">모바일 이미지</label>
          <input
            name="mobileImage"
            id="mobileImage"
            type="file"
            accept="image/*"
          />
        </div>

        <button type="submit">업로드</button>
      </form>
    </div>
    <button
      @click="
        () => {
          handleDeleteStore(store.index);
        }
      "
    >
      매장 삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import axios from "axios";
import { Store } from "@/utils";

@Component
export default class StoreView extends Vue {
  @Prop() store!: Store;

  private async handleDeleteStore(storeIndex: number) {
    try {
      if (confirm("매장을 삭제하시겠습니까?")) {
        await axios.post("/deleteStore.php", {
          storeIndex: storeIndex
        });

        alert("삭제에 성공 했습니다.");
        location.reload();
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
      location.reload();
    }
  }

  protected async handleDeleteImage(storeIndex: number, imageIndex: number) {
    try {
      if (confirm("이미지를 삭제하시겠습니까?")) {
        await axios.post("/deleteStoreImage.php", {
          storeIndex: storeIndex,
          imageIndex: imageIndex
        });

        alert("삭제에 성공 했습니다.");
        location.reload();
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
      location.reload();
    }
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";

button {
  display: block;
}

.store-imgs {
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;

  .image {
    margin-right: 20px;
  }
}

@include form-type-1;
@include content-wrap;
</style>
