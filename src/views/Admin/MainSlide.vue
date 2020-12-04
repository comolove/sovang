<template>
  <div class="manage-container">
    <header>
      <h2>메인 슬라이드</h2>
    </header>
    <div class="selector">
      <select ref="mainSlideSelector" @change="onSlideSelect">
        <option value="-1">슬라이드를 선택해 주세요</option>  
        <option
          v-for="(mainSlide, index) in mainSlides"
          :key="index"
          :value="index"
        >
          {{ index + 1 }}
        </option>
      </select>
    </div>
    <MainSlideView
      :image="selectedMainSlide"
      @modify="onModify"
      @delete="onDelete"
    />
    <hr />
    <form v-on:submit.prevent="onSubmit">
      <h3>메인 슬라이드 {{selectedMainSlide ? "변경" : "추가"}}</h3>
      <div class="input-wrap" v-if="!selectedMainSlide">
        <label for="pcImage">PC 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap" v-if="!selectedMainSlide">
        <label for="mobileImage">모바일 이미지</label>
        <input
          ref="mobileImage"
          id="mobileImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="link">링크 {{selectedMainSlide ? "변경" : "추가"}}</label>
        <input ref="link" id="link" type="text" placeholder="빈칸 가능" :value="selectedMainSlide ? selectedMainSlide.link : ''" />
      </div>
      <button :class="selectedMainSlide ? 'blue-button' : 'green-button'" type="submit">{{selectedMainSlide ? "변경" : "업로드"}}</button>
    </form>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Ref, Watch } from "vue-property-decorator";
import { MainSlideView } from "@/components/Admin";
import { AxiosHelper, MainSlide } from "@/utils";

@Component({
  name: "AdminMainSlide",
  components: {
    MainSlideView
  }
})
export default class AdminMainSlide extends Vue {
  @Ref() readonly mainSlideSelector!: HTMLSelectElement;

  private mainSlides: MainSlide[] = [];
  private selectedMainSlide: MainSlide | null = null;

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

  @Watch("mainSlides")
  private async onChangeMainSlides() {
    this.selectSlide();
  }

  private async onSubmit() {
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;

    if (this.selectedMainSlide) {
      try {
         const { data } = await AxiosHelper.POST("/modifyMainSlide.php", {
           index : this.selectedMainSlide.index,
           link : link.value
        });

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }

      await this.LoadData();
      return;
    }

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
      formData.append("link", link.value);

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

  private async onModify() {
    await this.LoadData();
  }

  private onSlideSelect() {
    this.selectSlide();
  }

  private selectSlide() {
    let index = -1;

    if (this.mainSlideSelector) {
      index = parseInt(this.mainSlideSelector.value);
    }

    if (this.mainSlides.length > 0 && this.mainSlides.length > index && index > -1) {
      this.selectedMainSlide = this.mainSlides[index];
    }
    else {
      this.selectedMainSlide = null;
    }
  }

  private async onDelete(index: number) {
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
@import "../../assets/styles/admin/manage-container";
</style>
