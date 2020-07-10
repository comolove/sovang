<template>
  <div class="admin">
    <h1>소녀방앗간 관리자 페이지</h1>
    <div class="login-form" v-if="!isLogin">
      <Login />
    </div>
    <div class="manage-list" v-else>
      <div class="title-slides">
        <div></div>
        <form
          action="/uploadMainSlide.php"
          enctype="multipart/form-data"
          method="POST"
        >
          <input name="type" type="hidden" value="mainSlide" />
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
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Login } from "@/components/Admin";

@Component({
  name: "Brand",
  components: {
    Login
  }
})
export default class Admin extends Vue {
  private isLogin = false;
  private grade = 0;
  private name = "";

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
    /* */
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

    input {
      display: block;
    }
  }
}
</style>
