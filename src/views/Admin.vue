<template>
  <div class="admin">
    <h1>소녀방앗간 관리자 페이지</h1>
    <div class="login-form" v-if="!isLogin">
      <Login />
    </div>
    <div class="manage-list" v-else>
      <div class="title-slides">
        <h2>홈페이지 메인 슬라이드</h2>
        <ScalingImgList :images="mainSlides" @delete="handleDeleteMainSlide" />
        <form
          class="form-main-slide"
          action="/uploadMainSlide.php"
          enctype="multipart/form-data"
          method="POST"
        >
          <h3>슬라이드 추가</h3>
          <label for="name">슬라이드 이름</label>
          <input name="name" id="name" type="text" />
          <label for="pcImage">PC 사이즈 이미지</label>
          <input name="pcImage" id="pcImage" type="file" accept="image/*" />
          <label for="mobileImage">모바일 사이즈 이미지</label>
          <input
            name="mobileImage"
            id="mobileImage"
            type="file"
            accept="image/*"
          />
          <button type="submit">업로드</button>
        </form>
      </div>
      <div class="onlinemall-slides">
        <h2>홈 페이지 온라인 몰 슬라이드</h2>
        <OnlineMallImgList
          :images="onlineMallItems"
          @delete="handleDeleteOnlineMallItem"
        />
        <form
          class="form-main-slide"
          action="/uploadOnlineMallItem.php"
          enctype="multipart/form-data"
          method="POST"
        >
          <h3>상품 추가</h3>
          <label for="itemName">상품 이름</label>
          <input name="itemName" id="itemName" type="text" />
          <label for="itemDesc">상품 설명</label>
          <input name="itemDesc" id="itemDesc" type="text" />
          <label for="link">상품 링크</label>
          <input name="link" id="link" type="text" />
          <label for="pcImage">PC 사이즈 이미지</label>
          <input name="pcImage" id="pcImage" type="file" accept="image/*" />
          <label for="mobileImage">모바일 사이즈 이미지</label>
          <input
            name="mobileImage"
            id="mobileImage"
            type="file"
            accept="image/*"
          />
          <button type="submit">업로드</button>
        </form>
      </div>
      <div class="store">
        <h2>식사 공간</h2>
        <StoreList :stores="stores" @delete="handleDeleteOnlineMallItem" />
        <form
          class="form-main-slide"
          action="/uploadStore.php"
          enctype="multipart/form-data"
          method="POST"
        >
          <h3>매장 추가</h3>
          <label for="storeName">매장 이름</label>
          <input name="storeName" id="storeName" type="text" />
          <label for="link">매장 외부 링크</label>
          <input name="link" id="link" type="text" />
          <label for="pcImage">홈페이지 PC 이미지</label>
          <input name="pcImage" id="pcImage" type="file" accept="image/*" />
          <label for="mobileImage">홈페이지 모바일 이미지</label>
          <input
            name="mobileImage"
            id="mobileImage"
            type="file"
            accept="image/*"
          />
          <button type="submit">업로드</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import axios from "axios";
import {
  Login,
  ScalingImgList,
  OnlineMallImgList,
  StoreList
} from "@/components/Admin";
import { MainSlide, OnlineMallItem, Store } from "@/utils";

@Component({
  name: "Brand",
  components: {
    Login,
    ScalingImgList,
    OnlineMallImgList,
    StoreList
  }
})
export default class Admin extends Vue {
  private isLogin = false;
  private grade = 0;
  private name = "";

  private mainSlides: MainSlide[] = [];
  private onlineMallItems: OnlineMallItem[] = [];
  private stores: Store[] = [];

  async created() {
    const loginData = this.$cookies.get("login_data");
    if (loginData) {
      this.grade = loginData.data.grade;
      this.name = loginData.data.name;

      this.isLogin = true;

      await this.LoadData();
    } else {
      this.isLogin = false;
    }
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

    try {
      const { data } = await axios.get("/getOnlineMallItems.php");
      const list = data.data;

      this.onlineMallItems = list;
    } catch (error) {
      alert("홈페이지 온라인 몰 아이템 로딩 실패");
      console.log(error);
    }

    try {
      const { data } = await axios.get("/getStore.php");
      const list = data.data;

      this.stores = list;
      console.log(this.stores);
    } catch (error) {
      alert("식사공간 로딩 실패");
      console.log(error);
    }
  }

  private async handleDeleteMainSlide(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        const { data } = await axios.post("/deleteMainSlide.php", {
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

  private async handleDeleteOnlineMallItem(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        const { data } = await axios.post("/deleteOnlineMallItem.php", {
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
admin {
  position: relative;
}
h1 {
  font-size: 24px;
}

.manage-list {
  width: 100%;
  height: 100%;
  padding: 0 5%;

  & > * {
    margin: 16px 0;
  }
}

[class^="form"] {
  & > * {
    margin-bottom: 6px;
  }

  input {
    display: block;
  }
}
</style>
