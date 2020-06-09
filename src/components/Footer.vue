<template>
  <footer>
    <div class="wrap">
      <div class="header">
        <h3>청정재료 한식밥집 소녀방앗간</h3>
        <div class="sns">
          <a href="https://www.facebook.com/" class="facebook">
            <img src="../assets/images/icon-facebook.png" />
          </a>
          <a href="https://www.instagram.com/" class="insta">
            <img src="../assets/images/icon-instagram.png" />
          </a>
        </div>
      </div>
      <p>
        주식회사 방앗간컴퍼니 ㅣ 대표. 김민영 ㅣ 사업자등록번호. 206-87-00778<br />
        청정재료문의전화. +82(0)10-4721-0778 ㅣ문의시간. 오전 10시 - 오후 7시<br />
        대표메일. sobang@millcompany.co.kr ㅣ 서울 광진구 긴고랑로7길 5
      </p>
      <p class="copyright">copyrhight (c) millcompany. All rights reserved</p>
    </div>
  </footer>
</template>

<script lang="ts">
export default {};
</script>

<style scoped lang="scss">
footer {
  width: 100%;
  background-color: #ecebe8;

  padding: {
    top: 3.875rem;
    bottom: 8.25rem;
  }
}

.header {
  margin-bottom: 3.063rem;

  h3 {
    display: inline;
    font-size: 1.313rem;
    font-weight: normal;
    color: #595757;
  }

  .sns {
    float: right;

    .facebook {
      padding-right: 1rem;
    }
  }
}

p {
  font-size: 1.313rem;
  color: #595757;
  font-weight: 300;
  line-height: 1.52;
}

.copyright {
  margin-top: 2.75rem;
  font-size: 1.313rem;
}
</style>
