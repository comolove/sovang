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
        <li>
          <router-link to="/admin/cateringstory">케이터링 이야기</router-link>
        </li>
        <li>
          <router-link to="/admin/presentproject"
            >명절선물 기획 프로젝트</router-link
          >
        </li>
        <li>
          <a href="/downloadCateringOrders.php">다운로드 케이터링 주문</a>
        </li>
        <li>
          <a href="/downloadPresentOrders.php">다운로드 명절선물 컨설팅</a>
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

  /*

  async downloadCatering() {
    console.log("Download catering");

    try {
      const workbook = XLSX.utils.book_new();

      const { data } = await AxiosHelper.GET("/getCateringOrders.php");
      
      const cateringOrders = data.data.map((element : CateringOrder) => {
        return {
          "단체명" : element.organization,
          "담당자" : element.personInCharge,
          "연락처" : element.hp,
          "이메일" : element.email,
          "날짜/시간" : element.date,
          "인원" : element.headcount,
          "결제방법" : element.payType,
          "주소" : element.address,
          "카테고리" : element.category,
          "메뉴구성" : element.menuSet,
          "메뉴항목" : element.menuItem,
          "추가메뉴" : element.extraMenu,
          "추가메시지" : element.extraMessage,
          "문의 날짜" : element.createdAt
        }
      });

      const sheet = XLSX.utils.json_to_sheet(cateringOrders);
      XLSX.utils.book_append_sheet(workbook, sheet, "케이터링 주문");

      XLSX.writeFile(workbook, "케이터링 주문.xlsx");
    }
    catch (error) {
      console.log(error);
      alert("케이터링 데이터 로드 실패");
    }
  }

  async downloadPresent() {
    console.log("Download present");

    try {
      const workbook = XLSX.utils.book_new();

      const { data } = await AxiosHelper.GET("/getPresentOrders.php");

      const presentConsult = data.data.map((element : PresentConsult) => {
        return {
          "단체명" : element.organization,
          "담당자" : element.personInCharge,
          "연락처" : element.hp,
          "이메일" : element.email,
          "문의내용" : element.question,
          "문의 날짜" : element.createdAt
        }
      });

      const sheet = XLSX.utils.json_to_sheet(presentConsult);
      XLSX.utils.book_append_sheet(workbook, sheet, "명절선물 컨설팅");

      XLSX.writeFile(workbook, "명절선물 컨설팅.xlsx");
    }
    catch (error) {
      console.log(error);
      alert("명절선물 데이터 로드 실패");
    }
  }

  */
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
