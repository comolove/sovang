<template>
  <main ref="main">
    <Header />
    <section class="main" data-aos="fade-up">
      <section class="img-slider">
        <Carousel
          class="main-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :autoplayTimeout="3000"
          :autoplayHoverPause="false"
          :loop="true"
          :speed="1000"
          :paginationEnabled="false"
          :navigationEnabled="true"
          :navigationNextLabel="mainCarouselNavigationNext"
          :navigationPrevLabel="mainCarouselNavigationPrev"
        >
          <Slide
            v-for="(data, index) of mainSlideData"
            :key="index"
            :id="'main-carousel-slide-' + index"
          >
            <img :src="isMobile ? data.img.mobilePath : data.img.pcPath" />
          </Slide>
        </Carousel>
      </section>
      <div class="info info-1" data-aos="fade-up">
        청정지역의 제철먹거리와 함께
        <br v-if="isMobile" />특별하고 의미있는 모임을 기획하는 가장 쉬운 방법.
        <br />소녀방앗간과 함께 어떤 특별함을 만들 수 있을까요?
      </div>
    </section>

    <section class="content-1">
      <AssetImage
        data-aos="fade-up"
        class="illust"
        :src="'catering-page/illustration' + (isMobile ? '-m.png' : '-pc.png')"
      />
      <HomeContent title="청정케이터링 이야기" data-aos="fade-up">
        <CateringStoryContent
          :stories="cateringStorySlideData"
          :isMobile="isMobile"
        />
      </HomeContent>
      <div class="info info-1" data-aos="fade-up">
        2017년부터 지금까지 여러 공공기관과 대기업, 그리고
        <br v-if="isMobile" />사회적경제의 스타트업까지
        <br v-if="!isMobile" />다양한 공간에서 소녀방앗간과
        <br v-if="isMobile" />함께 청정케이터링 서비스를 경험하고 있습니다.
      </div>
      <AssetImage
        class="logo"
        :src="'catering-page/logo-' + (isMobile ? 'm' : 'pc') + '.jpg'"
        data-aos="fade-up"
      />
    </section>

    <section class="content-2">
      <div class="info info-2" data-aos="fade-up">청정케이터링</div>
      <HomeContent
        class="catering-visit-large"
        title="방문 케이터링 (30인 이상)"
        data-aos="fade-up"
      >
        <CateringContent
          class="contentsWrap-1"
          :contentData="cateringVisitSlideData"
        />
      </HomeContent>
      <HomeContent
        title="박스 케이터링 (30인 이하)"
        class="catering-visit-small"
        data-aos="fade-up"
      >
        <CateringContent
          class="contentsWrap-2"
          :contentData="cateringBoxSlideData"
        />
      </HomeContent>
    </section>

    <section class="content-3">
      <div class="info info-2" data-aos="fade-up">청정도시락</div>
      <HomeContent
        class="easy-lunch-box"
        title="간편 도시락 (10인 이상)"
        data-aos="fade-up"
      >
        <CateringContent
          class="contentsWrap-3"
          :contentData="easyLunchBoxSlideData"
        />
      </HomeContent>
      <HomeContent
        title="맞춤 도시락 (10인 이상)"
        data-aos="fade-up"
        class="custom-lunch-box"
      >
        <CateringContent
          class="contentsWrap-4"
          :contentData="
            isMobile ? customLunchBoxSlideDataMobile : customLunchBoxSlideDataPC
          "
        />
        <div class="info-3">
          <div class="info-4">
            <span class="bold">맞춤 도시락</span>
            <span class="price">
              20,000원 이상 (1인)
              <span class="hide">/</span>
              <br />메뉴 구성 및 용기는 모두 고객 맞춤형으로
              <span class="hide"
                >귀한 손님들에게 준비해드리는 맞춤 도시락입니다.</span
              >
              <span class="non-hide">
                , 특별한 행사에 참석하신 귀한
                <br />손님들에게 준비해드리기 좋은 맞춤 도시락입니다.
              </span>
            </span>
          </div>
        </div>
      </HomeContent>

      <HomeContent
        title="추가 메뉴 (도시락만 해당)"
        data-aos="fade-up"
        class="additional-menu"
      >
        <CateringContent
          class="contentsWrap-5"
          :contentData="additionalMenuSlideData"
        />
      </HomeContent>
    </section>

    <section class="content-4">
      <div class="info info-2" data-aos="fade-up">주문 안내</div>
      <div class="info-6" data-aos="fade-up">
        <span class="bold"
          >특별한 케이터링을 위해 소녀방앗간에 문의해보셔요 :)</span
        >
        <br />
        <span v-if="!isMobile">아래의</span> 상담 예약을 먼저 완료해주시면
        <span v-if="!isMobile">더 </span>빠른 소통이 가능합니다.
      </div>
      <div class="info-7" data-aos="fade-up" style="text-align:justify !important; text-align-last: left !important">
        <span class="bold-2">1) 주문시간</span> : 행사일 기준,
        <span class="red"
          >케이터링/맞춤도시락은 최소 1주 전, 간편도시락은 3일 전</span
        >
        메뉴확정이 필요합니다.
        <br v-if="!isMobile" />
        <span class="blank">
          (하단의 상담 예약을 하신 당일 혹은 익일 연락드려 소통하게 됩니다.)
        </span>
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">2) 메뉴구성</span> : 행사와 계절에 맞게 제철메뉴로
        제안드리며, 충분히 소통하여 조율 가능합니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2 wider-3">3) 최소인원</span> :
        <span class="red">
          <span class="wider-3">박스케이터링/도시락은 10인 이상, 방문</span>
          케이터링은 30인 이상</span
        >부터 준비 가능합니다.
        <br />
        <br v-if="isMobile" />
        <span class="wider-4">
          <span class="bold-2">4) 배송진행</span> : 박스케이터링/도시락은
          지정업체에서
        </span>
        <span class="wider-1">퀵배송해드리며, 방문케이터링은 직접 방문해</span>
        준비해드립니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">5) 견적문의</span> : 식사견적 외에 배송 및 현장운영
        비용은 인원 / 위치에 따라 별도로 적용됩니다.
        <br />
        <br v-if="isMobile" />
        <span class="bold-2">6) 결제방법</span> : 계좌이체, 카드결제 중 편하신
        방법으로 선택해주시면 됩니다.
        <br v-if="!isMobile" />
        <span class="blank">(단, 퀵배송의 경우 카드결제는
          BC/우리/국민/농협카드만 가능합니다.)
        </span>
      </div>
      <span v-if="!isMobile" class="warning">
        <span style="color:red;">*</span> 별표 표시 항목은 필수
        입력사항입니다.
      </span>
      <div class="contentsWrap-6" data-aos="fade-up">
        <InputText
          ref="input-groupID"
          name="groupID"
          placeholder="단체명"
          :isRequired="false"
        />
        <InputText
          v-if="isMobile"
          ref="input-manager-m"
          name="manager"
          placeholder="담당자"
          :isRequired="true"
        />
        <InputText
          v-if="isMobile"
          ref="input-contact-m"
          name="contact"
          placeholder="연락처"
          :isRequired="true"
        />
        <InputText
          v-if="isMobile"
          ref="input-email-m"
          name="email"
          placeholder="이메일"
          :isRequired="false"
        />
        <div class="dateWrap">
          날짜
          <span class="redAsterisk" style="margin-left: -0.2vw;">*</span>
          <select id="year" @change="onChangeYear()" v-model="selectedYear">
            <option value="0" selected disabled>
              <span v-if="!isMobile">년</span>
            </option>
            <option v-for="y in 6" :key="y" :value="2019 + y"
              >{{ 2019 + parseInt(y) }}년</option
            >
          </select>
          <select id="month" @change="onChangeDate()" v-model="selectedMonth">
            <option value="0" selected disabled>
              <span v-if="!isMobile">월</span>
            </option>
            <option v-for="index in 12" :key="index" :value="index"
              >{{ index }}월</option
            >
          </select>
          <select id="day" v-model="selectedDay">
            <option selected disabled value="0">
              <span v-if="!isMobile">일</span>
            </option>
            <option v-for="d in 28" :key="d" :value="d">{{ d }}일</option>
            <option v-show="selectedMonth != 2" :value="29">29일</option>
            <option v-show="selectedMonth != 2" :value="30">30일</option>
            <option v-show="isMonthWith31Days" :value="31">31일</option>
          </select>
        </div>
        <InputText
          v-if="!isMobile"
          ref="input-manager-pc"
          name="manager"
          placeholder="담당자"
          :isRequired="true"
        />
        <div class="timeWrap">
          시간
          <span class="redAsterisk" style="margin-left: -0.2vw;">*</span>
          <select id="hour" v-model="selectedHour">
            <option selected disabled :value="-1">
              <span v-if="!isMobile">시</span>
            </option>
            <option :value="9">오전 9시</option>
            <option :value="10">오전 10시</option>
            <option :value="11">오전 11시</option>
            <option :value="12">오전 12시</option>
            <option v-for="h in 12" :key="h" :value="12 + h"
              >오후 {{ h }}시</option
            >
          </select>
          <select id="min" v-model="selectedMin">
            <option selected disabled :value="-1">
              <span v-if="!isMobile">분</span>
            </option>
            <option v-for="m in 6" :key="m" :value="10 * (m - 1)"
              >{{ 10 * (m - 1) }}분</option
            >
          </select>
        </div>
        <InputText
          v-if="!isMobile"
          ref="input-contact-pc"
          name="contact"
          placeholder="연락처"
          :isRequired="true"
        />
        <div class="miniWrap">
          <InputText
            placeholder="인원(10인 이상 입력)"
            ref="people"
            class="mini"
            :isRequired="true"
            name="people"
          />
          <div>
          <select class="mini" v-model="payType">
            <option selected disabled value>결제방법</option>
            <option>카드결제</option>
            <option>계좌이체</option>
          </select>
          </div>
        </div>
        <InputText
          v-if="!isMobile"
          ref="input-email-pc"
          name="email"
          placeholder="이메일"
          :isRequired="false"
        />
        <InputText
          ref="input-adress"
          name="adress"
          placeholder="주소"
          :isRequired="false"
        />
        <span>
          <span v-show="selectedCategory == 0" class="redAsterisk">*</span>
          <select id="category" v-model="selectedCategory" @change="onChange()">
            <option :value="0" selected disabled>카테고리</option>
            <option :value="1">방문 케이터링</option>
            <option :value="2">박스 케이터링</option>
            <option :value="3">간편 도시락</option>
            <option :value="4">맞춤 도시락</option>
          </select>
        </span>
        <span>
          <span v-show="selectedMenu == 0" class="redAsterisk">*</span>
          <select id="menuComposition" v-model="selectedMenu">
            <option selected disabled value>메뉴구성</option>
            <option v-show="isCatering">실속형</option>
            <option v-show="isCatering">일반형</option>
            <option v-show="isCatering">고급형</option>
            <option v-show="isEasyLaunchbox"
              >고춧가루제육볶음 한 상 도시락</option
            >
            <option v-show="isEasyLaunchbox">돼지갈비찜 한 상 도시락</option>
            <option v-show="isEasyLaunchbox">소불고기 한 상 도시락</option>
            <option v-show="isCustomLaunchbox">선택 없음</option>
          </select>
        </span>
        <span>
          <span v-show="selectedItem == ''" class="redAsterisk">*</span>
          <select id="menuItem" v-model="selectedItem">
            <option selected disabled value>메뉴항목</option>
            <option v-show="!isEasyLaunchbox">식사</option>
            <option v-show="!isEasyLaunchbox">다과</option>
            <option v-show="isEasyLaunchbox">선택 없음</option>
          </select>
        </span>
        <span>
          <select id="additionalMenu" v-model="selectedAdditionalMenu">
            <option value selected disabled>
              추가메뉴
              <span v-if="!isMobile">(도시락만 해당)</span>
            </option>
            <option v-show="isCatering">선택 없음</option>
            <option v-show="!isCatering">재래식장국</option>
            <option v-show="!isCatering">들깨미역국</option>
            <option v-show="!isCatering">컵샐러드</option>
            <option v-show="!isCatering">컵과일</option>
            <option v-show="!isCatering">발효청</option>
            <option v-show="!isCatering">산나물차</option>
            <option v-show="!isCatering">커피</option>
          </select>
        </span>
        <textarea
          class="large"
          placeholder="추가메세지 : 전체 예산을 적어 문의해주시면 더 빠른 상담이 가능합니다:)"
          v-model="extraMessage"
        />
      </div>
      <div class="privacyCondition">
        <input type="checkbox" id="privacy" v-model="isPrivacyChecked" />
        <label for="privacy">
          <AssetImage src="catering-page/privacy.png" />
        </label>
        개인정보 수집 및 이용 동의
        <input
          class="privacyButton"
          type="button"
          value="내용 보기"
          @click="openPrivacyModal"
        />
      </div>
      <input
        class="consultButton"
        type="button"
        value="상담 예약"
        @click="handleSubmitCatering"
      />
    </section>
    <Modal v-if="consultModal" class="consultModal">
      <p v-if="!isPrivacyChecked">
        개인정보 동의는 필수입니다 :)
      </p>
      <p v-else-if="isEmpty">붉은색 별표 표시된 항목은 필수 입력사항입니다 :)</p>
      <p v-else>
        상담을 예약해주셔서 감사합니다 :)
        <br />빠른 시일 내에 연락드리도록 하겠습니다.
      </p>
      <template slot="footer">
        <button @click="closeConsultModal">확인</button>
      </template>
    </Modal>
    <Modal v-show="privacyModal" class="privacyModal">
      <h2>
        개인정보 수집 및 이용
        <img
          src="@/assets/images/icon-close-darkblue.png"
          @click="closePrivacyModal"
        />
      </h2>
      <p>
        <span class="bold">[개인정보 수집 및 이용 동의 ]</span> 주식회사
        방앗간컴퍼니는 개인정보 보호를 최우선의 가치로 삼으며 개인정보 보호와
        관련한 국내외 모든 법령을 성실히 준수합니다. 주식회사 방앗간컴퍼니는
        케이터링 & 도시락 상담 예약을 위하여, 아래와 같이 개인정보를 수집 및
        이용합니다. 내용을 상세히 확인하신 후 동의 여부를 결정하여 주시기
        바랍니다.
        <br />
        <br />
        <span class="bold">1. 개인정보의 수집 및 이용 목적</span>
        <br />케이터링 & 도시락 상담
        <br />
        <br />
        <span class="bold">2. 수집하는 개인정보의 항목</span>
        <br />담당자명, 연락처, 이메일주소(선택)
        <br />
        <br />
        <span class="bold">3. 개인정보의 보유 및 이용기간</span>
        <br />정보 수집 및 이용 목적이 달성된 후 문의 내역관리를 위하여 문의
        내용과 개인정보 입력항목에 대해서는 1년간 보유 이후 해당 정보를
        파기합니다.
        <br />
        <br />
        <span class="bold"
          >4. 동의를 거부할 권리 및 동의 거부에 따른 불이익</span
        >
        <br />서비스 제공을 위하여 기본 정보를 수집하고 있으며, 동의 거부시 상담
        예약이 제한될 수 있습니다.
        <br />
        <br />
        <span class="bold">
          본인은 [개인정보 수집 및 이용에 관한 동의]를 잘 읽어 보았으며,
          개인정보 수집 및 이용에 동의 합니다.
        </span>
      </p>
    </Modal>
    <AssetImage
      class="button-go-top"
      :class="{
        'button-go-top-visible': isVisible,
        'button-go-top-invisible': !isVisible
      }"
      @click="goTop"
      src="button-go-top.png"
    />
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
  AssetImage,
  ImageOverlayInfo,
  CateringStoryContent,
  CateringContent,
  InputText,
  TextareaWithRedAsterisk,
  Modal
} from "@/components";
import {
  AxiosHelper,
  screenSize,
  ImgPath,
  CateringOrder,
  CateringStory,
  MainSlide
} from "@/utils";

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
    AssetImage,
    ImageOverlayInfo,
    CateringStoryContent,
    CateringContent,
    TextareaWithRedAsterisk,
    InputText,
    Modal,
    agile: VueAgile
  }
})
export default class Catering extends Vue {
  private mainSlideData: MainSlide[] = [];
  private cateringStorySlideData: CateringStory[] = [];
  private cateringVisitSlideData: CateringContentData[] = [];
  private cateringBoxSlideData: CateringContentData[] = [];
  private easyLunchBoxSlideData: CateringContentData[] = [];
  private customLunchBoxSlideDataPC: CateringContentData[] = [];
  private customLunchBoxSlideDataMobile: CateringContentData[] = [];
  private additionalMenuSlideData: CateringContentData[] = [];

  private isMobile = false;
  private isVisible = false;

  private year = 10;
  private month = 12;
  private day = 29;

  private payType = "";
  private consultModal = false;
  private privacyModal = false;

  private selectedCategory = 0;
  private selectedYear = 0;
  private selectedMonth = 0;
  private selectedDay = 0;
  private selectedHour = -1;
  private selectedMin = -1;
  private selectedMenu = "";
  private selectedItem = "";
  private selectedAdditionalMenu = "";
  private extraMessage = "";
  private isPrivacyChecked = false;

  private storeCarouselPerPage = 1;
  private homeContentCarouselPaginationActiveColor = "black";
  private curStoreIndex = 0;
  private infoBreak = false;

  async created() {
    window.addEventListener("resize", this.handleResize);
    window.addEventListener("scroll", this.handleScroll);

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
        index: -1,
        pcPath: `catering-page/catering-visit/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-visit/Mobile/${i + 1}.jpg`,
        name: "",
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
        index: -1,
        pcPath: `catering-page/catering-box/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/catering-box/Mobile/${i + 1}.jpg`,
        name: "",
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
        index: -1,
        pcPath: `catering-page/easy-lunch-box/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/easy-lunch-box/Mobile/${i + 1}.jpg`,
        name: "",
        title: easyTitle[i],
        price: easyPrice[i],
        info: easyInfo[i]
      });
    }

    this.customLunchBoxSlideDataPC.push({
      index: -1,
      pcPath: `catering-page/custom-lunch-box/WEB/1.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/1.jpg`,
      name: "",
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataMobile.push({
      index: -1,
      pcPath: `catering-page/custom-lunch-box/WEB/1.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/1.jpg`,
      name: "",
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataPC.push({
      index: -1,
      pcPath: `catering-page/custom-lunch-box/WEB/2.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/2.jpg`,
      name: "",
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataMobile.push({
      index: -1,
      pcPath: `catering-page/custom-lunch-box/WEB/2.jpg`,
      tabletPath: "",
      mobilePath: `catering-page/custom-lunch-box/Mobile/2.jpg`,
      name: "",
      title: "",
      price: "",
      info: ""
    });

    this.customLunchBoxSlideDataPC.push({
      index: -1,
      pcPath: `catering-page/custom-lunch-box/WEB/3.jpg`,
      tabletPath: "",
      // 에러가 발생하니 아무 이미지 링크를 넣어줌
      mobilePath: "catering-page/custom-lunch-box/WEB/3.jpg",
      name: "",
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
        index: -1,
        pcPath: `catering-page/additional-menu/WEB/${i + 1}.jpg`,
        tabletPath: "",
        mobilePath: `catering-page/additional-menu/Mobile/${i + 1}.jpg`,
        name: "",
        title: additionalTitle[i],
        price: additionalPrice[i],
        info: ""
      });
    }

    await this.LoadCateringStories();
  }

  async LoadCateringStories() {
    try {
      let result = await AxiosHelper.GET("/getCateringStories.php");
      const cateringList = result.data.data as CateringStory[];

      this.cateringStorySlideData = cateringList;

      result = await AxiosHelper.GET("/getCateringMainSlides.php");
      const cateringSlide = result.data.data as MainSlide[];

      this.mainSlideData = cateringSlide;
    } catch (error) {
      console.log("케이터링 이야기 로딩 실패");
      console.log(error);
    }
  }

  mounted() {
    this.handleResize();
    this.responseComponents();

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
  }

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
    window.removeEventListener("scroll", this.handleScroll);
  }

  onChange(/*event*/) {
    this.selectedMenu = "";
    this.selectedAdditionalMenu = "";
    this.selectedItem = "";
  }

  onChangeYear(/* event */) {
    this.selectedMonth = 0;
    this.selectedDay = 0;
  }

  onChangeDate(/*event*/) {
    this.selectedDay = 0;
  }

  openPrivacyModal() {
    this.privacyModal = true;
  }

  closePrivacyModal() {
    this.privacyModal = false;
  }

  closeConsultModal() {
    this.consultModal = false;
  }

  handleStoreSlideClick(dataset: { index: string }) {
    this.curStoreIndex = parseInt(dataset.index);
    // index 값으로 주면 해당 인덱스가 왼쪽(start)에 붙게되서 - 1 인덱스로 해주어서 선택한 인덱스가 가운데로 오도록 함
    (this.$refs.storeCarousel as Carousel).goToPage(this.curStoreIndex - 1);
  }

  handleResize(/* e : Event */) {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleStoreCarouselChange(index: number) {
    this.curStoreIndex = index;
  }

  async handleSubmitCatering() {
    if (!this.isPrivacyChecked) {
      this.consultModal = true;
      return;
    }

    if (this.isEmpty) {
      this.consultModal = true;
      return;
    }

    const order = new CateringOrder();
    order.organization = this.organization;
    order.personInCharge = this.personInCharge;
    order.hp = this.hp;
    order.email = this.email;
    order.date = `${this.selectedYear}-${this.selectedMonth}-${this.selectedDay} ${this.selectedHour}:${this.selectedMin}`;
    order.headcount = this.headcount;
    order.payType = this.payType;
    order.address = this.address;
    order.category = this.CategoryToString(this.selectedCategory);
    order.menuItem = this.selectedItem;
    order.menuSet = this.selectedMenu;
    order.extraMenu = this.selectedAdditionalMenu;
    order.extraMessage = this.extraMessage;
    console.log(order);

    try {
      await AxiosHelper.POST("/insertCateringOrder.php", { ...order });
      this.consultModal = true;
    }
    catch(error) {
      alert("실패");
      console.log(error);
    }
  }

  handleScroll(/* e : Evuent */) {
    if (
      window.pageYOffset >
      ((this.$refs.main as HTMLElement).clientHeight as number) -
        window.innerHeight +
        window.innerWidth * (this.isMobile ? 0.06389 : 0.07849) -
        5
    )
      this.isVisible = true;
    else this.isVisible = false;
  }

  goTop() {
    if(this.isVisible)
      window.scroll({
        top: 0,
        left: 0,
        behavior: "smooth"
      });
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

  private CategoryToString(category: number): string {
    switch (category) {
      case 1:
        return "방문 케이터링";
      case 2:
        return "박스 케이터링";
      case 3:
        return "간편 도시락";
      case 4:
        return "맞춤 도시락";
      default:
        return "";
    }
  }

  private ExtraMenuToString(menu: number): string {
    switch (menu) {
      case 1:
        return "방문 케이터링";
      case 2:
        return "박스 케이터링";
      case 3:
        return "간편 도시락";
      case 4:
        return "맞춤 도시락";
      default:
        return "";
    }
  }

  get organization(): string {
    const organization = this.$refs["input-groupID"] as InputText;

    return organization.value;
  }

  get hp(): string {
    const contact = this.$refs[
      this.isMobile ? "input-contact-m" : "input-contact-pc"
    ] as InputText;

    return contact.value;
  }

  get personInCharge(): string {
    const manager = this.$refs[
      this.isMobile ? "input-manager-m" : "input-manager-pc"
    ] as InputText;

    return manager.value;
  }

  get email(): string {
    const email = this.$refs[
      this.isMobile ? "input-email-m" : "input-email-pc"
    ] as InputText;

    return email.value;
  }

  get headcount(): string {
    const people = this.$refs["people"] as InputText;

    return people.value;
  }

  get address(): string {
    const adress = this.$refs["input-adress"] as InputText;

    return adress.value;
  }

  get isEmpty(): boolean {
    const contact = this.$refs[
      this.isMobile ? "input-contact-m" : "input-contact-pc"
    ] as InputText;
    const manager = this.$refs[
      this.isMobile ? "input-manager-m" : "input-manager-pc"
    ] as InputText;
    const people = this.$refs["people"] as InputText;

    if (
      people.isEmpty ||
      contact.isEmpty ||
      manager.isEmpty ||
      this.selectedCategory == 0 ||
      this.selectedYear == 0 ||
      this.selectedMonth == 0 ||
      this.selectedDay == 0 ||
      this.selectedHour == -1 ||
      this.selectedMin == -1 ||
      this.selectedMenu == "" ||
      this.selectedItem == ""
    ) {
      return true;
    }

    return false;
  }

  public get isCatering(): boolean {
    if (this.selectedCategory == 1 || this.selectedCategory == 2) {
      return true;
    } else {
      return false;
    }
  }

  public get isEasyLaunchbox(): boolean {
    if (this.selectedCategory == 3) {
      return true;
    } else {
      return false;
    }
  }

  public get isCustomLaunchbox(): boolean {
    if (this.selectedCategory == 4) {
      return true;
    } else {
      return false;
    }
  }

  public get isMonthWith31Days(): boolean {
    const sel = this.selectedMonth;
    if ((sel <= 7 && sel % 2 == 1) || (sel > 7 && sel % 2 == 0)) {
      return true;
    } else {
      return false;
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

    @include mobile {
      padding: 3.194vw 0 0 2.778vw;
      font-size: 2.778vw;
      line-height: 1.7;
      color: #595757;
    }
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
    letter-spacing: -0.03vw;

    @include mobile {
      font-size: 2.778vw;
      -webkit-text-size-adjust: none;
      line-height: 1.7;
      background: white;
      letter-spacing: 0.09vw;
      padding: 5.833vw 5vw;
      text-align: justify;
      margin: 8.056vw 0 9.444vw;
      word-break: keep-all;

      .wider {
        &-1 {
          letter-spacing: 0.85vw;
        }

        &-2 {
          letter-spacing: 0.6vw;
        }

        &-3 {
          letter-spacing: 0.35vw;
        }

        &-4 {
          letter-spacing: 0.45vw;
        }
      }
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
        top: 17.708vw;

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
        top: 17.708vw;

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
    margin: 6.51vw 0 9.635vw 21.979vw;
    width: 56.042vw;

    @include mobile {
      margin: 26.389vw 0 31.111vw 11.667vw;
      width: 76.667vw;
      height: 75.444vw;
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
      .VueCarousel-slide {
        .info-3 {
          @include IE {
            visibility: hidden;
          }
        }
      }
      .info-3 {
        position: relative;
        background: unset;
        bottom: 3.85vw;
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
      margin-top: 23.861vw;
      &::v-deep {
        .info-3 {
          bottom: 9.3vw;
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
      }
    }
  }
  .additional-menu {
    height: 17.135vw;
    margin-top: 10.573vw;
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
  position: relative;
  display: block;
  background-color: #ededee;
  width: 100%;
  height: 87.396vw;
  padding: 8.385vw 27.083vw 9.427vw 27.083vw;

  @include mobile {
    height: 344.167vw;
    padding: 20.833vw 9.444vw 22.222vw 9.444vw;
  }

  .warning {
      position: absolute;
      font-size: 0.99vw;
      left: 27.683vw;
      bottom: 16.35vw;
      color: #797777;

      @include mobile {
        display: none;
      }
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
    position: relative;
    justify-content: space-between;
    align-content: space-between;
    flex-wrap: wrap;
    select::-ms-expand {display:none}
    height: 27.813vw;

    @include mobile {
      height: 131.667vw;
    }

    input,
    select,
    div {
      color: #595757;
      font-weight: 300;
      font-size: 1.006vw;
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

    > div {
      background: white;
      width: 22.135vw;
      border: none;
      padding: 0;

      @include mobile {
        width: 100%;
      }
    }
    > span {
      display: block;
      position: relative;

      @include mobile {
        width: 50%;
      }

      .redAsterisk {
        position: absolute;
        left: 4.3vw;
        top: 0.45vw;

        @include mobile {
          top: 0.7vw;
          left: 15vw;
        }
      }

      & > select {
        background: #ededee;
        color: #001845;
        line-height: 1.73;
        cursor: pointer;
        width: 22.135vw;
        height: 2.083vw;
        border: 0;
        border-bottom: 0.052vw solid black;
        appearance: none;
        background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/1vw;

        @include mobile {
          width: 100%;
          height: 7.5vw;
          line-height: 7.361vw;
          background: url("../assets/images/select-arrow.png") no-repeat 96% 50%/3vw;
        }
      }
    }

    select {
      cursor: pointer;
    }

    &::v-deep {
      label {
        width: 100%;
        height: 100%;
        top: 0.383vw;
        background: transparent;
        color: #595757;
      }

      > div input {
        padding-left: 0.677vw;
        width: 21.458vw;
        height: 100%;
        @include mobile {
          width: 78.611vw;
          padding-left: 2.5vw;
        }
      }
    }

    .miniWrap {
      display: inline-flex;
      justify-content: space-between;
      padding: 0;
      background: #ededee;
      
      div {
        background-color: white;
        select.mini {
          padding: 0 1.398vw 0 0.3vw;
          appearance: none;
          background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/1vw;

          @include mobile {
            padding-right: 5vw;
            background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/3vw;
          }    
        }
      }

      .mini::v-deep {
        display: inline-block;
        background: white;
        border: 0;
        padding: 0;
        width: 10.781vw;

        input[type="text"] {
          width: 100%;
          height: 100%;
          width: 10.104vw;
        }

        label {
          width: 10.104vw;
          letter-spacing: -0.09vw;
        }

        @include mobile {
          width: 39.722vw;

          label {
            width: 37.5vw;
          }
        }
      }
    }

    .dateWrap {
      padding-left: 0.677vw;

      @include mobile {
        padding-left: 2.222vw;
      }

      > select {
        direction: rtl;
        padding-right: 1.398vw;
        appearance: none;
        background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/1vw;

        @include mobile {
          padding-right: 5vw;
          background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/3vw;
        }
      }

      #year {
        width: 5.292vw;
        margin-left: 1vw;
        @include mobile {
          width: 28.778vw;
        }
      }

      #month,
      #day {
        width: 4.879vw;
        margin-left: 1vw;
        @include mobile {
          width: 18.781vw;
        }
      }
    }

    .timeWrap {
      padding-left: 0.677vw;

      @include mobile {
        padding-left: 2.222vw;
      }

      > select {
        direction: rtl;
        padding-right: 1.398vw;
        appearance: none;
        background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/1vw;

        @include mobile {
          padding-right: 5vw;
          background: url("../assets/images/select-arrow.png") no-repeat 97% 50%/3vw;
        }
      }

      #hour {
        width: 7.171vw;
        margin-left: 5vw;
        @include mobile {
          width: 24.818vw;
        }
      }

      #min {
        width: 4.879vw;
        margin-left: 1vw;
        @include mobile {
          width: 38.53vw;
        }
      }
    }

    .large {
      color: #797777;
      line-height: 1.73;
      font-weight: 300;
      font-size: 1.006vw;
      width: 100%;
      height: 4.896vw;
      padding: 0;
      border: 0;
      padding: 0.521vw 0 0 0.677vw;
      resize: none;

      &::placeholder {
        font-family: "Noto Sans KR", sans-serif;
      }

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
    font-family: "Noto Sans KR", sans-serif;
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
        top: 0.22vw;
        right: 17.5vw;
        border: 0;
        border-radius: 50%;
        background: white;
        cursor: pointer;

        @include mobile {
          width: 4.167vw;
          height: 4.167vw;
          top: 0.563vw;
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

      &:hover + label {
        background: #a4a4a4;
        img {
          filter: brightness(1);
        }
      }

      &:checked + label {
        background: #001845;
        img {
          filter: brightness(1);
        }
      }
    }

    .privacyButton {
      display: inline-block;
      border-radius: 0.755vw;
      border: 0.052vw solid #001845;
      padding: 0 0.677vw;
      margin-left: 0.3vw;
      font-size: 0.99vw;
      line-height: 1.667vw;
      cursor: pointer;

      @include mobile {
        border-radius: 2.278vw;
        border-width: 0.278vw;
        font-size: 2.917vw;
        line-height: 1;
        padding: 0.833vw 2.222vw 0.833vw 1.667vw;
      }

      &:hover {
        background: #a4a4a4;
        color: white;
      }
    }
  }

  .consultButton {
    width: 9.531vw;
    height: 2.656vw;
    margin: 3.906vw 0 0 18.125vw;
    padding: 0;
    border: 0;
    border-radius: 1.302vw;
    background-color: #001845;
    color: white;
    font-weight: 500; 
    font-size: 1.302vw;
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

.consultModal {
  p {
    font-size: 1.146vw;
    line-height: 1.5;
    color: #001845;
    text-align: center;

    @include mobile {
      font-size: 3.472vw;
      line-height: 1.68;
    }
  }

  button {
    margin: 0 15.182vw 1.615vw;
    border: 0;
    border-radius: 0.859vw;
    font-size: 1.146vw;
    font-weight: 500;
    line-height: 1.875vw;
    padding: 0 1.38vw;
    background: #001845;
    color: white;
    cursor: pointer;

    @include mobile {
      margin: 0 0 4.444vw 34.722vw;
      width: 13.333vw;
      font-size: 3.472vw;
      line-height: 5.278vw;
      border-radius: 2.139vw;
    }
  }
}

.redAsterisk {
  color: red;
  &InSelect {
    position: absolute;
  }
}

.privacyModal {
  color: #001845;

  &::v-deep {
    .modal-window {
      border-radius: 1.042vw;

      @include mobile {
        border-radius: 2.778vw;
      }

      button {
        display: none;
      }

      .modal-content {
        position: relative;
        padding: 3.75vw 3.021vw 3.281vw 3.177vw;
        width: 45.833vw;

        @include mobile {
          width: 82.222vw;
          padding: 8.056vw 6.111vw 7.222vw 6.111vw;
        }
      }
    }
  }

  h2 {
    font-size: 1.719vw;
    font-weight: 500;
    line-height: 1;
    padding-bottom: 1.875vw;
    border-bottom: #001845 solid 0.104vw;

    @include mobile {
      font-size: 4.583vw;
      font-weight: normal;
    }
  }

  p {
    padding-top: 1.458vw;
    text-align: justify;
    word-break: keep-all;
    font-size: 0.99vw;
    line-height: 1.74;
    letter-spacing: -0.032vw;

    @include mobile {
      font-size: 2.778vw;
      line-height: 1.7;
      letter-spacing: -0.025vw;
    }

    .bold {
      font-weight: bold;
    }
  }
  img {
    position: absolute;
    top: 3.854vw;
    right: 3.229vw;

    @include mobile {
      width: 4.444vw;
      top: 8.056vw;
      right: 6.111vw;
    }
  }
}

.button-go-top {
  position: fixed;
  width: 3.385vw;
  bottom: 23.281vw;
  right: 14.299vw;
  transition: opacity 0.5s;
  opacity: 0;
  cursor: pointer;

  @include mobile {
    width: 9.167vw;
    height: 7.222vw;
    bottom: 49.167vw;
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
