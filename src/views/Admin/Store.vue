<template>
  <div class="manage-container">
    <header>
      <h2>식사 공간</h2>
    </header>
    <StoreList :stores="stores" @LoadData="LoadData" />
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import { StoreList } from "@/components/Admin";
import { AxiosHelper, Store } from "@/utils";

@Component({
  name: "AdminStore",
  components: {
    StoreList
  }
})
export default class AdminStore extends Vue {
  private stores: Store[] = [];

  async created() {
    await this.LoadData();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getStore.php");
      const list = data.data;

      this.stores = list;
    } catch (error) {
      alert("식사공간 로딩 실패");
      console.log(error);
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/styles/admin/manage-container";
</style>
