<template>
  <div class="title-slides">
    <h2>메인 페이지 - 메인 슬라이드</h2>
    <ScalingImgList :images="mainSlides" @delete="handleDeleteMainSlide" />
    <form
      action="/uploadMainSlide.php"
      enctype="multipart/form-data"
      method="POST"
    >
      <h3>메인 슬라이드 추가</h3>
      <div class="input-wrap">
        <label for="name">슬라이드 이름</label>
        <input
          name="name"
          id="name"
          type="text"
          placeholder="빈칸만 아니면 됩니다."
        />
      </div>
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
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import axios from "axios";
import { ScalingImgList } from "@/components/Admin";
import { MainSlide } from "@/utils";

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
      const { data } = await axios.get("/getMainSlides.php");
      const list = data.data;

      this.mainSlides = list;
    } catch (error) {
      alert("홈페이지 메인 슬라이드 로딩 실패");
      console.log(error);
    }
  }

  private async handleDeleteMainSlide(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await axios.post("/deleteMainSlide.php", {
          index: index
        });

        alert("이미지 삭제에 성공 했습니다.");
        location.reload();
      }
    } catch (error) {
      alert("이미지 삭제에 실패 했습니다.");
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
