<template>
  <div class="btn-group">
    <a
      href="#"
      class="d-flex text-white align-items-center dropdown-toggle p-0"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <img
        :src="_User.profilePhoto"
        class="rounded-circle mr-2   "
        style="width:30px; height:30px;"
      />
      {{ _User.fullName }}
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <router-link
        :to="{ name: 'Profile', params: { username: _User.username } }"
        class="dropdown-item"
        type="button"
        ><i class="fas fa-user mr-1"></i> Profile</router-link
      >
      <router-link
        v-if="_User.type == 1"
        :to="{ name: 'AdminIndex' }"
        class="dropdown-item"
        type="button"
        ><i class="fas fa-chart-line mr-1"></i> Adminpanel</router-link
      >
      <div class="dropdown-divider"></div>
      <Logout class="text-dark ml-3"/>
    </div>
  </div>
</template>
<script>
import Logout from '@/components/Auth/Logout.vue'
import { mapGetters } from "vuex";
export default {
    components:{
        Logout
    },
  computed: {
    ...mapGetters(["_User"]),
  },
};
</script>
