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
    font-size: 1.625rem;
    padding-bottom: 0.875rem;
    margin-bottom: 3.5rem;
  }
}
</style>
