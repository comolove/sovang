<template>
  <div class="login">
    <div class="content">
      <h3>Login</h3>
      <input v-model="id" placeholder="ID" />
      <input v-model="password" type="password" placeholder="Password" />
      <button @click="handleLogin">로그인</button>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import { AxiosHelper } from "@/utils";

@Component
export default class Login extends Vue {
  private id = "";
  private password = "";

  async handleLogin() {
    try {
      const result = await AxiosHelper.POST("/auth.php", {
        id: this.id,
        password: this.password
      });

      const data = result["data"];
      this.$cookies.set("login_data", data, 60 * 5); // 5분동안 로그인 유지
      location.reload();
    } catch (error) {
      console.log(error);
      alert(error.response.data.msg);
    }
  }
}
</script>

<style scoped lang="scss">
.login {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;

  display: -webkit-flex;
  -webkit-align-item: center;
  -webkit-justify-content: center;

  .content {
    h3 {
      text-align: center;
    }

    input {
      display: block;
      width: 180px;
      height: 40px;
      background-color: #eee;
      border: none;
      margin: 8px 0;
      padding: 0 10px;
      border-radius: 8px;
    }

    button {
      border-radius: 20px;
      border: 1px solid #ff4b2b;
      background-color: #ff4b2b;
      color: #ffffff;
      font-size: 12px;
      font-weight: bold;
      padding: 12px 45px;
      letter-spacing: 1px;
      text-transform: uppercase;
      transition: transform 40ms ease-in;
      margin-left: 36px;

      &:active {
        transform: scale(0.95);
      }

      &:focus {
        outline: none;
      }
    }
  }
}
</style>
