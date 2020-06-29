<template>
  <main class="store">
    <section class="main">
      <div class="mainimg"></div>
      <div class="info-1">
        매일 다른 제철반찬과 향긋하게 윤기나는<br />
        산나물밥을 단정한 한 그릇에 담습니다.
      </div>
      <div class="info-2">
        식사공간에서는 편안하고 건강한 한 끼를 드실 수 있도록<br />
        설명하지 않아도 더 깊은 정보와 경험을 전하고자 합니다.
      </div>
    </section>
    <section class="contents">
      <HomeContent title="서울숲시작점"> </HomeContent>
      <HomeContent title="현대백화점 신도림점"> </HomeContent>
      <HomeContent title="이화여대점"> </HomeContent>
      <HomeContent title="마로니에점"> </HomeContent>
      <HomeContent title="서울고속터미널점"> </HomeContent>
      <HomeContent title="현대백화점 킨텍스점"> </HomeContent>
      <HomeContent title="중곡제일시장점"> </HomeContent>
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

@Component({
  name: "Store",
  components: {
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo
  }
})
export default class Store extends Vue {}
</script>

<style lang="scss" scoped>
.main {
  .mainimg {
    width: 100%;
    height: 40.313vw;
    background: black;
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
  }

  .info-2 {
    color: #595757;
    text-align: center;
    font-weight: 300;
    line-height: 1.91;
    padding-top: 1.979vw;
  }
}

.contents {
  margin-left: 14.323vw;
  margin-right: 14.323vw;

  article {
    margin-top: 9.375vw;
    height: 40.313vw;

    &:nth-child(1) {
      margin-top: 8.281vw;
    }
  }
}
</style>
