<template>
  <article>
    <h3 class="bar-bottom" v-html="title"></h3>
    <slot></slot>
  </article>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component
export default class HomeContent extends Vue {
  @Prop() private title!: string;
}
</script>

<style scoped lang="scss">
@import "../assets/styles/layouts";

article {
  position: relative;
  width: 100%;

  h3 {
    padding-bottom: 0.729vw;
    margin-bottom: 2.76vw;
    font-size: 1.198vw;
    color: #001845;

    @include mobile {
      padding-bottom: 1.311vw;
      margin-bottom: 6.389vw;
      font-size: 3.611vw;
      font-weight: 500;
    }
  }
}
</style>
