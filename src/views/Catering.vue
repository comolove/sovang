<template>
  <main>
    <section class="main" data-aos="fade-up">
      <section class="img-slider">
        <Carousel
          class="main-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :autoplayTimeout="6000"
          :autoplayHoverPause="false"
          :loop="true"
          paginationPosition="bottom-overlay"
          paginationColor="#c9caca"
          paginationActiveColor="white"
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
      <div class="info info-1">
        청정지역의 제철먹거리와 함께 특별하고 의미있는 모임을 기획하는 가장 쉬운 방법.
        <br />소녀방앗간과 함께 어떤 특별함을 만들 수 있을까요?
      </div>
    </section>

    <section class="content-1">
      <AssetImage
        class="illust"
        :src="'catering-page/illustration' + (isMobile ? '-m.jpg' : '-pc.jpg')"
      />
      <HomeContent title="청정케이터링 이야기" data-aos="fade-up">
        <Carousel
          ref="storeCarousel"
          class="store-carousel"
          :per-page="storeCarouselPerPage"
          :scrollPerPage="false"
          :autoplayTimeout="4000"
          :paginationEnabled="true"
          :navigationEnabled="true"
          :navigationNextLabel="storeCarouselNavigationNext"
          :navigationPrevLabel="storeCarouselNavigationPrev"
          :autoplay="true"
          :loop="true"
          :spacePadding="-20"
          paginationColor="#c9caca"
          :paginationActiveColor="homeContentCarouselPaginationActiveColor"
          @page-change="handleStoreCarouselChange"
        >
          <Slide
            v-for="(data, index) of cateringStorySlideData"
            :key="index"
            :data-index="index"
            data-name="DataName"
            @slideclick="handleStoreSlideClick"
          >
            <div class="store-content">
              <AssetImage class="mono" :src="isMobile ? data.mobileMonoPath : data.pcMonoPath" />
              <AssetImage class="color" :src="isMobile ? data.mobilePath : data.pcPath" />
              <p>
                {{ data.cateringStoryName1 }}
                <br />
                <span>{{ data.cateringStoryName2 }}</span>
              </p>
            </div>
          </Slide>
        </Carousel>
      </HomeContent>
      <div class="info info-1">
        2017년부터 지금까지 여러 공기관과 대기업, 그리고 사회적경제의 스타트업까지
        <br />다양한 공간에서 소녀방앗간과 함께 청정케이터링 서비스를 경험하고 있습니다.
      </div>
      <AssetImage class="logo" src="catering-page/logo-pc.jpg" />
    </section>

    <section class="content-2">
      <div class="info info-2">청정케이터링</div>
      <HomeContent title="방문 케이터링(30인 이상)" style="height: 25.625vw;">
        <div class="contentsWrap contentsWrap-1">
          <div>
            <AssetImage
              :src="'catering-page/catering-visit/' + (isMobile ? 'Mobile' : 'WEB') + '/1.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">실속형</span> 15,000 - 20,000원 (1인) / 메뉴 7 - 9종
              </div>
              <div class="info-5">소규모, 또는 가볍고 편리한 모임에 적합합니다.</div>
            </div>
          </div>
          <div>
            <AssetImage
              :src="'catering-page/catering-visit/' + (isMobile ? 'Mobile' : 'WEB') + '/2.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">일반형</span> 20,000 - 30,000원 (1인) / 메뉴 10 - 12종
              </div>
              <div class="info-5">기업 모임, 행사 등의 알찬 구성에 적합합니다.</div>
            </div>
          </div>
          <div>
            <AssetImage
              :src="'catering-page/catering-visit/' + (isMobile ? 'Mobile' : 'WEB') + '/3.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">고급형</span> 30,000원 이상 (1인) / 메뉴 12종 이상
              </div>
              <div class="info-5">잔치나 파티 등 풍성한 차림의 행사에 적합합니다.</div>
            </div>
          </div>
        </div>
      </HomeContent>
      <HomeContent
        title="방문 케이터링(30인 이하)"
        style="height: 36.875vw; margin-top: 7.917vw;"
      >
        <div class="contentsWrap contentsWrap-2">
          <div>
            <AssetImage
              :src="'catering-page/catering-box/' + (isMobile ? 'Mobile' : 'WEB') + '/1.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">실속형</span> 10,000 - 15,000형 (1인) / 메뉴 5 - 6종
              </div>
              <div class="info-5">
                회의 등 모임에 개별로 가볍게 준비해야 할 때
                <br />적합하며, 우드도시락으로 제공됩니다.
              </div>
            </div>
          </div>
          <div>
            <AssetImage
              :src="'catering-page/catering-box/' + (isMobile ? 'Mobile' : 'WEB') + '/2.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">일반형</span> 10,000 - 20,000형 (1인) / 메뉴 7 - 10 종
              </div>
              <div class="info-5">합리적이고 다양한 구성의 메뉴가 필요할 때 
              <br />박스형태로 제공되어 편리하게 이용합니다.</div>
            </div>
          </div>
          <div>
            <AssetImage
              :src="'catering-page/catering-box/' + (isMobile ? 'Mobile' : 'WEB') + '/3.jpg'"
            />
            <div class="info-3">
              <div class="info-4">
                <span class="bold">고급형</span> 20,000 - 30,000형 (1인) / 메뉴 7-10종
              </div>
              <div class="info-5">풍성한 메뉴 구성이 필요한 소규모 모임 또는
              <br />고급 답례품 형태로도 제공가능합니다. </div>
            </div>
          </div>
        </div>
      </HomeContent>
    </section>

    <section class="content-3">

    </section>

    <section class="content-4"></section>
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import { VueAgile } from "vue-agile";
import {
  HomeContent,
  HoverTextImage,
  AssetImage,
  ImageOverlayInfo
} from "@/components";
import Breakpoint from "@/utils/screenSize";

class ImgPath {
  public pcPath = "";
  public tabletPath = "";
  public mobilePath = "";
}
class CateringStoryData extends ImgPath {
  public pcMonoPath = "";
  public tabletMonoPath = "";
  public mobileMonoPath = "";
  public cateringStoryName1 = "";
  public cateringStoryName2 = "";
}

@Component({
  name: "Catering",
  components: {
    Carousel,
    Slide,
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo,
    agile: VueAgile
  }
})
export default class Catering extends Vue {
  private mainSlideData: ImgPath[] = [];
  private cateringStorySlideData: CateringStoryData[] = [];

  private isMobile = false;
  private storeCarouselPerPage = 1;
  private homeContentCarouselPaginationActiveColor = "black";

  private curStoreIndex = 0;
  private infoBreak = false;

  created() {
    window.addEventListener("resize", this.handleResize);

    // TODO : Backend 개발 후 DB에서 불러오기
    for (let i = 0; i < 2; i++) {
      this.mainSlideData.push({
        pcPath: `catering-page/main/WEB/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/main/Mobile/main-slide-${i + 1}.jpg`
      });
    }

    const cateringStory1 = [
      `한화 LIFE PLUS 컨퍼런스 2019`,
      `2020 대법원 시무식`,
      `스타트업의 옥상 박스 케이터링`
    ];

    const cateringStory2 = [
      `Future Ways of [Living] - 로컬푸드 청정재료 이야기`,
      `행사의 품격을 더해준 청정다과 케이터링 이야기`,
      `특별하고 편리하게 즐기는 박스 케이터링 이야기`
    ];
    for (let i = 0; i < cateringStory1.length; i++) {
      this.cateringStorySlideData.push({
        pcPath: `catering-page/catering-story/WEB/${i + 1}-color.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-story/Mobile/${i + 1}-color.jpg`,
        pcMonoPath: `catering-page/catering-story/WEB/${i + 1}-mono.jpg`,
        tabletMonoPath: "",
        mobileMonoPath: `catering-page/catering-story/Mobile/${i + 1}-mono.jpg`,
        cateringStoryName1: cateringStory1[i],
        cateringStoryName2: cateringStory2[i]
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
    this.responseComponents();
  }

  handleStoreSlideClick(dataset: { index: string }) {
    this.curStoreIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.storeCarousel as Carousel).goToPage(this.curStoreIndex - 1);
  }

  handleResize(/* e : Event */) {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleStoreCarouselChange(index: number) {
    this.curStoreIndex = index;
  }

  responseComponents() {
    if (this.isMobile) {
      this.storeCarouselPerPage = 1;
      this.infoBreak = true;
      this.homeContentCarouselPaginationActiveColor = "#001845";
    } else {
      this.storeCarouselPerPage = 3;
      this.infoBreak = false;
      this.homeContentCarouselPaginationActiveColor = "black";
    }
  }

  public get mainCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-white.png")}
            >`;
  }

  public get mainCarouselNavigationPrev(): string {
    return `<img 
              src=${require("@/assets/images/arrow-left-white.png")} 
            >`;
  }

  public get storeCarouselNavigationNext(): string {
    if (this.isMobile) return "";

    return `<img 
              src=${require("@/assets/images/arrow-right-black.png")} 
              style="width:1.042vw;"
            >`;
  }

  public get storeCarouselNavigationPrev(): string {
    if (this.curStoreIndex == 0 || this.isMobile) return "";

    return `<img 
              src=${require("@/assets/images/arrow-left-black.png")} 
              style="width:1.042vw;"
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin: 0 14.271vw 0 14.271vw;
  width: 71.354vw;
}

.info {
  text-align: center;
  color: #595757;

  &-1 {
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 2.188vw;
  }

  &-2 {
    font-size: 1.719vw;
    font-weight: 500;
    color: #001845;
  }

  &-3 {
    background: white;
  }

  &-4 {
    padding: 0.964vw 0 0 0.885vw;
    font-size: 0.99vw;
    font-weight: 300;
    line-height: 1.53;
    color: #747171;
  }

  &-5 {
    padding: 0.417vw 0 0 0.885vw;
    font-size: 0.99vw;
    font-weight: 300;
    line-height: 1.53;
    color: #747171;
  }
}

.contentsWrap {
  display: flex;
  justify-content: space-between;
  img {
    width: 100%;
    height: 15.677vw;
  }
}

.main {
  .img-slider {
    width: 100%;

    &::v-deep {
      .VueCarousel-navigation-prev {
        transform: unset;
        left: 3.229vw;
        top: 17.188vw;

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
        top: 17.188vw;

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
        transition: transform 0s ease 0.5s !important;

        .VueCarousel-slide {
          transition: opacity 0.5s !important;
          opacity: 0 !important;
        }
        .VueCarousel-slide-active {
          transition: opacity 0.5s ease 0.5s !important;
          opacity: 1 !important;
        }
      }
    }

    img {
      width: 100%;
      @include mobile {
        height: 147.222vw;
        object-fit: contain;
        overflow: hidden;
      }
    }
  }

  .info-1 {
    padding-top: 7.448vw;
  }
}

.content-1 {
  .illust {
    margin: 7.656vw 23.281vw 10.781vw 23.281vw;
    width: 53.438vw;
    height: 16.875vw;
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

  .store-carousel {
    // 매장 이미지들의 사이 간격
    .VueCarousel-slide > div {
      padding-right: 1.354vw;
      img {
        width: 22.917vw;

        @include mobile {
          width: 100%;
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
        transform: translateY(-70%) translateX(-150%);
      }

      .VueCarousel-navigation-next {
        transform: translateY(-70%) translateX(150%);
      }

      @include mobile {
        @include RightAlignPagination(-4.856vw);
      }
    }

    // 매장 사진 밑에 텍스트
    .store-content {
      height: 19.323vw;

      img {
        position: absolute;
      }

      & > .color {
        opacity: 0;
        transition: opacity 1s;
      }

      &:hover > .color {
        opacity: 1;
      }

      p {
        color: #595757;
        font-weight: 300;
        font-size: 0.964vw;
        line-height: 1.57;
        padding-top: 16.224vw;

        > span {
          color: #797777;
        }
      }

      @include mobile {
        p {
          font-size: 3.611vw;
          text-align: left;
        }
      }
    }
  }

  .info-1 {
    padding: 12.188vw 0 6.25vw 0;
  }

  .logo {
    width: 100%;
    height: 32.604vw;
    margin-bottom: 5.99vw;
    background-color: black;
  }

  article {
    height: 23.906vw;
  }
}

.content-2 {
  background-color: #ededee;

  .info-2 {
    padding: 8.281vw 0 6.563vw 0;
  }

  .bold {
    color: #001845;
    padding-right: 0.5vw;
    font-weight: 500;
  }

  .contentsWrap-1 {
    > div {
      width: 22.917vw;
      height: 21.042vw;

      > div {
        height: 5.365vw;
      }
    }
  }

  .contentsWrap-2 {
    
    > div {
      width: 22.917vw;
      height: 21.042vw;

      > div {
        height: 6.875vw;

        .info-5 {
          padding-left: 4.323vw;
        }
      }
    }
  }
}
</style>