<template>
  <main>
    <Header />
    <section class="main" data-aos="fade-up">
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
          paginationActiveColor="white"
        >
          <Slide
            v-for="(data, index) of mainSlideData"
            :key="index"
            :id="'main-carousel-slide-' + index"
          >
            <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" />
          </Slide>
        </Carousel>
      </section>
      <div class="info info-1" data-aos="fade-up">
        청정지역의 제철먹거리와 함께
        <br v-if="isMobile" />특별하고 의미있는 모임을 기획하는 가장 쉬운
        방법.
        <br />소녀방앗간과 함께 어떤 특별함을 만들 수 있을까요?
      </div>
    </section>

    <section class="content-1">
      <AssetImage
        data-aos="fade-up"
        class="illust"
        :src="'catering-page/illustration' + (isMobile ? '-m.jpg' : '-pc.jpg')"
      />
      <HomeContent title="청정케이터링 이야기" data-aos="fade-up">
        <CarouselContent :slideData="cateringStorySlideData" :isMobile="isMobile" />
      </HomeContent>
      <div class="info info-1" data-aos="fade-up">
        2017년부터 지금까지 여러 공기관과 대기업, 그리고
        <br v-if="isMobile" />사회적경제의
        스타트업까지
        <br v-if="!isMobile" />다양한 공간에서 소녀방앗간과
        <br v-if="isMobile" />함께 청정케이터링 서비스를 경험하고
        있습니다.
      </div>
      <AssetImage
        class="logo"
        :src="'catering-page/logo-' + (isMobile ? 'm' : 'pc') + '.jpg'"
        data-aos="fade-up"
      />
    </section>

    <section class="content-2">
      <div class="info info-2" data-aos="fade-up">청정케이터링</div>
      <HomeContent class="catering-visit-large" title="방문 케이터링(30인 이상)" data-aos="fade-up">
        <CateringContent class="contentsWrap-1" :contentData="cateringVisitSlideData" />
      </HomeContent>
      <HomeContent title="방문 케이터링(30인 이하)" class="catering-visit-small" data-aos="fade-up">
        <CateringContent class="contentsWrap-2" :contentData="cateringBoxSlideData" />
      </HomeContent>
    </section>

    <section class="content-3">
      <div class="info info-2" data-aos="fade-up">청정도시락</div>
      <HomeContent class="easy-lunch-box" title="간편 도시락(10인 이상)" data-aos="fade-up">
        <CateringContent class="contentsWrap-3" :contentData="easyLunchBoxSlideData" />
      </HomeContent>
      <HomeContent title="맞춤 도시락(10인 이상)" data-aos="fade-up" class="custom-lunch-box">
        <CateringContent class="contentsWrap-4" :contentData="isMobile ? customLunchBoxSlideDataMobile : customLunchBoxSlideDataPC" />
      </HomeContent>

      <HomeContent title="추가 메뉴(도시락만 해당)" data-aos="fade-up" class="additional-menu">
        <CateringContent class="contentsWrap-5" :contentData="additionalMenuSlideData" />
      </HomeContent>
    </section>

    <section class="content-4">
      <div class="info info-2" data-aos="fade-up">주문 안내</div>
      <div class="info-6" data-aos="fade-up">
        <span class="bold">특별한 케이터링을 위해 소녀방앗간에 문의해보셔요 :)</span>
        <br />
        <span v-if="!isMobile">아래의</span>상담 예약을 먼저 완료해주시면
        <span v-if="!isMobile">더</span>빠른 소통이 가능합니다.
      </div>
      <div class="info-7" data-aos="fade-up">
        <span class="bold-2">1) 주문시간</span> : 행사일 기준,
        <span class="red">케이터링/맞춤도시락은 최소 1주 전, 간편도시락은 3일 전</span> 메뉴확정이 필요합니다.
        <br v-if="!isMobile" />
        <span class="blank">(하단의 상담 예약을 하신 당일 혹은 익일 연락드려 소통하게 됩니다.)</span>
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">2) 메뉴구성</span> : 행사와 계절에 맞게 제철메뉴로 제안드리며, 충분히 소통하여 조율 가능합니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">3) 최소인원</span> :
        <span class="red">박스케이터링/도시락은 10인 이상, 방문 케이터링은 30인 이상</span>부터 준비 가능합니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">4) 배송진행</span> : 박스케이터링/도시락은 지정업체에서 퀵배송해드리며, 방문케이터링은 직접 방문해 준비해드립니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">5) 견적문의</span> : 식사견적 외에 배송 및 현장운영 비용은 인원 / 위치에 따라 별도로 적용됩니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">6) 결제방법</span> : 계좌이체, 카드결제 중 편하신 방법으로 선택해주시면 됩니다.
        <br v-if="!isMobile" />
        <span class="blank">(단, 퀵배송의 경우 카드결제는 BC/우리/국민/농협카드만 가능합니다.)</span>
      </div>
      <div class="contentsWrap-6" data-aos="fade-up">
        <input type="text" placeholder="단체명" />
        <div class="dateWrap">
          날짜
          <select id="year" v-model="selectedYear">
            <option value="0" selected disabled>
              <span v-if="!isMobile">년</span>
            </option>
            <option v-for="y in 11" :key="y">{{(2019 + parseInt(y))}}년</option>
            <option>이후 10년</option>
          </select>
          <select id="month" @change="onChangeDate()" v-model="selectedMonth">
            <option value="0" selected disabled>
              <span v-if="!isMobile">월</span>
            </option>
            <option v-for="index in 12" :key="index" :value="index">{{index}}월</option>
          </select>
          <select id="day">
            <option selected disabled>
              <span v-if="!isMobile">일</span>
            </option>
            <option v-for="d in 28" :key="d">{{d}}일</option>
            <option v-show="selectedMonth!=2">29일</option>
            <option v-show="selectedMonth!=2">30일</option>
            <option v-show="isMonthWith31Days">31일</option>
          </select>
        </div>
        <input type="text" placeholder="담당자" />
        <div class="timeWrap">
          시간
          <select id="hour">
            <option selected disabled>
              <span v-if="!isMobile">시</span>
            </option>
            <option>오전 9시</option>
            <option>오전 10시</option>
            <option>오전 11시</option>
            <option>오전 12시</option>
            <option v-for="h in 12" :key="h">오후 {{h}}시</option>
          </select>
          <select id="min">
            <option selected disabled>
              <span v-if="!isMobile">분</span>
            </option>
            <option v-for="m in 60" :key="m">{{m}}분</option>
          </select>
        </div>
        <input type="text" placeholder="연락처" />
        <div class="miniWrap">
          <input type="text" class="mini" placeholder="인원(10인 이상 입력)" />
          <select class="mini">
            <option selected disabled>결제방법</option>
            <option>카드결제</option>
            <option>계좌이체</option>
          </select>
        </div>
        <input type="text" placeholder="이메일" />
        <input type="text" placeholder="주소" />
        <select id="category" v-model="seletedValue" @change="onChange()">
          <option value="0" selected disabled>카테고리</option>
          <option value="1">방문 케이터링</option>
          <option value="2">박스 케이터링</option>
          <option value="3">간편 도시락</option>
          <option value="4">맞춤 도시락</option>
        </select>
        <select id="menuComposition">
          <option selected disabled>메뉴구성</option>
          <option v-show="isCatering">실속형</option>
          <option v-show="isCatering">일반형</option>
          <option v-show="isCatering">고급형</option>
          <option v-show="seletedValue==3">고춧가루제육볶음 한 상 도시락</option>
          <option v-show="seletedValue==3">돼지갈비찜 한 상 도시락</option>
          <option v-show="seletedValue==3">소불고기 한 상 도시락</option>
          <option v-show="seletedValue==4">선택 없음</option>
        </select>
        <select id="menuItem">
          <option selected disabled>메뉴항목</option>
          <option>식사</option>
          <option>다과</option>
        </select>
        <select id="additionalMenu">
          <option selected disabled>
            추가메뉴
            <span v-if="!isMobile">(도시락만 해당)</span>
          </option>
          <option v-show="isCatering">선택 없음</option>
          <option v-show="!isCatering">재래식장국</option>
          <option v-show="!isCatering">들깨미역국</option>
          <option v-show="!isCatering">컵셀러드</option>
          <option v-show="!isCatering">컵과일</option>
          <option v-show="!isCatering">발효청</option>
          <option v-show="!isCatering">산나물차</option>
          <option v-show="!isCatering">커피</option>
        </select>
        <textarea
          class="large"
          :placeholder="isMobile ? '추가메세지: 이 외 궁금하신 사항이 있다면 문의주셔요.' : '추가메세지: 이 외 궁금하신 내용이 있다면 문의해주셔요:)'"
        />
      </div>
      <div class="privacyCondition">
        <input type="checkbox" id="privacy" />
        <label for="privacy">
          <AssetImage src="catering-page/privacy.png" />
        </label>
        개인정보 수집 및 이용 동의
        <div>내용 보기</div>
      </div>
      <input type="button" value="상담 예약" />
    </section>
    <Footer class="footer" />
  </main>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { Carousel, Slide } from "vue-carousel";
import { VueAgile } from "vue-agile";
import {
  Header,
  Footer,
  HomeContent,
  HoverTextImage,
  AssetImage,
  ImageOverlayInfo,
  CarouselContent,
  CateringContent
} from "@/components";
import Breakpoint from "@/utils/screenSize";

class ImgPath {
  public pcPath = "";
  public tabletPath = "";
  public mobilePath = "";
}

class CateringStoryData extends ImgPath {
  public pcMonoPath = "";
  public tabletMonoPath = "";
  public mobileMonoPath = "";
  public cateringStoryName1 = "";
  public cateringStoryName2 = "";
}

class CateringContentData extends ImgPath {
  public title = "";
  public price = "";
  public info = "";
}

@Component({
  name: "Catering",
  components: {
    Header,
    Footer,
    Carousel,
    Slide,
    HomeContent,
    HoverTextImage,
    AssetImage,
    ImageOverlayInfo,
    CarouselContent,
    CateringContent,
    agile: VueAgile
  }
})
export default class Catering extends Vue {
  private mainSlideData: ImgPath[] = [];
  private cateringStorySlideData: CateringStoryData[] = [];
  private cateringVisitSlideData: CateringContentData[] = [];
  private cateringBoxSlideData: CateringContentData[] = [];
  private easyLunchBoxSlideData: CateringContentData[] = [];
  private customLunchBoxSlideDataPC: CateringContentData[] = [];
  private customLunchBoxSlideDataMobile: CateringContentData[] = [];
  private additionalMenuSlideData: CateringContentData[] = [];

  private isMobile = false;
  private isCatering = false;
  private isMonthWith31Days = false;

  private year = 10;
  private month = 12;
  private day = 29;
  private seletedValue = 0;
  private selectedYear = 0;
  private selectedMonth = 0;
  private storeCarouselPerPage = 1;
  private homeContentCarouselPaginationActiveColor = "black";

  private curStoreIndex = 0;
  private infoBreak = false;

  created() {
    window.addEventListener("resize", this.handleResize);

    // TODO : Backend 개발 후 DB에서 불러오기
    for (let i = 0; i < 2; i++) {
      this.mainSlideData.push({
        pcPath: `catering-page/main/WEB/main-slide-${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/main/Mobile/main-slide-${i + 1}.jpg`
      });
    }

    const cateringStory1 = [
      `한화 LIFE PLUS 컨퍼런스 2019`,
      `2020 대법원 시무식`,
      `스타트업의 옥상 박스 케이터링`
    ];

    const cateringStory2 = [
      `Future Ways of [Living] - 로컬푸드 청정재료 이야기`,
      `행사의 품격을 더해준 청정다과 케이터링 이야기`,
      `특별하고 편리하게 즐기는 박스 케이터링 이야기`
    ];

    for (let i = 0; i < cateringStory1.length; i++) {
      this.cateringStorySlideData.push({
        pcPath: `catering-page/catering-story/WEB/${i + 1}-color.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-story/Mobile/${i + 1}-color.jpg`,
        pcMonoPath: `catering-page/catering-story/WEB/${i + 1}-mono.jpg`,
        tabletMonoPath: "",
        mobileMonoPath: `catering-page/catering-story/Mobile/${i + 1}-mono.jpg`,
        cateringStoryName1: cateringStory1[i],
        cateringStoryName2: cateringStory2[i]
      });
    }

    const visitTitle = ["실속형", "일반형", "고급형"];

    const visitPrice = [
      `15,000 - 20,000원 (1인) / 메뉴 7 - 9종`,
      `20,000 - 30,000원 (1인) / 메뉴 10 - 12종 `,
      `30,000원 이상 (1인) / 메뉴 12종 이상 `
    ];

    const visitInfo = [
      `소규모, 또는 가볍고 편리한 모임에 적합합니다.`,
      `기업 모임, 행사 등의 알찬 구성에 적합합니다. `,
      `잔치나 파티 등 풍성한 차림의 행사에 적합합니다.`
    ];

    for (let i = 0; i < visitTitle.length; i++) {
      this.cateringVisitSlideData.push({
        pcPath: `catering-page/catering-visit/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-visit/Mobile/${i + 1}.jpg`,
        title: visitTitle[i],
        price: visitPrice[i],
        info: visitInfo[i]
      });
    }

    const boxPrice = [
      `10,000 - 15,000형 (1인) / 메뉴 5 - 6종`,
      `10,000 - 20,000형 (1인) / 메뉴 7 - 10 종`,
      `20,000 - 30,000형 (1인) / 메뉴 7-10종`
    ];

    const boxInfo = [
      `회의 등 모임에 개별로 가볍게 준비해야 할 때<br /> 
      적합하며, 우드도시락으로 제공됩니다.`,
      `합리적이고 다양한 구성의 메뉴가 필요할 때<br /> 
      박스형태로 제공되어 편리하게 이용합니다.`,
      `풍성한 메뉴 구성이 필요한 소규모 모임 또는<br />
      고급 답례품 형태로도 제공가능합니다. `
    ];

    for (let i = 0; i < boxInfo.length; i++) {
      this.cateringBoxSlideData.push({
        pcPath: `catering-page/catering-box/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-box/Mobile/${i + 1}.jpg`,
        title: visitTitle[i],
        price: boxPrice[i],
        info: boxInfo[i]
      });
    }
    const easyTitle = [
      `고춧가루제육볶음 한 상 도시락`,
      `돼지갈비찜 한 상 도시락`,
      `소불고기 한 상 도시락`
    ];

    const easyPrice = [`10,000원`, `12,000원`, `15,000원`];

    const easyInfo = [
      `경북 청송 황태한 어르신의 고추를 빻아 만든<br /> 
      고춧가루로 양념해 건강합니다.`,
      `청송 청운 마을에서 재배한 콩을 약수에 담근 재래식<br /> 
      간장에 최상급 국내산 돼지갈비를 숙성해 쪘습니다. `,
      `청송 청운 마을에서 재배한 콩을 약수에 담근 재래식<br /> 
      간장에 부드러운 호주산 소고기를 숙성해 볶았습니다. `
    ];

    for (let i = 0; i < easyInfo.length; i++) {
      this.easyLunchBoxSlideData.push({
        pcPath: `catering-page/easy-lunch-box/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/easy-lunch-box/Mobile/${i + 1}.jpg`,
        title: easyTitle[i],
        price: easyPrice[i],
        info: easyInfo[i]
      });
    }

    this.customLunchBoxSlideDataPC.push({
      pcPath: `catering-page/custom-lunch-box/WEB/1.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/1.jpg`,
      title: "맞춤 도시락",
      price: `20,000원 이상 (1인) <span class="hide">/ </span> <br />메뉴 구성 및 용기는 모두 고객 맞춤형으로<span class="hide> 귀한 손님들에게 준비해드리는 맞춤 도시락입니다. </span>
      <span class="non-hide">, 특별한 행사에 참석하신 귀한<br />손님들에게 준비해드리기 좋은 맞춤 도시락입니다.</span>`,
      info: ""
    });

    this.customLunchBoxSlideDataMobile.push({
      pcPath: `catering-page/custom-lunch-box/WEB/1.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/1.jpg`,
      title: "맞춤 도시락",
      price: `20,000원 이상 (1인) <span class="hide">/ </span> <br />메뉴 구성 및 용기는 모두 고객 맞춤형으로<span class="hide> 귀한 손님들에게 준비해드리는 맞춤 도시락입니다. </span>
      <span class="non-hide">, 특별한 행사에 참석하신 귀한<br />손님들에게 준비해드리기 좋은 맞춤 도시락입니다.</span>`,
      info: ""
    });

    this.customLunchBoxSlideDataPC.push({
      pcPath: `catering-page/custom-lunch-box/WEB/2.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/2.jpg`,
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataMobile.push({
      pcPath: `catering-page/custom-lunch-box/WEB/2.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/2.jpg`,
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataPC.push({
      pcPath: `catering-page/custom-lunch-box/WEB/3.jpg`,
      tabletPath: "",
      mobilePath: "",
      title: "",
      price: "",
      info: ""
    });

    const additionalTitle = [
      `재래식장국 / 들깨미역국`,
      `컵샐러드 / 컵과일`,
      `발효청 / 산나물차 / 커피 (200ml)`
    ];

    const additionalPrice = [`각 1,500원`, `각 1,500원`, `각 2,000원`];

    for (let i = 0; i < additionalPrice.length; i++) {
      this.additionalMenuSlideData.push({
        pcPath: `catering-page/additional-menu/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/additional-menu/Mobile/${i + 1}.jpg`,
        title: additionalTitle[i],
        price: additionalPrice[i],
        info: ""
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
      const firstSlide = (document as Document).getElementById(
        "main-carousel-slide-0"
      ) as Element;
      if (firstSlide) {
        firstSlide.classList.remove("VueCarousel-slide-active");
      }
    }, 6000);

    this.handleResize();
    this.responseComponents();
  }

  onChange(/*event*/) {
    if (this.seletedValue == 1 || this.seletedValue == 2)
      this.isCatering = true;
    else this.isCatering = false;
  }

  onChangeDate(/*event*/) {
    const sel = this.selectedMonth;
    if ((sel <= 7 && sel % 2 == 1) || (sel > 7 && sel % 2 == 0))
      this.isMonthWith31Days = true;
    else this.isMonthWith31Days = false;
  }

  handleStoreSlideClick(dataset: { index: string }) {
    this.curStoreIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.storeCarousel as Carousel).goToPage(this.curStoreIndex - 1);
  }

  handleResize(/* e : Event */) {
    this.isMobile = Breakpoint.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleStoreCarouselChange(index: number) {
    this.curStoreIndex = index;
  }

  responseComponents() {
    if (this.isMobile) {
      this.storeCarouselPerPage = 1;
      this.infoBreak = true;
      this.homeContentCarouselPaginationActiveColor = "#001845";
    } else {
      this.storeCarouselPerPage = 3;
      this.infoBreak = false;
      this.homeContentCarouselPaginationActiveColor = "black";
    }
  }

  public get mainCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-white.png")}
            >`;
  }

  public get mainCarouselNavigationPrev(): string {
    return `<img 
              src=${require("@/assets/images/arrow-left-white.png")} 
            >`;
  }

  public get storeCarouselNavigationNext(): string {
    if (this.isMobile)
      return `<img 
              src=${require("@/assets/images/arrow-right-white.png")} 
              style="width:3.889vw;"
            >`;

    return `<img 
              src=${require("@/assets/images/arrow-right-black.png")} 
              style="width:1.042vw;"
            >`;
  }

  public get storeCarouselNavigationPrev(): string {
    if (this.curStoreIndex == 0 || this.isMobile)
      return `<img 
              src=${require("@/assets/images/arrow-left-white.png")} 
              style="width:3.889vw;"
            >`;

    return `<img 
              src=${require("@/assets/images/arrow-left-black.png")} 
              style="width:1.042vw;"
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin-left: 14.271vw;
  width: 71.354vw;

  @include mobile {
    margin-left: 9.167vw;
    width: 81.667vw;
  }
}

.info {
  text-align: center;
  color: #595757;
  font-weight: 300;

  &-1 {
    font-size: 1.146vw;
    line-height: 2.188vw;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
    }
  }

  &-2 {
    font-size: 1.719vw;
    font-weight: 500;
    padding: 8.281vw 0 6.563vw 0;
    color: #001845;

    @include mobile {
      font-size: 4.722vw;
      padding: 20.556vw 0;
    }
  }

  &-3 {
    background: white;
  }

  &-4 {
    padding: 0.964vw 0 0 0.885vw;
    font-size: 0.99vw;
    line-height: 1.53;
    color: #747171;
  }

  &-5 {
    padding: 0.417vw 0 0 0.885vw;
    font-size: 0.99vw;
    line-height: 1.53;
    color: #747171;
  }

  &-6 {
    font-size: 0.99vw;
    line-height: 1.901vw;
    color: #001848;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
      text-align: center;
      color: #595757;
      letter-spacing: -0.2vw;
    }
  }

  &-7 {
    font-size: 0.99vw;
    line-height: 2;
    margin: 2.148vw 0 4.609vw;
    letter-spacing: -0.005vw;

    @include mobile {
      font-size: 2.778vw;
      line-height: 1.7;
      background: white;
      letter-spacing: normal;
      padding: 5.833vw 5vw;
      text-align: justify;
      word-break: keep-all;
      margin: 8.056vw 0 9.444vw;
    }
  }
}

.bold {
  color: #001845;
  padding-right: 0.5vw;
  font-weight: 500;
}

.contentsWrap {
  display: flex;
  justify-content: space-between;
  img {
    width: 100%;
    height: 15.677vw;
  }
}

.main {
  .img-slider {
    width: 100%;

    &::v-deep {
      .VueCarousel-navigation-prev {
        transform: unset;
        left: 3.229vw;
        top: 17.188vw;

        img {
          width: 1.458vw;
        }

        @include mobile {
          left: 4vw;
          top: 45%;

          img {
            width: 3.889vw;
          }
        }
      }

      .VueCarousel-navigation-next {
        transform: unset;
        right: 3.229vw;
        top: 17.188vw;

        img {
          width: 1.458vw;
        }

        @include mobile {
          right: 4vw;
          top: 45%;

          img {
            width: 3.889vw;
          }
        }
      }

      // 메인 슬라이드 페이지네이션 버튼 위치
      .VueCarousel-pagination--bottom-overlay {
        bottom: 1.667vw;

        .VueCarousel-dot {
          width: 0.729vw !important;
          height: 0.729vw !important;
          padding: 0 0.599vw !important;
        }

        @include mobile {
          bottom: 5.278vw;

          .VueCarousel-dot {
            width: 2.5vw !important;
            height: 2.5vw !important;
            padding: 0 2.222vw !important;
          }
        }
      }

      // 메인 슬라이드 트랜지션 재정의
      .VueCarousel-inner {
        transition: transform 0s ease 1s !important;
        transform: none !important;

        .VueCarousel-slide {
          transition: opacity 1s !important;
          width: 100%;
          height: 40.313vw;
          opacity: 0 !important;

          @include mobile {
            height: 148.056vw;
          }

          img {
            position: absolute;
            width: 100%;

            &:last-child {
              left: 0;
            }
          }
        }
        .VueCarousel-slide-active {
          transition: opacity 1s !important;
          opacity: 1 !important;
        }
      }
    }

    img {
      width: 100%;
      @include mobile {
        height: 147.222vw;
        object-fit: contain;
        overflow: hidden;
      }
    }
  }

  .info-1 {
    padding-top: 7.448vw;

    @include mobile {
      padding-top: 20.556vw;
    }
  }
}

.content-1 {
  .illust {
    margin: 7.156vw 0 10.281vw 21.581vw;
    width: 55.438vw;
    height: 17.875vw;

    @include mobile {
      margin: 26.389vw 0 30vw 11.667vw;
      width: 76.667vw;
      height: 79.444vw;
    }
  }

  .info-1 {
    padding: 12.188vw 0 6.25vw 0;

    @include mobile {
      padding: 29.167vw 0 22.222vw 0;
    }
  }

  .logo {
    width: 100%;
    height: 32.604vw;
    margin-bottom: 5.99vw;

    @include mobile {
      width: 81.667vw;
      height: 66.667vw;
      margin: 0 0 22.5vw 9.167vw;
    }
  }

  article {
    height: 23.906vw;

    @include mobile {
      height: 78.056vw;
    }
  }
}

.content-2 {
  background-color: #ededee;

  .catering-visit-large {
    height: 25.625vw;
    .contentsWrap-1 {
      height: 21.042vw;
    }
    @include mobile {
      height: 81.389vw;
      .contentsWrap-1 {
        height: 69.444vw;
      }
    }
  }

  .catering-visit-small {
    height: 36.875vw;
    margin-top: 7.917vw;
    .contentsWrap-2 {
      height: 22.552vw;
      &::v-deep {
        .info-5 {
          padding-left: 4.323vw;
          @include mobile {
            padding-left: 16.111vw;
          }
        }
      }
    }

    @include mobile {
      height: 112.222vw;
      margin-top: 20.556vw;
      .contentsWrap-2 {
        height: 74.444vw;
      }
    }
  }
}

.content-3 {
  .easy-lunch-box {
    height: 25.99vw;
    .contentsWrap-3 {
      &::v-deep {
        .info-5 {
          padding-top: 0.573vw;
        }
      }
    }

    @include mobile {
      height: 77.222vw;
      .contentsWrap-3 {
        &::v-deep {
          .info {
            &-4 {
              padding-left: 0;
              padding-top: 2.639vw;
            }
            &-5 {
              width: 81.944vw;
              padding: 0;
              letter-spacing: -0.1vw;
              word-break: keep-all;
              br {
                display: none;
              }
            }
          }
          .price {
            padding-left: 4.167vw;
          }
          .VueCarousel-navigation-button {
            img {
              filter: opacity(0.5) drop-shadow(0 0 0 gray);
            }
          }
        }
      }
    }
  }

  .custom-lunch-box {
    height: 23.542vw;
    margin-top: 10.573vw;
    &::v-deep {
      .info-3 {
        background: unset;
        .info-4 {
          width: 22.917vw;
          white-space: nowrap;
          .non-hide {
            display: none;
          }
          .hide {
            display: inline;
          }
          br {
            display: none;
          }
        }
      }
    }
    @include mobile {
      height: 81.667vw;
      margin-top: 19.861vw;
      &::v-deep {
        .info-3 {
          .info-4 {
            padding: 2.639vw 0 0 0;
            .non-hide {
              display: inline;
            }
            .hide {
              display: none;
            }
            br {
              display: inline;
            }
          }
        }

        .VueCarousel-slide {
          &:nth-child(3) {
            display: none;
          }
        }
      }
    }
  }
  .additional-menu {
    height: 17.135vw;
    margin-top: 10.417vw;
    margin-bottom: 11.042vw;
    .contentsWrap-5 {
      &::v-deep {
        .VueCarousel-slide {
          img {
            height: 9.479vw;
          }
        }
      }
    }
    @include mobile {
      height: 63.333vw;
      margin-top: 19.861vw;
      margin-bottom: 26.389vw;
      .contentsWrap-5 {
        &::v-deep {
          .VueCarousel-slide {
            img {
              height: 44.444vw;
            }
          }
          .VueCarousel-navigation-button {
            top: 45%;
            img {
              filter: opacity(0.5) drop-shadow(0 0 0 gray);
            }
          }
          .info-4 {
            padding: 2.917vw 0 0 0;
          }
        }
      }
    }
  }
}

.content-4 {
  display: block;
  background-color: #ededee;
  width: 100%;
  height: 87.396vw;
  padding: 8.385vw 27.083vw 9.427vw 27.083vw;

  @include mobile {
    height: 344.167vw;
    padding: 20.833vw 9.444vw 22.222vw 9.444vw;
  }

  .info-2 {
    padding: 0 0 4.818vw;
    @include mobile {
      padding-bottom: 10vw;
    }
  }

  .bold {
    font-size: 1.146vw;
    @include mobile {
      font-size: 3.611vw;
    }
  }

  .bold-2 {
    font-weight: 500;
  }

  .red {
    color: #f9423a;
  }

  .blank {
    padding-left: 5.508vw;
    @include mobile {
      padding-left: 0;
    }
  }

  .contentsWrap-6 {
    display: flex;
    justify-content: space-between;
    align-content: space-between;
    flex-wrap: wrap;
    height: 27.813vw;

    @include mobile {
      height: 131.667vw;
    }

    input,
    select,
    div {
      color: #595757;
      font: 300 1.006vw NotoSansCjKr;
      line-height: 1.73;
      height: 2.604vw;
      border: none;
      background: white;

      @include mobile {
        font-size: 3.611vw;
        line-height: 9.167vw;
        height: 9.167vw;
      }
    }

    > input,
    div {
      background: white;
      width: 22.135vw;
      border: none;
      padding: 0;

      @include mobile {
        width: 100%;
      }
    }

    > input {
      width: 21.458vw;
      padding-left: 0.677vw;
      @include mobile {
        width: 79.444vw;
        padding-left: 2.222vw;
      }
    }

    > select {
      background: #ededee;
      color: #001845;
      font-size: 1.146vw;
      font-weight: 300;
      line-height: 1.73;
      cursor: pointer;
      width: 22.135vw;
      height: 2.083vw;
      border: 0;
      border-bottom: 0.052vw solid black;

      @include mobile {
        width: 50%;
        height: 7.5vw;
        font-size: 3.472vw;
        line-height: 7.361vw;
      }
    }

    > div {
      padding-left: 0.677vw;

      @include mobile {
        padding-left: 2.222vw;
      }
    }

    select {
      cursor: pointer;
    }

    .miniWrap {
      display: inline-flex;
      justify-content: space-between;
      padding: 0;
      background: #ededee;

      .mini {
        display: inline-block;
        background: white;
        border: 0;
        padding: 0;
        width: 10.781vw;

        &:first-child {
          padding-left: 0.677vw;
          width: 10.104vw;
        }

        @include mobile {
          width: 39.722vw;

          &:first-child {
            padding-left: 2.222vw;
            width: 37.5vw;
          }
        }
      }
    }

    .dateWrap {
      > select {
        text-align-last: right;
      }

      #year {
        width: 7.292vw;
        @include mobile {
          width: 27.778vw;
        }
      }

      #month,
      #day {
        width: 5.879vw;
        @include mobile {
          width: 21.111vw;
        }
      }
    }

    .timeWrap {
      > select {
        text-align-last: right;
      }

      #hour {
        width: 13.171vw;
        @include mobile {
          width: 27.778vw;
        }
      }

      #min {
        width: 5.879vw;
        @include mobile {
          width: 42.222vw;
        }
      }
    }

    .large {
      color: #797777;
      line-height: 1.73;
      font: 300 1.146vw NotoSansCjKr;
      width: 100%;
      height: 4.896vw;
      padding: 0;
      border: 0;
      padding: 0.521vw 0 0 0.677vw;

      @include mobile {
        padding: 1.667vw 2.083vw 0 2.083vw;
        height: 18.333vw;
        font-size: 3.611vw;
        line-height: 1.62;
        letter-spacing: -0.35vw;
      }
    }
  }

  .privacyCondition {
    margin-top: 0.69vw;
    position: relative;
    text-align: right;
    font-size: 0.99vw;
    line-height: 1.615vw;

    @include mobile {
      margin-top: 3.056vw;
      font-size: 2.917vw;
      line-height: 1;
    }

    input[type="checkbox"] {
      display: none;

      & + label {
        position: absolute;
        width: 1.406vw;
        height: 1.406vw;
        top: 0.24vw;
        right: 17.5vw;
        border: 0;
        border-radius: 50%;
        background: white;
        cursor: pointer;

        @include mobile {
          width: 4.167vw;
          height: 4.167vw;
          top: 0.833vw;
          right: 51.389vw;
        }

        img {
          position: relative;
          z-index: 2;
          width: 0.677vw;
          height: 0.833vw;
          right: 0.363vw;
          bottom: 0.1vw;
          background: transparent;

          @include mobile {
            width: 1.944vw;
            height: 2.5vw;
            right: 1vw;
            top: 0.7vw;
            bottom: 0;
          }
        }
      }

      &:checked + label {
        background: #001845;
        img {
          filter: brightness(1);
        }
      }
    }

    div {
      display: inline-block;
      border-radius: 0.755vw;
      border: 0.052vw solid #001845;
      padding: 0 0.703vw;
      margin-left: 0.521vw;

      @include mobile {
        border-radius: 2.278vw;
        border-width: 0.278vw;
        padding: 0.833vw 2.222vw 0.833vw 1.667vw;
      }
    }
  }

  input[type="button"] {
    width: 9.531vw;
    height: 2.656vw;
    margin: 3.906vw 0 0 18.125vw;
    padding: 0;
    border: 0;
    border-radius: 1.302vw;
    background-color: #001845;
    color: white;
    font: 500 1.302vw NotoSansCJKr;
    cursor: pointer;

    @include mobile {
      margin: 11.111vw 0 0 26.944vw;
      width: 28.056vw;
      height: 7.778vw;
      border-radius: 3.861vw;
      font-size: 3.889vw;
    }
  }
}

.footer {
  background-color: white;
}
</style>
