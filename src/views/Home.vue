<template>
  <div class="home">
    <div class="img-slider">
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
    </div>
    <div class="info">
      <p class="title">좋은 음식을 준비하는 모두의 마음 속엔 소녀가 있습니다.</p>
      <p class="content">소녀방앗간은 청정지역 장인들이 해마다 정성들여 수확한 청정 햇-식재료를 수확한 만큼만 신선하게 담아 도시의 소비자에게 건강한 한 끼로 대접합니다.</p>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";

interface SlideImage {
  src: string;
}

@Component({
  name: "Home",
  components: {
    Carousel,
    Slide
  }
})
export default class Home extends Vue {
  slideImgPaths: string[] = [];

  created() {
    this.slideImgPaths.push("/images/slide/1.png" );
    this.slideImgPaths.push("/images/slide/1.png" );
    this.slideImgPaths.push("/images/slide/1.png" );
    this.slideImgPaths.push("/images/slide/1.png" );
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
  padding: 0 35rem 0 35rem;
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
</style>
