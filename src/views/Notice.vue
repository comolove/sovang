<template>
  <main>
    <Header />
    <HomeContent title="알립니다">
      <div class="title">
        {{title}}
      </div>
      <div class="content" v-html="content"></div>
      <div class="written-by">
        <span class="author">{{author}}</span>
        <span class="date">{{createdAt}}</span>
      </div>
      <div class="goList">
        <a @click="goBack">목록</a>
      </div>
    </HomeContent>
    <Footer />
  </main>
</template>

<script lang="ts">
import { Component, Vue, Prop } from "vue-property-decorator";
import { Header, Footer, HomeContent } from "@/components";
import { screenSize } from "@/utils";

@Component({
  name: "Notice",
  components: {
    Header,
    Footer,
    HomeContent
  }
})
export default class Notice extends Vue {

  private title = "";
  private content = "";
  private author = "";
  private createdAt = "";

  private isMobile = false;

  created() {
    this.title = this.$route.params.title;
    this.content = this.$route.params.content;
    this.author = this.$route.params.author;
    this.createdAt = this.$route.params.createdAt;
  }

  mounted() {
    this.isMobile = screenSize.tablet > window.innerWidth ? true : false;
  }

  goBack() {
    window.history.back();
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

article {
  margin: 0 0 0 14.323vw;
  width: 71.354vw; 
  padding: 4.688vw 0 3.906vw 0;

  @include mobile {
    margin: 12.5vw 0 17.222vw 8.889vw;
    width: 81.944vw;
    padding: 0;
  }

  div {
    background: #f3f0ed;
    color: #595757;
    font-size: 1.146vw;
    font-weight: 300;
    line-height: 1.5;
    text-align: center;

    @include mobile {
      font-size: 3.333vw;
      line-height: 1.42;
    }

    &.title {
      font-weight: 500;
      padding: 1.302vw 0 1.146vw;
      border-top: 1px solid #a19b95;
      border-bottom: 1px solid #a19b95;

      @include mobile {
        padding: 3.194vw 0; 
      }
    }

    &.content {
      padding: 3.75vw 0 3.281vw;

      @include mobile {
        text-align: justify;
        word-break: keep-all;
        padding: 9.028vw 2.917vw 8.75vw 2.917vw;
      }
    }

    &.written-by {
      padding: 1.302vw 0;
      border-top: 1px solid #a19b95;
      border-bottom: 1px solid #a19b95;
      text-align: right;

      @include mobile {
        padding: 3.611vw 0;
        font-size: 2.778vw;
      }

      .author {
        padding-right: 1.667vw;
        
        @include mobile {
          padding-right: 3.333vw;
        }
      }

      .date {
        padding-right: 1.458vw;

        @include mobile {
          padding-right: 1.944vw;
        }
      }
    }
  }

  .goList{
    text-align: right;
    background: white;
    padding-top: 1.25vw;

    @include mobile {
      padding-top: 3.889vw;
    }

    a {
      text-decoration: none;
      padding: 0.104vw 0.833vw;
      border: 1px solid #a19b95;
      cursor: pointer;

      @include mobile {
        font-size: 2.778vw;
        padding: 0 1.944vw;
      }
    }
  }
}
</style>