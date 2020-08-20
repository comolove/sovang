<template>
  <div class="notice-wrap" v-if="isInCurrentPage"
    ref="notice"
    @click="() => {
      this.$router.push(`/notice/${index}`);
    }"
  >
    <span class="index" v-if="!isMobile">{{index}}</span>
    <span class="title">{{title}}</span>
    <span class="author">{{author}}</span>
    <span class="date">{{date}}</span>
  </div>
</template>

<script lang="ts">
import { Vue, Prop, Component } from "vue-property-decorator";

@Component({
  name: "NoticeSummary"
})
export default class NoticeSummary extends Vue {
  @Prop() private index !: string;
  @Prop() private title !: string;
  @Prop() private author !: string;
  @Prop() private date !: string;
  @Prop() private currentPage !: number;
  @Prop() private isMobile !: boolean;

  mounted() {
    if(parseInt(this.index) == 1) {
      (this.$refs.notice as HTMLDivElement).style.borderTop="1px solid #a19b95";
    }
  }

  get isInCurrentPage() : boolean {
    const currentIndex = parseInt(this.index);
    return this.currentPage==Math.floor((currentIndex-1)/5+1);
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

.notice-wrap{
  width: 100%;
  border-bottom: 1px solid #a19b95;
  background: #f3f0ed;
  font-size: 1.146vw;
  line-height: 3.958vw;

  @include mobile {
    font-size: 3.333vw;
    line-height: 1.42;
  }

  span {
    display: inline-block;
    text-align: center;
    color: #595757;

    @include mobile {
      text-align: left;
    }

    &.index {
      width: 4.323vw;
      margin-right: 1.667vw;
    }

    &.title {
      width: 50.104vw;
      text-align: left;
      font-weight: bold;

      @include mobile {
        width: 100%;
        padding: 3.056vw 0 0 3.056vw;
        letter-spacing: -0.2vw;
      }
    }

    &.author {
      width: 6.406vw;

      @include mobile {
        width: auto;
        padding: 1.389vw 0 0 3.056vw;
      }
    }

    &.date {
      width: 8.854vw;

      @include mobile {
        width: auto;
        padding: 0 0 3.472vw 3.333vw;
      }
    }
  }
}
</style>