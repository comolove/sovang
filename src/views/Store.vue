<template>
  <main class="store" ref="main">
    <Header />
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
      <HomeContent
        v-for="(store, index) in stores"
        :key="index"
        :title="store.storeName"
        data-aos="fade-up"
      >
        <MapLink :link="store.link" />
        <CarouselWithNavCarousel
          :mainSlides="getMainSlideOfStore(store)"
          :navSlides="getNavSlideOfStore(store)"
          :isMobile="isMobile"
        />
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
import { Carousel, Slide } from "vue-carousel";
import { VueAgile } from "vue-agile";
import {
  Header,
  Footer,
  HomeContent,
  AssetImage,
  ImageOverlayInfo,
  CarouselWithNavCarousel
} from "@/components";
import { MapLink } from "@/components/Store";
import { AxiosHelper, screenSize, ImgPath, Store as StoreData } from "@/utils";

@Component({
  name: "Store",
  components: {
    Header,
    Footer,
    Carousel,
    Slide,
    HomeContent,
    AssetImage,
    ImageOverlayInfo,
    CarouselWithNavCarousel,
    MapLink,
    agile: VueAgile
  }
})
export default class Store extends Vue {
  private mainSlideData: ImgPath[] = [];
  private stores: StoreData[] = [];

  private isMobile = false;
  private isVisible = false;
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

  async created() {
    window.addEventListener("resize", this.handleResize);
    window.addEventListener("scroll", this.handleScroll);

    for (let i = 0; i < 6; i++) {
      this.mainSlideData.push({
        name: "",
        pcPath: `store-page/main/WEB/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `store-page/main/Mobile/main-slide-${i + 1}.jpg`
      });
    }

    await this.LoadStores();
  }

  mounted() {
    this.handleResize();
  }

  async LoadStores() {
    try {
      const { data } = await AxiosHelper.GET("/getStore.php");
      const list = data.data as StoreData[];

      this.stores = list;
    } catch (error) {
      console.log("식사공간 로딩 실패");
      console.log(error);
    }
  }

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
    window.removeEventListener("scroll", this.handleScroll);
  }

  getMainSlideOfStore(store: StoreData): string[] {
    return store.imgList.map(value => {
      return value.pcPath;
    });
  }

  getNavSlideOfStore(store: StoreData): string[] {
    return store.imgList.map(value => {
      return value.mobilePath;
    });
  }

  handleResize(/* e : Event */) {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleScroll(/* e : Evuent */) {
    if (window.scrollY > ((this.$refs.main as HTMLElement).clientHeight as number - window.innerHeight)+(window.innerWidth*(this.isMobile?0.06389:0.07849))-5)
      this.isVisible = true;
    else this.isVisible = false;
  }

  goTop() {
    window.scroll({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
  }

  responseComponents() {
    if (this.isMobile) {
      this.mainSlidePadding = 0;
    } else {
      this.mainSlidePadding = 1920 * 0.143 * (window.innerWidth / 1920);
    }
  }

  get mainCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-white.png")}
            >`;
  }

  get mainCarouselNavigationPrev(): string {
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
            cursor: pointer;

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

      @include mobile {
        height: auto;
      }
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
  }
}

.button-go-top {
  position: fixed;
  width: 3.385vw;
  bottom: 23.365vw;
  right: 14.299vw;
  transition: opacity 0.5s;
  opacity: 0;
  cursor: pointer;

  @include mobile {
    width: 9.167vw;
    height: 7.222vw;
    bottom: 49.611vw;
    right: 9.167vw;
  }

  &-visible {
    opacity: 1;
  }
  &-invisible {
    opacity: 0;
  }
}
</style>
