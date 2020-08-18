<template>
  <div class="input-text-wrap">
    <label :for="name" ref="label">
      {{ placeholder }}
      <span v-if="isRequired">*</span>
    </label>
    <input
      type="text"
      :name="name"
      ref="input"
      :id="name"
      v-model="value"
      @keydown="hidePlaceholder"
      @blur="showPlaceholder"
      @change="onChange"
    />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component({ name: "InputText" })
export default class InputText extends Vue {
  @Prop() private name!: string;
  @Prop() private placeholder!: string;
  @Prop() private isRequired!: boolean;

  public isEmpty = true;
  public value = "";

  $refs!: {
    input: HTMLInputElement;
    label: HTMLLabelElement;
  };

  onChange() {
    this.isEmpty = this.$refs.input.value.length == 0 ? true : false;
  }

  hidePlaceholder() {
    this.$refs.label.innerHTML = "";
  }

  showPlaceholder() {
    if (this.isEmpty) {
      this.$refs.label.innerHTML =
        this.placeholder +
        (this.isRequired ? '<span style="color:red">*</span>' : "");
      this.$emit("empty", this);
    } else {
      this.$emit("non-empty", this);
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/styles/layouts";

div {
  position: relative;

  input {
    border: 0;
    padding: 0;
  }

  label {
    position: absolute;
    cursor: text;
    left: 0.667vw;
    top: 0.677vw;
    font-size: 1.006vw;
    color: #595757;
    font-weight: 300;

    @include mobile {
      font-size: 3.611vw;
      left: 2.5vw;
      top: 2.917vw;
    }

    > span {
      color: red;
      margin-left: -0.15vw;
    }
  }
}
</style>
