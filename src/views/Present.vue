<template>
  <main>
    <Header />
    <section class="main img-slider" data-aos="fade-up">
      <Carousel
        class="main-carousel"
        :per-page="1"
        :mouseDrag="false"
        :autoplay="true"
        :autoplayTimeout="3000"
        :autoplayHoverPause="false"
        :loop="true"
        :navigationEnabled="true"
        :navigationNextLabel="mainCarouselNavigationNext"
        :navigationPrevLabel="mainCarouselNavigationPrev"
        paginationPosition="bottom-overlay"
        paginationColor="white"
        paginationActiveColor="#595757"
      >
        <Slide
          v-for="(data, index) of mainSlideData"
          :key="index"
          :id="'main-carousel-slide-' + index"
        >
          <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
        </Slide>
      </Carousel>
    </section>
    <section class="content-1">
      <HomeContent title="오지에서 온 선물">
        <AssetImage
          :src="'present-page/' + (isMobile ? 'Mobile' : 'Web') + '/backcountry-present.jpg'"
        />
        <div>
          소녀방앗간은 청정지역 어르신들과 함께 식재료를 어떻게 생산할지 고민하며 한 해를 시작합니다.
          <br />
          <br />산 속에 핀 수많은 풀 중에 먹을 것을 골라내기 위해 수십년 산을 타 온 어르신들을 마주할 때 - 매 해 이른 봄, 오랫동안
          <span
            class="wider-1"
          >이어온 옛 방식으로 발효음식의 전통을 빚어오는</span> 장인분들을 마주할 때 - 매일의 순간이 모여 역사와 혜안을 만든다는 것을 배웁니다.
          <br />
          <br />
          <span class="wider-2">모두가 매일의 순간을 사랑하는 한 해를 기원하며 소녀방앗간은 늘 건강과 풍요를 위해 마음을 담아 준비합니다.</span>
        </div>
      </HomeContent>
    </section>
    <section class="content-2">
      <HomeContent title="소녀방앗간 명절선물">
        <span>낭비없는 생산을 위하여 해마다 준비하는 명절 선물의 품목과 종류가 다를 수 있습니다 :)</span>
        <div class="flexWrap" v-if="!isMobile">
          <div v-for="(data , index) of holidayPresentData" :key="index">
            <AssetImage class="before" :src="data.pcPath" />
            <AssetImage class="after" :src="data.pcPathAfter" />
            <p v-html="data.info" />
          </div>
        </div>
        <Carousel
          v-if="isMobile"
          class="present-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :autoplayTimeout="3000"
          :autoplayHoverPause="false"
          :loop="true"
          :navigationEnabled="true"
          :paginationEnabled="false"
          :navigationNextLabel="mainCarouselNavigationNext"
          :navigationPrevLabel="mainCarouselNavigationPrev"
        >
          <Slide
            v-for="(data, index) of holidayPresentData"
            :key="index"
            :id="'main-carousel-slide-' + index"
          >
            <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
            <p v-html="data.info" />
          </Slide>
        </Carousel>
      </HomeContent>
    </section>
    <section class="content-3">
      <span>지역동행 청정재료 선물기획</span>
      <p>
        산지직송 청정재료로 만드는 "고객 맞춤형" 선물세트를<br v-if="isMobile" /> 기획부터 구성, <span v-if="isMobile">그리고 </span>포장까지 전 과정을 진행합니다.
        <br />귀한 손님에게 귀사만의 브랜드 아이덴티티를 온전하게<br v-if="isMobile" /> 담은 특별한 청정재료 선물보따리를 전하셔요 :)
      </p>
      <AssetImage :src="'present-page/' + (isMobile ? 'Mobile' : 'Web') + '/presentAI.png'" />
    </section>
    <section class="content-4">
      <HomeContent title="명절선물 기획 프로젝트">
        <span>맞춤형 선물세트의 최소 제작 수량은 500개부터 가능합니다 :)</span>
        <Carousel
          ref="projectCarousel"
          class="projectCarousel"
          :per-page="carouselPerPage"
          :scrollPerPage="false"
          :autoplayTimeout="4000"
          :paginationEnabled="false"
          :navigationEnabled="true"
          :navigationNextLabel="projectCarouselNavigationNext"
          :navigationPrevLabel="projectCarouselNavigationPrev"
          :autoplay="true"
          :loop="true"
          :spacePadding="0"
        >
          <Slide
            v-for="(data, index) of projectData"
            :key="index"
            :data-index="index"
            data-name="DataName"
          >
            <div>
              <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
              <AssetImage v-if="!isMobile" class="after" :src="data.pcPathAfter" />
              <span v-html="data.info" />
            </div>
          </Slide>
        </Carousel>
      </HomeContent>
    </section>
    <section class="content-5">
      <div>
        감사한 분들께 건강한 재료로 정성을 선물하고 싶다면
        <br />소녀방앗간과 함께 고민해보셔요 :)
      </div>
      <form name="consulting">
        <div class="flexWrap">
          <input type="text" placeholder="단체명" />
          <input type="text" placeholder="담당자" />
          <input type="text" placeholder="연락처" />
          <input type="text" placeholder="이메일" />
          <textarea v-if="!isMobile"
            placeholder="문의내용 : 
식재료, 수량, 예산 등 구체적인 내용으로
문의해주시면 빠른 상담이 가능합니다 :)
          "
          />
          <textarea v-if="isMobile" placeholder="추가메세지 : 식재료, 수량, 예산 등 구체적인 내용으로
문의해주시면 빠른 상담이 가능합니다 :)" />
        </div>
        <div class="privacyCondition">
          <input type="checkbox" id="privacy" />
          <label for="privacy">
            <AssetImage src="catering-page/privacy.png" />
          </label>
          개인정보 수집 및 이용 동의
          <div>내용 보기</div>
        </div>
        <input type="button" value="상담 예약" onclick=" " />
      </form>
    </section>
    <Footer class="footer" />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import { Header, Footer, HomeContent, AssetImage } from "@/components";
import { screenSize, ImgPath } from "@/utils";

class DoubleImgPath extends ImgPath {
  public pcPathAfter = "";
  public tabletPathAfter = "";
  public mobilePathAfter = "";
  public info = "";
}

@Component({
  name: "Present",
  components: {
    Header,
    Footer,
    Carousel,
    Slide,
    HomeContent,
    AssetImage
  }
})
export default class Present extends Vue {
  private mainSlideData: ImgPath[] = [];
  private projectData: DoubleImgPath[] = [];
  private holidayPresentData: DoubleImgPath[] = [];

  private carouselPerPage = 1;
  private curIndex = 0;
  private isMobile = false;

  created() {
    window.addEventListener("resize", this.handleResize);

    for (let i = 1; i <= 4; i++) {
      this.mainSlideData.push({
        name: "",
        pcPath: `present-page/Web/main/${i}.jpg`,
        tabletPath: "",
        mobilePath: `present-page/Mobile/main/${i}.jpg`
      });
    }

    const projectInfo = [
      `2016 설 선물세트 _ 우리쌀떡보따리 (with 이노션)
      <br /><span>#떡국떡, 간장, 흑화고, 죽방멸치, 홍새우, 다시마</span>`,
      `2018 설 선물세트 _ 발효미학 (with 이노션)
      <br /><span>#된장, 옹기, 쌈장, 고추장, 간장, 매실청</span>`,
      `2018 추석 선물세트 _ INOCEAN (with 이노션)
      <br /><span>#제주돌미역, 다시마, 건강밥톳, 홍새우, 함초소</span>금`
    ];

    for (let i = 1; i <= 3; i++) {
      this.projectData.push({
        name: "",
        pcPath: `present-page/Web/planning-project/${i}-1.jpg`,
        tabletPath: "",
        mobilePath: `present-page/Mobile/planning-project/${i}.jpg`,
        pcPathAfter: `present-page/Web/planning-project/${i}-2.jpg`,
        tabletPathAfter: "",
        mobilePathAfter: "",
        info: projectInfo[i - 1]
      });
    }

    const presentInfo = [
      `오지의 장
      <br />
      <span>#재래식된장, 재래식찹쌀고추장, 어수리장아찌, 무장아찌</span>
      `,
      `오지의 맛
      <br />
      <span>#재래식간장, 함초소금, 취나물분말</span>
      `,
      `오지의 향
      <br />
      <span>#전통참기름, 전통들기름, 재래식간장</span>
      `,
      `오지의 부각
      <br />
      <span>#찹쌀김부각, 다시마부각, 고추부각</span>
      `,
      `오지의 약밥
      <br />
      <span>#영양밥, 찰약밥, 건재료 8종, 재래식간장, 전통들기름</span>
      `,
      `오지의 떡국
      <br />
      <span>#현미/오색떡국떡, 재래식간장, 호박오가리, 맛국물팩</span>
      `
    ];
    for (let i = 1; i <= 6; i++) {
      this.holidayPresentData.push({
        name: "",
        pcPath: `present-page/Web/holiday-present/${i}-1.jpg`,
        tabletPath: "",
        mobilePath: `present-page/Mobile/holiday-present/${i}.jpg`,
        pcPathAfter: `present-page/Web/holiday-present/${i}-2.jpg`,
        tabletPathAfter: "",
        mobilePathAfter: "",
        info: presentInfo[i - 1]
      });
    }
  }

  mounted() {
    // vue-carousel mounted시 첫 번째 요소가 활성화 클래스 태그가 안붙는 문제가 있음
    ((document as Document).getElementById(
      "main-carousel-slide-0"
    ) as Element).classList.add("VueCarousel-slide-active");

    setTimeout(() => {
      // 슬라이드가 바뀌어도 임의로 넣어준 active 클래스는 삭제가 안되서 n초후에 임의로 삭제
      const firstSlide = (document as Document).getElementById(
        "main-carousel-slide-0"
      ) as Element;
      if (firstSlide) {
        firstSlide.classList.remove("VueCarousel-slide-active");
      }
    }, 6000);

    this.handleResize();
  }

  handleResize(/* e : Event */) {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleCarouselChange(index: number) {
    this.curIndex = index;
  }

  responseComponents() {
    if (this.isMobile) {
      this.carouselPerPage = 1;
    } else {
      this.carouselPerPage = 3;
    }
  }

  public get mainCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-gray.png")}
            >`;
  }

  public get mainCarouselNavigationPrev(): string {
    return `<img 
              src=${require("@/assets/images/arrow-left-gray.png")} 
            >`;
  }

  public get projectCarouselNavigationNext(): string {
    return `<img
              src=${require("@/assets/images/arrow-right-black.png")} 
            >`;
  }

  public get projectCarouselNavigationPrev(): string {
    return `<img
              src=${require("@/assets/images/arrow-left-black.png")} 
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin-left: 14.323vw;
  width: 71.354vw;

  @include mobile {
    margin-left: 9.167vw;
    width: 81.667vw;
  }
}

@mixin RightAlignPagination($bottom) {
  .VueCarousel-pagination {
    position: absolute;
    display: block;
    right: 0;
    bottom: $bottom;
    width: auto !important;
    height: 10vw;
    background-color: white !important;

    .VueCarousel-dot-container {
      margin-top: 0 !important;

      .VueCarousel-dot {
        margin-top: 0 !important;
        width: 1.944vw !important;
        height: 1.944vw !important;
        padding: 0.667vw !important;
      }
    }
  }
}

.img-slider {
  width: 100%;
  margin-bottom: 9.688vw;

  @include mobile {
    margin-bottom: 23.056vw;
  }

  &::v-deep {
    .VueCarousel-navigation-prev {
      transform: unset;
      left: 3.229vw;
      top: 17.708vw;

      img {
        width: 1.458vw;
      }

      @include mobile {
        left: 4vw;
        top: 45%;

        img {
          width: 3.889vw;
        }
      }
    }

    .VueCarousel-navigation-next {
      transform: unset;
      right: 3.229vw;
      top: 17.708vw;

      img {
        width: 1.458vw;
      }

      @include mobile {
        right: 4vw;
        top: 45%;

        img {
          width: 3.889vw;
        }
      }
    }

    // 메인 슬라이드 페이지네이션 버튼 위치
    .VueCarousel-pagination--bottom-overlay {
      bottom: 1.667vw;

      .VueCarousel-dot {
        width: 0.729vw !important;
        height: 0.729vw !important;
        padding: 0 0.599vw !important;
      }

      @include mobile {
        bottom: 5.278vw;

        .VueCarousel-dot {
          width: 2.5vw !important;
          height: 2.5vw !important;
          padding: 0 2.222vw !important;
        }
      }
    }

    // 메인 슬라이드 트랜지션 재정의
    .VueCarousel-inner {
      transition: transform 0s ease 1s !important;
      transform: none !important;

      .VueCarousel-slide {
        transition: opacity 1s !important;
        width: 100%;
        height: 40.313vw;
        opacity: 0 !important;

        @include mobile {
          height: 147.778vw;
        }

        img {
          position: absolute;
          width: 100%;

          @include mobile {
            width: 90.833vw;
            height: 147.778vw;
            margin-left: 4.722vw;
          }

          &:last-child {
            left: 0;
          }
        }
      }
      .VueCarousel-slide-active {
        transition: opacity 1s !important;
        opacity: 1 !important;
      }
    }
  }
}

.content-1 {
  position: relative;
  margin-bottom: 10.99vw;

  @include mobile {
    margin-bottom: 22.778vw;
  }

  img {
    position: absolute;
    display: inline-block;
    left: -14.323vw;
    width: 55.885vw;
    height: 26.719vw;

    @include mobile {
      position: relative;
      left: 0;
      width: 100%;
      height: 54.167vw;
    }
  }

  div {
    display: inline-block;
    width: 24.375vw;
    margin: 0.625vw 0 0.104vw 46.875vw;
    color: #595757;
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.91;
    text-align: justify;
    word-break: keep-all;

    @include mobile {
      width: 100%;
      font-size: 3.611vw;
      line-height: 1.62;
      margin: 5vw 0 0 0;
      letter-spacing: -0.1vw;

      .wider-1 {
        letter-spacing: 0.3vw;
      }

      .wider-2 {
        letter-spacing: 0.3vw;
      }
    }
  }
}

.content-2 {
  article {
    margin-bottom: 7.917vw;

    @include mobile {
      margin-bottom:5.278vw;
    }

    > span {
      position: absolute;
      right: 0;
      top: 0.208vw;
      font-size: 0.885vw;
      font-weight: 300;
      color: #b1b1b1;

      @include mobile {
        left: 0;
        top: 79.222vw;
        font-size: 2.222vw;
        padding-top: 1.389vw;
        color: #9e9e9e;
      }
    }

    .flexWrap {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

      > div {
        display: inline-block;
        width: 22.917vw;
        height: 21.875vw;
        position: relative;

        img {
          position: absolute;
          width: 100%;
          height: 15.677vw;

          &.after {
            transition: 1s opacity;
            opacity: 0;
          }

          &:hover.after {
            opacity: 1;
          }
        }

        p {
          margin-top: 16.653vw;
          font-size: 0.99vw;
          font-weight: 500;
          line-height: 1.53;
          color: #595757;

          span {
            color: #797777;
            font-weight: 300;
          }
        }
      }
    }

    .present-carousel {
      &::v-deep {
        .VueCarousel-slide {
          width: 81.667vw;
          height: 91.667vw;

          > img {
            width: 100%;
          }

          > p {
            margin-top: 2.5vw;
            font-size: 3.611vw;
            line-height: 5.7vw;
            color: #595757;

            > span {
              font-size: 2.778vw;
            }
          }
        }

        .VueCarousel-navigation-prev {
          transform: unset;
          left: 3.229vw;
          top: 17.708vw;

          img {
            width: 1.458vw;
          }

          @include mobile {
            left: 4vw;
            top: 21%;

            img {
              width: 3.889vw;
            }
          }
        }

        .VueCarousel-navigation-next {
          transform: unset;
          right: 3.229vw;
          top: 17.708vw;

          img {
            width: 1.458vw;
          }

          @include mobile {
            right: 4vw;
            top: 21%;

            img {
              width: 3.889vw;
            }
          }
        }

        @include mobile {
          @include RightAlignPagination(-4.856vw);
        }
      }
    }
  }
}

.content-3 {
  background: #ededee;
  > span {
    display: block;
    padding: 8.281vw 0 5.729vw;
    font-size: 1.719vw;
    font-weight: 500;
    color: #001845;
    text-align: center;

    @include mobile {
      padding: 26.389vw 0 13.611vw;
      font-size: 4.722vw;
    }
  }

  > p {
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.91;
    color: #595757;
    text-align: center;

    @include mobile{
      font-size: 3.611vw;
      line-height: 1.62;
    }
  }

  img {
    margin: 5.208vw 0 6.615vw 21.979vw;
    width: 56.042vw;

    @include mobile {
      margin: 13.056vw 0 25vw 8.75vw;
      width: 81.667vw;
    }
  }
}

.content-4 {
  padding: 8.802vw 0 10.521vw;

  @include mobile {
    padding: 20.833vw 0 3.056vw 0;
  }

  article {
    > span {
      position: absolute;
      right: 0;
      top: 0.208vw;
      font-size: 0.885vw;
      font-weight: 300;
      color: #b1b1b1;

      @include mobile {
        left: 0;
        top: 80vw;
        font-size: 2.222vw;
        color: #9e9e9e;
      }
    }
  }

  .projectCarousel {
    // 매장 이미지들의 사이 간격
    .VueCarousel-slide {
      width: 22.917vw;

      @include mobile {
        width: 81.667vw;
      }

      & > div {
        width: 22.917vw;
        position: relative;

        @include mobile {
          width: 81.667vw;
          height: 94.444vw;
        }

        img {
          width: 22.917vw;
          position: absolute;

          &.after {
            transition: 1s opacity;
            opacity: 0;
          }

          &:hover.after {
            opacity: 1;
          }

          @include mobile {
            width: 81.667vw;
          }
        }

        > span {
          display: inline-block;
          margin-top: 15.872vw;
          font-size: 0.964vw;
          font-weight: 300;
          line-height: 1.57;
          color: #595757;

          @include mobile {
            margin-top: 56.667vw;
            font-size: 3.611vw;
            line-height: 5.833vw;
          }

          > span {
            color: #797777;

            @include mobile {
              color: #595757;
              font-size: 2.778vw;
            }
          }
        }
      }
    }

    &::v-deep {
      .VueCarousel-pagination {
        display: none;

        @include mobile {
          padding-top: 0.8vw;
        }
      }

      .VueCarousel-navigation-prev {
          transform: unset;
          left: 3.229vw;
          top: 17.708vw;

          img {
            width: 1.458vw;
          }

          @include mobile {
            left: 4vw;
            top: 21%;

            img {
              width: 3.889vw;
            }
          }
        }

        .VueCarousel-navigation-next {
          transform: unset;
          right: 3.229vw;
          top: 17.708vw;

          img {
            width: 1.458vw;
          }

          @include mobile {
            right: 4vw;
            top: 21%;

            img {
              width: 3.889vw;
            }
          }
        }

        @include mobile {
          @include RightAlignPagination(-4.856vw);
        }
    }
  }
}

.content-5 {
  background: url("../assets/images/present-page/Web/background.jpg") no-repeat
    center/cover;

  @include mobile {
    background: url("../assets/images/present-page/Mobile/background.jpg") no-repeat
    center/cover;
  }

  > div {
    padding: 9.948vw 0 4.531vw;
    color: #001845;
    font-size: 1.146vw;
    font-weight: 500;
    line-height: 1.667vw;
    text-align: center;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
      padding: 23.333vw 0 19.167vw;
    }
  }

  form {
    .flexWrap {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      justify-content: space-between;
      width: 45.833vw;
      height: 13.616vw;
      margin-left: 27.083vw;

      @include mobile {
        width: 81.667vw;
        height: 68.611vw;
        margin-left: 9.167vw;
      }

      input,
      textarea {
        font-size: 1.146vw;
        font-family: NotoSansCJKKr;
        line-height: 1.73;

        @include mobile {
          font-size: 3.611vw;
          line-height: 1.62;
        }
      }

      input {
        width: 21.458vw;
        height: 2.604vw;
        padding-left: 0.677vw;
        border: 0;
        color: #595757;

        @include mobile {
          width: 79.167vw;
          height: 9.167vw;
          padding-left: 2.222vw;
          color: #797777;
        }
      }

      textarea {
        width: 20.259vw;
        height: 12.99vw;
        border: 0;
        padding: 0.313vw 0.938vw;
        letter-spacing: -0.15vw;
        color: #797979;

        @include mobile {
          width: 75vw;
          height: 18.333vw;
          padding: 2.778vw 4.444vw 0 2.222vw;
          letter-spacing: -0.39vw;
          margin-top: 4.722vw;
        }
      }
    }

    .privacyCondition {
      margin: 0.69vw 27.839vw 0;
      position: relative;
      text-align: right;
      font-size: 0.99vw;
      line-height: 1.615vw;

      @include mobile {
        margin: 3.889vw 8.611vw 0;
        font-size: 2.917vw;
        line-height: 1;
      }

      input[type="checkbox"] {
        display: none;

        & + label {
          position: absolute;
          width: 1.406vw;
          height: 1.406vw;
          top: 0.24vw;
          right: 17.5vw;
          border: 0;
          border-radius: 50%;
          background: white;
          cursor: pointer;

          @include mobile {
            width: 4.167vw;
            height: 4.167vw;
            top: 0.25vw;
            right: 50.689vw;
          }

          img {
            position: relative;
            z-index: 2;
            width: 0.677vw;
            height: 0.833vw;
            right: 0.363vw;
            bottom: 0.1vw;
            background: transparent;

            @include mobile {
              width: 1.944vw;
              height: 2.5vw;
              right: 1.02vw;
              top: 0.7vw;
              bottom: 0;
            }
          }
        }

        &:checked + label {
          background: #001845;
          img {
            filter: brightness(1);
          }
        }
      }

      div {
        display: inline-block;
        border-radius: 0.755vw;
        border: 0.052vw solid #001845;
        padding: 0 0.703vw;
        margin-left: 0.521vw;
        cursor: pointer;

        @include mobile {
          border-radius: 2.278vw;
          border-width: 0.278vw;
          padding: 0.333vw 1.2vw;
          margin-left: 2vw;
        }
      }
    }

    input[type="button"] {
      width: 9.531vw;
      height: 2.656vw;
      margin: 4.479vw 0 10.521vw 45.208vw;
      padding: 0;
      border: 0;
      border-radius: 1.302vw;
      background-color: #001845;
      color: white;
      font: 500 1.302vw NotoSansCJKr;
      cursor: pointer;

      @include mobile {
        margin: 11.111vw 0 24.167vw 36.111vw;
        width: 28.056vw;
        height: 8.056vw;
        border-radius: 3.861vw;
        font-size: 3.889vw;
      }
    }
  }
}

.footer {
  background: white;
}
</style>