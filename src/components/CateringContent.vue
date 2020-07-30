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
    :spacePadding="-12.5"
    paginationColor="#c9caca"
    :paginationActiveColor="carouselPaginationActiveColor"
    @page-change="handleCarouselChange"
  >
    <Slide
      v-for="(data, index) of contentData"
      :key="index"
      :data-index="index"
      data-name="DataName"
    >
      <div>
        <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
        <div class="info-3">
          <div class="info-4">
            <span class="bold" v-html="data.title"></span>
            <span class="price" v-html="data.price" />
          </div>
          <div class="info-5"><span v-html="data.info"></span></div>
        </div>
      </div>
    </Slide>
  </Carousel>
</template>

<script lang="ts">
import { Component, Vue, Prop } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import { AssetImage } from "@/components";
import ScreenSize from "@/utils/screenSize";

class ImgPath {
  public pcPath = "";
  public tabletPath = "";
  public mobilePath = "";
}

class CateringContentData extends ImgPath {
  public title = "";
  public price = "";
  public info = "";
}

@Component({
  name: "CarouselContent",
  components: {
    AssetImage,
    Carousel,
    Slide
  }
})
export default class CateringContent extends Vue {
  @Prop() contentData!: CateringContentData[];
  @Prop() slidePadding!: number;

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

  handleResize(/* e : Event */) {
    this.isMobile = ScreenSize.tablet > window.innerWidth ? true : false;

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

.info {
  text-align: center;
  color: #595757;
  font-weight: 300;

  &-3 {
    background: white;
  }

  &-4 {
    padding: 0.964vw 0 0 0.885vw;
    font-size: 0.99vw;
    line-height: 1.53;
    color: #747171;

    @include mobile {
      padding: 3.194vw 0 0 2.778vw;
      font-size: 2.778vw;
      line-height: 1.7;
      color: #595757;
    }
  }

  &-5 {
    padding: 0.417vw 0 0.833vw 0.885vw;
    font-size: 0.99vw;
    line-height: 1.53;
    color: #747171;

    @include mobile {
      padding: 0 0 2.639vw 16.389vw;
      font-size: 2.778vw;
      line-height: 1.7;
      color: #595757;
    }
  }
}

.bold {
  color: #001845;
  padding-right: 0.5vw;
  font-weight: 500;

  @include mobile {
    padding: 0;
  }
}

.price {
  @include mobile {
    padding: 0 0 0 5.833vw;
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

.carousel {
  // 매장 이미지들의 사이 간격
  .VueCarousel-slide {
    @include mobile {
      width: 81.667vw;
    }
  }
  .VueCarousel-slide > div {
    width: 22.917vw;

    @include mobile {
      width: 81.667vw;
    }

    img {
      width: 22.917vw;

      @include mobile {
        width: 81.667vw;
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
        top: 40%;
      }
    }

    .VueCarousel-navigation-next {
      transform: translateY(-70%) translateX(150%);

      @include mobile {
        right: 11.944vw;
        top: 40%;
      }
    }

    @include mobile {
      @include RightAlignPagination(-4.856vw);
    }
  }
}
</style>
