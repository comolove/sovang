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
        :loop="true"
        paginationPosition="bottom-overlay"
        paginationColor="#c9caca"
        :paginationSize="14"
        :paginationPadding="10"
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
        좋은 음식을 준비하는 모두의 마음 속엔 소녀가 있습니다.
      </p>
      <p class="content">
        소녀방앗간은 청정지역 장인들이 해마다 정성들여 수확한 청정
        햇-식재료를<br />
        수확한 만큼만 신선하게 담아 도시의 소비자에게 건강한 한 끼로 대접합니다.
      </p>
    </section>
    <section class="wrap home-contents">
      <HomeContent title="식사공간">
        <Carousel
          ref="storeCarousel"
          class="store-carousel"
          :per-page="3"
          :scrollPerPage="false"
          :paginationEnabled="false"
          :navigationEnabled="true"
          :navigationNextLabel="navigationNext"
          :navigationPrevLabel="navigationPrev"
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
            <HoverTextImage
              :src="data.imgPath"
              :infoHtml="data.info"
              :href="data.link"
            />
          </div>
        </div>
      </HomeContent>
      <HomeContent title="케이터링">
        <ImageOverlayInfo src="catering.png" backgroundColor="#edeae6">
          <div
            class="on-overlay-info dark"
            @click="
              () => {
                this.$router.push('/catering');
              }
            "
          >
            <div class="overlay-header">
              <p>로컬청정재료를 건강하고 지속가능하게</p>
              <h2>청정재료 케이터링</h2>
            </div>
            <div class="overlay-content">
              <p>
                산지직송 로컬푸드 중 제철재료만을 골라, 저염 건강식으로
                고급스럽게 도시락과 케이터링을 준비합니다. 로컬푸드 식재료를
                가장 건강하게 즐길 수 있는 레시피로 행사와 모임에 품격을 더하며,
                지속가능한 식습관을 제안합니다.
              </p>
              <a>&lt; 케이터링 소식 더 보러가기 &gt;</a>
            </div>
          </div>
        </ImageOverlayInfo>
      </HomeContent>
      <HomeContent title="명절선물">
        <ImageOverlayInfo src="present.png" backgroundColor="#867d72">
          <div
            class="on-overlay-info white"
            @click="
              () => {
                this.$router.push('/present');
              }
            "
          >
            <div class="overlay-header">
              <p>매해 가장 좋은 재료로</p>
              <h2>산지직송 명절선물</h2>
            </div>
            <div class="overlay-content">
              <p>
                50년 경력의 청정지역 장인들이 직접 손으로 한땀 한땀 정성들여
                수확한 청정재료로 한 해의 고마움을 전합니다. 땅과 공기가 줄 수
                있는 에너지를 온전히 담은 재료로 청정지역 장인들의 수준높은
                식문화를 전합니다.
              </p>
              <a>&lt; 명절선물 소식 더 보러가기 &gt;</a>
            </div>
          </div>
        </ImageOverlayInfo>
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
  private storeData: {imgPath : string, storeName : string}[] = [];
  private onlineMallData: {imgPath : string, info : string, link : string}[] = [];

  private curStoreIndex = 0;

  created() {
    this.slideImgPaths.push("slide/1.png");
    this.slideImgPaths.push("slide/1.png");
    this.slideImgPaths.push("slide/1.png");

    for (let i = 0 ; i < 8; i++)
    {
      this.onlineMallData.push({
        imgPath : "online-grid-template.png",
        info : "<p style='font-weight:100;'>Hello, World!</p>",
        link : "https://google.com"
      });
    }

    for (let i = 0 ; i < 11; i++)
    {
      this.storeData.push({
        imgPath : "store.png",
        storeName : i.toString()
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
      ((document as Document).getElementById(
        "main-carousel-slide-0"
      ) as Element).classList.remove("VueCarousel-slide-active");
    }, 6000);
  }

  handleStoreSlideClick(dataset: {index : string}) {
    this.curStoreIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.storeCarousel as Carousel).goToPage(this.curStoreIndex - 1);
  }

  public get navigationNext(): string {
    return `<img src=${require("@/assets/images/arrow-right.png")} style="margin-left:4.25rem;">`;
  }

  public get navigationPrev(): string {
    return `<img src=${require("@/assets/images/arrow-left.png")} style="margin-right:4.25rem;">`;
  }
}
</script>

<style lang="scss" scoped> 
.img-slider {
  width: 100%;

  &::v-deep .VueCarousel-pagination--bottom-overlay {
    bottom: 2.063rem;
  }

  &::v-deep .VueCarousel-inner {
    // transition: none !important;
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
.info {
  margin-top: 7.75rem;
  text-align: center;

  .title {
    font-family: mbatang;
    font-size: 1.813rem;
    letter-spacing: -0.15px;
  }

  .content {
    margin-top: 2.813rem;
    font-size: 1.563rem;
    line-height: 1.68;
    font-weight: 300;
  }
}

.home-contents {
  margin-top: 11.5rem;

  > * {
    margin-bottom: 14.25rem;

    img {
      width: 100%;
    }
  }

  .online-mall-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.188rem 1.625rem;

    .item {
      img {
        width: 100%;
      }
    }
  }

  .on-overlay-info {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: {
      top: 13.7%;
      bottom: 12.1%;
      left: 8%;
      right: 2.125rem;
    }
    cursor: pointer;

    &.dark {
      color: #595757;
    }
    &.white {
      color: white;
    }

    h2 {
      font-size: 1.719vw;
      letter-spacing: -0.42px;
    }

    p,
    a {
      font-size: 1.094vw;
      font-weight: 300;
      line-height: 1.38;
    }

    a {
      display: inline-block;
      font-style: italic;
      margin-top: 2.063rem;
    }
  }

  .store-carousel {
    .VueCarousel-slide > div {
      padding-left: 0.5rem;
      padding-right: 2.125rem;
    }

    .store-content {
      p {
        margin-top: 1.563rem;
        text-align: center;
        font-size: 1.469rem;
      }
    }
  }
}
</style>
