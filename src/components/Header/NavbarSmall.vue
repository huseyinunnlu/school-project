<template>
  <nav class="navbar">
    <div class="container navbar-container d-flex justify-content-between">
      <div class="nav-items">
        <router-link :to="{ name: 'Index' }" class="nav-item">Home</router-link>
        <router-link :to="{ name: 'Index' }" class="nav-item"
          >Contact</router-link
        >
        <router-link :to="{ name: 'Index' }" class="nav-item">Help</router-link>
      </div>
      <div class="nav-items" v-if="!_IsAuth">
        <router-link :to="{ name: 'Login' }" class="nav-item"
          >Login</router-link
        >
        <router-link :to="{ name: 'Register' }" class="nav-item"
          >Register</router-link
        >
      </div>
      <div class="nav-items" v-else>
        <UserNavbar />
      </div>
    </div>
  </nav>
</template>
<script>
import UserNavbar from "@/components/Header/UserNavbar.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    UserNavbar,
  },
  computed: {
    ...mapGetters(["_IsAuth"]),
  },
};
</script>
<style scoped>
.navbar {
  height: 60px;
  background-color: #1a1a1a;
}
.nav-item {
  margin: auto 10px;
  padding: 5px 5px;
  color: white;
  transition: color 0.3s;
}
.nav-item:hover {
  border-bottom: 2px solid #999999;
  color: #999999;
}
</style>
