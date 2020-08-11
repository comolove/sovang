<template>
  <main ref="main">
    <Header />
    <section class="main">
      <AssetImage
        :src="'community-page/' + (isMobile?'Mobile':'WEB') + '/main.jpg'"
        class="main-img"
      />
    </section>
    <section class="content-1">
      <HomeContent title="지역과 동행하는 푸릇농펠로십">
        <AssetImage
          :src="'community-page/' + (isMobile?'Mobile':'WEB') + '/fellowship.jpg'"
          class="fellowship"
        />
        <p>
          소녀방앗간은 지역의 생산자분들과 동행하고자 매 해 지역의 영세/중소 농업인분들을 선정하여 함께 지역의 청정식재료를 개발하는
          <span
            class="bold"
          >[푸릇농펠로십]</span>을 운영
          <span v-if="!isMobile">하고 있습니다.</span>
          <span v-if="isMobile">합니다.</span>
          <br />
          <br />소농의 푸릇한 양심을 가슴 가득히 품고 경작하시는 생산자분들의 지속가능한 생산을 위해 소녀방앗간은 소박하지만 깊은 존경의 마음을 더합니다.
          <br />
          <br />일정 평수 미만의 경작지에서 종자 하나하나 마음 담는 농부님, 직접 씨를 받아 자부심있게 경작하시는 생산자님, 토종종자만을 사용하시는 푸릇한 양심 가득한 농부님 -
          <span
            v-if="!isMobile"
          >소녀방앗간은</span> 모든 소농의 푸릇한 양심을 존경하고 응원합니다.
        </p>
      </HomeContent>
    </section>
    <section class="content-2">
      <h2>
        <span v-if="!isMobile">소녀방앗간</span>푸릇농펠로십, 이렇게 운영합니다.
      </h2>
      <div v-if="!isMobile">
        <span class="subTitle">선정기준</span>
        <p>
          <span style="letter-spacing: 0.09vw;">가장 중요한 기준은 “소농의 푸릇한 양심"입니다. 영세/중소농업인 기준에 해당하는</span>
          <br />생산자분들 중 본인만의 철학으로 농사를 지으시는 농업 생산자분들에게 모두 열려있습니다.
        </p>
      </div>
      <div v-if="isMobile">
        <p>
          <span class="blue">- 선정기준 :</span>가장 중요한 기준은 “소농의 푸릇한
          <span style="letter-spacing: 0.3vw;">양심"입니다. 영세/중소농업인 기준에 해당하는</span> 생산자분들 중 본인만의 철학으로 농사를 지으시는 농업 생산자분들에게 모두 열려있습니다.
        </p>
      </div>

      <div style="margin-top: 2.656vw;" v-if="!isMobile">
        <p>
          <span class="bold">- 영세농업인 기준 :</span> 연소득 3천만원 이하 또는 경작면적 0.1ha 이상 - 0.5ha 이하
          <br />
          <span class="bold">- 중소농업인 기준 :</span>
          연소득 5천만원 이하 또는 경작면적 0.5ha 이상 - 2ha 이하
        </p>
      </div>
      <div v-if="isMobile" style="margin-top: 5.278vw;">
        <p>
          <span class="blue">* 영세농업인 기준 :</span> 연소득 3천만원 이하 또는 경작면적 0.1ha 이상 - 0.5ha 이하
          <br />
          <span class="blue">* 중소농업인 기준 :</span> 연소득 5천만원 이하 또는 경작면적 0.5ha 이상 - 2ha 이하
        </p>
      </div>

      <div class="warning" v-if="!isMobile">
        <p>
          * 위 기준은 한국농촌경제연구원의 정책연구 보고 중 &lt;저소득 농가의 농가 경제 실태 분석&gt; 보고 자료와 청송군 농업 정책 중
          <br />농업인 소득배가정책 자료에 근거한 기준입니다. 위 기준은 농업 경제 현황 등에 따라 변동될 수 있습니다.
        </p>
      </div>
      <div v-if="isMobile" class="warning">
        <p>(위 기준은 한국농촌경제연구원의 정책연구 보고 중 &lt;저소득 농가의 농가 경제 실태 분석&gt; 보고 자료와 청송군 농업 정책 중 농업인 소득배가정책 자료에 근거한 기준이며, 농업 경제 현황 등에 따라 변동될 수 있습니다.)</p>
      </div>

      <div style="margin-top: 2.63vw;" v-if="!isMobile">
        <span class="subTitle">선정기간</span>
        <p>상시모집 및 개별공지</p>
      </div>
      <div style="margin-top: 6.389vw;" v-if="isMobile">
        <p>
          <span class="blue">- 선정기간 :</span> 매년 하반기 (8~9월) 예정
        </p>
      </div>
      <div class="procedure">
        <span v-if="!isMobile" class="subTitle">선정절차</span>
        <span v-if="isMobile" class="blue">- 선정절차</span>
        <div class="flexWrap">
          <div>
            <div>발굴</div>- 지역연계
            <br />- 추천 & 발굴
            <br />- 신규품목 제안
          </div>
          <AssetImage src="contents-arrow.png" />
          <div>
            <div>선발 1차</div>- 지원농민 부합
            <br />
            <span class="indent">조건확인</span>
            <br />- 서류심사
          </div>
          <AssetImage src="contents-arrow.png" />
          <div>
            <div>선발 2차</div>- 지원자 만남
            <br />
            <span class="indent">(생산 및 변화</span>
            <br />
            <span class="indent">의지 확인)</span>
            <br />- 펠로우 선정
          </div>
          <AssetImage src="contents-arrow.png" v-if="!isMobile" />
          <div>
            <div>사전계약</div>- 계약서 작성
            <br />- 예상품목, 기간,
            <br />
            <span class="indent">목표기준 확인</span>
          </div>
          <AssetImage src="contents-arrow.png" />
          <div>
            <div>지속관리</div>- 농사 중 지속
            <br />
            <span class="indent">연결 관리</span>
            <br />- 재배 환경 변화
            <br />
            <span class="indent">집중</span>
          </div>
          <AssetImage src="contents-arrow.png" />
          <div>
            <div>최종공급</div>- 유통/판매 계획
            <br />
            <span class="indent">및 실행</span>
            <br />- 최종 공급
          </div>
        </div>
      </div>
    </section>
    <section class="content-3">
      <h2>푸릇농펠로우 이야기</h2>
      <p>
        지속가능한 생산을 위한 동행의 길을 함께 걸어가실 농업생산자분들을 모십니다.
        <br />본인만의 철학으로 농사를 지으시는 모든 영세 농업생산자분들의 많은 가르침을 기다립니다.
      </p>
      <div v-if="!isMobile">
        <AssetImage v-for="i in 3" :key="i" :src="'community-page/story-'+i+'.png'" />
      </div>
      <Carousel
          v-if="isMobile"
          class="fellow-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :autoplayTimeout="3000"
          :autoplayHoverPause="false"
          :loop="true"
          :navigationEnabled="true"
          :paginationEnabled="false"
          :navigationNextLabel="fellowCarouselNavigationNext"
          :navigationPrevLabel="fellowCarouselNavigationPrev"
        >
          <Slide
            v-for="index in 3"
            :key="index"
            :id="'fellow-carousel-slide-' + index"
          >
            <AssetImage
              :src="'community-page/story-'+index+'.png'"
            />
          </Slide>
        </Carousel>
    </section>
    <!-- 모바일 사진 넣기 -->
    <section class="content-4">
      <AssetImage :src="'community-page/' + (isMobile?'Mobile':'WEB') + '/food.jpg'" />
    </section>
    <AssetImage
      class="button-go-top"
      :class="{'button-go-top-visible': isVisible,'button-go-top-invisible': !isVisible}"
      @click="goTop"
      src="button-go-top.png"
    />
    <Footer class="footer" />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import {
  Header,
  Footer,
  HomeContent,
  AssetImage,
  Modal,
  InputText,
  TextareaWithRedAsterisk,
  PresentPopup
} from "@/components";
import { screenSize } from "@/utils";
@Component({
  name: "Community",
  components: {
    Header,
    Footer,
    HomeContent,
    AssetImage,
    Carousel,
    Slide,
    Modal,
    InputText,
    TextareaWithRedAsterisk,
    PresentPopup
  }
})
export default class Community extends Vue {
  private isMobile = false;
  private isVisible = false;

  private height = 0;

  created() {
    window.addEventListener("resize", this.handleResize);
    window.addEventListener("scroll", this.handleScroll);
  }

  mounted() {
    this.handleResize();
  }

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
    window.removeEventListener("scroll", this.handleScroll);
  }

  handleResize(/* e : Event */) {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;
  }

  handleScroll(/* e : Evuent */) {
    if (window.scrollY > ((this.$refs.main as HTMLElement).clientHeight as number - window.innerHeight)+(window.innerWidth*(this.isMobile?0.06389:0.07849))-5)
      this.isVisible = true;
    else this.isVisible = false;
    console.log(((this.$refs.main as HTMLElement).clientHeight as number - window.innerHeight)+(window.innerWidth*0.07849)-5);
    console.log(window.scrollY);
  }

  goTop() {
    window.scroll({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
  }

  public get fellowCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-gray.png")}
            >`;
  }

  public get fellowCarouselNavigationPrev(): string {
    return `<img 
              src=${require("@/assets/images/arrow-left-gray.png")} 
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

.main {
  &-img {
    width: 100%;
  }
}

.bold {
  font-weight: 500;
}

.indent {
  padding-left: 0.6vw;

  @include mobile {
    padding-left: 1.9vw;
  }
}

.blue {
  color: #001845;
  font-weight: 500;
}

h2 {
  padding: 8.281vw 0 3.75vw;
  text-align: center;
  font-size: 1.719vw;
  font-weight: 500;
  color: #001845;

  @include mobile {
    padding: 26.111vw 0 13.056vw;
    font-size: 4.722vw;
  }
}

.content {
  &-1 {
    article {
      margin: 9.688vw 0 11.406vw 14.271vw;
      width: 71.406vw;

      @include mobile {
        margin: 23.056vw 0 28.889vw 9.167vw;
        width: 81.667vw;
      }

      .fellowship {
        position: absolute;
        left: -14.271vw;
        width: 55.885vw;

        @include mobile {
          position: static;
          width: 100%;
        }
      }

      p {
        margin: 0.729vw 0 0 46.979vw;
        font-size: 1.146vw;
        font-weight: 300;
        line-height: 1.73;
        text-align: justify;
        word-break: keep-all;
        color: #595757;

        @include mobile {
          margin: 7.778vw 0 0 0;
          font-size: 3.611vw;
          line-height: 1.62;
          letter-spacing: -0.05vw;
        }
      }
    }
  }
  &-2 {
    background: #ededed;

    > div {
      font-size: 1.146vw;
      font-weight: 300;
      line-height: 1.91;
      margin: 0 0 0 28.802vw;
      color: #595757;

      > .subTitle {
        position: absolute;
        left: 22.24vw;
        font-weight: 400;
        color: #001845;
      }

      @include mobile {
        font-size: 3.611vw;
        line-height: 1.62;
        text-align: justify;
        word-break: keep-all;
        margin: 0 0 0 9.444vw;
        width: 80.556vw;
        letter-spacing: -0.03vw;
      }
    }

    .warning {
      font-size: 0.938vw;
      line-height: 1.39;
      color: #909090;
      margin-top: 1.172vw;

      @include mobile {
        font-size: 3.056vw;
        line-height: 1.91;
        margin-top: 4.722vw;
      }
    }

    .procedure {

      @include mobile {
        margin-top: 6.667vw;
      }
      .flexWrap {
        display: flex;
        width: 56.615vw;
        justify-content: space-between;
        margin-top: 3.542vw;
        padding-bottom: 8.333vw;

        @include mobile {
          margin-top: 6.111vw;
          flex-wrap: wrap;
          align-content: space-between;
          width: 100%;
          height: 107.778vw;
          padding-bottom: 26.389vw;
        }

        > div {
          position: relative;
          width: 8.073vw;
          height: 12.24vw;
          background: white;
          font-size: 1.094vw;
          line-height: 1.81;
          padding: 2.891vw 0 0 0.469vw;
          border-bottom-right-radius: 0.521vw;
          border-bottom-left-radius: 0.521vw;

          @include mobile {
            width: 24.167vw;
            height: 36.944vw;
            font-size: 3.333vw;
            line-height: 1.79;
            padding: 10.278vw 0 0 1.389vw;
            border-bottom-right-radius: 2.778vw;
            border-bottom-left-radius: 2.778vw;
          }

          > div {
            position: absolute;
            background: #001845;
            text-align: center;
            width: 8.073vw;
            height: 2.135vw;
            top: -0.573vw;
            left: 0;
            color: white;
            border-top-left-radius: 0.521vw;
            border-top-right-radius: 0.521vw;

            @include mobile {
              width:24.167vw;
              height: 6.389vw;
              font-size: 3.472vw;
              top: -1.667vw;
              border-top-left-radius: 2.778vw;
              border-top-right-radius: 2.778vw;

            }
          }
        }

        > img {
          width: 0.729vw;
          height: 1.406vw;

          @include mobile {
            width: 2.222vw; 
            height: 3.889vw;
          }
        }
      }
    }
  }
  &-3 {
    p {
      font-size: 1.146vw;
      font-weight: 300;
      line-height: 1.91;
      margin-top: 4.01vw;
      text-align: center;

      @include mobile {
        font-size: 3.611vw;
        line-height: 1.62;
        width: 81.111vw;
        margin: 0 0 0 9.444vw;
        text-align: justify;
        word-break: keep-all;
        letter-spacing: 0.24vw;
        br {
          display: none;
        }
      }
    }
    > div {
      display: flex;
      justify-content: space-between;
      margin: 5.417vw 0 8.542vw 26.042vw;
      width: 47.969vw;
      img {
        width: 15.208vw;
      }
    }

    @include mobile {
      .fellow-carousel {
        ::v-deep{
          margin-top: 13.611vw;
          margin-bottom: 26.389vw;
          .VueCarousel{
            &-navigation{
              &-button{
                padding: 6.667vw !important;
              }
              &-prev{
                img {
                  width: 3.889vw;
                }
              }

              &-next{
                img {
                  width: 3.889vw;
                }
              }
            }
            &-slide {
                width: 60vw; 
              img {
                width: 100%;
              }
            }
          }
        }
      }
    }
  }
  &-4 {
    img {
      width: 100%;
    }
  }
}

.button-go-top {
  position: fixed;
  width: 3.385vw;
  bottom: 23.365vw;
  right: 14.299vw;
  transition: opacity 0.5s;
  opacity: 0;
  cursor: pointer;

  @include mobile {
    width: 9.167vw;
    height: 7.222vw;
    bottom: 49.611vw;
    right: 9.167vw;
  }

  &-visible {
    opacity: 1;
  }
  &-invisible {
    opacity: 0;
  }
}

.footer {
  background-color: white;
}
</style>