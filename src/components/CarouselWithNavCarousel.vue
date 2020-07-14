<template>
  <div class="CWNC">
    <agile
      ref="main"
      class="main"
      :options="mainOptions"
      :speed="1000"
      @after-change="handleAfterChange($event)"
    >
      <div
        class="slide"
        v-for="(slide, index) in isMobile ? navSlides : mainSlides"
        :key="index"
        :class="`slide--${index}`"
      >
        <AssetImage :src="slide" />
      </div>
      <template slot="prevButton">
        <AssetImage src="arrow-left-white.png" />
      </template>
      <template slot="nextButton">
        <AssetImage src="arrow-right-white.png" />
      </template>
    </agile>
    <agile
      class="thumbnails"
      ref="thumbnails"
      :options="thumbnailOptions"
      :speed="1000"
    >
      <div
        class="slide slide--thumbnail"
        v-for="(slide, index) in navSlides"
        :key="index"
        :class="`slide--${index}`"
        @click="
          () => {
            clickThumbnail(index);
          }
        "
      >
        <AssetImage :src="slide" />
      </div>
    </agile>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Prop } from "vue-property-decorator";
import { VueAgile } from "vue-agile";
import { AssetImage } from "@/components";
import ScreenSize from "@/utils/screenSize";

@Component({
  name: "CarouselWithNavCarousel",
  components: {
    AssetImage,
    agile: VueAgile
  }
})
export default class CarouselWithNavCarousel extends Vue {
  @Prop() mainSlides!: string[];
  @Prop() navSlides!: string[];
  @Prop() isMobile!: boolean;

  private SLIDES_TO_SHOW_MOBILE = 2;
  private SLIDES_TO_SHOW_PC = 5;

  private prevSlide = 0;
  private curSlide = 0;

  mainOptions = {
    dots: false
  };

  thumbnailOptions = {
    navButtons: false,
    dots: false,
    slidesToShow: this.SLIDES_TO_SHOW_MOBILE,
    responsive: [
      {
        breakpoint: ScreenSize.tablet,
        settings: {
          slidesToShow: this.SLIDES_TO_SHOW_PC
        }
      }
    ]
  };

  get slidesToShow(): number {
    return this.isMobile ? this.SLIDES_TO_SHOW_MOBILE : this.SLIDES_TO_SHOW_PC;
  }

  mounted() {
    this.goToThumbnail(0, 0);
  }

  handleAfterChange(event: { currentSlide: number }) {
    this.prevSlide = this.curSlide;
    this.curSlide = event.currentSlide;

    this.goToThumbnail(this.curSlide, this.prevSlide);
  }

  clickThumbnail(index: number) {
    this.prevSlide = this.curSlide;
    this.curSlide = index;

    this.goToMain(this.curSlide);
    this.goToThumbnail(this.curSlide, this.prevSlide);
  }

  goToMain(index: number) {
    (this.$refs.main as VueAgile).goTo(index);
  }

  goToThumbnail(curSlideIndex: number, prevSlideIndex: number) {
    const prevSlide = (this.$refs.thumbnails as VueAgile).$el.querySelectorAll(
      `.slide--${prevSlideIndex}`
    );
    const nextSlide = (this.$refs.thumbnails as VueAgile).$el.querySelectorAll(
      `.slide--${curSlideIndex}`
    );

    prevSlide.forEach(element => {
      element.classList.remove("active");
    });
    nextSlide.forEach(element => {
      element.classList.add("active");
    });

    const slidePage = Math.floor(curSlideIndex / this.slidesToShow);
    const indexInPage = curSlideIndex % this.slidesToShow;

    if (slidePage > 0 && indexInPage == 0) {
      (this.$refs.thumbnails as VueAgile).goTo(curSlideIndex);
    } else if (slidePage == 0 && indexInPage == 0) {
      (this.$refs.thumbnails as VueAgile).goTo(curSlideIndex);
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

::v-deep {
  .agile {
    &.main {
      margin-bottom: 0.781vw;

      @include mobile {
        margin-bottom: 2.778vw;
      }
    }

    &.thumbnails {
      margin: 0 -5px;
      width: calc(100% + 10px);
    }

    &__nav-button {
      background: transparent;
      border: none;

      .main & {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        img {
          width: 1.458vw;
          height: 3.438vw;

          @include mobile {
            width: 3.889vw;
            height: 9.167vw;
          }
        }

        &--prev {
          left: 1.979vw;

          @include mobile {
            left: 2.778vw;
          }
        }

        &--next {
          right: 1.979vw;

          @include mobile {
            right: 2.778vw;
          }
        }
      }
    }
  }
}

.slide {
  &--thumbnail {
    padding: 0 5px;
    transition: opacity 0.3s;

    &.active {
      opacity: 0.58;
    }
  }

  img {
    height: 100%;
    object-fit: cover;
    object-position: center;
    width: 100%;
  }
}
</style>
