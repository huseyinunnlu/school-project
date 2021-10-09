import { createRouter, createWebHistory } from "vue-router";
//import store from "../store/index.js";
const token = localStorage.getItem("token");
const perm = localStorage.getItem("perm");

const routes = [
  //Index Routes
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
    }
  },
  {
    path: "/u/settings",
    name: "ProfileSettings",
    component: () => import("../views/Profile/ProfileSettings.vue"),
    beforeEnter: (_, from, next) => {
      if (token != "null") {
        next();
      } else {
        router.push({ name: "Index" });
      }
    },
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

//is auth middleware
router.beforeEach((to, _, next) => {
  const authRoutes = ["Register", "Login"];
  const adminRoutes = ["AdminIndex"];
  //const authReqRoutes = ["Profile"];
  if (authRoutes.indexOf(to.name) > -1 && token != "null") {
    router.push({ name: "Index" });
  } else if (adminRoutes.indexOf(to.name) > -1 && perm == "0") {
    router.push({ name: "Login" });
  } else {
    next();
  }
});

export default router;
