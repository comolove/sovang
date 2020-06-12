<template>
  <main class="home">
    <section class="img-slider">
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
      >
        <Slide
          v-for="(path, index) of slideImgPaths"
          :key="index"
          :id="'main-carousel-slide-' + index"
        >
          <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
          <AssetImage :src="path" />
        </Slide>
      </Carousel>
    </section>
    <section class="info">
      <p class="title">
        좋은 음식을 준비하는<br v-if="infoBreak" />
        모두의 마음 속엔 소녀가 있습니다.
      </p>
      <p class="content">
        소녀방앗간은 청정지역 장인들이 해마다 정성들여 수확한 청정 햇-식재료를
        <br v-if="!infoBreak" />수확한 만큼만 신선하게 담아 도시의 소비자에게
        건강한 한 끼로 대접합니다.
      </p>
    </section>
    <section class="wrap home-contents">
      <HomeContent title="식사공간">
        <Carousel
          ref="storeCarousel"
          class="store-carousel"
          :per-page="storeCarouselPerPage"
          :scrollPerPage="false"
          :autoplayTimeout="4000"
          :paginationEnabled="false"
          :navigationEnabled="true"
          :navigationNextLabel="storeCarouselNavigationNext"
          :navigationPrevLabel="storeCarouselNavigationPrev"
          :autoplay="true"
          :loop="true"
          :spacePadding="-15"
          @page-change="handleStoreCarouselChange"
        >
          <Slide
            v-for="(data, index) of storeData"
            :key="index"
            :data-index="index"
            data-name="DataName"
            @slideclick="handleStoreSlideClick"
          >
            <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
            <div class="store-content">
              <AssetImage :src="data.imgPath" />
              <p>{{ data.storeName }}</p>
            </div>
          </Slide>
        </Carousel>
      </HomeContent>
      <HomeContent title="온라인몰">
        <div class="online-mall-container">
          <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
          <div
            class="item"
            v-for="(data, index) of onlineMallData"
            :key="index"
          >
            <HoverTextImage :src="data.imgPath" :href="data.link">
              <p>
                {{ data.desc }}<br /><span>{{ data.name }}</span>
              </p>
            </HoverTextImage>
          </div>
        </div>
        <div class="online-mall-container-mobile">
          <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
          <Carousel
            ref="onlineMallCarousel"
            class="online-mall-carousel"
            :per-page="1"
            :scrollPerPage="false"
            :paginationEnabled="false"
            :navigationEnabled="true"
            :navigationNextLabel="storeCarouselNavigationNext"
            :navigationPrevLabel="storeCarouselNavigationPrev"
            :autoplay="true"
            :loop="true"
          >
            <Slide
              v-for="(data, index) of storeData"
              :key="index"
              :data-index="index"
              data-name="DataName"
              @slideclick="handleStoreSlideClick"
            >
              <div class="store-content">
                <AssetImage :src="data.imgPath" />
                <p>{{ data.storeName }}</p>
              </div>
            </Slide>
          </Carousel>
        </div>
      </HomeContent>
      <HomeContent title="케이터링">
        <div
          class="clickable"
          @click="
            () => {
              this.$router.push('/catering');
            }
          "
        >
          <AssetImage src="catering.jpg" />
        </div>
      </HomeContent>
      <HomeContent title="명절선물">
        <div
          class="clickable"
          @click="
            () => {
              this.$router.push('/present');
            }
          "
        >
          <AssetImage src="present.jpg" />
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
  private slideImgPaths: string[] = [];
  private storeData: { imgPath: string; storeName: string }[] = [];
  private onlineMallData: {
    imgPath: string;
    desc: string;
    name: string;
    link: string;
  }[] = [];

  private storeCarouselPerPage = 1;
  private curStoreIndex = 0;
  private infoBreak = false;

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  }

  created() {
    window.addEventListener("resize", this.handleResize);
    for (let i = 1; i <= 4; i++) {
      this.slideImgPaths.push(`slide/pc/main-slide-${i}.jpg`);
    }

    this.storeData.push({
      imgPath: "store/5)web_매장_서울숲시작점.jpg",
      storeName: "서울숲시작점"
    });
    this.storeData.push({
      imgPath: "store/6)web_매장_현대백화점신도림점.jpg",
      storeName: "현대백화점 신도림점"
    });
    this.storeData.push({
      imgPath: "store/7)web_매장_이화여대점.jpg",
      storeName: "이화여대점"
    });
    this.storeData.push({
      imgPath: "store/8)web_매장_마로니에점.jpg",
      storeName: "마로니에점"
    });
    this.storeData.push({
      imgPath: "store/9)web_매장_고속터미널점.jpg",
      storeName: "고속터미널점"
    });
    this.storeData.push({
      imgPath: "store/10)web_매장_킨텍스점.jpg",
      storeName: "킨텍스점"
    });
    this.storeData.push({
      imgPath: "store/11)web_매장_중곡시장점.jpg",
      storeName: "중곡시장점"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/12)web_온라인몰_간장.jpg",
      desc: "오랜 세월 깊어지는 맛",
      name: "재래식 된장 (450g)",
      link: "/"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/13)web_온라인몰_된장.jpg",
      desc: "100% 국내산 고춧가루로 담근",
      name: "찹쌀 고추장 (450g)",
      link: "/"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/14)web_온라인몰_고추장.jpg",
      desc: "임금님이 드시던 나물",
      name: "어수리 (80g)",
      link: "/"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/15)web_온라인몰_곤드레.jpg",
      desc: "태백산의 보물",
      name: "곤드레 (80g)",
      link: "/"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/16)web_온라인몰_어수리.jpg",
      desc: "봄나물의 대명사",
      name: "취나물 (80g)",
      link: "/"
    });

    this.onlineMallData.push({
      imgPath: "online-mall/17)web_온라인몰_취나물.jpg",
      desc: "오랜 세월 깊어지는 맛",
      name: "재래식 된장 (450g)",
      link: "/"
    });
  }

  mounted() {
    // vue-carousel mounted시 첫 번째 요소가 활성화 클래스 태그가 안붙는 문제가 있음
    ((document as Document).getElementById(
      "main-carousel-slide-0"
    ) as Element).classList.add("VueCarousel-slide-active");

    setTimeout(() => {
      // 슬라이드가 바뀌어도 임의로 넣어준 active 클래스는 삭제가 안되서 n초후에 임의로 삭제
      ((document as Document).getElementById(
        "main-carousel-slide-0"
      ) as Element).classList.remove("VueCarousel-slide-active");
    }, 6000);

    if (Breakpoint.tablet > window.innerWidth) {
      this.infoBreak = true;
      this.storeCarouselPerPage = 1;
    } else {
      this.infoBreak = false;
      this.storeCarouselPerPage = 3;
    }
  }

  handleStoreSlideClick(dataset: { index: string }) {
    this.curStoreIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.storeCarousel as Carousel).goToPage(this.curStoreIndex - 1);
  }

  handleResize(/* e : Event */) {
    if (Breakpoint.tablet > window.innerWidth) {
      this.infoBreak = true;
    } else {
      this.infoBreak = false;
    }
  }

  handleStoreCarouselChange(index: number) {
    this.curStoreIndex = index;
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
    return `<img 
              src=${require("@/assets/images/arrow-right-black.png")} 
              style="margin-left:1.771vw;margin-bottom:3.646vw;width:1.042vw;"
            >`;
  }

  public get storeCarouselNavigationPrev(): string {
    if (this.curStoreIndex == 0) return "";

    return `<img 
              src=${require("@/assets/images/arrow-left-black.png")} 
              style="margin-right:1.771vw;margin-bottom:3.646vw;width:1.042vw;"
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";
@import url(http://fonts.googleapis.com/earlyaccess/notosanskr.css);

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
    }

    .VueCarousel-navigation-next {
      transform: unset;
      right: 3.229vw;
      top: 17.188vw;

      img {
        width: 1.458vw;
      }
    }

    // 메인 슬라이드 페이지네이션 버튼 위치
    .VueCarousel-pagination--bottom-overlay {
      bottom: 1.667vw;

      button.VueCarousel-dot {
        width: 0.729vw;
        height: 0.729vw;
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
      max-width: 100%;
      width: 316vw;
      height: 131.667vw;
      object-fit: cover;
      overflow: hidden;
    }
  }
}
.info {
  margin-top: 7.917vw;
  text-align: center;

  @include mobile {
    margin-top: 13.889vw;
  }

  .title {
    font-family: "munche_jemok_batang";
    font-size: 1.354vw;
    letter-spacing: -0.13px;

    @include mobile {
      font-size: 4vw;
      width: 65.278vw;
      height: 11.111vw;
      margin-left: 17.361vw;
      margin-right: 17.361vw;
      line-height: 6vw;
    }
  }

  .content {
    margin-top: 2.344vw;
    font-size: 1.198vw;
    line-height: 1.83;
    font-weight: 300;

    @include mobile {
      font-family: "Noto Sans KR";
      color: #595757;
      margin-top: 7.5vw;
      margin-left: 11.944vw;
      margin-right: 11.944vw;
      line-height: 5vw;
      font-size: 3.611vw;
      height: 15.278vw;
    }
  }
}

.home-contents {
  margin-top: 11.458vw;

  @include mobile {
    margin-top: 17.5vw;
    padding-right: 9.167vw;
    padding-left: 9.167vw;
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
      margin-bottom: 17.222vw;
      &:nth-last-child(1) {
        margin-bottom: 20.278vw;
      }
    }
  }

  // 식사 공간
  .store-carousel {
    // 매장 이미지들의 사이 간격
    .VueCarousel-slide > div {
      // padding-left: 0.417vw;
      padding-right: 1.354vw;
      img {
        width: 22.917vw;
        @include mobile{
          width: 100%;
        }
      }
    }

    // 매장 사진 밑에 텍스트
    .store-content {
      p {
        margin-top: 1.146vw;
        text-align: center;
        font-size: 0.99vw;
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
    @include mobile {
      display: block;
    }
  }
}

.clickable {
  cursor: pointer;
}
</style>
