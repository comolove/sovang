<template>
  <div class="manage-container">
    <header>
      <h2>소녀방앗간 명절선물</h2>
    </header>
    <div class="selector">
      <select ref="storySelector" @change="selectStory">
        <option value="-1">소녀방앗간 명절선물을 선택해 주세요</option>  
        <option
          v-for="(item, index) in cateringStories"
          :key="index"
          :value="index"
        >
          {{ item.title }}
        </option>
      </select>
    </div>
    <PresentItemView
      :story="selectedStory"
      @modify="onModify"
      @delete="onDelete"
    />
    <hr/>
    <form v-on:submit.prevent="onSubmit">
      <h3>소녀방앗간 명절선물 {{selectedStory ? "변경" : "추가"}}</h3>
      <div class="input-wrap">
        <label for="title">제목</label>
        <input ref="title" id="title" type="text" v-model="title"/>
      </div>
      <div class="input-wrap">
        <label for="desc">설명</label>
        <input ref="desc" id="desc" type="text" v-model="desc"/>
      </div>
      <div class="input-wrap">
        <label for="popup_title">팝업내 제목</label>
        <input ref="popup_title" id="popup_title" type="text" v-model="popupTitle"/>
      </div>
      <div class="input-wrap">
        <label for="desc" style="margin-bottom: 6px;">팝업내 내용</label>
        <quill-editor
          v-model="content"
          :options="editorOption"
      />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="thumbPcImg">PC 이미지</label>
        <input
          ref="thumbPcImg"
          id="thumbPcImg"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="thumbMobileImg">모바일 이미지</label>
        <input
          ref="thumbMobileImg"
          id="thumbMobileImg"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="bodyPcImage">팝업내 PC 이미지</label>
        <input
          ref="bodyPcImage"
          id="bodyPcImage"
          type="file"
          accept="image/*"
        />
      </div>
      <div class="input-wrap" v-if="!selectedStory">
        <label for="bodyMobileImage">팝업내 모바일 이미지</label>
        <input
          ref="bodyMobileImage"
          id="bodyMobileImage"
          type="file"
          accept="image/*"
        />
      </div>

      <button :class="selectedStory ? 'blue-button' : 'green-button'" type="submit">{{selectedStory ? "변경" : "업로드"}}</button>
    </form>
  </div>
</template>

<script lang="js">
import { Vue, Component, Ref, Watch } from "vue-property-decorator";
import { PresentItemView } from "@/components/Admin";
import { AxiosHelper, PresentItem } from "@/utils";

import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

import { quillEditor } from 'vue-quill-editor';

@Component({
  components: {
    PresentItemView,
    quillEditor
  }
})
export default class AdminPresentItem extends Vue {
  @Ref() storySelector;

  editorOption = { }

  cateringStories = [];
  selectedStory = new PresentItem();
  
  title = "";
  desc = "";
  content = "";
  popupTitle = "";

  async created() {
    await this.LoadData();
  }

  @Watch("cateringStories")
  async onChangeItems() {
    this.selectStory();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentItem.php");
      const list = data.data;

      this.cateringStories = list;
    } catch (error) {
      alert("소녀방앗간 명절선물 로딩 실패");
      console.log(error);
    }
  }

  async onModify() {
    await this.LoadData();
  }

  selectStory() {
    let index = 0;

    if (this.storySelector) {
      index = parseInt(this.storySelector.value);

      if (isNaN(index) || !index) {
        index = 0;
      }
    }

    if (this.cateringStories.length === 0) {
      this.selectedStory = new PresentItem();
    } else if (this.cateringStories.length < index) {
      index = 0;
    }

    this.selectedStory = this.cateringStories[index];
    if (this.selectedStory) {
      this.title = this.selectedStory.title;
      this.desc = this.selectedStory.desc;
      this.popupTitle = this.selectedStory.popupTitle;
      this.content = this.selectedStory.body;
    }
  }

  async onSubmit() {
    const title = this.$refs["title"];
    const desc = this.$refs["desc"];
    const popupTitle = this.popupTitle;
    const body = this.content;
    const thumbPcImg = this.$refs["thumbPcImg"];
    const thumbMobileImg = this.$refs["thumbMobileImg"];
    const bodyPcImage = this.$refs["bodyPcImage"];
    const bodyMobileImage = this.$refs["bodyMobileImage"];

    if (this.selectedStory) {
      try {
         const { data } = await AxiosHelper.POST("/modifyPresentItem.php", {
           index : this.selectedStory.index,
           title : title.value,
           desc : desc.value,
           popupTitle : popupTitle,
           body : body
        });

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }
    }
    else {
      if (
        !thumbPcImg.files ||
        !thumbMobileImg.files ||
        !bodyPcImage.files ||
        !bodyMobileImage.files
      ) {
        alert("이미지를 업로드 해주세요");
        return;
      }

      if (
        title.value &&
        desc.value &&
        thumbPcImg.files.length > 0 &&
        thumbMobileImg.files.length > 0 &&
        bodyPcImage.files.length > 0 &&
        bodyMobileImage.files.length > 0
      ) {
        const formData = new FormData();
        formData.append("title", title.value);
        formData.append("desc", desc.value);
        formData.append("popupTitle", popupTitle);
        formData.append("body", body);
        formData.append("thumbPcImg", thumbPcImg.files[0]);
        formData.append("thumbMobileImg", thumbMobileImg.files[0]);
        formData.append("bodyPcImage", bodyPcImage.files[0]);
        formData.append("bodyMobileImage", bodyMobileImage.files[0]);

        try {
          const { data } = await AxiosHelper.POST(
            "/uploadPresentItem.php",
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

  async onDelete(index) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deletePresentItem.php", {
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
