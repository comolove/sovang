<template>
  <div class="catering_story">
    <h2>케이터링 이야기</h2>
    <CateringStoryList :stories="cateringStories" @delete="handleDeleteStory" />
    <form
      class="form-main-slide"
      action="/uploadCateringStory.php"
      enctype="multipart/form-data"
      method="POST"
    >
      <h3>추가</h3>
      <div class="input-wrap">
        <label for="title">이름</label>
        <input name="title" id="title" type="text" />
      </div>
      <div class="input-wrap">
        <label for="desc">설명</label>
        <input name="desc" id="desc" type="text" />
      </div>
      <div class="input-wrap">
        <label for="frontPcImage">PC 흑백 이미지</label>
        <input
          name="frontPcImage"
          id="frontPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="frontMobileImage">모바일 흑백 이미지</label>
        <input
          name="frontMobileImage"
          id="frontMobileImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backPcImage">PC 컬러 이미지</label>
        <input
          name="backPcImage"
          id="backPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backMobileImage">모바일 컬러 이미지</label>
        <input
          name="backMobileImage"
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
      console.log(list);
      this.cateringStories = list;
    } catch (error) {
      alert("케이터링 이야기 로딩 실패");
      console.log(error);
    }
  }

  async handleDeleteStory(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteCateringStory.php", {
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
