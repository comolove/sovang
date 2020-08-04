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
          >[푸릇농펠로십]</span>을 운영하고 있습니다.
          <br />
          <br />소농의 푸릇한 양심을 가슴 가득히 품고 경작하시는 생산자분들의 지속가능한 생산을 위해 소녀방앗간은 소박하지만 깊은 존경의 마음을 더합니다.
          <br />
          <br />일정 평수 미만의 경작지에서 종자 하나하나 마음 담는 농부님, 직접 씨를 받아 자부심있게 경작하시는 생산자님, 토종종자만을 사용하시는 푸릇한 양심 가득한 농부님 - 소녀방앗간은 모든 소농의 푸릇한 양심을 존경하고 응원합니다.
        </p>
      </HomeContent>
    </section>
    <section class="content-2">
      <h2>소녀방앗간 푸릇농펠로십, 이렇게 운영합니다.</h2>
      <div>
        <span class="subTitle">선정기준</span>
        <p>
          <span style="letter-spacing: 0.09vw;">가장 중요한 기준은 “소농의 푸릇한 양심"입니다. 영세/중소농업인 기준에 해당하는</span>
          <br />생산자분들 중 본인만의 철학으로 농사를 지으시는 농업 생산자분들에게 모두 열려있습니다.
        </p>
      </div>
      <div style="margin-top: 2.656vw;">
        <p>
          <span class="bold">- 영세농업인 기준 :</span> 연소득 3천만원 이하 또는 경작면적 0.1ha 이상 - 0.5ha 이하
          <br />
          <span class="bold">- 중소농업인 기준 :</span>
          연소득 5천만원 이하 또는 경작면적 0.5ha 이상 - 2ha 이하
        </p>
      </div>
      <div class="warning">
        <p>
          * 위 기준은 한국농촌경제연구원의 정책연구 보고 중 &lt;저소득 농가의 농가 경제 실태 분석&gt; 보고 자료와 청송군 농업 정책 중
          <br />농업인 소득배가정책 자료에 근거한 기준입니다. 위 기준은 농업 경제 현황 등에 따라 변동될 수 있습니다.
        </p>
      </div>
      <div style="margin-top: 2.63vw;">
        <span class="subTitle">선정기간</span>
        <p>매년 하반기 (8~9월) 예정</p>
      </div>
      <div>
        <span class="subTitle">선정일자</span>
        <div class="flexWrap">
          <div>
            <div>발굴</div>- 지역연계
            <br />- 추천 & 발굴
            <br />- 신규품목 제안
          </div>
          <AssetImage src="arrow-right-black.png" />
          <div>
            <div>선발 1차</div>- 지원농민 부합
            <br />
            <span class="indent">조건확인</span>
            <br />- 서류심사
          </div>
          <AssetImage src="arrow-right-black.png" />
          <div>
            <div>선발 2차</div>- 지원자 만남
            <br />
            <span class="indent">(생산 및 변화</span>
            <br />
            <span class="indent">의지 확인)</span>
            <br />- 펠로우 선정
          </div>
          <AssetImage src="arrow-right-black.png" />
          <div>
            <div>사전계약</div>- 계약서 작성
            <br />- 예상품목, 기간,
            <br />
            <span class="indent">목표기준 확인</span>
          </div>
          <AssetImage src="arrow-right-black.png" />
          <div>
            <div>지속관리</div>- 농사 중 지속
            <br />
            <span class="indent">연결 관리</span>
            <br />- 재배 환경 변화
            <br />
            <span class="indent">집중</span>
          </div>
          <AssetImage src="arrow-right-black.png" />
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
      <div>
        <AssetImage v-for="i in 3" :key="i" :src="'community-page/story-'+i+'.png'" />
      </div>
    </section>
    <section class="content-4">
      <AssetImage :src="'community-page/' + (isMobile?'Mobile':'WEB') + '/food.jpg'" />
    </section>
    <AssetImage class="button-go-top" :class="{'button-go-top-visible': isVisible,'button-go-top-invisible': !isVisible}" @click="goTop" src="button-go-top.png" />
    <Footer class="footer" />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
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
    if (window.scrollY > ((this.$refs.main as HTMLElement).clientHeight as number-window.innerHeight)/2)
      this.isVisible = true;
    else this.isVisible = false;
  }

  goTop() {
    window.scroll({
      top:0,
      left:0,
      behavior: "smooth"
    });
  }
}
</script>

<style lang="scss" scoped>
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
}

h2 {
  padding: 8.281vw 0 3.75vw;
  text-align: center;
  font-size: 1.719vw;
  font-weight: 500;
  color: #001845;
}

.content {
  &-1 {
    article {
      margin: 9.688vw 0 11.406vw 14.271vw;
      width: 71.406vw;

      .fellowship {
        position: absolute;
        left: -14.271vw;
        width: 55.885vw;
      }

      p {
        margin: 0.729vw 0 0 46.979vw;
        font-size: 1.146vw;
        font-weight: 300;
        line-height: 1.73;
        text-align: justify;
        word-break: keep-all;
        color: #595757;
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
        color: #001845;
      }
    }

    .warning {
      font-size: 0.938vw;
      line-height: 1.39;
      color: #909090;
      margin-top: 1.172vw;
    }

    .flexWrap {
      display: flex;
      width: 56.615vw;
      justify-content: space-between;
      margin-top: 3.542vw;
      padding-bottom: 8.333vw;

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
        }
      }

      > img {
        width: 0.729vw;
        height: 1.406vw;
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
  }
  &-4 {
    img {
      width: 100%;
    }
  }
}

.button-go-top {
  position: fixed;
  bottom: 22.292vw;
  right: 2.188vw;
  transition: opacity 0.5s;
  opacity: 0;
  cursor: pointer;
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