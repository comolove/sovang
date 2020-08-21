<template>
  <div class="manage-container">
    <header>
      <h2>청청케이터링 이야기</h2>
    </header>
    <div class="selector">
      <select ref="storySelector" @change="selectStory">
        <option value="-1">케이터링 이야기를 선택해 주세요</option>  
        <option
          v-for="(item, index) in cateringStories"
          :key="index"
          :value="index"
        >
          {{ item.title }}
        </option>
      </select>
    </div>
    <CateringStoryView
      :story="selectedStory"
      @modify="onModify"
      @delete="onDelete"
    />
    <hr/>
    <form v-on:submit.prevent="onSubmit">
      <h3>청정케이터링 이야기 {{selectedStory ? "변경" : "추가"}}</h3>
      <div class="input-wrap">
        <label for="title">제목</label>
        <input ref="title" id="title" type="text" :value="selectedStory ? selectedStory.title : ''"/>
      </div>
      <div class="input-wrap">
        <label for="desc">설명</label>
        <input ref="desc" id="desc" type="text" :value="selectedStory ? selectedStory.desc : ''"/>
      </div>
      <div class="input-wrap">
        <label for="link">블로그 링크</label>
        <input ref="link" id="link" type="text" placeholder="빈칸 가능" :value="selectedStory ? selectedStory.link : ''" />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="frontPcImage">PC 흑백 이미지</label>
        <input
          ref="frontPcImage"
          id="frontPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="frontMobileImage">모바일 흑백 이미지</label>
        <input
          ref="frontMobileImage"
          id="frontMobileImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="backPcImage">PC 컬러 이미지</label>
        <input
          ref="backPcImage"
          id="backPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="backMobileImage">모바일 컬러 이미지</label>
        <input
          ref="backMobileImage"
          id="backMobileImage"
          type="file"
          accept="image/*"
        />
      </div>

      <button :class="selectedStory ? 'blue-button' : 'green-button'" type="submit">{{selectedStory ? "변경" : "업로드"}}</button>
    </form>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Ref, Watch } from "vue-property-decorator";
import { CateringStoryView } from "@/components/Admin";
import { AxiosHelper, CateringStory } from "@/utils";

@Component({
  components: {
    CateringStoryView
  }
})
export default class AdminCateringStory extends Vue {
  @Ref() storySelector!: HTMLSelectElement;

  private cateringStories: CateringStory[] = [];
  private selectedStory: CateringStory = new CateringStory();

  async created() {
    await this.LoadData();
  }

  @Watch("cateringStories")
  private async onChangeItems() {
    this.selectStory();
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

  private async onModify() {
    await this.LoadData();
  }

  private selectStory() {
    let index = 0;

    if (this.storySelector) {
      index = parseInt(this.storySelector.value);

      if (isNaN(index) || !index) {
        index = 0;
      }
    }

    if (this.cateringStories.length === 0) {
      this.selectedStory = new CateringStory();
    } else if (this.cateringStories.length < index) {
      index = 0;
    }

    this.selectedStory = this.cateringStories[index];
  }

  private async onSubmit() {
    const title = this.$refs["title"] as HTMLInputElement;
    const desc = this.$refs["desc"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const frontPcImage = this.$refs["frontPcImage"] as HTMLInputElement;
    const frontMobileImage = this.$refs["frontMobileImage"] as HTMLInputElement;
    const backPcImage = this.$refs["backPcImage"] as HTMLInputElement;
    const backMobileImage = this.$refs["backMobileImage"] as HTMLInputElement;

    if (this.selectedStory) {
      try {
         const { data } = await AxiosHelper.POST("/modifyCateringStory.php", {
           index : this.selectedStory.index,
           title : title.value,
           desc : desc.value,
           link : link.value
        });

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }
    }
    else {
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
        formData.append("link", link.value);
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
    }

    await this.LoadData();
  }

  async onDelete(index: number) {
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
@import "../../assets/styles/admin/manage-container";
</style>
