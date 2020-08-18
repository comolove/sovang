<template>
  <div class="title-slides">
    <h2>메인 페이지 - 메인 슬라이드</h2>
    <ScalingImgList :images="mainSlides" @delete="handleDeleteMainSlide" />
    <form v-on:submit.prevent="onSubmit">
      <h3>메인 슬라이드 추가</h3>
      <div class="input-wrap">
        <label for="pcImage">PC 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap">
        <label for="mobileImage">모바일 이미지</label>
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
import { ScalingImgList } from "@/components/Admin";
import { AxiosHelper, MainSlide } from "@/utils";

@Component({
  name: "AdminMainSlide",
  components: {
    ScalingImgList
  }
})
export default class AdminMainSlide extends Vue {
  private mainSlides: MainSlide[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getMainSlides.php");
      const list = data.data;

      this.mainSlides = list;
    } catch (error) {
      alert("홈페이지 메인 슬라이드 로딩 실패");
      console.log(error);
    }
  }

  private async onSubmit() {
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (!pcImage.files || !mobileImage.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (pcImage.files.length > 0 && mobileImage.files.length > 0) {
      const pcImageFile = pcImage.files[0];
      const mobileImageFile = mobileImage.files[0];

      const formData = new FormData();
      formData.append("pcImage", pcImageFile);
      formData.append("mobileImage", mobileImageFile);

      try {
        const { data } = await AxiosHelper.POST(
          "/uploadMainSlide.php",
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

      pcImage.value = pcImage.defaultValue;
      mobileImage.value = mobileImage.defaultValue;

      await this.LoadData();
    } else {
      alert("이미지를 선택해 주세요");
    }
  }

  private async handleDeleteMainSlide(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteMainSlide.php", {
          index: index
        });

        alert("이미지 삭제에 성공 했습니다.");
      }
    } catch (error) {
      alert("이미지 삭제에 실패 했습니다.");
    }

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
