<template>
  <Carousel
    ref="carousel"
    class="carousel"
    :per-page="carouselPerPage"
    :scrollPerPage="false"
    :autoplayTimeout="4000"
    :paginationEnabled="isMobile ? false : true"
    :navigationEnabled="true"
    :navigationNextLabel="carouselNavigationNext"
    :navigationPrevLabel="carouselNavigationPrev"
    :autoplay="true"
    :loop="true"
    :spacePadding="-20"
    paginationColor="#c9caca"
    :paginationActiveColor="carouselPaginationActiveColor"
    @page-change="handleCarouselChange"
  >
    <Slide
      v-for="(data, index) of slideData"
      :key="index"
      :data-index="index"
      data-name="DataName"
      @slideclick="handleSlideClick"
    >
      <div class="additionalContent">
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
</template>

<script lang="ts">
import { Component, Vue, Prop } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import { AssetImage } from "@/components";
import Breakpoint from "@/utils/screenSize";
import ScreenSize from "@/utils/screenSize";

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
  name: "CarouselContent",
  components: {
    AssetImage,
    Carousel,
    Slide
  }
})
export default class CarouselContent extends Vue {
  @Prop() slideData!: CateringStoryData[];

  private carouselPerPage = 1;
  private curIndex = 0;
  private carouselPaginationActiveColor = "";
  private isMobile = true;

  created() {
    window.addEventListener("resize", this.handleResize);
  }

  mounted() {
    this.handleResize();
    this.responseComponents();
  }

  handleSlideClick(dataset: { index: string }) {
    this.curIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.carousel as Carousel).goToPage(this.curIndex - 1);
  }

  handleResize(/* e : Event */) {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleCarouselChange(index: number) {
    this.curIndex = index;
  }

  responseComponents() {
    if (this.isMobile) {
      this.carouselPerPage = 1;
      this.carouselPaginationActiveColor = "#001845";
    } else {
      this.carouselPerPage = 3;
      this.carouselPaginationActiveColor = "black";
    }
  }

  public get carouselNavigationNext(): string {
    if (this.isMobile)
      return `<img 
              src=${require("@/assets/images/arrow-right-white.png")} 
              style="width:3.889vw;"
            >`;

    return `<img 
              src=${require("@/assets/images/arrow-right-black.png")} 
              style="width:1.042vw;"
            >`;
  }

  public get carouselNavigationPrev(): string {
    if (this.curIndex == 0 || this.isMobile)
      return `<img 
              src=${require("@/assets/images/arrow-left-white.png")} 
              style="width:3.889vw;"
            >`;

    return `<img 
              src=${require("@/assets/images/arrow-left-black.png")} 
              style="width:1.042vw;"
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

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

.carousel {
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

      @include mobile {
        left: 11.944vw;
        top: 45%;
      }
    }

    .VueCarousel-navigation-next {
      transform: translateY(-70%) translateX(150%);

      @include mobile {
        right: 11.944vw;
        top: 45%;
      }
    }

    @include mobile {
      @include RightAlignPagination(-4.856vw);
    }
  }

  // 매장 사진 밑에 텍스트
  .additionalContent {
    height: 19.323vw;

    @include mobile {
      height: 66.389vw;
    }

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

        @include mobile {
          color: #001845;
          font-size: 2.778vw;
        }
      }

      @include mobile {
        padding-top: 56.667vw;
        color: #001845;
        font-size: 3.611vw;
        line-height: 5.417vw;
      }
    }
  }
}
</style>