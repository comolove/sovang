<template>
  <img :src="require(`@/assets/images/${src}`)" />
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component
export default class AssetImage extends Vue {
  @Prop() private src!: string;
}
</script>

<style scoped lang="scss"></style>
