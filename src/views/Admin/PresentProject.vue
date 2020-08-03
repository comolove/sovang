<template>
  <div class="catering_story">
    <h2>명절선물 기획 프로젝트</h2>
    <PresentProjectList
      :projects="presentProjects"
      @delete="handleDeleteProject"
    />
    <form
      class="form-main-slide"
      action="/uploadPresentProject.php"
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
        <label for="frontPcImage">PC 앞 이미지</label>
        <input
          name="frontPcImage"
          id="frontPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backPcImage">PC 뒷 이미지</label>
        <input
          name="backPcImage"
          id="backPcImage"
          type="file"
          accept="image/*"
        />
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
import { Vue, Component } from "vue-property-decorator";
import { PresentProjectList } from "@/components/Admin";
import { AxiosHelper, PresentProject } from "@/utils";

@Component({
  components: {
    PresentProjectList
  }
})
export default class AdminPresentProject extends Vue {
  private presentProjects: PresentProject[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentProjects.php");
      const list = data.data as PresentProject[];

      this.presentProjects = list;
    } catch (error) {
      alert("명절선물 기획 프로젝트 로딩 실패");
      console.log(error);
    }
  }

  async handleDeleteProject(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deletePresentProject.php", {
          index: index
        });

        alert("삭제에 성공 했습니다.");
        location.reload();
      }
    } catch (error) {
      console.log(error);
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
