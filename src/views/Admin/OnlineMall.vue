<template>
  <div class="manage-container">
    <header>
      <h2>온라인 몰 물품</h2>
    </header>
    <div class="selector">
      <select ref="mallItemSelector" @change="onSlideSelect">
        <option value="-1">온라인 몰 물품을 선택해 주세요</option>  
        <option
          v-for="(item, index) in onlineMallItems"
          :key="index"
          :value="index"
        >
          {{ item.itemName }}
        </option>
      </select>
    </div>
    <OnlineMallView
      :item="selectedItem"
      @modify="onModify"
      @delete="onDelete"
    />
    <hr />
    <form v-on:submit.prevent="onSubmit">
      <h3>물품 {{selectedItem ? "변경" : "추가"}}</h3>
      <div class="input-wrap">
        <label for="itemName">물품 이름</label>
        <input ref="itemName" id="itemName" type="text" :value="selectedItem ? selectedItem.itemName : ''"/>
      </div>
      <div class="input-wrap">
        <label for="itemDesc">물품 설명</label>
        <input ref="itemDesc" id="itemDesc" type="text" :value="selectedItem ? selectedItem.itemDesc : ''"/>
      </div>
      <div class="input-wrap">
        <label for="link">물품 링크</label>
        <input ref="link" id="link" type="text" :value="selectedItem ? selectedItem.link : ''"/>
      </div>
      <div class="input-wrap" v-if="!selectedItem">
        <label for="pcImage">PC 이미지</label>
        <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
      </div>
      <div class="input-wrap" v-if="!selectedItem">
        <label for="mobileImage">모바일 이미지</label>
        <input
          ref="mobileImage"
          id="mobileImage"
          type="file"
          accept="image/*"
        />
      </div>

      <button :class="selectedItem ? 'blue-button' : 'green-button'" type="submit">{{selectedItem ? "변경" : "업로드"}}</button>
    </form>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Ref, Watch } from "vue-property-decorator";
import { OnlineMallView } from "@/components/Admin";
import { AxiosHelper, OnlineMallItem } from "@/utils";

@Component({
  name: "AdminOnlineMall",
  components: {
    OnlineMallView
  }
})
export default class AdminOnlineMall extends Vue {
  @Ref() mallItemSelector!: HTMLSelectElement;

  private onlineMallItems: OnlineMallItem[] = [];
  private selectedItem: OnlineMallItem = new OnlineMallItem();

  async created() {
    await this.LoadData();
  }

  @Watch("onlineMallItems")
  private async onChangeItems() {
    this.selectSlide();
  }

  async LoadData() {
    try {
      const { data } = await AxiosHelper.GET("/getOnlineMallItems.php");
      const list = data.data;

      this.onlineMallItems = list;
    } catch (error) {
      alert("홈페이지 온라인 몰 아이템 로딩 실패");
      console.log(error);
    }
  }

  private async onModify() {
    await this.LoadData();
  }

  private onSlideSelect() {
    this.selectSlide();
  }

  private selectSlide() {
    let index = 0;

    if (this.mallItemSelector) {
      index = parseInt(this.mallItemSelector.value);

      if (isNaN(index) || !index) {
        index = 0;
      }
    }

    if (this.onlineMallItems.length === 0) {
      this.selectedItem = new OnlineMallItem();
    } else if (this.onlineMallItems.length < index) {
      index = 0;
    }

    this.selectedItem = this.onlineMallItems[index];
  }

  private async onSubmit() {
    const itemName = this.$refs["itemName"] as HTMLInputElement;
    const itemDesc = this.$refs["itemDesc"] as HTMLInputElement;
    const link = this.$refs["link"] as HTMLInputElement;
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (this.selectedItem) {
      try {
         const { data } = await AxiosHelper.POST("/modifyOnlineMall.php", {
           index : this.selectedItem.index,
           itemName : itemName.value,
           itemDesc : itemDesc.value,
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
        itemName.value &&
        itemDesc.value &&
        link.value &&
        pcImage.files.length > 0 &&
        mobileImage.files.length > 0
      ) {
        const formData = new FormData();
        formData.append("itemName", itemName.value);
        formData.append("itemDesc", itemDesc.value);
        formData.append("link", link.value);
        formData.append("pcImage", pcImage.files[0]);
        formData.append("mobileImage", mobileImage.files[0]);

        try {
          const { data } = await AxiosHelper.POST(
            "/uploadOnlineMallItem.php",
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            }
          );

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

  private async onDelete(index: number) {
    try {
      if (confirm("삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteOnlineMallItem.php", {
          index: index
        });

        alert("삭제에 성공 했습니다.");
        await this.LoadData();
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../assets/styles/admin/manage-container";
</style>
