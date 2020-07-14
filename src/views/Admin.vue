<template>
  <div class="admin">
    <h1>소녀방앗간 관리자 페이지</h1>
    <div class="login-form" v-if="!isLogin">
      <Login />
    </div>
    <div class="manage-list" v-else>
      <ul class="menu-list">
        <li><router-link to="/admin/mainslide">메인 슬라이드</router-link></li>
        <li><router-link to="/admin/onlinemall">온라인 몰</router-link></li>
        <li><router-link to="/admin/store">식사 공간</router-link></li>
      </ul>
      <router-view></router-view>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Login } from "@/components/Admin";

@Component({
  name: "Admin",
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
    } else {
      this.isLogin = false;
    }
  }
}
</script>

<style lang="scss" scoped>
h1 {
  font-size: 24px;
}

h2 {
  font-size: 20px;
}

.manage-list {
  width: 100%;
  height: 100%;
  padding: 0 5%;

  .menu-list {
    display: flex;
    flex-direction: row;

    li {
      list-style-type: circle;
      margin-right: 30px;
    }
  }

  & > * {
    margin: 16px 0;
  }
}
</style>
