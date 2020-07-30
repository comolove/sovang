<template>
  <transition name="modal" appear>
    <div class="modal modal-overlay">
      <div class="modal-window">
        <div class="modal-content">
          <h2>
            <slot name="title" />
            <img src="@/assets/images/icon-close-darkblue.png" @click="$emit('close')" />
          </h2>
          <div class="flexWrap"  @scroll.once="hideArrow">
            <AssetImage :src="src" @click="$emit('click')" />
            <p>
              <slot />
            </p>
          </div>
          <AssetImage class="arrow-bottom" src="arrow-bottom.png" v-if="isMobile&&!isHide" />
        </div>
      </div>
    </div>
  </transition>
</template>

<script lang="ts">
import { Vue, Prop, Component } from "vue-property-decorator";
import { AssetImage } from "@/components";

@Component({
  components: {
    AssetImage
  }
})
export default class PresentPopup extends Vue {
  @Prop() private src!: string;
  @Prop() private isMobile!: boolean;

  private isHide = false;

  hideArrow() {
    this.isHide = true;
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

.modal {
  &.modal-overlay {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    z-index: 30;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    @include mobile {
      background: rgba(0, 0, 0, 0.4);
    }
  }

  &-window {
    background: white;
    border-radius: 1.042vw;
    overflow: hidden;

    @include mobile {
      border-radius: 2.778vw;
    }
  }

  &-content {
    position: relative;
    padding: 2.604vw 3.021vw 0.521vw 3.125vw;
    width: 63.229vw;

    @include mobile {
      padding: 6.319vw 6.389vw 0 6.389vw;
      margin-bottom: 13.333vw;
      width: 82.222vw;
    }

    h2 {
      font-size: 1.146vw;
      font-weight: 500;
      line-height: 1;
      padding-bottom: 0.938vw;
      border-bottom: 1px solid #001845;
      color: #001845;

      @include mobile {
        font-size: 4.583vw;
        line-height: 5.278vw;
        padding-bottom: 3.889vw;
      }

      img {
        position: absolute;
        top: 2.396vw;
        right: 3.021vw;
        width: 1.302vw;

        @include mobile {
          width: 4.444vw;
          top: 6.944vw;
          right: 6.389vw;
        }
      }
    }

    .flexWrap {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      height: 27.083vw;

      @include mobile {
        display: block;
        height: 100vw;
        overflow: scroll;

        &::-webkit-scrollbar {
          display: none;
        }
      }

      img {
        width: 28.906vw;

        @include mobile {
          width: 100%;
          height: 47.5vw;
          margin-top: 5vw;
        }
      }

      p{
        text-align: justify;
        word-break: keep-all;
        width: 25.781vw;
        font-weight: 300;
        font-size: 0.859vw;
        line-height: 1.85;
        color: #424141;

        @include mobile {
          margin-top: 4.028vw;
          font-size: 2.778vw;
          line-height: 1.7;
          width: 100%;
        }
      }
    }

    .arrow-bottom {
      @include mobile {
        position: absolute;
        left: 37.5vw;
        top: 129.167vw;
      }
    }
  }
}

// 오버레이 트랜지션
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.4s;

  // 오버레이에 포함되어 있는 모달 윈도의 트랜지션
  .modal-window {
    transition: opacity 0.4s, transform 0.4s;
  }
}

// 딜레이가 적용된 모달 윈도가 제거된 후에 오버레이가 사라짐
.modal-leave-active {
  transition: opacity 0.6s ease 0.4s;
}

.modal-enter,
.modal-leave-to {
  opacity: 0;

  .modal-window {
    opacity: 0;
    transform: translateY(-20px);
  }
}
</style>
