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
          <!-- <img :src="path" /> -->
          <!-- TODO : backend 구현 후 db에서 링크 불러와서 넣어주도록 변경 -->
          <img src="../assets/images/slide/1.png" />
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
        <img src="../assets/images/catering.png"/>
      </HomeContent>
      <HomeContent title="온라인몰">
        <img src="../assets/images/catering.png"/>
      </HomeContent>
      <HomeContent title="케이터링">
        <img src="../assets/images/catering.png"/>
      </HomeContent>
      <HomeContent title="명절선물">
        <img src="../assets/images/catering.png"/>
      </HomeContent>
    </section>
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import HomeContent from "@/components/HomeContent.vue";

@Component({
  name: "Home",
  components: {
    Carousel,
    Slide,
    HomeContent
  }
})
export default class Home extends Vue {
  private slideImgPaths: string[] = [];

  created() {
    this.slideImgPaths.push("/images/slide/1.png");
    this.slideImgPaths.push("/images/slide/1.png");
    this.slideImgPaths.push("/images/slide/1.png");
    this.slideImgPaths.push("/images/slide/1.png");
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
  margin-top: 6.438rem;
  // padding: 0 35rem 0 35rem;
  text-align: center;

  .title {
    font-size: 1.875rem;
    letter-spacing: -0.15px;
  }

  .content {
    margin-top: 2.688rem;
    font-size: 1.625rem;
    line-height: 1.62;
    font-weight: 300;
  }
}

.home-contents {
  margin-top: 11.5rem;
  
  > * {
    margin-bottom: 11.875rem;
  }

  > *:last-child {
    margin-bottom: 14.25rem;
  }
}
</style>
