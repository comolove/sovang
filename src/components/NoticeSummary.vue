<template>
  <div class="notice-wrap" v-if="isInCurrentPage"
    ref="noticeItem"
    @click="toNoticePage"
  >
    <span class="index" v-if="!isMobile">{{index}}</span>
    <span class="title">{{notice.title}}</span>
    <span class="author">{{notice.author}}</span>
    <span class="date">{{notice.createdAt}}</span>
  </div>
</template>

<script lang="ts">
import { Vue, Prop, Component, Ref } from "vue-property-decorator";
import { NoticeData } from "@/utils";

@Component({
  name: "NoticeSummary"
})
export default class NoticeSummary extends Vue {
  @Ref() noticeItem! : HTMLDivElement;

  @Prop() private notice!: NoticeData
  @Prop() private index !: string;
  @Prop() private currentPage !: number;
  @Prop() private isMobile !: boolean;

  mounted() {
    console.log(this.notice);
    if(parseInt(this.index) == 1 && this.isMobile) {
      this.noticeItem.style.borderTop = "1px solid #a19b95";
    }
  }

  toNoticePage() {
    this.$router.push({
      name: "Notice",
      params : {
        index : this.index,
        title: this.notice.title,
        content : this.notice.content,
        author : this.notice.author,
        createdAt : this.notice.createdAt
      }
    });
  }

  get isInCurrentPage() : boolean {
    const currentIndex = parseInt(this.index);

    return this.currentPage == Math.floor((currentIndex - 1) / 5 + 1);
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
  white-space: nowrap;  
  cursor: pointer;

  @include mobile {
    font-size: 3.333vw;
    line-height: 1.42;
    white-space: normal;  
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
      margin-right: 1vw;
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
      width: 6.356vw;

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