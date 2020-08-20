<template>
  <div class="admin-container">
    <header>
      <h1>소녀방앗간 관리자 페이지</h1>
    </header>
    <div class="login-form" v-if="!isLogin">
      <Login />
    </div>
    <div class="manage-view" v-else>
      <ul class="menu-list-d1">
        <li>
          메인 페이지
          <ul class="menu-list-d2">
            <li><router-link to="/admin/mainslide">메인 슬라이드</router-link></li>
            <li><router-link to="/admin/onlinemall">온라인 몰</router-link></li>
          </ul>
        </li>
        <li>
          브랜드 페이지
          <ul class="menu-list-d2">
            <li><router-link to="/admin/notice">알립니다</router-link></li>
          </ul>
        </li>
        <li>
          케이터링 페이지
          <ul class="menu-list-d2">
            <li><router-link to="/admin/cateringstory">청정케이터링 이야기</router-link></li>
          </ul>
        </li>
        <li>
          명절선물 페이지
          <ul class="menu-list-d2">
            <li><router-link to="/admin/presentproject">명절선물 기획 프로젝트</router-link></li>
          </ul>
        </li>
        <li><router-link to="/admin/store">식사 공간 (매장 정보)</router-link></li>
        <li>
          <a href="/downloadCateringOrders.php">케이터링 문의 목록 다운로드</a>
        </li>
        <li>
          <a href="/downloadPresentOrders.php">명절선물 상담 목록 다운로드</a>
        </li>
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
.admin-container {
  display: block;
  position: relative;

  width: 100%;
  height: 100%;
  padding: 24px;
  
  header {
    display: block;
    margin-bottom: 30px;

    h1 {
      font-size: 24px;
    }
  }
}

.manage-view {
  overflow: hidden;
  width: 100%;
  height: 100%;
  margin-right: 30px;
  padding-left: 24px;

  a {
    color: black;
    text-decoration: none;

    &:hover {
      font-weight: bold;
    }
  }

  li {
    margin-top: 8px;
    font-size: 16px;
  }

  .menu-list-d1 {
    display: inline-block;
    position: absolute;
    width: 20%;

    > li {
      list-style-type: square;
    }
  }

  .menu-list-d2 {
    padding-left: 24px;
    margin-bottom: 10px;

    > li {
      list-style-type: disc;
    }
  }
}
</style>
