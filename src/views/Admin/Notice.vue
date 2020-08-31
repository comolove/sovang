<template>
  <div class="manage-container">
    <header>
      <h2>알립니다(PC)</h2>
    </header>
    <div class="selector">
      <select ref="noticeSelector" @change="onNoticeSelect">
        <option value="-1">새 알립니다 만들기</option>
        <option
          v-for="(notice, index) in noticeList"
          :key="index"
          :value="index"
        >
          {{ notice.title }}
        </option>
      </select>
    </div>
    <form v-on:submit.prevent="onSubmit">
      <div class="input-wrap">
        <label for="title">제목</label>
        <input 
          v-model="title"
          type="text" 
          name="title"
          placeholder="이곳에 알립니다 공지 제목을 써주세요"
          />
      </div>
      <quill-editor
        ref="myQuillEditor"
        v-model="content"
        :options="editorOption"
      />
      <div>
        <button 
          :class="index >= 0 ? 'blue-button half' : 'green-button'"
          type="submit"
        >
          {{index >= 0 ? "변경" : "업로드"}}
        </button>
        <button type="button" class="red-button half" v-if="index >= 0" @click="onNoticeDelete">삭제</button>
      </div>
    </form>
  </div>
</template>

<script lang="js">
import { Component, Vue, Ref, Watch } from "vue-property-decorator";
import { AxiosHelper } from "@/utils";

import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

import { quillEditor } from 'vue-quill-editor';

@Component({
  name: "Notice",
  components: {
    quillEditor
  }
})
export default class Notice extends Vue {
    noticeList = [];

    index = -1;
    title = "";
    content = "";

    editorOption = { }

    async created() {
      await this.LoadData();
    }

    async LoadData() {
      this.noticeList = [];

      try {
        const { data } = await AxiosHelper.GET("/getNotice.php");

        this.noticeList = data.data;
      } catch (error) {
        console.log("로딩 실패");
        console.log(error.response);
      }

      this.selectNotice();
    }

    async onSubmit() {
      if (this.index == -1) {
        try {
          await AxiosHelper.POST("/insertNotice.php", {
            title : this.title,
            content : this.content,
            author : "소녀방앗간"
          });

          alert("알립니다 업로드 성공");
        }
        catch (error) {
          console.log(error);
          alert("업로드 실패");
        }
      }
      else {
        try {
          await AxiosHelper.POST("/modifyNotice.php", {
            index : this.noticeList[this.index].index,
            title : this.title,
            content : this.content,
            author : "소녀방앗간"
          });

          alert("알립니다 수정 성공");
        }
        catch (error) {
          console.log(error);
          alert("수정 실패");
        }
      }

      await this.LoadData();
    }

    async onNoticeDelete() {
      try {
        await AxiosHelper.POST("/deleteNotice.php", {
          index : this.noticeList[this.index].index
        });

        alert("삭제 성공");
        await this.LoadData();
      } 
      catch (error) {
        console.log(error);
        alert("삭제 실패");
      }
    }

    onNoticeSelect() {
      this.selectNotice();
    }

    selectNotice() {
      const noticeSelector = this.$refs.noticeSelector;

      if (noticeSelector) {
        this.index = parseInt(noticeSelector.value);
      }

      if (this.index >= 0 && this.noticeList.length > 0) {
        this.title = this.noticeList[this.index].title;
        this.content = this.noticeList[this.index].content;
      }
      else {
        this.title = "";
        this.content = "";
        this.index = -1;
      }
    }
}
</script>

<style lang="scss" scoped>
@import "../../assets/styles/admin/manage-container";

button {
  margin-top: 24px;
  transition: none;
  width: 50%;

  &.green-button {
    width: 100%;
  }
}

.half {
  display: inline !important;
}
</style>
