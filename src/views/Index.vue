<template>
  <div>
    index
    <button v-if="_IsAuth" @click="logout" class="btn btn-primary">
      Logout
    </button>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_User",'_IsAuth']),
  },
  created() {},
  methods: {
    logout() {
      this.$appAxios
        .post("/logout")
        .then(() => {
          this.$store.state.User.user = [];
          this.$store.state.User.isAuth = false;
          localStorage.setItem("token", null);
          this.$router.push({ name: "Login" });
          this.$notify({
            type: "success",
            title: "Successfully logged out.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Didn't logged out.",
          });
        });
    },
  },
};
</script>
