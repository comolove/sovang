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
        :speed="1000"
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
          <img :src="isMobile ? data.img.mobilePath : data.img.pcPath" />
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
          온 어르신들을 마주할 때 - 매해 이른 봄, 오랫동안
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
      <HomeContent title="소녀방앗간 명절선물<span class='additional'>(클릭 시 상세내용을 보실 수 있습니다.)</span>" data-aos="fade-up">
        <span>
          낭비없는 생산을 위해 해마다 준비하는 명절 선물의 품목과 종류가 다를 수
          있습니다 :)
        </span>
        <div class="flexWrap" v-if="!isMobile">
          <div v-for="(data, index) of holidayPresentData" :key="index" @click="openPopup(index)">
            <div>
              <img class="before" :src="data.thumbImg.pcPath" />
            </div>
            <p>{{data.title}}<br /><span>{{data.desc}}</span></p>
          </div>
        </div>
        <Carousel
          v-if="isMobile"
          class="present-carousel"
          :per-page="1"
          :mouseDrag="false"
          :autoplay="true"
          :speed="1000"
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
            <img :src="data.thumbImg.mobilePath" @click="openPopup(index)" />
            <p>{{data.title}}<br /><span>{{data.desc}}</span></p>
          </Slide>
        </Carousel>
        <PresentPopup
          v-for="(data, index) of holidayPresentData"
          :key="index"
          :class="'popup-' + index"
          v-show="holidayPresentModal[index]"
          :src="data.bodyImg.pcPath"
          @close="closePopup(index)"
          :isMobile="isMobile"
        >
          <template slot="title">
            <span>
              {{data.popupTitle}}
            </span>
          </template>
          <p v-html="data.body" />
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
          :speed="1000"
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
          개인정보 수집 및 이용에 동의 합니다.
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
  PresentProject,
  MainSlide,
  PresentItem
} from "@/utils";

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
  private mainSlideData: MainSlide[] = [];
  private projectData: PresentProject[] = [];
  private holidayPresentData: PresentItem[] = [];

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

    await this.LoadData();
  }

  async LoadData() {
    await this.LoadPresentProject();
    await this.LoadMainSlides();
    await this.LoadPrsentItems();
  }

  async LoadPresentProject() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentProjects.php");
      const projectList = data.data as PresentProject[];

      this.projectData = projectList;
    } catch (error) {
      console.log("명절선물 기획 프로젝트 로딩 실패");
      console.log(error);
    }
  }

  async LoadMainSlides() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentMainSlides.php");
      const mainSlide = data.data as MainSlide[];

      this.mainSlideData = mainSlide;
    } catch (error) {
      console.log("명절선물 기획 프로젝트 로딩 실패");
      console.log(error);
    }
  }

  async LoadPrsentItems() {
    try {
      const { data } = await AxiosHelper.GET("/getPresentItem.php");
      const presentItem = data.data as PresentItem[];

      this.holidayPresentData = presentItem;

      for (let i = 0; i < this.holidayPresentData.length; i++) {
        this.holidayPresentModal.push(false);
      }
    } catch (error) {
      console.log("명절선물 기획 프로젝트 로딩 실패");
      console.log(error);
    }
  }

  mounted() {
    // vue-carousel mounted시 첫 번째 요소가 활성화 클래스 태그가 안붙는 문제가 있음
    setTimeout(() => {
      const firstSlideOfMain = document.getElementById("main-carousel-slide-0");
      if (firstSlideOfMain) {
        firstSlideOfMain.classList.add("VueCarousel-slide-active");
      }
    }, 1000);

    setTimeout(() => {
      // 슬라이드가 바뀌어도 임의로 넣어준 active 클래스는 삭제가 안되서 n초후에 임의로 삭제
      const firstSlide = document.getElementById("main-carousel-slide-0");
      if (firstSlide) {
        firstSlide.classList.remove("VueCarousel-slide-active");
      }
    }, 5000);

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

    &::v-deep .additional {
      font-size: 0.99vw;
      padding-left: 0.781vw;
      @include mobile {
        font-size: 3.056vw;
        padding-left: 2.222vw;
      }
    }

    @include mobile {
      vmargin-bottom: 5.278vw;
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
              margin: 0.00001vw;
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
        border: 1px solid #001845;
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
      font-weight: 500;
      font-size: 1.302vw;
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
