import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  //Index Routes
  {
    path: '/',
    name: 'Index',
    component: () => import('../views/Index.vue')
  },

  //Auth Routes
  {
    path: '/register',
    name: 'Register',
    component: () => import('../views/Auth/Register.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Auth/Login.vue')
  }

  //Adminpanel Routes
]

//  router.beforeEach(()=>{
  
// })

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
