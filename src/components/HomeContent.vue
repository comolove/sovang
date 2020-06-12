<template>
  <article>
    <h3 class="bar-bottom">{{ title }}</h3>
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
article {
  width: 100%;

  h3 {
    padding-bottom: 0.729vw;
    margin-bottom: 2.76vw;
    font-size: 1.198vw;
    color: #807670;
  }
}
</style>
