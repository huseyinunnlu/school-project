import { createRouter, createWebHistory } from "vue-router";
//import store from "../store/index.js";
const token = localStorage.getItem("token");
const perm = localStorage.getItem("perm");

const routes = [
  //Index Routes
  {
    path: "/404",
    name: "404",
    component: () => import("../views/404.vue"),
  },

  {
    path: "/",
    name: "Index",
    component: () => import("../views/Index.vue"),
  },

  //Auth Routes
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/Auth/Register.vue"),
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("../views/Auth/Login.vue"),
  },

  //Adminpanel Routes
  {
    path: "/dashboard",
    name: "AdminIndex",
    component: () => import("../views/Adminpanel/Index.vue"),
  },

  //User Adding Routes

  {
    path: "/users",
    name: "AdminUser",
    component: () => import("../views/Adminpanel/User/AdminUser.vue"),
  },
  {
    path: "/users/:id/edit",
    name: "UserEdit",
    component: () => import("../views/Adminpanel/User/UserEdit.vue"),
  },
  //Admin Routues finish

  //Profile Routes

  {
    path: "/u/:username",
    name: "Profile",
    component: () => import("../views/Profile/Profile.vue"),
    beforeEnter: (_, from, next) => {
      if (token != "null") {
        next();
      } else {
        router.push({ name: "Index" });
      }
    },
  },
  {
    path: "/user/settings",
    name: "ProfileSettings",
    component: () => import("../views/Profile/ProfileSettings.vue"),
    beforeEnter: (_, from, next) => {
      if (token != "null") {
        next();
      } else {
        router.push({ name: "Index" });
      }
    },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

//is auth middleware
router.beforeEach((to, _, next) => {
  const authRoutes = ["Register", "Login"];
  const adminRoutes = ["AdminIndex",'AdminUser'];
  //const authReqRoutes = ["Profile"];
  if (!to.matched.length) {
    router.push({ name: "404" });
  } else if (authRoutes.indexOf(to.name) > -1 && token != "null") {
    router.push({ name: "Index" });
  } else if (adminRoutes.indexOf(to.name) > -1 && perm == "0") {
    router.push({ name: "Login" });
  } else {
    next();
  }
});

export default router;
