<template>
  <div class="onlinemall-slides">
    <h2>홈 페이지 온라인 몰 슬라이드</h2>
    <OnlineMallImgList
      :images="onlineMallItems"
      @delete="handleDeleteOnlineMallItem"
    />
    <form v-on:submit.prevent="onSubmit">
      <h3>상품 추가</h3>
      <div class="input-wrap">
        <label for="itemName">상품 이름</label>
        <input ref="itemName" id="itemName" type="text" />
      </div>
      <div class="input-wrap">
        <label for="itemDesc">상품 설명</label>
        <input ref="itemDesc" id="itemDesc" type="text" />
      </div>
      <div class="input-wrap">
        <label for="link">상품 링크</label>
        <input ref="link" id="link" type="text" />
      </div>
      <div class="input-wrap">
        <label for="pcImage">PC 사이즈 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap">
        <label for="mobileImage">모바일 사이즈 이미지</label>
        <input
          ref="mobileImage"
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
import { OnlineMallImgList } from "@/components/Admin";
import { AxiosHelper, OnlineMallItem } from "@/utils";

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
      const { data } = await AxiosHelper.GET("/getOnlineMallItems.php");
      const list = data.data;

      this.onlineMallItems = list;
    } catch (error) {
      alert("홈페이지 온라인 몰 아이템 로딩 실패");
      console.log(error);
    }
  }

  private async onSubmit() {
    const itemName = this.$refs["itemName"] as HTMLInputElement;
    const itemDesc = this.$refs["itemDesc"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (!pcImage.files || !mobileImage.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (
      itemName.value &&
      itemDesc.value &&
      link.value &&
      pcImage.files.length > 0 &&
      mobileImage.files.length > 0
    ) {
      const formData = new FormData();
      formData.append("itemName", itemName.value);
      formData.append("itemDesc", itemDesc.value);
      formData.append("link", link.value);
      formData.append("pcImage", pcImage.files[0]);
      formData.append("mobileImage", mobileImage.files[0]);

      try {
        const { data } = await AxiosHelper.POST(
          "/uploadOnlineMallItem.php",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          }
        );

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }
    } else {
      alert("모든 정보를 채워주세요.");
    }

    itemName.value = itemName.defaultValue;
    itemDesc.value = itemDesc.defaultValue;
    link.value = link.defaultValue;
    pcImage.value = pcImage.defaultValue;
    mobileImage.value = mobileImage.defaultValue;

    await this.LoadData();
  }

  private async handleDeleteOnlineMallItem(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteOnlineMallItem.php", {
          index: index
        });

        alert("삭제에 성공 했습니다.");
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
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
