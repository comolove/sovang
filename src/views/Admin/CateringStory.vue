<template>
  <div class="catering_story">
    <h2>케이터링 이야기</h2>
    <CateringStoryList :stories="cateringStories" @delete="handleDeleteStory" />
    <form v-on:submit.prevent="onSubmit">
      <h3>추가</h3>
      <div class="input-wrap">
        <label for="title">이름</label>
        <input ref="title" id="title" type="text" />
      </div>
      <div class="input-wrap">
        <label for="desc">설명</label>
        <input ref="desc" id="desc" type="text" />
      </div>
      <div class="input-wrap">
        <label for="frontPcImage">PC 흑백 이미지</label>
        <input
          ref="frontPcImage"
          id="frontPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="frontMobileImage">모바일 흑백 이미지</label>
        <input
          ref="frontMobileImage"
          id="frontMobileImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backPcImage">PC 컬러 이미지</label>
        <input
          ref="backPcImage"
          id="backPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backMobileImage">모바일 컬러 이미지</label>
        <input
          ref="backMobileImage"
          id="backMobileImage"
          type="file"
          accept="image/*"
        />
      </div>

      <button type="submit">업로드</button>
    </form>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import { CateringStoryList } from "@/components/Admin";
import { AxiosHelper, CateringStory } from "@/utils";

@Component({
  components: {
    CateringStoryList
  }
})
export default class AdminCateringStory extends Vue {
  private cateringStories: CateringStory[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getCateringStories.php");
      const list = data.data as CateringStory[];

      this.cateringStories = list;
    } catch (error) {
      alert("케이터링 이야기 로딩 실패");
      console.log(error);
    }
  }

  private async onSubmit() {
    const title = this.$refs["title"] as HTMLInputElement;
    const desc = this.$refs["desc"] as HTMLInputElement;
    const frontPcImage = this.$refs["frontPcImage"] as HTMLInputElement;
    const frontMobileImage = this.$refs["frontMobileImage"] as HTMLInputElement;
    const backPcImage = this.$refs["backPcImage"] as HTMLInputElement;
    const backMobileImage = this.$refs["backMobileImage"] as HTMLInputElement;

    if (
      !frontPcImage.files ||
      !frontMobileImage.files ||
      !backPcImage.files ||
      !backMobileImage.files
    ) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (
      title.value &&
      desc.value &&
      frontPcImage.files.length > 0 &&
      frontMobileImage.files.length > 0 &&
      backPcImage.files.length > 0 &&
      backMobileImage.files.length > 0
    ) {
      const formData = new FormData();
      formData.append("title", title.value);
      formData.append("desc", desc.value);
      formData.append("frontPcImage", frontPcImage.files[0]);
      formData.append("frontMobileImage", frontMobileImage.files[0]);
      formData.append("backPcImage", backPcImage.files[0]);
      formData.append("backMobileImage", backMobileImage.files[0]);

      try {
        const { data } = await AxiosHelper.POST(
          "/uploadCateringStory.php",
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

    title.value = title.defaultValue;
    desc.value = desc.defaultValue;
    frontPcImage.value = frontPcImage.defaultValue;
    frontMobileImage.value = frontMobileImage.defaultValue;
    backPcImage.value = backPcImage.defaultValue;
    backMobileImage.value = backMobileImage.defaultValue;

    await this.LoadData();
  }

  async handleDeleteStory(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteCateringStory.php", {
          index: index
        });

        alert("삭제에 성공 했습니다.");
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
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
