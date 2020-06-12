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
        주식회사 방앗간컴퍼니 ㅣ 대표. 김민영 ㅣ 사업자등록번호. 206-87-00778
        <br />청정재료문의전화. +82(0)10-4721-0778 ㅣ문의시간. 오전 10시 - 오후 7시
        <br />대표메일. sobang@millcompany.co.kr ㅣ 서울 광진구 긴고랑로7길 5
        <br />copyrhight (c) millcompany. All rights reserved
      </p>
    </div>
  </footer>
</template>

<script lang="ts">
export default {};
</script>

<style scoped lang="scss">
@import "../assets/styles/layouts";
@import url(http://fonts.googleapis.com/earlyaccess/notosanskr.css);

footer {
  width: 100%;
  background-color: #ecebe8;

  padding: {
    top: 3.875rem;
    bottom: 8.25rem;
  }
  @include mobile {
    padding-top: 4.722vw;
    padding-bottom: 16.944vw;
  }
}

.header {
  margin-bottom: 1.927vw;

  @include mobile{
    margin-bottom: 5.389vw;
  }

  h3 {
    display: inline;
    font-size: 1.094vw;
    font-weight: normal;
    color: #595757;

    @include mobile{
      font-size: 3vw;
      font-weight: 500;
      font-family: "Noto Sans KR",sans-serif;
      width: 35.833vw;
    }
  }

  .sns {
    float: right;
    img {
      width: 2.5vw;
      @include mobile{
        width: 5.833vw;
      }
    }

    .facebook {
      padding-right: 0.833vw;
      @include mobile{
        padding-right: 1.389vw;
      }
    }
  }
}

p {
  font-size: 0.99vw;
  color: #595757;
  font-weight: 300;
  line-height: 2;
  @include mobile{
    font-weight: 400;
    font-family: "Noto Sans KR",sans-serif;
  }
}
</style>
