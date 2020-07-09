<template>
  <div class="admin">
    <div class="login-form" v-if="!isLogin">
      <form action="/auth.php" method="POST">
        <input name="id" placeholder="ID">
        <input name="password" type="password" placeholder="Password">
        <button type="confirm">로그인</button>
      </form>
    </div>
    <div v-else>
      Options are here
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component({
})
export default class Admin extends Vue {
  private isLogin = true;

  created() {
    this.isLogin = this.$cookies.get("login") ? true : false;
  }
}
</script>

<style lang="scss" scoped>
</style>