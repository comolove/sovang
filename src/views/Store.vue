<template>
  <main class="store">
    <section class="main">
      <agile
        v-show="!isMobile"
        :autoplay="true"
        :autoplaySpeed="6000"
        :slidesToShow="1"
        :centerMode="true"
      >
        <AssetImage
          v-for="(data, index) of mainSlideData"
          :key="index"
          :id="'main-carousel-slide-' + index"
          :src="isMobile ? data.mobilePath : data.pcPath"
        />
        <template slot="prevButton" class="leftPaginationImg pagination">
          <img src="@/assets/images/arrow-left-white.png" />
        </template>
        <template slot="nextButton" class="rightPaginationImg pagination">
          <img src="@/assets/images/arrow-right-white.png" />
        </template>
      </agile>
      <section data-aos="fade-up" class="img-slider" v-show="isMobile">
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
      <div class="info-1">
        매일 다른 제철반찬과 향긋하게 윤기나는
        <br />산나물밥을 단정한 한 그릇에 담습니다.
      </div>
      <div class="info-2">
        식사공간에서는 편안하고 건강한 한 끼를 드실 수 있도록
        <br />설명하지 않아도 더 깊은 정보와 경험을 전하고자 합니다.
      </div>
    </section>
    <section class="contents">
      <HomeContent title="서울숲시작점">
        <a href="https://store.naver.com/restaurants/detail?id=35848947">
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="현대백화점 신도림점">
        <a href="https://store.naver.com/restaurants/detail?id=37253784">
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="이화여대점">
        <a
          href="https://store.naver.com/restaurants/detail?entry=plt&id=38232807&query=%EC%86%8C%EB%85%80%EB%B0%A9%EC%95%97%EA%B0%84%20%EC%9D%B4%ED%99%94%EC%97%AC%EB%8C%80%EC%A0%90"
        >
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="마로니에점">
        <a href="https://store.naver.com/restaurants/detail?id=1712003259">
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="서울고속터미널점">
        <a href="https://store.naver.com/restaurants/detail?id=1440926417">
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="현대백화점 킨텍스점">
        <a href="https://store.naver.com/restaurants/detail?id=1996930133">
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
      <HomeContent title="중곡제일시장점">
        <a
          href="https://search.naver.com/search.naver?sm=tab_hty.top&where=nexearch&query=%EC%86%8C%EB%85%80%EB%B0%A9%EC%95%97%EA%B0%84+%EC%A4%91%EA%B3%A1%EC%A0%9C%EC%9D%BC%EC%8B%9C%EC%9E%A5%EC%A0%90&oquery=%EC%86%8C%EB%85%80%EB%B0%A9%EC%95%97%EA%B0%84+%ED%98%84%EB%8C%80%EB%B0%B1%ED%99%94%EC%A0%90+%ED%82%A8%ED%85%8D%EC%8A%A4%EC%A0%90&tqi=UYqzrsprvmZssF1J9HRssssstul-415622"
        >
          <img class="searchIcon" src="@/assets/images/icon-searching.png" />
        </a>
      </HomeContent>
    </section>
    <agile
      :autoplay-speed="1000"
      :speed="2500"
      :fade="true"
      :pauseOnHover="true"
      :dots="false"
      :centerMode="true"
      :pauseOnDotsHover="true"
      :autoplay="true"
      :slidesToShow="2"
    >
      <img
        class="slide"
        src="https://images.unsplash.com/photo-1509549649946-f1b6276d4f35?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE0NTg5fQ"
      />
      <img
        class="slide"
        src="https://images.unsplash.com/photo-1511469054436-c7dedf24c66b?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjEyMDd9"
      />
      <img
        class="slide"
        src="https://images.unsplash.com/photo-1511135232973-c3ee80040060?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjEyMDd9"
      />
      <img
        class="slide"
        src="https://images.unsplash.com/photo-1511231683436-44735d14c11c?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjEyMDd9"
      />
      <img
        class="slide"
        src="https://images.unsplash.com/photo-1517677129300-07b130802f46?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1600&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjEyMDd9"
      />
    </agile>
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { VueAgile } from "vue-agile";
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

@Component({
  name: "Store",
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
export default class Store extends Vue {
  private mainSlideData: ImgPath[] = [];
  private isMobile = false;
  private mainCarouselPaginationActiveColor = "";

  created() {
    window.addEventListener("resize", this.handleResize);

    for (let i = 0; i < 6; i++) {
      this.mainSlideData.push({
        pcPath: `store-page/main/WEB/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `store-page/main/Mobile/main-slide-${i + 1}.jpg`
      });
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
      this.mainCarouselPaginationActiveColor = "white";
    } else {
      this.mainCarouselPaginationActiveColor = "black";
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
  .agile {
    width: 100%;

  }

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

      img {
        width: 100%;
      }
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
    height: 40.313vw;

    @include mobile {
      margin-top: 23.194vw;
      height: 97.222vw;
    }

    &:nth-child(1) {
      margin-top: 8.281vw;

      @include mobile {
        margin-top: 20.556vw;
      }
    }

    .searchIcon {
      position: relative;
      bottom: 5vw;
      width: 1.719vw;
      left: 69.583vw;

      @include mobile {
        width: 4.444vw;
        bottom: 11.5vw;
        left: 77.222vw;
      }
    }
  }
}
</style>
