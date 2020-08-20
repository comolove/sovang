<template>
  <main>
    <Header />
    <HomeContent title="알립니다">
      <div class="title">
        [알림] 소녀방앗간 공식홈페이지 리뉴얼 소식을 전합니다.
      </div>
      <div class="content">
        2020년 8월, 소녀방앗간 공식홈페이지가 새롭게 리뉴얼 되었습니다.
        <br /><br />2014년 10월부터 많은 분들이 소녀방앗간을 아껴주신 덕분에 지난 5년간 저희는 식사공간
        <br v-if="!isMobile" />이상으로 다양한 서비스를 시도하며 조금씩이나마 다방면으로 더욱 성장해올 수 있었습니다.
        <br /><br />소녀방앗간을 아껴주시는 많은 고객, 기업, 단체들에서 저희가 제공하는 서비스를 조금 더
        <br v-if="!isMobile" />편리하게 접하시고, 경험하실 수  있도록 리뉴얼을 하였습니다. 고객분들과의 소통에 더욱
        <br v-if="!isMobile" />힘쓰며, 앞으로도 꾸준한 소녀방앗간이 되겠습니다. 감사합니다 :)  
      </div>
      <div class="written-by">
        <span class="author">소녀방앗간</span>
        <span class="date">2020 - 08 - 22</span>
      </div>
      <div class="goList">
        <a @click="goBack">목록</a>
      </div>
    </HomeContent>
    <Footer />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Header, Footer, HomeContent, NoticeSummary } from "@/components";
import Breakpoint from "@/utils/screenSize";

@Component({
  name: "Notice",
  components: {
    Header,
    Footer,
    HomeContent,
    NoticeSummary
  }
})
export default class Notice extends Vue {
  private currentIndex = "";
  private isMobile = false;

  created() {
    this.currentIndex = this.$route.params.index;
  }

  mounted() {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;
  }

  goBack() {
    window.history.back();
  }
  //DB에서 currentIndex에 해당하는 정보 가져오기
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin: 4.688vw 0 3.646vw 14.323vw;
  width: 71.354vw; 

  @include mobile {
    margin: 6.944vw 0 11.677vw 8.889vw;
    width: 81.944vw;
  }

  div {
    background: #f3f0ed;
    color: #595757;
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.5;
    text-align: center;

    @include mobile {
      font-size: 3.333vw;
      line-height: 1.42;
    }

    &.title {
      font-weight: bold;
      padding: 1.302vw 0 1.146vw;
      border-top: 1px solid #a19b95;
      border-bottom: 1px solid #a19b95;

      @include mobile {
        padding: 3.194vw 0; 
      }
    }

    &.content {
      padding: 3.75vw 0 3.281vw;

      @include mobile {
        text-align: justify;
        word-break: keep-all;
        padding: 9.028vw 2.917vw 8.75vw 2.917vw;
      }
    }

    &.written-by {
      padding: 1.302vw 0;
      border-top: 1px solid #a19b95;
      border-bottom: 1px solid #a19b95;
      text-align: right;

      @include mobile {
        padding: 3.611vw 0;
        font-size: 2.778vw;
      }

      .author {
        padding-right: 1.667vw;
        
        @include mobile {
          padding-right: 3.333vw;
        }
      }

      .date {
        padding-right: 1.458vw;

        @include mobile {
          padding-right: 1.944vw;
        }
      }
    }
  }

  .goList{
    text-align: right;
    background: white;
    padding-top: 1.25vw;

    @include mobile {
      padding-top: 3.889vw;
    }

    a {
      text-decoration: none;
      padding: 0.104vw 0.833vw;
      border: 1px solid #a19b95;

      @include mobile {
        font-size: 2.778vw;
        padding: 0 1.944vw;
      }
    }
  }
}
</style>