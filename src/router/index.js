import { createRouter, createWebHistory } from "vue-router";
//import store from "../store/index.js";
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
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

//is auth middleware
router.beforeEach((to,_,next) => {
  const token = localStorage.getItem("token");
  const authRoutes = ["Register", "Login"];
  //const adminRoutes = ['AdminIndex']
  if ((authRoutes.indexOf(to.name) > -1 && token!='null')) {
    router.push({ name: "Index" });
  }else{
    next()
  }
});


export default router;
