<template>
  <div class="wrapper">
    <div
      v-if="isLoading"
      style="font-size:30px;"
      class="preloader flex-column justify-content-center align-items-center"
    >
      <span> <b>Mod</b>Hub </span>
    </div>
    <div v-else>
      <router-view :key="$route.fullPath" />
      <notifications class="my-3 mx-4" />
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoading: true,
    };
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      if (localStorage.getItem("token")) {
        this.isLoading = true;
        this.$appAxios
          .get("user")
          .then((res) => {
            this.$store.state.User.user = res.data;
            this.$store.state.User.isAuth = true;
            localStorage.setItem("perm", res.data.type);
          })
          .catch(() => {
            this.$store.state.User.user = [];
            this.$store.state.User.isAuth = false;
            localStorage.setItem("perm", null);
            localStorage.setItem("token", null);
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        this.$store.User.state.user = [];
        localStorage.setItem("token", null);
        localStorage.setItem("perm", null);
      }
    },
  },
};
</script>
