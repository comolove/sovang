<template>
  <div>
    <label :for="name" ref="label" v-html="placeholder"></label>
    <textarea
      ref="textarea"
      :id="name"
      :name="name"
      @keydown="hidePlaceholder"
      @blur="showPlaceholder"
      @change="onChange"
    />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component({ name: "TextareaWithRedAsterisk" })
export default class TextaredWithRedAsterisk extends Vue {
  @Prop() private name!: string;
  @Prop() private placeholder!: string;

  public isEmpty = true;

  $refs!: {
    textarea: HTMLTextAreaElement;
    label: HTMLLabelElement;
  };

  onChange() {
    this.isEmpty = this.$refs.textarea.value.length == 0 ? true : false;
  }

  hidePlaceholder() {
    this.$refs.label.innerHTML = "";
  }

  showPlaceholder() {
    if (this.isEmpty) {
      this.$refs.label.innerHTML = this.placeholder;
      this.$emit("empty");
    } else {
      this.$emit("non-empty");
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

div {
  position: relative;
  label {
    position: absolute;
    cursor: text;
    top: 0.729vw;
    left: 0.938vw;
    font-size: 1.146vw;
    font-family: NotoSansCJKKr;
    letter-spacing: -0.1vw;
    line-height: 1.73;
    font-weight: 300;

    @include mobile {
      font-size: 3.611vw;
      line-height: 1.62;
      letter-spacing: -0.39vw;
    }
  }
}
</style>