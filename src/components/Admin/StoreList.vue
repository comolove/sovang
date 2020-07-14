<template>
  <div class="store-list">
    <StoreView :store="value" v-for="(value, index) in stores" :key="index" />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { StoreView } from "./";
import { Store } from "@/utils";

@Component({
  components: {
    StoreView
  }
})
export default class StoreList extends Vue {
  @Prop() stores!: Store[];

  protected handleModify(index: number) {
    this.$emit("modify", index);
  }

  protected handleDelete(index: number) {
    this.$emit("delete", index);
  }
}
</script>

<style scoped lang="scss">
.store-list {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;

  .store {
    margin: 10px 0;
  }
}
</style>
