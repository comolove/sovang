<template>
  <main ref="main">
    <Header />
    <section class="main img-slider" data-aos="fade-up">
      <Carousel
        class="main-carousel"
        :per-page="1"
        :mouseDrag="false"
        :autoplay="true"
        :autoplayTimeout="3000"
        :autoplayHoverPause="false"
        :loop="true"
        :paginationEnabled="false"
        :navigationEnabled="true"
        :navigationNextLabel="mainCarouselNavigationNext"
        :navigationPrevLabel="mainCarouselNavigationPrev"
        paginationPosition="bottom-overlay"
        paginationColor="white"
        paginationActiveColor="#595757"
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
    <section class="content-1">
      <HomeContent title="오지에서 온 선물" data-aos="fade-up">
        <AssetImage
          :src="
            'present-page/' +
              (isMobile ? 'Mobile' : 'Web') +
              '/backcountry-present.jpg'
          "
        />
        <div>
          소녀방앗간은 청정지역 어르신들과 함께 식재료를 어떻게 생산할지
          고민하며 한 해를 시작합니다.
          <br />
          <br />산 속에 핀 수많은 풀 중에 먹을 것을 골라내기 위해 수십년 산을 타
          온 어르신들을 마주할 때 - 매 해 이른 봄, 오랫동안
          <span
            class="wider-1"
          >이어온 옛 방식으로 발효음식의 전통을 빚어오는</span>
          장인분들을 마주할 때 - 매일의 순간이 모여 역사와 혜안을 만든다는 것을
          배웁니다.
          <br />
          <br />
          <span class="wider-2">
            모두가 매일의 순간을 사랑하는 한 해를 기원하며 소녀방앗간은 늘
            건강과 풍요를 위해 마음을 담아 준비합니다.
          </span>
        </div>
      </HomeContent>
    </section>
    <section class="content-2">
      <HomeContent title="소녀방앗간 명절선물" data-aos="fade-up">
        <span>
          낭비없는 생산을 위해 해마다 준비하는 명절 선물의 품목과 종류가 다를 수
          있습니다 :)
        </span>
        <div class="flexWrap" v-if="!isMobile">
          <div v-for="(data, index) of holidayPresentData" :key="index" @click="openPopup(index)">
            <div>
              <AssetImage class="before" :src="data.pcPath" />
            </div>
            <p v-html="data.info" />
          </div>
        </div>
        <Carousel
          v-if="isMobile"
          class="present-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :autoplayTimeout="3000"
          :autoplayHoverPause="false"
          :loop="true"
          :navigationEnabled="true"
          :paginationEnabled="false"
          :navigationNextLabel="mainCarouselNavigationNext"
          :navigationPrevLabel="mainCarouselNavigationPrev"
        >
          <Slide
            v-for="(data, index) of holidayPresentData"
            :key="index"
            :id="'main-carousel-slide-' + index"
          >
            <AssetImage :src="isMobile ? data.mobilePath : data.pcPath" @click="openPopup(index)" />
            <p v-html="data.info" />
          </Slide>
        </Carousel>
        <PresentPopup
          class="popup-1"
          v-show="holidayPresentModal[0]"
          src="present-page/Web/holiday-present/popup-img.jpg"
          @close="closePopup(0)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">
              오지의 장 - 소녀방앗간의 시그니처, 오랜시간 고숙성한
              ‘발효장’
            </span>
            <span v-if="isMobile">
              오지의 장
              <br />
              <span class="subTitle">
                소녀방앗간의 시그니처,
                <br />오랜시간 고숙성한 발효장
              </span>
            </span>
          </template>
          <span class="bold">재래식 된장</span>은 토종 메주콩을 가마솥에 삶아
          만든 메주를 구들방에 띄우는 전통 재래방식으로 만든 된장입니다.
          청정지역 청송에서 3년 이상 천일염에 발효시킨 귀한 재래식 된장은 훌륭한
          건강식품입니다.
          <br />
          <br />
          <span class="bold">찹쌀고추장</span>은 국산 고춧가루만을 사용하여
          인공조미료를 전혀 가미하지 않은 순도 100% 재래식 고추장입니다. 100일
          동안 항아리에 숙성시킨 찹쌀고추장은 달지 않고 깔끔하며 깊은 매운 맛을
          자랑합니다.
          <br />
          <br />
          <span class="bold">어수리장아찌</span>는 청정지역 청송에서 무농약
          재배한 어수리 나물을 간장에 저온숙성하여 어수리의 독특한 풍미가 그대로
          담긴 장아찌입니다. 어수리 나물은 임금님 수라상에 올렸을 만큼
          영양성분이 풍부하며, 건나물이 아닌 생나물로 바로 담근 장아찌라 그 향이
          더욱 깊습니다.
          <br />
          <br />
          <span class="bold">무우장아찌</span>는 무를 먹기 좋은 크기로 잘라
          간장에 담가 숙성시켰습니다. 새콤달콤하게 담근 무우장아찌를 참기름에
          버무려, 담백하고 아삭한 반찬으로 즐겨보셔요.
        </PresentPopup>
        <PresentPopup
          class="popup-2"
          v-show="holidayPresentModal[1]"
          src="present-page/Web/holiday-present/2-1.jpg"
          @close="closePopup(1)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">오지의 맛 - 재료 본연의 맛에 집중한 완벽한 장인의 맛</span>
            <span v-if="isMobile">
              오지의 맛
              <br />
              <span class="subTitle">
                재료 본연의 맛에 집중한
                <br />완벽한 장인의 맛
              </span>
            </span>
          </template>
          <span class="bold">재래식 간장</span>에는 50년 이상 장을 담궈 온 지역
          어르신들의 지혜와 정성이 깃들어 있습니다. 전통 항아리에서 충분히 볕을
          받고 자연 발효하여 영양과 감칠맛을 축적한 귀한 식재료입니다. 청정지역
          오지의 어르신들이, 국산 대두로 만든 메주에 천일염 간수로 발효시켜 직접
          만든 재래식 간장은 재료 본연의 풍미를 살리며 오지의 맛을 전합니다.
          <br />
          <br />
          <span class="bold">함초소금</span>은 미네랄의 보고, 바다의 산삼이라
          불리는 함초로 만든 유네스코 생물권보전지역의 귀한 소금입니다. 미네랄과
          각종 무기질이 풍부한 양질의 갯벌을 기반으로 한 우리나라 최고의 천일염
          생산지에서 유기농 함초와 한여름 최상품 천일염으로 만들었습니다. 그
          어떤 소금보다 건강하게, 바다의 정수를 느낄 수 있습니다.
        </PresentPopup>
        <PresentPopup
          class="popup-3"
          v-show="holidayPresentModal[2]"
          src="present-page/Web/holiday-present/3-1.jpg"
          @close="closePopup(2)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">
              오지의 향 - 국내산 참깨와 들깨를 저온착유한 전통기름과 직접 담은
              재래식 간장
            </span>
            <span v-if="isMobile">
              오지의 향
              <br />
              <span class="subTitle">
                국내산 참깨와 들깨를 저온착유한
                <br />전통기름과 직접 담은 재래식 간장
              </span>
            </span>
          </template>
          <span class="bold">소녀방앗간의 저온 착유기름</span>은 말린 참깨와
          들깨를 깨끗이 씻어, 타지 않도록 적정온도에서 볶아 유해물질의 생성을
          차단합니다. HACCP시설에서 살균하고 착유하여 유통과정에서 상하는 것을
          방지합니다. 청정지역 청송에서 수확한 참깨와 들깨를 50년 이상의 장인이
          가업을 이어 운영하는 곳에서 직접 짰습니다.
          <br />
          <br />참기름에는 불포화지방산이 많아 콜레스테롤의 생성을 억제해
          동맥경화 예방에 좋고, 치즈의 2배, 우유의 11배가 넘는 칼슘을 포함하고
          있는 참깨는 뼈를 더욱 튼튼하게 합니다. 들기름은 뇌의 신경기능을
          촉진하여 성장기 두뇌발달과 노인의 치매예방에 탁월합니다.
          <br />
          <br />
          <span class="bold">재래식 간장</span>에는 50년 이상 장을 담구어 온
          나주 어르신들의 지혜와 정성이 깃들어 있습니다. 전통 항아리에서 충분히
          볕을 받고 자연 발효하여 영양과 감칠맛을 축적한 귀한 식재료입니다.
        </PresentPopup>
        <PresentPopup
          class="popup-4"
          v-show="holidayPresentModal[3]"
          src="present-page/Web/holiday-present/4-1.jpg"
          @close="closePopup(3)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">오지의 부각 - 귀한 손님 상에 올라온 한식별미, 찹쌀부각</span>
            <span v-if="isMobile">
              오지의 부각
              <br />
              <span class="subTitle">
                귀한 손님 상에 올라온
                <br />한식별미, 찹쌀부각
              </span>
            </span>
          </template>
          국내산 찹쌀로 만든 찹쌀풀을 켜켜이 수작업으로 발라 만든 100% 국내산
          찹쌀부각입니다. 기계로 찹쌀풀을 바르면 두껍게 뭉쳐 재료 본연의 맛을
          전하기 어려워 한여름에도 일일이 수작업으로 찹쌀풀을 정성껏 발라
          만들었습니다. 깨끗한 기름으로 튀기기 위하여, 한정 수량만을 생산하는
          고집스러운 장인의 솜씨를 느껴보셔요.
          <br />
          <br />소녀방앗간에서는 재래식 간장과 유자청을 곁들여 손님들께
          준비하고, 항상 품절이 되는 인기반찬입니다. 이제 집에서도 아이와 함께,
          가족과 함께 건강 간식과 별찬으로 찹쌀부각을 즐겨보셔요.
        </PresentPopup>
        <PresentPopup
          class="popup-5"
          v-show="holidayPresentModal[4]"
          src="present-page/Web/holiday-present/5-1.jpg"
          @close="closePopup(4)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">오지의 약밥 - 집에서 간편하게 만들어 먹는 찰약밥과 영양밥</span>
            <span v-if="isMobile">
              오지의 약밥
              <br />
              <span class="subTitle">
                집에서 간편하게 만들어 먹는
                <br />찰약밥과 영양밥
              </span>
            </span>
          </template>
          찰약밥은 밥 중에 가장 약이 되어 약밥이라 불렸다는 옛이야기가 전해지는,
          정월대보름에 먹는 절식 중 하나입니다. 큰 잔치에서 주로 만들어 예부터
          귀한 손님들께 대접해왔습니다. 간장과 꽃당으로 짭조름하며 건강한 단맛을
          내어 남녀노소 사랑받는 영양간식이지요.
          <br />
          <br />영양밥은 다채로운 재료를 함께 먹을 수 있는 영양 가득한 오색미
          영양 오곡밥입니다. 영양밥의 오색은 기장, 녹미, 적미, 흑미, 찹쌀로
          구성되며 그외 건연근, 건더덕, 건가지, 호박오가리 4종의 건재료를 넣어
          더욱 건강합니다. 정량으로 소포장 되어있어 요리할 때에도 한층 더
          편리합니다:)
        </PresentPopup>
        <PresentPopup
          class="popup-6"
          v-show="holidayPresentModal[5]"
          src="present-page/Web/holiday-present/6-1.jpg"
          @close="closePopup(5)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span v-if="!isMobile">오지의 떡국 - 새해엔 떡국 한 그릇</span>
            <span v-if="isMobile">
              오지의 떡국
              <br />
              <span class="subTitle">새해엔 떡국 한 그릇</span>
            </span>
          </template>
          무색소, 무방부제, 무첨가물, 무보존료의 HACCP 관리 하에 바로 도정한
          깨끗하고 건강한 떡국떡으로 만들어, 새해 가족과 함께 건강하게 드실 수
          있도록 준비한 떡국 선물세트입니다.
          <br />
          <br />현미떡국떡은 현미, 정제염, 정세주 외에 아무것도 들어가지 않은
          직접 도정한 신선한 현미로 담은 순수 떡국떡, 오색떡국떡은 신선한 햅쌀에
          국내산 천연재료로 오색(흑미, 단호박, 백년초, 쑥)을 더했습니다.
          <br />
          <br />소녀방앗간 재래식 간장과 남해안의 고급 국물용 햇멸치와 진도의
          홍새우, 완도의 다시마가 담긴 맛국물팩으로 요리에 감칠맛을 더할 수
          있습니다.
        </PresentPopup>
      </HomeContent>
    </section>
    <section class="content-3">
      <span data-aos="fade-up">지역동행 청정재료 선물기획</span>
      <p data-aos="fade-up">
        산지직송 청정재료로 만드는 "고객 맞춤형" 선물세트를
        <br v-if="isMobile" />기획부터 구성,
        <span v-if="isMobile"> 그리고</span> 포장까지 전 과정을 진행합니다.
        <br />귀한 손님에게 귀사만의 브랜드 아이덴티티를 온전하게
        <br v-if="isMobile" />담은 특별한 청정재료 선물보따리를 전하셔요 :)
      </p>
      <AssetImage
        data-aos="fade-up"
        :src="
          'present-page/' + (isMobile ? 'Mobile' : 'Web') + '/presentAI.png'
        "
      />
    </section>
    <section class="content-4">
      <HomeContent title="명절선물 기획 프로젝트" data-aos="fade-up">
        <span>맞춤형 선물세트의 최소 제작 수량은 500개부터 가능합니다 :)</span>
        <Carousel
          ref="projectCarousel"
          class="projectCarousel"
          :per-page="carouselPerPage"
          :scrollPerPage="false"
          :autoplayTimeout="4000"
          :paginationEnabled="false"
          :navigationEnabled="true"
          :navigationNextLabel="projectCarouselNavigationNext"
          :navigationPrevLabel="projectCarouselNavigationPrev"
          :autoplay="true"
          :loop="true"
          :spacePadding="-12.5"
        >
          <Slide
            v-for="(data, index) of projectData"
            :key="index"
            :data-index="index"
            data-name="DataName"
          >
            <div>
              <img
                :src="
                  isMobile ? data.frontImg.mobilePath : data.frontImg.pcPath
                "
              />
              <img v-if="!isMobile" class="after" :src="data.backImg.pcPath" />
              <span>
                {{ data.title }}
                <br />
                <span>{{ data.desc }}</span>
              </span>
            </div>
          </Slide>
        </Carousel>
      </HomeContent>
    </section>
    <section class="content-5">
      <div data-aos="fade-up">
        감사한 분들께 건강한 재료로 정성을 선물하고 싶다면
        <br />소녀방앗간과 함께 고민해보셔요 :)
      </div>
      <form name="consulting" data-aos="fade-up">
        <div class="flexWrap">
          <InputText ref="input-group" placeholder="단체명" name="groupName" :isRequired="false" />
          <InputText ref="input-manager" placeholder="담당자" name="manager" :isRequired="true" />
          <InputText ref="input-contact" placeholder="연락처" name="contact" :isRequired="true" />
          <InputText ref="input-email" placeholder="이메일" name="groupName" :isRequired="false" />
          <TextareaWithRedAsterisk
            ref="input-question"
            v-if="!isMobile"
            name="question-pc"
            placeholder="문의내용<span style='color:red'>*</span>
            <br />식재료, 수량, 예산 등 구체적인 내용으로
            <br />문의해주시면 빠른 상담이 가능합니다 :)
            "
          />
          <textarea
            v-if="isMobile"
            placeholder="문의내용 : 식재료, 수량, 예산 등 구체적인 내용으로
문의해주시면 빠른 상담이 가능합니다 :)"
          />
        </div>
        <span>
          <span style="color:red">*</span> 별표 표시 항목은 필수 입력사항입니다.
        </span>
        <div class="privacyCondition">
          <input ref="privacyCheckbox" type="checkbox" id="privacy" @click="privacyAgree" />
          <label for="privacy">
            <AssetImage src="catering-page/privacy.png" />
          </label>
          개인정보 수집 및 이용 동의
          <div @click="openPrivacyModal">내용 보기</div>
        </div>
        <input type="button" value="상담 예약" @click="handleClickConsult" />
      </form>
    </section>
    <Modal v-if="consultModal" class="consultModal">
      <p v-show="isEmpty">붉은색 별표 표시된 항목은 필수 입력사항입니다 :)</p>
      <p v-show="!isEmpty && !isChecked">개인정보 동의는 필수입니다 :)</p>
      <p v-show="!isEmpty && isChecked">
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
        <img src="@/assets/images/icon-close-darkblue.png" @click="closePrivacyModal" />
      </h2>
      <p>
        <span class="bold">[개인정보 수집 및 이용 동의 ]</span> 주식회사
        방앗간컴퍼니는 개인정보 보호를 최우선의 가치로 삼으며 개인정보 보호와
        관련한 국내외 모든 법령을 성실히 준수합니다. 주식회사 방앗간컴퍼니는
        명절선물 상담 예약을 위하여, 아래와 같이 개인정보를 수집 및 이용합니다.
        내용을 상세히 확인하신 후 동의 여부를 결정하여 주시기 바랍니다.
        <br />
        <br />
        <span class="bold">1. 개인정보의 수집 및 이용 목적</span>
        <br />명절선물 상담
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
        <span class="bold">4. 동의를 거부할 권리 및 동의 거부에 따른 불이익</span>
        <br />서비스 제공을 위하여 기본 정보를 수집하고 있으며, 동의 거부시 상담
        예약이 제한될 수 있습니다.
        <br />
        <br />
        <span class="bold">
          본인은 [개인정보 수집 및 이용에 관한 동의]를 잘 읽어 보았으며,
          개인정보수집 및 이용에 동의 합니다.
        </span>
      </p>
    </Modal>
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
import axios from "axios";
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
import {
  AxiosHelper,
  screenSize,
  ImgPath,
  PresentConsult,
  PresentProject
} from "@/utils";

class DoubleImgPath extends ImgPath {
  public pcPathAfter = "";
  public tabletPathAfter = "";
  public mobilePathAfter = "";
  public info = "";
}

@Component({
  name: "Present",
  components: {
    Header,
    Footer,
    Carousel,
    Slide,
    HomeContent,
    AssetImage,
    Modal,
    InputText,
    TextareaWithRedAsterisk,
    PresentPopup
  }
})
export default class Present extends Vue {
  private mainSlideData: ImgPath[] = [];
  private projectData: PresentProject[] = [];
  private holidayPresentData: DoubleImgPath[] = [];

  private carouselPerPage = 1;
  private curIndex = 0;

  private isMobile = false;
  private isVisible = false;
  private isChecked = false;
  private consultModal = false;
  private privacyModal = false;
  private holidayPresentModal: boolean[] = [];

  async created() {
    window.addEventListener("resize", this.handleResize);
    window.addEventListener("scroll", this.handleScroll);

    for (let i = 0; i < 6; i++) {
      this.holidayPresentModal.push(false);
    }

    for (let i = 1; i <= 2; i++) {
      this.mainSlideData.push({
        index: -1,
        name: "",
        pcPath: `present-page/Web/main/${i}.jpg`,
        tabletPath: "",
        mobilePath: `present-page/Mobile/main/${i}.jpg`
      });
    }

    const presentInfo = [
      `오지의 장
      <br />
      <span>#재래식된장, 재래식찹쌀고추장, 어수리장아찌, 무장아찌</span>
      `,
      `오지의 맛
      <br />
      <span>#재래식간장, 함초소금, 취나물분말</span>
      `,
      `오지의 향
      <br />
      <span>#전통참기름, 전통들기름, 재래식간장</span>
      `,
      `오지의 부각
      <br />
      <span>#찹쌀김부각, 다시마부각, 고추부각</span>
      `,
      `오지의 약밥
      <br />
      <span>#영양밥, 찰약밥, 건재료 8종, 재래식간장, 전통들기름</span>
      `,
      `오지의 떡국
      <br />
      <span>#현미/오색떡국떡, 재래식간장, 호박오가리, 맛국물팩</span>
      `
    ];
    for (let i = 1; i <= 6; i++) {
      this.holidayPresentData.push({
        index: -1,
        name: "",
        pcPath: `present-page/Web/holiday-present/${i}-1.jpg`,
        tabletPath: "",
        mobilePath: `present-page/Mobile/holiday-present/${i}.jpg`,
        pcPathAfter: `present-page/Web/holiday-present/${i}-2.jpg`,
        tabletPathAfter: "",
        mobilePathAfter: "",
        info: presentInfo[i - 1]
      });
    }

    await this.LoadPresentProject();
  }

  async LoadPresentProject() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentProjects.php");
      const list = data.data as PresentProject[];

      this.projectData = list;
    } catch (error) {
      console.log("명절선물 기획 프로젝트 로딩 실패");
      console.log(error);
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
  }

  destroyed() {
    window.removeEventListener("resize", this.handleResize);
    window.removeEventListener("scroll", this.handleScroll);
  }

  openPopup(index: number) {
    Vue.set(this.holidayPresentModal, index, true);
  }

  closePopup(index: number) {
    Vue.set(this.holidayPresentModal, index, false);
  }

  handleResize(/* e : Event */) {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;

    this.responseComponents();
  }

  handleCarouselChange(index: number) {
    this.curIndex = index;
  }

  handleScroll(/* e : Evuent */) {
    if (
      window.scrollY >
      ((this.$refs.main as HTMLElement).clientHeight as number) -
        window.innerHeight +
        window.innerWidth * (this.isMobile ? 0.06389 : 0.07849) -
        5
    )
      this.isVisible = true;
    else this.isVisible = false;
  }

  goTop() {
    window.scroll({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
  }

  responseComponents() {
    if (this.isMobile) {
      this.carouselPerPage = 1;
    } else {
      this.carouselPerPage = 3;
    }
  }

  privacyAgree() {
    this.isChecked = (this.$refs.privacyCheckbox as HTMLInputElement).checked
      ? true
      : false;
  }

  async handleClickConsult() {
    if (!this.isChecked) {
      this.consultModal = true;
      return;
    }

    if (this.isEmpty) {
      this.consultModal = true;
      return;
    }

    const consult = new PresentConsult();
    consult.organization = this.organization;
    consult.personInCharge = this.personInCharge;
    consult.hp = this.hp;
    consult.email = this.email;
    consult.question = this.question;

    console.log(consult);

    try {
      await AxiosHelper.POST("/insertPresentConsult.php", { ...consult });
      this.consultModal = true;
    }
    catch(error) {
      alert("실패");
      console.log(error);
    }
  }

  closeConsultModal() {
    this.consultModal = false;
  }

  openPrivacyModal() {
    this.privacyModal = true;
  }

  closePrivacyModal() {
    this.privacyModal = false;
  }

  get organization(): string {
    const organization = this.$refs["input-group"] as InputText;

    return organization.value;
  }

  get personInCharge(): string {
    const personInCharge = this.$refs["input-manager"] as InputText;

    return personInCharge.value;
  }

  get hp(): string {
    const hp = this.$refs["input-contact"] as InputText;

    return hp.value;
  }

  get email(): string {
    const email = this.$refs["input-email"] as InputText;

    return email.value;
  }

  get question(): string {
    const question = this.$refs["input-question"] as TextareaWithRedAsterisk;

    return question.value;
  }

  get isEmpty(): boolean {
    const question = this.$refs["input-question"] as TextareaWithRedAsterisk;
    const contact = this.$refs["input-contact"] as InputText;
    const manager = this.$refs["input-manager"] as InputText;

    if (question.isEmpty || contact.isEmpty || manager.isEmpty) {
      return true;
    }

    return false;
  }

  public get mainCarouselNavigationNext(): string {
    return `<img 
              src=${require("@/assets/images/arrow-right-gray.png")}
            >`;
  }

  public get mainCarouselNavigationPrev(): string {
    return `<img 
              src=${require("@/assets/images/arrow-left-gray.png")} 
            >`;
  }

  public get projectCarouselNavigationNext(): string {
    return `<img
              src=${require("@/assets/images/arrow-right-black.png")} 
            >`;
  }

  public get projectCarouselNavigationPrev(): string {
    return `<img
              src=${require("@/assets/images/arrow-left-black.png")} 
            >`;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin-left: 14.323vw;
  width: 71.354vw;

  @include mobile {
    margin-left: 9.167vw;
    width: 81.667vw;
  }
}

@mixin RightAlignPagination($bottom) {
  .VueCarousel-pagination {
    position: absolute;
    display: block;
    right: 0;
    bottom: $bottom;
    width: auto !important;
    height: 10vw;
    background-color: white !important;

    .VueCarousel-dot-container {
      margin-top: 0 !important;

      .VueCarousel-dot {
        margin-top: 0 !important;
        width: 1.944vw !important;
        height: 1.944vw !important;
        padding: 0.667vw !important;
      }
    }
  }
}

.img-slider {
  width: 100%;
  margin-bottom: 9.688vw;

  @include mobile {
    margin-bottom: 23.056vw;
  }

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
          height: 147.778vw;
        }

        img {
          position: absolute;
          width: 100%;

          @include mobile {
            height: 147.778vw;
          }

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
}

.content-1 {
  position: relative;
  margin-bottom: 10.99vw;

  @include mobile {
    margin-bottom: 22.778vw;
  }

  img {
    position: absolute;
    display: inline-block;
    left: -14.323vw;
    width: 55.885vw;
    height: 26.719vw;

    @include mobile {
      position: relative;
      left: 0;
      width: 100%;
      height: 54.167vw;
    }
  }

  div {
    display: inline-block;
    width: 24.375vw;
    margin: 0.625vw 0 0.104vw 46.875vw;
    color: #595757;
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.91;
    text-align: justify;
    word-break: keep-all;

    @include mobile {
      width: 100%;
      font-size: 3.611vw;
      line-height: 1.62;
      margin: 5vw 0 0 0;
      letter-spacing: -0.1vw;

      .wider-1 {
        letter-spacing: 0.3vw;
      }

      .wider-2 {
        letter-spacing: 0.3vw;
      }
    }
  }
}

.content-2 {
  article {
    margin-bottom: 7.917vw;

    @include mobile {
      margin-bottom: 5.278vw;
    }

    > span {
      position: absolute;
      right: 0;
      top: 0.208vw;
      font-size: 0.885vw;
      font-weight: 300;
      color: #b1b1b1;

      @include mobile {
        left: 0;
        top: 80.222vw;
        font-size: 2.36vw;
        padding-top: 1.389vw;
        color: #797979;
      }
    }

    .flexWrap {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

      > div {
        display: inline-block;
        width: 22.917vw;
        height: 21.875vw;
        position: relative;

        > div {
          position: absolute;
          display: inline-block;
          overflow: hidden;
          width: 22.917vw;
          height: 15.677vw;
          img {
            position: absolute;
            cursor: pointer;

            &.before {
              transition: 0.6s all ease;
              width: 22.917vw;
              height: 15.677vw;
              margin: 0;
            }

            &:hover.before {
              width: 24.917vw;
              height: 17.677vw;
              margin: -1vw 0 0 -1vw;
            }
          }
        }

        p {
          margin-top: 16.653vw;
          font-size: 0.99vw;
          font-weight: 500;
          line-height: 1.53;
          color: #595757;

          &::v-deep span {
            color: #797777;
            font-weight: 300;
            letter-spacing: -0.02vw;
          }
        }
      }
    }

    .present-carousel {
      &::v-deep {
        .VueCarousel-slide {
          width: 81.667vw;
          height: 91.667vw;

          > img {
            width: 100%;
          }

          > p {
            margin-top: 2.5vw;
            font-size: 3.611vw;
            line-height: 5vw;
            color: #595757;

            > span {
              font-size: 3.056vw;
            }
          }
        }

        .VueCarousel-navigation-prev {
          transform: unset;
          left: 3.229vw;
          top: 17.708vw;

          img {
            width: 1.458vw;
          }

          @include mobile {
            left: 2.6vw;
            top: 21%;

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
            right: 2.6vw;
            top: 21%;

            img {
              width: 3.889vw;
            }
          }
        }

        @include mobile {
          @include RightAlignPagination(-4.856vw);
        }
      }
    }
  }
}

.content-3 {
  background: #ededee;
  > span {
    display: block;
    padding: 8.281vw 0 5.729vw;
    font-size: 1.719vw;
    font-weight: 500;
    color: #001845;
    text-align: center;

    @include mobile {
      padding: 26.389vw 0 13.611vw;
      font-size: 4.722vw;
    }
  }

  > p {
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.91;
    color: #595757;
    text-align: center;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
    }
  }

  img {
    margin: 5.208vw 0 6.615vw 21.979vw;
    width: 56.042vw;

    @include mobile {
      margin: 13.056vw 0 25vw 8.75vw;
      width: 81.667vw;
    }
  }
}

.content-4 {
  padding: 8.802vw 0 10.521vw;

  @include mobile {
    padding: 20.833vw 0 3.056vw 0;
  }

  article {
    > span {
      position: absolute;
      right: 0;
      top: 0.208vw;
      font-size: 0.885vw;
      font-weight: 300;
      color: #b1b1b1;

      @include mobile {
        left: 0;
        top: 80.5vw;
        font-size: 2.36vw;
        color: #797979;
      }
    }
  }

  .projectCarousel {
    // 매장 이미지들의 사이 간격
    .VueCarousel-slide {
      width: 22.917vw;

      @include mobile {
        width: 81.667vw;
      }

      & > div {
        width: 22.917vw;
        position: relative;

        @include mobile {
          width: 81.667vw;
          height: 94.444vw;
        }

        img {
          width: 22.917vw;
          position: absolute;

          &.after {
            transition: 1s opacity;
            opacity: 0;
          }

          &:hover.after {
            opacity: 1;
          }

          @include mobile {
            width: 81.667vw;
          }
        }

        > span {
          display: inline-block;
          margin-top: 15.872vw;
          font-size: 0.964vw;
          font-weight: 300;
          line-height: 1.57;
          color: #595757;

          @include mobile {
            margin-top: 56.667vw;
            font-size: 3.611vw;
            line-height: 5.833vw;
          }

          &::v-deep > span {
            color: #797777;

            @include mobile {
              color: #595757;
              font-size: 2.778vw;
            }
          }
        }
      }
    }

    &::v-deep {
      .VueCarousel-pagination {
        display: none;

        @include mobile {
          padding-top: 0.8vw;
        }
      }

      .VueCarousel-navigation-prev {
        transform: unset;
        left: -3.75vw;
        top: 6.354vw;

        img {
          width: 1.042vw;
        }

        @include mobile {
          left: 2.6vw;
          top: 21%;

          img {
            width: 3.889vw;
          }
        }
      }

      .VueCarousel-navigation-next {
        transform: unset;
        right: -3.75vw;
        top: 6.354vw;

        img {
          width: 1.042vw;
        }

        @include mobile {
          right: 2.6vw;
          top: 21%;

          img {
            width: 3.889vw;
          }
        }
      }

      @include mobile {
        @include RightAlignPagination(-4.856vw);
      }
    }
  }
}

.content-5 {
  background: url("../assets/images/present-page/Web/background.jpg") no-repeat
    center/cover;

  @include mobile {
    background: url("../assets/images/present-page/Mobile/background.jpg")
      no-repeat center/cover;
  }

  > div {
    padding: 9.948vw 0 4.531vw;
    color: #001845;
    font-size: 1.146vw;
    font-weight: 500;
    line-height: 1.667vw;
    text-align: center;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
      padding: 23.333vw 0 19.167vw;
    }
  }

  form {
    position: relative;
    .flexWrap {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      justify-content: space-between;
      width: 45.833vw;
      height: 13.616vw;
      margin-left: 27.083vw;

      @include mobile {
        width: 81.667vw;
        height: 68.611vw;
        margin-left: 9.167vw;
      }

      &::v-deep {
        input,
        textarea {
          font-size: 1.146vw;
          font-family: Noto Sans KR;
          font-weight: 300;
          line-height: 1.73;

          @include mobile {
            font-size: 3.611vw;
            line-height: 1.62;
          }
        }

        input {
          width: 21.458vw;
          height: 2.604vw;
          padding-left: 0.677vw;
          border: 0;
          color: #595757;

          @include mobile {
            width: 79.167vw;
            height: 9.167vw;
            padding-left: 2.222vw;
            color: #797777;
          }
        }

        textarea {
          width: 20.259vw;
          height: 12.574vw;
          border: 0;
          padding: 0.729vw 0.729vw 0.313vw 0.938vw;
          color: #797979;
          resize: none;

          @include mobile {
            width: 75vw;
            height: 18.333vw;
            padding: 2.778vw 4.444vw 0 2.222vw;
            margin-top: 4.722vw;
          }
        }
      }
    }

    > span {
      position: absolute;
      font-size: 0.99vw;
      left: 27.708vw;
      top: 14.792vw;
      color: #797777;

      @include mobile {
        display: none;
      }
    }

    .privacyCondition {
      margin: 0.69vw 27.839vw 0;
      position: relative;
      text-align: right;
      font-size: 0.99vw;
      line-height: 1.615vw;

      @include mobile {
        margin: 3.889vw 8.611vw 0;
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
            top: 0.25vw;
            right: 50.689vw;
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
              right: 1.02vw;
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

      div {
        display: inline-block;
        border-radius: 0.755vw;
        border: 0.052vw solid #001845;
        padding: 0 0.703vw;
        margin-left: 0.521vw;
        cursor: pointer;

        @include mobile {
          border-radius: 2.278vw;
          border-width: 0.278vw;
          padding: 0.333vw 1.2vw;
          margin-left: 2vw;
        }

        &:hover {
          background: #a4a4a4;
          color: white;
        }
      }
    }

    input[type="button"] {
      width: 9.531vw;
      height: 2.656vw;
      margin: 4.479vw 0 10.521vw 45.208vw;
      padding: 0;
      border: 0;
      border-radius: 1.302vw;
      background-color: #001845;
      color: white;
      font: 500 1.302vw NotoSansCJKr;
      cursor: pointer;

      @include mobile {
        margin: 11.111vw 0 24.167vw 36.111vw;
        width: 28.056vw;
        height: 8.056vw;
        border-radius: 3.861vw;
        font-size: 3.889vw;
      }
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

.subTitle {
  display: inline-block;
  font-size: 3.472vw;
  padding-top: 0.694vw;
}

.bold {
  font-weight: bold;
}

.footer {
  background: white;
}
</style>
