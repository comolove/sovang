<template>
  <div class="store">
    <h2>식사 공간</h2>
    <StoreList :stores="stores" @LoadData="LoadData" />
    <form v-on:submit.prevent="onSubmit">
      <h3>매장 추가</h3>
      <div class="input-wrap">
        <label for="storeName">매장 이름</label>
        <input ref="storeName" id="storeName" type="text" />
      </div>
      <div class="input-wrap">
        <label for="link">매장 외부 링크</label>
        <input ref="link" id="link" type="text" />
      </div>
      <div class="input-wrap">
        <label for="pcImage">홈페이지 PC 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap">
        <label for="mobileImage">홈페이지 모바일 이미지</label>
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

  private async onSubmit() {
    const storeName = this.$refs["storeName"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (!pcImage.files || !mobileImage.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (
      storeName.value ||
      link.value ||
      pcImage.files.length > 0 ||
      mobileImage.files.length > 0
    ) {
      const formData = new FormData();
      formData.append("storeName", storeName.value);
      formData.append("link", link.value);
      formData.append("pcImage", pcImage.files[0]);
      formData.append("mobileImage", mobileImage.files[0]);

      try {
        const { data } = await AxiosHelper.POST("/uploadStore.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        });

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }
    } else {
      alert("모든 정보를 채워주세요.");
    }

    storeName.value = storeName.defaultValue;
    link.value = link.defaultValue;
    pcImage.value = pcImage.defaultValue;
    mobileImage.value = mobileImage.defaultValue;

    await this.LoadData();
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
