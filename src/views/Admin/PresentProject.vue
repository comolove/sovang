<template>
  <div class="present-project">
    <h2>명절선물 기획 프로젝트</h2>
    <div class="present-project-selector">
      <select ref="projectSelector" @change="selectProject">
        <option
          v-for="(item, index) in presentProjects"
          :key="index"
          :value="index"
        >
          {{ index + 1 }}
        </option>
      </select>
    </div>
    <PresentProjectView
      :project="selectedProject"
      @modify="onModify"
      @delete="onDelete"
    />
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
        <label for="link">블로그 링크(빈칸 가능)</label>
        <input ref="link" id="link" type="text" />
      </div>
      <div class="input-wrap">
        <label for="frontPcImage">PC 앞 이미지</label>
        <input
          ref="frontPcImage"
          id="frontPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap">
        <label for="backPcImage">PC 뒷 이미지</label>
        <input
          ref="backPcImage"
          id="backPcImage"
          type="file"
          accept="image/*"
        />
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
import { Vue, Component, Ref, Watch } from "vue-property-decorator";
import { PresentProjectView } from "@/components/Admin";
import { AxiosHelper, PresentProject } from "@/utils";

@Component({
  components: {
    PresentProjectView
  }
})
export default class AdminPresentProject extends Vue {
  @Ref() projectSelector! : HTMLSelectElement;

  private presentProjects: PresentProject[] = [];
  private selectedProject: PresentProject = new PresentProject();

  async created() {
    await this.LoadData();
  }

  @Watch("presentProjects")
  private async onChangeItems() {
    this.selectProject();
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

  private async onModify() {
    await this.LoadData();
  }

  private selectProject() {
    let index = 0;

    if (this.projectSelector) {
      index = parseInt(this.projectSelector.value);

      if (isNaN(index) || !index) {
        index = 0;
      }
    }

    if (this.presentProjects.length === 0) {
      this.selectedProject = new PresentProject();
    } else if (this.presentProjects.length < index) {
      index = 0;
    }

    this.selectedProject = this.presentProjects[index];
  }

  private async onSubmit() {
    const title = this.$refs["title"] as HTMLInputElement;
    const desc = this.$refs["desc"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const frontPcImage = this.$refs["frontPcImage"] as HTMLInputElement;
    const backPcImage = this.$refs["backPcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (!frontPcImage.files || !backPcImage.files || !mobileImage.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (
      title.value &&
      desc.value &&
      frontPcImage.files.length > 0 &&
      backPcImage.files.length > 0 &&
      mobileImage.files.length > 0
    ) {
      const formData = new FormData();
      formData.append("title", title.value);
      formData.append("desc", desc.value);
      formData.append("link", link.value);
      formData.append("frontPcImage", frontPcImage.files[0]);
      formData.append("backPcImage", backPcImage.files[0]);
      formData.append("mobileImage", mobileImage.files[0]);

      try {
        const { data } = await AxiosHelper.POST(
          "/uploadPresentProject.php",
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
    backPcImage.value = backPcImage.defaultValue;
    mobileImage.value = mobileImage.defaultValue;

    await this.LoadData();
  }

  async onDelete(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deletePresentProject.php", {
          index: index
        });

        alert("삭제에 성공 했습니다.");
      }
    } catch (error) {
      console.log(error);
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
