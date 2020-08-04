import Vue from "vue";
import VueRouter, { RouteConfig } from "vue-router";
import Home from "../views/Home.vue";
import Brand from "../views/Brand.vue";
import Store from "../views/Store.vue";
import Catering from "../views/Catering.vue";
import Present from "../views/Present.vue";
import Community from "../views/Community.vue"
import Admin from "../views/Admin.vue";
import AdminMainSlide from "../views/Admin/MainSlide.vue";
import AdminOnlineMall from "../views/Admin/OnlineMall.vue";
import AdminStore from "../views/Admin/Store.vue";
import AdminCateringStory from "../views/Admin/CateringStory.vue";
import AdminPresentProject from "../views/Admin/PresentProject.vue";

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
      }
    ]
  }
  // {
  //   path: "/about",
  //   name: "About",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/About.vue")
  // }
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
