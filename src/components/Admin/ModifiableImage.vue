<template>
  <div class="modifiable-image" @click="onClick">
    <img :src="prefixSrc" />
    <div class="overlay">
      <p>클릭 시 이미지를 변경합니다.</p>
    </div>
    <input
      ref="replaceImage"
      id="replaceImage"
      type="file"
      accept="image/*"
      @change="onChangeImage"
    />
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, Ref } from "vue-property-decorator";
import { AxiosHelper } from "@/utils";

@Component({
  name: "AdminModifiableImage"
})
export default class ModifiableImage extends Vue {
  @Ref() readonly replaceImage!: HTMLInputElement;

  @Prop() src!: string;
  @Prop() type!: string;
  @Prop() index!: number;

  private onClick() {
    this.replaceImage.click();
  }

  private async onChangeImage() {
    const image = this.replaceImage;

    if (!image.files) {
      alert("이미지를 업로드 해주세요");
      return;
    }

    if (image.files.length > 0) {
      const imageFile = image.files[0];

      const formData = new FormData();
      formData.append("newImage", imageFile);
      formData.append("type", this.type);
      formData.append("index", this.index.toString());

      try {
        const { data } = await AxiosHelper.POST("/modifyImage.php", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        });

        this.$emit("modify");
        alert(data.msg);
      } catch (error) {
        console.log("Upload Error : ", error);

        alert(error.response.data.msg);
        console.log(error.response.data);
      }
    } else {
      alert("이미지를 선택해 주세요");
    }
  }

  private get prefixSrc() {
    if (!process) return this.src;
    if (!process.env) return this.src;

    const mode = process.env["NODE_ENV"] as string;
    if (mode) {
      if (mode.trim().toLowerCase() == "development") {
        return "http://localhost:8080" + this.src;
      }
    }

    return this.src;
  }
}
</script>

<style scoped lang="scss">
@import "../../assets/styles/layouts";

.modifiable-image {
  position: relative;
}

.overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  background-color: rgb(0, 0, 0);
  opacity: 0;
  color: white;
  text-align: center;
  transition: all 1s;

  p {
    margin: 32px;
  }
}

img {
  display: block;
  width: 100%;
  height: auto;
}

.modifiable-image:hover {
  .overlay {
    cursor: pointer;
    opacity: 0.6;
  }
}

#replaceImage {
  display: none;
}

</style>
