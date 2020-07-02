<template>
  <div class="CWNC">
    <agile
      ref="main"
      class="main"
      :options="mainOptions"
      :as-nav-for="asNavForMain"
      :speed="1000"
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
      :as-nav-for="asNavForThumbnail"
    >
      <div
        class="slide slide--thumbnail"
        v-for="(slide, index) in navSlides"
        :key="index"
        :class="`slide--${index}`"
        @click="$refs.thumbnails.goTo(index)"
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

  private asNavForMain: Vue[] = [];
  private asNavForThumbnail: Vue[] = [];

  mainOptions = {
    dots: false
  };

  thumbnailOptions = {
    navButtons: false,
    dots: false,
    slidesToShow: 2,
    responsive: [
      {
        breakpoint: ScreenSize.tablet,
        settings: {
          slidesToShow: 5
        }
      }
    ]
  };

  mounted() {
    this.asNavForMain.push(this.$refs.thumbnails as Vue);
    this.asNavForThumbnail.push(this.$refs.main as Vue);
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

    &.agile__slide--active {
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
