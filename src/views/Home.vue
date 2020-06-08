<template>
  <main class="home">
    <section class="img-slider">
      <Carousel
        :per-page="1"
        :mouse-drag="false"
        paginationPosition="bottom-overlay"
        paginationColor="#c9caca"
        paginationSize="17"
      >
        <Slide v-for="(path, index) of slideImgPaths" :key="index">
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
        <AssetImage src="catering.png" />
      </HomeContent>
      <HomeContent title="온라인몰">
        <div class="online-mall-container">
          <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
          <div class="item">
            <HoverTextImage
              src="online-grid-template.png"
              infoHtml="<p style='font-weight:100;'>Hello, World!</p>"
            />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
          <div class="item">
            <HoverTextImage src="online-grid-template.png" />
          </div>
        </div>
      </HomeContent>
      <HomeContent title="케이터링">
        <ImageOverlayInfo src="catering.png" backgroundColor="#edeae6">
          <div class="on-overlay-info dark">
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
          <div class="on-overlay-info white">
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

  created() {
    this.slideImgPaths.push("slide/1.png");
    this.slideImgPaths.push("slide/1.png");
    this.slideImgPaths.push("slide/1.png");
    this.slideImgPaths.push("slide/1.png");
  }
}
</script>

<style lang="scss" scoped>
.img-slider {
  width: 100%;

  img {
    width: 100%;
  }
}

.info {
  margin-top: 7.75rem;
  text-align: center;

  .title {
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
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;

    .item {
      margin-bottom: 3.438rem;

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
      top: 4.313rem;
      bottom: 3.938rem;
      left: 2rem;
      right: 2.125rem;
    }

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
}
</style>
