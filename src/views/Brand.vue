<template>
  <main class="brand">
    <section class="main">
      <AssetImage :src="mainImgPath" />
    </section>
    <section class="contents">
      <HomeContent title="농촌과 도시를 잇다">
        <AssetImage :src="'brand-page/' + (isMobile?'Mobile':'WEB') + '/content-1.jpg'" />
        <div class="info-1">
          농사 장인이
          <br />직접 생산한 청정재료를
          <br />도시의 건강한 먹거리로
          <br />
        </div>
        <div class="info-2">
          소녀방앗간의 먹거리는 수십 년간 평생 농사를
          지어온 장인들이 고향 땅에서 직접 키웠습니다.
          식재료는 태백산맥 산악지형으로 둘러싸인 청정지역
          경북 청송에서 재배하였습니다.
          <br />
          <br />소녀방앗간은 땅과 공기가 줄 수 있는 에너지를
          온전히 담은 재료로 청정지역 장인들의 수준 높은
          식문화를 전합니다.
        </div>
      </HomeContent>
      <HomeContent title="지속가능한 생산, 유통, 소비">
        <AssetImage :src="'brand-page/' + (isMobile?'Mobile':'WEB') + '/content-2.jpg'" />
        <div class="info-1">
          지속가능한 생산과
          <br />낭비없는 소비의 순환
        </div>
        <div class="info-2">
          오지 어르신들과 10년간 청정재료를 재배해 온
          청년들이 모여 소녀방앗간을 운영합니다. 지역
          생산자들과는 꾸준하고 안정적인 거래를 이어가고,
          도시 소비자들에게는 농부의 정성어린 먹거리를
          건강한 한끼로 제공하여 모두를 위한 선순환을
          만들어 갑니다.
        </div>
      </HomeContent>
      <HomeContent title="함께하는 로컬 네트워크">
        <div class="info-2">
          소녀방앗간은 '모두의 먹을거리'에 대한 진정성을 바탕으로
          생산자와 소비자 모두를 위한 농업유통을 고민합니다.
          <br />
          <br />지난 10년간 전국 각지에서 150여분의 생산자를 만나, 농산물을
          계약재배하여 지속가능한 농업생산물 유통전문 브랜드로
          성장해왔습니다. 소녀방앗간은 건강한 식재료를 위해 지속가능한
          생산과 낭비 없는 소비의 순환 원칙을 지켜갑니다.
        </div>
        <AssetImage :src="'brand-page/' + (isMobile?'Mobile':'WEB') + '/content-3.png'" />
      </HomeContent>
      <HomeContent title="청정지역, 오지의 메리트">
        <AssetImage :src="'brand-page/' + (isMobile?'Mobile':'WEB') + '/content-4.jpg'" />
        <div class="info-2">
          오지(奧地).
          <br />그 곳은 완전히 지워지지 않은 옛 삶의 방식이
          고스란히 남겨져 있었고, 먹거리에 관한 오래된
          유산을 이어받을 수 있는 곳이었습니다．
          <br />
          <br />산 속에 핀 수많은 풀 중에 먹을 것을 골라내는 눈,
          고구려 사람들로부터 이어져 내려온 발효음식의
          전통, 계절을 대비하여 식량을 갈무리하던 혜안 - 그
          모든 것을 몸에 아로새긴 사람들이 살고 있었습니다.
          <br />
          <br />그렇게 우리는 오랜 시골집 속에, 빛나는 오지의
          메리트를 찾았고, 지역과 농촌을 잇는 모두를 위한
          위로의 공간이 되어가고자 합니다.
        </div>
      </HomeContent>
      <HomeContent title="소녀방앗간 나물이야기">
        <AssetImage :src="'brand-page/' + (isMobile?'Mobile':'WEB') + '/content-5.jpg'" />
      </HomeContent>
    </section>
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
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
  name: "Brand",
  components: {
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo
  }
})
export default class Brand extends Vue {
  private isMobile = false;

  private mainImgPath = "";
  private contentPath: ImgPath[] = [];

  created() {
    window.addEventListener("resize", this.handleResize);

    for (let i = 0; i < 5; i++) {
      this.contentPath.push({
        pcPath: `brand-page/WEB/content-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `brand-page/Mobile/content-${i + 1}.jpg`
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
      this.mainImgPath = "brand-page/Mobile/main.jpg";
    } else {
      this.mainImgPath = "brand-page/WEB/main.jpg";
    }
  }
}
</script>

<style lang="scss" scoped>
main {
  margin-top: 7.849vw;

  .main {
    width: 100%;
    img {
      width: 100%;
    }
  }

  .contents {
    width: 100%;

    article {
      height: 31.563vw;
      margin-top: 9.531vw;
      padding-left: 14.323vw;
      padding-right: 14.323vw;
      color: #595757;

      img {
        position: absolute;
        left: 0;
        width: 54.5vw;
      }

      .info-1 {
        font-family: "munche_jemok_batang";
        font-size: 1.198vw;
      }

      .info-2 {
        text-align: justify;
        font-size: 1.146vw;
        font-weight: 300;
      }

      &:nth-child(1) {
        div {
          margin-left: 46.375vw;
          line-height: 1.979vw;

          &:nth-last-child(2) {
            padding-top: 1.2vw;
          }

          &:nth-last-child(1) {
            padding-top: 2.454vw;
          }
        }
      }

      &:nth-child(2) {
        div {
          margin-left: 46.675vw;

          &:nth-last-child(2) {
            line-height: 2.188vw;
            padding-top: 3.385vw;
          }

          &:nth-last-child(1) {
            line-height: 1.979vw;
            padding-top: 3.788vw;
          }
        }
      }

      &:nth-child(3) {
        div {
          display: inline-block;
          line-height: 1.979vw;
          width: 31.875vw;
          padding-top: 4.948vw;
        }
        img {
          left: 62.406vw;
          width: 21.042vw;
          height: 26.716vw;
        }
      }

      &:nth-child(4) {
        div {
          padding-top: 1vw;
          margin-left: 44.675vw;
          line-height: 1.879vw;
        }
      }

      &:nth-child(5) {
        margin-bottom: 8.75vw;
        img {
          position: relative;
          width: 100%;
        }
      }
    }
  }
}
</style>