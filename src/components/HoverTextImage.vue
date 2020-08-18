<template>
  <div
    class="hover-text-image"
    :class="{ 'cursor-pointer': hrefExist }"
    @click="handleClick"
  >
    <img :src="src" />
    <div class="overlay"></div>
    <span class="info"><slot></slot></span>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component({})
export default class HoverTextImage extends Vue {
  @Prop() private src!: string;
  @Prop() private href!: string;

  handleClick(/* e : Event */) {
    if (this.hrefExist) {
      window.open(this.href);
    }
  }

  get hrefExist() {
    return this.href != null;
  }
}
</script>

<style scoped lang="scss">
.hover-text-image {
  position: relative;

  img {
    width: 100%;
  }

  .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;

    opacity: 0;
    transition: 0.5s ease;
    background-color: #000000;
  }

  .info {
    color: white;
    position: absolute;
    width: 100%;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;

    transition: 0.5s ease;
    opacity: 0;
  }

  &:hover .overlay {
    opacity: 0.3;

    & + span {
      opacity: 1;
    }
  }
}

.cursor-pointer {
  cursor: pointer;
}
</style>
