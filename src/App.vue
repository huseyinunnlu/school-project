<template>
  <MainLoader v-if="isLoading" />
  <div v-else>
    <router-view :key="$route.fullPath" />
    <notifications class="my-3 mx-4" />
  </div>
</template>
<script>
import MainLoader from "@/components/Loaders/MainLoader.vue";
export default {
  components: {
    MainLoader,
  },
  data() {
    return {
      isLoading: false,
    };
  },
  created() {
    this.getUser();
    this.getSettings();
  },
  methods: {
    getUser() {
      this.isLoading = true;
      if (localStorage.getItem("token") != "") {
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
            this.$router.push({ name: "Index" });
            localStorage.setItem("perm", "");
            localStorage.setItem("token", "");
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        this.$store.state.User.user = [];
        localStorage.setItem("token", "");
        localStorage.setItem("perm", "");
      }
      this.isLoading = false;
    },
    getSettings() {
      this.isLoading = true;
      this.$appAxios.get("/settings").then((res) => {
        this.$store.state.Settings.settings = res.data.data;
      });
      this.isLoading = false;
    },
  },
};
</script>
