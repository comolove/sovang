<template>
  <div class="store">
    <h2>식사 공간</h2>
    <StoreList :stores="stores" />
    <form
      class="form-main-slide"
      action="/uploadStore.php"
      enctype="multipart/form-data"
      method="POST"
    >
      <h3>매장 추가</h3>
      <div class="input-wrap">
        <label for="storeName">매장 이름</label>
        <input name="storeName" id="storeName" type="text" />
      </div>
      <div class="input-wrap">
        <label for="link">매장 외부 링크</label>
        <input name="link" id="link" type="text" />
      </div>
      <div class="input-wrap">
        <label for="pcImage">홈페이지 PC 이미지</label>
        <input name="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap">
        <label for="mobileImage">홈페이지 모바일 이미지</label>
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
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { StoreList } from "@/components/Admin";
import { AxiosHelper, Store } from "@/utils";

@Component({
  name: "AdminStore",
  components: {
    StoreList
  }
})
export default class AdminStore extends Vue {
  private stores: Store[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getStore.php");
      const list = data.data;

      this.stores = list;
    } catch (error) {
      alert("식사공간 로딩 실패");
      console.log(error);
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/styles/layouts";

h2 {
  font-size: 20px;
}

@include form-type-1;
</style>
