<template>
  <div class="store-list">
    <div class="selector">
      <select ref="storeSelector" @change="selectStore">
        <option value="-1">매장을 선택해 주세요.</option>
        <option v-for="(store, index) in stores" :key="index" :value="index">
          {{ store.storeName }}
        </option>
      </select>
    </div>
    <StoreView :store="selectedStore" @LoadData="LoadData" />
    <hr/>
    <form v-on:submit.prevent="onSubmit">
      <h3>매장 {{selectedStore ? "변경" : "추가"}}</h3>
      <div class="input-wrap">
        <label for="storeName">매장 이름</label>
        <input ref="storeName" id="storeName" type="text" :value="selectedStore ? selectedStore.storeName : ''"/>
      </div>
      <div class="input-wrap">
        <label for="link">매장 외부 링크</label>
        <input ref="link" id="link" type="text" :value="selectedStore ? selectedStore.link : ''" />
      </div>
      <div class="input-wrap" v-if="!selectedStore">
        <label for="pcImage">홈페이지 PC 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap" v-if="!selectedStore">
        <label for="mobileImage">홈페이지 모바일 이미지</label>
        <input
          ref="mobileImage"
          id="mobileImage"
          type="file"
          accept="image/*"
        />
      </div>

      <button :class="selectedStore ? 'blue-button' : 'green-button'" type="submit">{{selectedStore ? "변경" : "업로드"}}</button>
    </form>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, Watch, Ref } from "vue-property-decorator";
import { StoreView } from "./";
import { AxiosHelper, Store } from "@/utils";

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

  private async onSubmit() {
    const storeName = this.$refs["storeName"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (this.selectedStore) {
      try {
         const { data } = await AxiosHelper.POST("/modifyStore.php", {
           index : this.selectedStore.index,
           storeName : storeName.value,
           link : link.value
        });

        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
      }
    }
    else {
      if (!pcImage.files || !mobileImage.files) {
        alert("이미지를 업로드 해주세요");
        return;
      }

      if (
        storeName.value ||
        link.value ||
        pcImage.files.length > 0 ||
        mobileImage.files.length > 0
      ) {
        const formData = new FormData();
        formData.append("storeName", storeName.value);
        formData.append("link", link.value);
        formData.append("pcImage", pcImage.files[0]);
        formData.append("mobileImage", mobileImage.files[0]);

        try {
          const { data } = await AxiosHelper.POST("/uploadStore.php", formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          });

          alert(data.msg);
        } catch (error) {
          console.log("Upload Error : ", error);

          alert(error.response.data.msg);
        }
      } else {
        alert("모든 정보를 채워주세요.");
      }
    }

    await this.LoadData();
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/admin/manage-container";
</style>
