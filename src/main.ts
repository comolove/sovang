import Vue from "vue";
import App from "./App.vue";
import router from "./router";

import AOS from "aos";
import "aos/dist/aos.css";

import VueCookies from "vue-cookies";
import VueScrollTo from "vue-scrollto";

Vue.config.productionTip = false;

Vue.use(VueCookies);
Vue.use(VueScrollTo);

new Vue({
  created() {
    AOS.init({
      duration: 1000,
      delay: 300,
      offset: 400
    });
  },
  router,
  render: h => h(App)
}).$mount("#app");
