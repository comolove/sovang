<template>
  <main class="brand" ref="main">
    <Header />
    <section class="main" ref="mainImg">
      <AssetImage :src="mainImgPath" />
    </section>
    <section class="contents" ref="contents">
      <HomeContent data-aos="fade-up" title="농촌과 도시를 잇다">
        <AssetImage
          :src="
            'brand-page/' + (isMobile ? 'Mobile' : 'WEB') + '/content-1.jpg'
          "
        />
        <div class="info-1">
          농사 장인이
          <br v-if="!isMobile" />생산한 청정재료를 <br />도시의 건강한
          먹거리로
          <br />
        </div>
        <div class="info-2">
          소녀방앗간의 먹거리는 수십 년간 평생 농사를 지어온 장인들이 고향
          땅에서 직접 키웠습니다. 식재료는 태백산맥 산악지형으로 둘러싸인
          청정지역 경북 청송에서 재배하였습니다.
          <br v-if="!isMobile" />
          <br v-if="!isMobile" />
          <span v-if="!isMobile">소녀방앗간은</span> 땅과 공기가 줄 수 있는
          에너지를 온전히 담은 재료로 청정지역 장인들의 수준 높은 식문화를
          전합니다.
        </div>
      </HomeContent>
      <HomeContent data-aos="fade-up" title="지속가능한 생산, 유통, 소비">
        <AssetImage
          :src="
            'brand-page/' + (isMobile ? 'Mobile' : 'WEB') + '/content-2.jpg'
          "
        />
        <div class="info-1">
          지속가능한 생산과
          <br v-if="!isMobile" />낭비없는 소비의 순환
        </div>
        <div class="info-2">
          오지 어르신들과 10년간 청정재료를 재배해 온 청년들이 모여 소녀방앗간을
          운영합니다. 지역 생산자들과는 꾸준하고 안정적인 거래를 이어가고, 도시
          소비자들에게는 농부의 정성어린 먹거리를 건강한 한끼로 제공하여 모두를
          위한 선순환을 만들어 갑니다.
        </div>
      </HomeContent>
      <HomeContent data-aos="fade-up" title="함께하는 로컬 네트워크">
        <!-- <div class="info-2">
          <span v-if="!isMobile">
            소녀방앗간은 '모두의 먹을거리'에 대한 진정성을 바탕으로 생산자와
            소비자 모두를 위한 농업유통을 고민합니다.
            <br />
            <br /> </span
          >지난
          <span class="highlight">10년간 전국 각지에서 150여분의 생산자</span>를
          만나, 농산물을 계약재배하여 지속가능한 농업생산물 유통전문 브랜드로
          성장해왔습니다. 소녀방앗간은 건강한 식재료를 위해 지속가능한 생산과
          낭비 없는 소비의 순환 원칙을 지켜갑니다.
        </div> -->
        <div class="info-2">
          청송, 산청, 영양, 하동, 김해, 안동, 영주, 예천, 
          <br />
          태백, 원주, 화천, 곡성, 나주, 고창, 부안, 연천 ... 
          <br />
          <br />
          소녀방앗간은 지난 10년간 전국의 먹거리 생산자들과 인연을 맺어왔습니다. 각지에서 자신의 논밭을 일구는 <span class="highlight">푸릇한 양심을 가진 농부들과 그들이 정직하게 키운 곡식은 소녀방앗간의 정체성이 되었습니다.</span> 먹거리에 대한 진정성을 바탕으로 지속가능한 생산과 낭비 없는 소비의 순환을 만들어가겠습니다.
        </div>
        <AssetImage
          :src="
            'brand-page/' + (isMobile ? 'Mobile' : 'WEB') + '/content-3.png'
          "
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="청정지역, 오지의 메리트">
        <AssetImage
          :src="
            'brand-page/' + (isMobile ? 'Mobile' : 'WEB') + '/content-4.jpg'
          "
        />
        <div class="info-2 og">
          <p>오지(奧地).</p>
          <p>집 안 아궁이에 불을 떼는 곳이라는 한자에서 유래된 오(奧). 깊고 깊은 그 곳엔, 오래 간직되어 온 따스한 온기가 있습니다.</p>
          <p>오지는 옛 삶의 방식이 고스란히 남겨져 있는 곳이자, 먹거리에 관한 오래된 유산을 이어받을 수 있는 곳이었습니다． 산 속에 핀 수많은 풀 중에 먹을 것을 골라내는 눈, 옛부터 이어져 내려온 발효음식의 전통, 계절을 대비해 식량을 갈무리하던 혜안.</p>
          <p>소녀방앗간은 오래 간직되어 온 빛나는 오지의 메리트를 찾아 지역과 도시 모두를 위로하는 공간을 만들고자 합니다.</p>
        </div>
      </HomeContent>
      <HomeContent data-aos="fade-up" title="소녀방앗간 나물이야기">
        <AssetImage
          :src="
            'brand-page/' + (isMobile ? 'Mobile' : 'WEB') + '/content-5.jpg'
          "
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="알립니다">
        <div class="summary-wrap" ref="list">
          <div class="classification" v-if="!isMobile">
            <span class="index">번호</span>
            <span class="title">글제목</span>
            <span class="author">작성자</span>
            <span class="date">작성일</span>
          </div>
          <NoticeSummary 
            v-for="index in numOfNoticeWithCurrentPage"
            :key="index"
            :notice="noticeList[(currentPage-1)*5+index-1]"
            :index="index"
            :currentPage="currentPage"
            :isMobile="isMobile"
          />
        </div>
        <div class="pagination">
          <span v-for="page in numOfPage" @click="currentPage=page" :key="page">{{page}}</span>
          <AssetImage src="go-to-next.png" @click="currentPage<numOfPage?currentPage++:currentPage" />
        </div>
      </HomeContent>
    </section>
    <AssetImage
      class="button-go-top"
      :class="{
        'button-go-top-visible': isVisible,
        'button-go-top-invisible': !isVisible
      }"
      @click="goTop"
      src="button-go-top.png"
    />
    <Footer />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import {
  Header,
  Footer,
  HomeContent,
  AssetImage,
  ImageOverlayInfo,
  NoticeSummary
} from "@/components";
import Breakpoint from "@/utils/screenSize";
import { AxiosHelper, NoticeData } from "@/utils";

@Component({
  name: "Brand",
  components: {
    Header,
    Footer,
    HomeContent,
    AssetImage,
    ImageOverlayInfo,
    NoticeSummary
  }
})
export default class Brand extends Vue {
  private isMobile = false;
  private isVisible = false;

  private mainImgPath = "brand-page/Mobile/main.jpg";
  private noticePCList: NoticeData[] = [];
  private noticeMobileList: NoticeData[] = [];
  private numOfPage = 0;
  private currentPage = 1;

  async created() {
    window.addEventListener("resize", this.handleResize);
    window.addEventListener("scroll", this.handleScroll);

    await this.LoadData();
  }

  mounted() {
    this.handleResize();
  }

  updated() {
    this.responseComponents();
  }

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
    window.removeEventListener("scroll", this.handleScroll);
  }
  
  get numOfNoticeWithCurrentPage() {
    if (this.numOfPage == 0) return 0;

    return this.currentPage == this.numOfPage ? this.noticeList.length % 5 : 5;
  }

  async LoadData() {
    try {
      const pcNoticeResult = await AxiosHelper.GET("/getNotice.php");
      this.noticePCList = pcNoticeResult.data.data as NoticeData[];

      const mobileNoticeResult = await AxiosHelper.GET("/getNoticeMobile.php");
      this.noticeMobileList = mobileNoticeResult.data.data as NoticeData[];

      this.numOfPage = Math.floor((this.noticeList.length - 1) / 5 + 1);
    } catch (error) {
      console.log("로딩 실패");
      console.log(error.response);
    }
  }

  get noticeList() {
    return this.isMobile ? this.noticeMobileList : this.noticePCList;
  }

  handleResize(/* e : Event */) {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleScroll(/* e : Evuent */) {
    this.responseComponents();
  }

  goTop() {
    if(this.isVisible) {
      window.scroll({
       top: 0,
       left: 0,
       behavior: "smooth"
      });
    }
  }

  responseComponents() {
    if (this.isMobile) {
      this.mainImgPath = "brand-page/Mobile/main.jpg";
    } else {
      this.mainImgPath = "brand-page/WEB/main.jpg";
    }

    if (
      window.pageYOffset >
      ((this.$refs.main as HTMLElement).clientHeight as number) -
        window.innerHeight +
        window.innerWidth * (this.isMobile ? 0.06389 : 0.07849) -
        5
    )
      this.isVisible = true;
    else this.isVisible = false;
  }

  getNoticeWithCurrentPage(index : number) : NoticeData | null {
    return this.noticeList[(this.currentPage-1)*5+index-1];
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

main {
  @include mobile {
    margin-top: 0;
  }
  .main {
    width: 100%;
    max-width: 100%;
    overflow: hidden;
    img {
      width: 100%;
      z-index: -1;
      @include pc {
        animation: pcMainImg 2s;
      }
      @include mobile {
        animation: mobileMainImg 3s;
      }
    }
  }

  .contents {
    width: 100%;

    article {
      height: 31.563vw;
      margin-top: 9.531vw;
      padding-left: 14.323vw;
      padding-right: 14.323vw;
      color: #595757;

      @include mobile {
        margin-top: 23.611vw;
        padding-left: 9.563vw;
        padding-right: 9.563vw;
      }

      img {
        position: absolute;
        width: 55.885vw;

        @include pc {
          left: 0;
        }

        @include tablet {
          left: 0;
        }

        @include mobile {
          right: 0;
          width: 90.833vw;
        }
      }

      .info-1 {
        font-family: "munche_jemok_batang";
        font-size: 1.198vw;

        @include mobile {
          font-family: "Noto Sans KR", sans-serif;
          font-size: 3.611vw;
          letter-spacing: normal;
        }
      }

      .info-2 {
        text-align: justify;
        text-justify: distribute-all-lines;
        font-size: 1.146vw;
        font-weight: 300;
        letter-spacing: -0.01vw;

        @include mobile {
          font-size: 3.611vw;
        }
      }

      .og {
        float: right;
        width: 24.479vw;
        height: 23.229vw;
        
        p {
          margin-bottom: 1.198vw;

          &:first-child {
            margin-bottom: 0px;
          }
        }

        @include mobile {
          clear: both;
          width: auto;
          height: auto;

          p {
            margin-bottom: 3.198vw;
          }
        }
      }

      &:nth-child(1) {
        div {
          margin-left: 46.927vw;
          line-height: 1.979vw;

          @include mobile {
            margin-left: 0;
            line-height: 1.62;
          }

          &:nth-last-child(2) {
            padding-top: 1.2vw;

            @include mobile {
              margin-top: 64.833vw;
              margin-left: 0;
              width: 54.111vw;
              padding: 0;
              height: 9.167vw;
              font-weight: 500;
            }
          }

          &:nth-last-child(1) {
            padding-top: 2.454vw;

            @include mobile {
              padding-top: 5.478vw;
            }
          }
        }

        @include mobile {
          height: 119.444vw;
        }
      }

      &:nth-child(2) {
        div {
          margin-left: 46.675vw;

          @include mobile {
            margin-left: 0;
          }

          &:nth-last-child(2) {
            line-height: 2.188vw;
            padding-top: 3.385vw;

            @include mobile {
              margin-top: 64.833vw;
              margin-left: 0;
              padding: 0;
              font-weight: 500;
              line-height: 1.62;
            }
          }

          &:nth-last-child(1) {
            line-height: 1.979vw;
            padding-top: 3.788vw;

            @include mobile {
              line-height: 1.62;
            }
          }
        }
        @include mobile {
          height: 107.778vw;
        }
      }

      &:nth-child(3) {
        div {
          display: inline-block;
          line-height: 1.979vw;
          width: 31.875vw;
          padding-top: 4.948vw;
          .highlight {
            font-weight: 500;

            @include mobile {
              font-weight: 300;
            }
          }

          @include mobile {
            display: block;
            position: relative;
            bottom: 0.833vw;
            width: auto;
            line-height: 1.62;
            padding: 0;
          }
        }
        img {
          left: 61.406vw;
          width: 23.042vw;
          height: 26.716vw;

          @include mobile {
            margin-top: 4.444vw;
            left: 24.611vw;
            width: 54.611vw;
            height: 61.667vw;
          }
        }

        @include mobile {
          height: 106.111vw;
        }
      }

      &:nth-child(4) {
        margin-top: 4.531vw;
        div {
          padding-top: 1vw;
          padding-bottom: 1vw;
          margin-left: 46.927vw;
          line-height: 1.879vw;

          @include mobile {
            margin: 0;
            margin-top: 59.833vw;
            padding: 0;
            line-height: 1.53;
          }
        }

        @include mobile {
          margin-top: 42.056vw;
          height: 141.111vw;

          img {
            left: 0;
          }
        }
      }

      &:nth-child(5) {
        margin-bottom: 8.75vw;

        @include mobile {
          margin-top: 22.222vw;
          margin-bottom: 19.444vw;
          height: 125.556vw;
        }
        img {
          position: relative;
          width: 100%;

          @include mobile {
            padding-top: 1.944vw;
          }
        }
      }

      &:nth-child(6) {
        height: auto;
        margin-bottom: 8.125vw;

        @include mobile {
          margin-bottom: 16.944vw;
        }

        .summary-wrap{
          display: flex;
          flex-direction: column;

          .classification {
            background: #f3f0ed;
            border-top: 1px solid #a19b95;
            border-bottom: 1px solid #a19b95;

            span {
              font-size: 1.146vw;
              font-weight: 300;
              line-height: 3.958vw;
              color: #595757;

              &.index {
                padding-left: 1.146vw;
              }

              &.title {
                padding-left: 27.188vw;
              }

              &.author {
                padding-left: 23.723vw;
              }

              &.date {
                padding-left: 4.792vw;
              }
            }
          }
        }
        .pagination {
          text-align: right;
          font-size: 1.146vw;
          padding-top: 1.042vw;

          @include mobile {
            font-size: 3.333vw;
            padding-top: 3.056vw;
          }

          span {
            position: relative;
            padding-right: 0.938vw;
            cursor: pointer;

            @include mobile {
              padding: 0 2.778vw 0 0;
              bottom: 0.833vw;
            }
          }

          img {
            width: 1.146vw;
            cursor: pointer;
            position: static;

            @include mobile {
              width: 5vw;
            }
          }
        }
      }
    }
  }

  div {
    word-break: keep-all;
    letter-spacing: -0.04vw;
    @include mobile {
      letter-spacing: -0.13vw;
    }
  }
}

.button-go-top {
  position: fixed;
  width: 3.385vw;
  bottom: 23.281vw;
  right: 14.299vw;
  transition: all 0.5s;
  opacity: 0;
  cursor: pointer;

  @include mobile {
    width: 9.167vw;
    height: 7.222vw;
    bottom: 49.167vw;
    right: 9.167vw;
  }

  &-visible {
    opacity: 1;
  }
  &-invisible {
    opacity: 0;
  }
}

@keyframes pcMainImg {
  from {
    width: 120%;
    margin-left: -10%;
    margin-top: -4.03%;
    margin-right: -10%;
    margin-bottom: -4.03%;
  }
  to {
    width: 100%;
    margin-left: 0;
    margin-top: 0;
    margin-right: 0;
    margin-bottom: 0;
  }
}

@keyframes mobileMainImg {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
