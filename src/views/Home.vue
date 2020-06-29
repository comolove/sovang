<template>
  <main class="home">
    <section data-aos="fade-up" class="img-slider">
      <Carousel
        class="main-carousel"
        :per-page="1"
        :mouseDrag="false"
        :autoplay="true"
        :autoplayTimeout="6000"
        :autoplayHoverPause="false"
        :navigationEnabled="true"
        :navigationNextLabel="mainCarouselNavigationNext"
        :navigationPrevLabel="mainCarouselNavigationPrev"
        :loop="true"
        paginationPosition="bottom-overlay"
        paginationColor="#c9caca"
        :paginationActiveColor="mainCarouselPaginationActiveColor"
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
    <section class="info">
      <p data-aos="fade-up" class="title">
        좋은 음식을 준비하는<br v-if="infoBreak" />
        모두의 마음 속엔 소녀가 있습니다.
      </p>
      <p data-aos="fade-up" class="content">
        소녀방앗간은 청정지역 장인들이 해마다 정성들여 수확한 청정
        햇-식재료를<br v-if="!infoBreak" />수확한 만큼만 신선하게 담아 도시의
        소비자에게 건강한 한 끼로 대접합니다.
      </p>
    </section>
    <section class="wrap home-contents">
      <HomeContent title="식사공간" data-aos="fade-up">
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
            v-for="(data, index) of storeSlideData"
            :key="index"
            :data-index="index"
            data-name="DataName"
            @slideclick="handleStoreSlideClick"
          >
            <div class="store-content">
              <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
              <p>{{ data.storeName }}</p>
            </div>
          </Slide>
        </Carousel>
      </HomeContent>
      <HomeContent title="온라인몰" data-aos="fade-up" >
        <div class="online-mall-container">
          <div
            class="item"
            v-for="(data, index) of onlineMallSlideData"
            :key="index"
          >
            <HoverTextImage
              :src="isMobile ? data.mobilePath : data.pcPath"
              :href="data.link"
            >
              <p>
                {{ data.desc }}<br /><span>{{ data.name }}</span>
              </p>
            </HoverTextImage>
          </div>
        </div>
        <div class="online-mall-container-mobile">
          <Carousel
            ref="onlineMallCarousel"
            class="online-mall-carousel"
            :per-page="1"
            :scrollPerPage="false"
            :autoplayTimeout="4000"
            :paginationEnabled="true"
            :navigationEnabled="true"
            :navigationNextLabel="storeCarouselNavigationNext"
            :navigationPrevLabel="storeCarouselNavigationPrev"
            :autoplay="true"
            :loop="true"
            paginationColor="#c9caca"
          >
            <Slide
              v-for="(data, index) of onlineMallSlideData"
              :key="index"
              :data-index="index"
              data-name="DataName"
              @slideclick="handleStoreSlideClick"
            >
              <div class="online-mall-content">
                <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
                <p>
                  {{ data.desc }}<br /><span>{{ data.name }}</span>
                </p>
              </div>
            </Slide>
          </Carousel>
        </div>
      </HomeContent>
      <HomeContent title="케이터링" data-aos="fade-up" >
        <div
          class="clickable"
          @click="
            () => {
              this.$router.push('/catering');
            }
          "
        >
          <AssetImage
            :src="isMobile ? cateringImg.mobilePath : cateringImg.pcPath"
          />
        </div>
      </HomeContent>
      <HomeContent title="명절선물" data-aos="fade-up" >
        <div
          class="clickable"
          @click="
            () => {
              this.$router.push('/present');
            }
          "
        >
          <AssetImage
            :src="isMobile ? presentImg.mobilePath : presentImg.pcPath"
          />
        </div>
      </HomeContent>
    </section>
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
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
class StoreData extends ImgPath {
  public storeName = "";
}
class OnlineMallData extends ImgPath {
  public desc = "";
  public name = "";
  public link = "";
}

@Component({
  name: "Home",
  components: {
    Carousel,
    Slide,
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo
  }
})
export default class Home extends Vue {
  private mainSlideData: ImgPath[] = [];
  private storeSlideData: StoreData[] = [];
  private onlineMallSlideData: OnlineMallData[] = [];

  private cateringImg: ImgPath = new ImgPath();
  private presentImg: ImgPath = new ImgPath();

  private isMobile = false;
  private storeCarouselPerPage = 1;
  private mainCarouselPaginationActiveColor = "#c9caca";
  private homeContentCarouselPaginationActiveColor = "black";

  private curStoreIndex = 0;
  private infoBreak = false;

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  }

  created() {
    window.addEventListener("resize", this.handleResize);

    this.cateringImg.pcPath = "catering.jpg";
    this.cateringImg.mobilePath = "catering-m.jpg";

    this.presentImg.pcPath = "present.jpg";
    this.presentImg.mobilePath = "present-m.jpg";

    // TODO : Backend 개발 후 DB에서 불러오기
    for (let i = 0; i < 4; i++) {
      this.mainSlideData.push({
        pcPath: `slide/pc/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `slide/mobile/main-slide-${i + 1}.jpg`
      });
    }

    const storeName = [
      "서울숲시작점",
      "현대백화점 신도림점",
      "이화여대점",
      "마로니에점",
      "서울고속터미널점",
      "현대백화점 킨텍스점",
      "중곡시장점"
    ];
    for (let i = 0; i < storeName.length; i++) {
      this.storeSlideData.push({
        pcPath: `store/store-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `store/mobile/store-${i + 1}.jpg`,
        storeName: storeName[i]
      });
    }

    const onlineMallDesc = [
      "청송 약수와 토종콩 메주로 담근",
      "오랜 세월 깊어지는 맛",
      "100% 국내산 고춧가루로 담근",
      "태백산의 보물",
      "임금님이 드시던 나물",
      "봄나물의 대명사"
    ];
    const onlineMallName = [
      "재래식 간장 (550ml)",
      "재래식 된장 (450g)",
      "찹쌀 고추장 (450g)",
      "곤드레 (80g)",
      "어수리 (80g)",
      "취나물 (80g)"
    ];
    const onlineMallLink = ["/"];
    for (let i = 0; i < onlineMallName.length; i++) {
      this.onlineMallSlideData.push({
        pcPath: `online-mall/online-mall-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `online-mall/mobile/online-mall-${i + 1}.jpg`,
        desc: onlineMallDesc[i],
        name: onlineMallName[i],
        link: onlineMallLink[0]
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
      this.mainCarouselPaginationActiveColor = "white";
      this.homeContentCarouselPaginationActiveColor = "#001845";
    } else {
      this.storeCarouselPerPage = 3;
      this.infoBreak = false;
      this.mainCarouselPaginationActiveColor = "black";
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

@include mobile {
  .home {
    margin-top: 0.8vw;
  }
}

// 메인 이미지 슬라이드
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

      @include mobile {
        button.VueCarousel-dot {
          width: 2.5vw !important;
          height: 2.5vw !important;
        }
      }
    }

    // 메인 슬라이드 트랜지션 재정의
    .VueCarousel-inner {
      transition: transform 0s ease 1s !important;

      .VueCarousel-slide {
        transition: opacity 1s !important;
        opacity: 0 !important;
      }

      .VueCarousel-slide-active {
        transition: opacity 2s ease 1s !important;
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
.info {
  margin-top: 7.917vw;
  text-align: center;

  @include mobile {
    margin-top: 22.222vw;
  }

  .title {
    font-family: "munche_jemok_batang";
    font-size: 1.27vw;
    letter-spacing: -0.13px;
    color: #595757;

    @include mobile {
      font-size: 3.889vw;
      margin-left: 17.361vw;
      margin-right: 17.361vw;
      line-height: 1.67;
    }
  }

  .content {
    margin-top: 2.344vw;
    font-size: 1.1vw;
    line-height: 1.83;
    font-weight: 300;
    color: #595757;

    @include mobile {
      text-align: center;
      letter-spacing: normal;
      font-weight: 300;
      font-size: 3.611vw;
      margin-top: 7.5vw;
      margin-left: 11.944vw;
      margin-right: 11.944vw;
      line-height: 1.62;
    }
  }
}

.home-contents {
  margin-top: 11.458vw;

  @include mobile {
    margin-top: 21.389vw;
  }

  > * {
    margin-bottom: 11.458vw;

    &:last-child {
      margin-bottom: 8.802vw;
    }

    img {
      width: 100%;
    }

    @include mobile {
      margin-bottom: 21.389vw;

      &:last-child {
        margin-bottom: 20.833vw;
      }
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

  // 식사 공간
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
      p {
        font-weight: 300;
        margin-top: 1.146vw;
        text-align: center;
        font-size: 0.99vw;
      }

      @include mobile {
        p {
          font-size: 3.611vw;
          text-align: left;
        }
      }
    }
  }

  // 온라인 몰
  .online-mall-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.354vw 1.354vw;

    .item {
      p {
        font-size: 0.964vw;
        font-weight: 300;
        line-height: 1.57;

        span {
          font-weight: 500;
        }
      }

      img {
        width: 100%;
      }
    }

    @include mobile {
      display: none;
    }
  }

  // 온라인몰 모바일
  .online-mall-container-mobile {
    display: none;

    &::v-deep {
      @include RightAlignPagination(-1vw);
    }
    .online-mall-content {
      color: #595757;

      font-weight: 300;
      font-size: 3.611vw;
      line-height: 1.3;

      span {
        font-weight: normal;
      }
    }

    @include mobile {
      display: block;

      .VueCarousel-pagination {
        padding-top: 5vw;
      }

      .online-mall-content {
        color: #595757;

        font-weight: 300;
        font-size: 3.611vw;
        line-height: 1.3;

        span {
          font-weight: 300;
        }
      }
    }
  }
}

.clickable {
  cursor: pointer;
}
</style>
