import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../views/Login.vue";
import ThesesView from "../views/ThesesView.vue";
//import Dashboard from "../components/dashboard.vue";
import Home from "../components/Home.vue";
import Theses from "../components/Theses.vue";

Vue.use(VueRouter);

const routes = [
   {
    path: "/",
    name: "Home",
    component: Home,
  }, 
  {
    path: "/thesesview",
    name: "ThesesView",
    component: ThesesView,
  }, 
  {
    path: "/theses",
    name: "Theses",
    component: Theses,
  },
  {
    path: "/admin",
    name: "Admin",
    component: Login,
    children: [
      {
        path: "/home",
        component: Home,
      },
      {
        path: "/theses",
        name: "Theses",
        component: Theses,
      },
    ],
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
