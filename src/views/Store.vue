<template>
  <main class="store">
    <section class="main">
      <section data-aos="fade-up" class="img-slider">
        <div class="main-slide-wrapper">
          <agile :speed="1000">
            <AssetImage
              v-for="(data, index) of mainSlideData"
              :key="index"
              class="slide"
              :id="'main-carousel-slide-' + index"
              :src="isMobile ? data.mobilePath : data.pcPath"
            >
            </AssetImage>

            <template slot="prevButton">
              <AssetImage src="arrow-left-white.png" />
            </template>
            <template slot="nextButton">
              <AssetImage src="arrow-right-white.png" />
            </template>
          </agile>
        </div>
      </section>
      <div data-aos="fade-up" class="info-1">
        매일 다른 제철반찬과 향긋하게 윤기나는
        <br />산나물밥을 단정한 한 그릇에 담습니다.
      </div>
      <div data-aos="fade-up" class="info-2">
        식사공간에서는 편안하고 건강한 한 끼를 드실 수 있도록
        <br />설명하지 않아도 더 깊은 정보와 경험을 전하고자 합니다.
      </div>
    </section>
    <section class="contents">
      <HomeContent data-aos="fade-up" title="서울숲시작점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=35848947"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_1.main"
          :navSlides="store_1.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="현대백화점 신도림점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=37253784"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_2.main"
          :navSlides="store_2.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="이화여대점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?entry=plt&id=38232807&query=%EC%86%8C%EB%85%80%EB%B0%A9%EC%95%97%EA%B0%84%20%EC%9D%B4%ED%99%94%EC%97%AC%EB%8C%80%EC%A0%90"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_3.main"
          :navSlides="store_3.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="마로니에점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=1712003259"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_4.main"
          :navSlides="store_4.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="서울고속터미널점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=1440926417"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_5.main"
          :navSlides="store_5.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="현대백화점 킨텍스점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=1996930133"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_6.main"
          :navSlides="store_6.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
      <HomeContent data-aos="fade-up" title="중곡시장점">
        <a
          class="searchIcon"
          href="https://store.naver.com/restaurants/detail?id=1513302117"
        >
          <img src="@/assets/images/icon-searching.png" />
        </a>
        <CarouselWithNavCarousel
          :mainSlides="store_7.main"
          :navSlides="store_7.thumbnail"
          :isMobile="isMobile"
        />
      </HomeContent>
    </section>
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
  ImageOverlayInfo,
  CarouselWithNavCarousel
} from "@/components";
import Breakpoint from "@/utils/screenSize";

class ImgPath {
  public pcPath = "";
  public tabletPath = "";
  public mobilePath = "";
}

class ImgAndThumbnailPath {
  public main: string[] = [];
  public thumbnail: string[] = [];
}

@Component({
  name: "Store",
  components: {
    Carousel,
    Slide,
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo,
    CarouselWithNavCarousel,
    agile: VueAgile
  }
})
export default class Store extends Vue {
  private mainSlideData: ImgPath[] = [];
  private store_1: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_2: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_3: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_4: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_5: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_6: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private store_7: ImgAndThumbnailPath = new ImgAndThumbnailPath();
  private isMobile = false;
  private mainSlidePadding = 0;

  private firstExtraImgTransition = "";
  private lastExtraImgTransition = "";

  private storeSlides = {
    "seoul-forest": {
      main: [
        "store-page/seoul-forest/main/1.png",
        "store-page/seoul-forest/main/2.png",
        "store-page/seoul-forest/main/3.png",
        "store-page/seoul-forest/main/4.png",
        "store-page/seoul-forest/main/5.png"
      ],
      thumbnail: [
        "store-page/seoul-forest/thumbnail/1.png",
        "store-page/seoul-forest/thumbnail/2.png",
        "store-page/seoul-forest/thumbnail/3.png",
        "store-page/seoul-forest/thumbnail/4.png",
        "store-page/seoul-forest/thumbnail/5.png"
      ]
    }
  };

  created() {
    window.addEventListener("resize", this.handleResize);

    for (let i = 0; i < 6; i++) {
      this.mainSlideData.push({
        pcPath: `store-page/main/WEB/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `store-page/main/Mobile/main-slide-${i + 1}.jpg`
      });
    }

    for (let i = 1; i <= 7; i++) {
      this.store_1.main.push(`store-page/content-1/main/${i}.jpg`);
      this.store_1.thumbnail.push(`store-page/content-1/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 5; i++) {
      this.store_2.main.push(`store-page/content-2/main/${i}.jpg`);
      this.store_2.thumbnail.push(`store-page/content-2/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 6; i++) {
      this.store_3.main.push(`store-page/content-3/main/${i}.jpg`);
      this.store_3.thumbnail.push(`store-page/content-3/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 7; i++) {
      this.store_4.main.push(`store-page/content-4/main/${i}.jpg`);
      this.store_4.thumbnail.push(`store-page/content-4/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 7; i++) {
      this.store_5.main.push(`store-page/content-5/main/${i}.jpg`);
      this.store_5.thumbnail.push(`store-page/content-5/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 6; i++) {
      this.store_6.main.push(`store-page/content-6/main/${i}.jpg`);
      this.store_6.thumbnail.push(`store-page/content-6/thumbnail/${i}.jpg`);
    }

    for (let i = 1; i <= 5; i++) {
      this.store_7.main.push(`store-page/content-7/main/${i}.jpg`);
      this.store_7.thumbnail.push(`store-page/content-7/thumbnail/${i}.jpg`);
    }
  }

  mounted() {
    this.handleResize();
  }

  handleResize(/* e : Event */) {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  responseComponents() {
    if (this.isMobile) {
      this.mainSlidePadding = 0;
    } else {
      this.mainSlidePadding = 1920 * 0.143 * (window.innerWidth / 1920);
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
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

.main {
  width: 100%;

  .main-slide-wrapper {
    padding: 0 14.3%;
    overflow: hidden;

    &::v-deep {
      .agile {
        .agile__list {
          overflow: unset;
        }

        &__nav-button {
          position: absolute;
          background: transparent;
          border: none;

          top: 50%;
          transform: translateY(-50%);

          img {
            width: 1.458vw;
            height: 3.438vw;

            @include mobile {
              width: 3.889vw;
              height: 9.167vw;
            }
          }

          &--prev {
            left: -11.979vw;

            @include mobile {
              left: 2.778vw;
            }
          }

          &--next {
            right: -11.979vw;

            @include mobile {
              right: 2.778vw;
            }
          }
        }

        &__dots {
          bottom: 1.667vw;
          left: 50%;
          position: absolute;
          transform: translateX(-50%);

          @include mobile {
            bottom: 5.278vw;
          }
        }

        &__dot {
          margin: 0 0.599vw;

          button {
            background-color: #c9caca;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: block;
            width: 0.729vw;
            height: 0.729vw;
            font-size: 0;
            line-height: 0;
            margin: 0;
            padding: 0;
            transition-duration: 0.3s;
          }

          @include mobile {
            margin: 0 2.222vw;
            button {
              width: 2.5vw;
              height: 2.5vw;
            }
          }

          &--current {
            button {
              background-color: white;
            }
          }
        }
      }
    }

    .slide {
      width: 100%;
      object-fit: cover;
      display: block;
    }

    @include mobile {
      padding: 0;
    }
  }

  div {
    color: #595757;
    text-align: center;
  }

  .info-1 {
    font-size: 1.354vw;
    font-family: "munche_jemok_batang";
    padding-top: 7.448vw;
    letter-spacing: -0.007vw;
    line-height: 2.292vw;

    @include mobile {
      font-size: 4.167vw;
      line-height: 6.944vw;
      padding-top: 20.278vw;
      letter-spacing: -0.022vw;
    }
  }

  .info-2 {
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.91;
    padding-top: 1.979vw;

    @include mobile {
      font-size: 3.511vw;
      line-height: 5.833vw;
      padding-top: 5vw;
    }
  }
}

.contents {
  margin-left: 14.323vw;
  margin-right: 14.323vw;

  @include mobile {
    margin-left: 9.167vw;
    margin-right: 9.167vw;
  }

  article {
    margin-top: 9.375vw;

    @include mobile {
      margin-top: 23.333vw;
    }

    &:nth-child(1) {
      margin-top: 8.854vw;

      @include mobile {
        margin-top: 20.556vw;
      }
    }

    &:last-child {
      margin-bottom: 11.406vw;

      @include mobile {
        margin-bottom: 20.833vw;
      }
    }

    .searchIcon {
      position: absolute;
      top: 0;
      right: 0;

      img {
        width: 1.719vw;
      }

      @include mobile {
        img {
          width: 4.444vw;
        }
      }
    }
  }
}
</style>
