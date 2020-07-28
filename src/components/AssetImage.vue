<template>
  <img :src="require(`@/assets/images/${src}`)" @click="$emit('click')" />
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component
export default class AssetImage extends Vue {
  @Prop() private src!: string;
}
</script>

<style scoped lang="scss"></style>
