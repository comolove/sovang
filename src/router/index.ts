import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";
import Brand from "../views/Brand.vue";
import Store from "../views/Store.vue";
import Catering from "../views/Catering.vue";
import Present from "../views/Present.vue";
import Community from "../views/Community.vue";
import Notice from "../views/Notice.vue";
import Admin from "../views/Admin.vue";
import AdminMainSlide from "../views/Admin/MainSlide.vue";
import AdminOnlineMall from "../views/Admin/OnlineMall.vue";
import AdminStore from "../views/Admin/Store.vue";
import AdminCateringStory from "../views/Admin/CateringStory.vue";
import AdminPresentProject from "../views/Admin/PresentProject.vue";
import AdminNotice from "../views/Admin/Notice.vue";
import AdminNoticeMobile from "../views/Admin/NoticeMobile.vue";
import AdminFellowshipPeople from "../views/Admin/FellowshipPeople.vue";
import AdminCateringMainSlide from "../views/Admin/CateringMainSlide.vue";
import AdminPresentMainSlide from "../views/Admin/PresentMainSlide.vue";
import AdminPresentItem from "../views/Admin/PresentItem.vue";

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/brand",
    name: "Brand",
    component: Brand
  },
  {
    path: "/store",
    name: "Store",
    component: Store
  },
  {
    path: "/catering",
    name: "Catering",
    component: Catering
  },
  {
    path: "/present",
    name: "Present",
    component: Present
  },
  {
    path: "/community",
    name: "Community",
    component: Community
  },
  {
    path: "/notice",
    name: "Notice",
    component: Notice
  },
  {
    path: "/wadiz",
    beforeEnter(/*to, from, next*/) {
      window.location.href = "https://www.wadiz.kr/web/campaign/detail/90769?utm_source=naver&utm_medium=maker_naver" 
    }
  },
  {
    path: "/admin",
    name: "Admin",
    component: Admin,
    children: [
      {
        path: "mainslide",
        component: AdminMainSlide
      },
      {
        path: "onlinemall",
        component: AdminOnlineMall
      },
      {
        path: "store",
        component: AdminStore
      },
      {
        path: "cateringstory",
        component: AdminCateringStory
      },
      {
        path: "presentproject",
        component: AdminPresentProject
      },
      {
        path: "notice",
        component: AdminNotice
      },
      {
        path: "noticemobile",
        component: AdminNoticeMobile
      },
      {
        path: "fellowship_people",
        component: AdminFellowshipPeople
      },
      {
        path: "catering_mainslide",
        component: AdminCateringMainSlide
      },
      {
        path: "present_mainslide",
        component: AdminPresentMainSlide
      },
      {
        path: "present_item",
        component: AdminPresentItem
      }
    ]
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { x: 0, y: 0 };
    }
  }
});

export default router;
