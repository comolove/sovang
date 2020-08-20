<template>
  <div class="store-list">
    <div class="selector">
      <select ref="storeSelector" @change="selectStore">
        <option v-for="(store, index) in stores" :key="index" :value="index">
          {{ store.storeName }}
        </option>
      </select>
    </div>
    <StoreView :store="selectedStore" @LoadData="LoadData" />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, Watch, Ref } from "vue-property-decorator";
import { StoreView } from "./";
import { Store } from "@/utils";

@Component({
  components: {
    StoreView
  }
})
export default class StoreList extends Vue {
  @Ref() storeSelector!: HTMLSelectElement;

  @Prop() stores!: Store[];

  private selectedStore: Store = new Store();

  private LoadData() {
    this.$emit("LoadData");
  }

  @Watch("stores")
  private async onChangeItems() {
    this.selectStore();
  }

  private selectStore() {
    let index = 0;

    if (this.storeSelector) {
      index = parseInt(this.storeSelector.value);

      if (isNaN(index) || !index) {
        index = 0;
      }
    }

    if (this.stores.length === 0) {
      this.selectedStore = new Store();
    } else if (this.stores.length < index) {
      index = 0;
    }

    this.selectedStore = this.stores[index];
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/admin/manage-container";

// .store-list {
//   display: flex;
//   flex-direction: column;
//   margin-top: 10px;

//   .store {
//     margin-right: 20px;
//   }
// }
</style>
