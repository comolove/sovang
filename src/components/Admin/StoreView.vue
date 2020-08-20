<template>
  <div class="store-view">
    <div class="content-wrap">
      <div class="text-wrap">
        <p class="subject">매장 이름</p>
        <p class="text">{{ store.storeName }}</p>
      </div>
      <div class="text-wrap">
        <p class="subject">매장 링크</p>
        <p class="text"><a :href="store.link">{{store.link}}</a></p>
      </div>
    </div>
    <div class="content-wrap main-store-img">
      <p>메인 페이지 매장 이미지</p>
      <SwapModifiableImage :image="store.img" @modify="onModify"/>
    </div>
    <div class="content-wrap store-imgs-container">
      <p>식사 공간 페이지 매장 이미지 목록</p>
      <div class="store-imgs">
        <div
          class="image"
          v-for="(value, index) in store.imgList"
          :key="index"
        >
          <SwapModifiableImage :image="value" @modify="onModify"/>
          <button
            class="red-button"
            @click="
              () => {
                handleDeleteImage(store.index, index);
              }
            "
          >
            이미지 삭제
          </button>
        </div>
        
        <form v-on:submit.prevent="onSubmit">
          <h3>식사공간 페이지 이미지 추가</h3>
          <input type="hidden" ref="storeIndex" :value="store.index" />
          <div class="input-wrap">
            <label for="pcImage">PC 이미지</label>
            <input ref="pcImage" id="pcImage" type="file" accept="image/*" />
          </div>
          <div class="input-wrap">
            <label for="mobileImage">모바일 이미지</label>
            <input
              ref="mobileImage"
              id="mobileImage"
              type="file"
              accept="image/*"
            />
          </div>

          <button class="green-button" style="width:400px" type="submit">이미지 업로드</button>
        </form>
      </div>
    </div>

    <button
      class="red-button"
      @click="
        () => {
          handleDeleteStore(store.index);
        }
      "
    >
      매장 삭제
    </button>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { AxiosHelper, Store } from "@/utils";

import ModifiableImage from "@/components/Admin/ModifiableImage.vue";
import SwapModifiableImage from "@/components/Admin/SwapModifiableImage.vue";

@Component({
  components: {
    ModifiableImage,
    SwapModifiableImage
  }
})
export default class StoreView extends Vue {
  @Prop() store!: Store;

  private async handleDeleteStore(storeIndex: number) {
    try {
      if (confirm("매장을 삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteStore.php", {
          storeIndex: storeIndex
        });

        alert("삭제에 성공 했습니다.");
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
    }

    this.$emit("LoadData");
  }

  private async onSubmit() {
    const storeIndex = this.$refs["storeIndex"] as HTMLInputElement;
    const pcImage = this.$refs["pcImage"] as HTMLInputElement;
    const mobileImage = this.$refs["mobileImage"] as HTMLInputElement;

    if (!pcImage.files || !mobileImage.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (
      storeIndex.value &&
      pcImage.files.length > 0 &&
      mobileImage.files.length > 0
    ) {
      const formData = new FormData();
      formData.append("storeIndex", storeIndex.value);
      formData.append("pcImage", pcImage.files[0]);
      formData.append("mobileImage", mobileImage.files[0]);

      try {
        const { data } = await AxiosHelper.POST(
          "/uploadStoreImage.php",
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

    pcImage.value = pcImage.defaultValue;
    mobileImage.value = mobileImage.defaultValue;

    this.$emit("LoadData");
  }

  private onModify() {
    this.$emit("LoadData");
  }

  protected async handleDeleteImage(storeIndex: number, imageIndex: number) {
    try {
      if (confirm("이미지를 삭제하시겠습니까?")) {
        await AxiosHelper.POST("/deleteStoreImage.php", {
          storeIndex: storeIndex,
          imageIndex: imageIndex
        });

        alert("삭제에 성공 했습니다.");
      }
    } catch (error) {
      alert("삭제에 실패 했습니다.");
    }

    this.$emit("LoadData");
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/admin/manage-container";
@include content-wrap;


.store-view {
  display: inline-block;
  margin-bottom: 40px;
}

.main-store-img {
  display: inline-block;
  margin-bottom: 32px !important;
}

.store-imgs-container {
  width: 35%;
  overflow-x: scroll;
  
  .store-imgs {
    display: flex;
    flex-direction: row;
    margin-bottom: 10px;

    .image {
      display: inline-block;
      margin-right: 20px;
    }
  }
}

@include content-wrap;
</style>
