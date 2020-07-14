<template>
  <div class="onlinemall-slides">
    <h2>홈 페이지 온라인 몰 슬라이드</h2>
    <OnlineMallImgList
      :images="onlineMallItems"
      @delete="handleDeleteOnlineMallItem"
    />
    <form
      class="form-main-slide"
      action="/uploadOnlineMallItem.php"
      enctype="multipart/form-data"
      method="POST"
    >
      <h3>상품 추가</h3>
      <div class="input-wrap">
        <label for="itemName">상품 이름</label>
        <input name="itemName" id="itemName" type="text" />
      </div>
      <div class="input-wrap">
        <label for="itemDesc">상품 설명</label>
        <input name="itemDesc" id="itemDesc" type="text" />
      </div>
      <div class="input-wrap">
        <label for="link">상품 링크</label>
        <input name="link" id="link" type="text" />
      </div>
      <div class="input-wrap">
        <label for="pcImage">PC 사이즈 이미지</label>
        <input name="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap">
        <label for="mobileImage">모바일 사이즈 이미지</label>
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
import axios from "axios";
import { OnlineMallImgList } from "@/components/Admin";
import { OnlineMallItem } from "@/utils";

@Component({
  name: "AdminOnlineMall",
  components: {
    OnlineMallImgList
  }
})
export default class AdminOnlineMall extends Vue {
  private onlineMallItems: OnlineMallItem[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await axios.get("/getOnlineMallItems.php");
      const list = data.data;

      this.onlineMallItems = list;
    } catch (error) {
      alert("홈페이지 온라인 몰 아이템 로딩 실패");
      console.log(error);
    }
  }

  private async handleDeleteOnlineMallItem(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await axios.post("/deleteOnlineMallItem.php", {
          index: index
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

<style lang="scss" scoped>
@import "../../assets/styles/layouts";

h2 {
  font-size: 20px;
}

@include form-type-1;
</style>
