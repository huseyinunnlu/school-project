<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Edit User'" />
            <h2 v-if="isLoading" class="text-center">Loading...</h2>
            <UserEditForm :user="user" v-if="!isLoading" />
          </div>
        </div>
      </div>
      <Footer />
    </div>
  </body>
</template>
<script>
import Navbar from "@/components/Adminpanel/Header/Navbar.vue";
import Sidebar from "@/components/Adminpanel/Sidebar/Sidebar.vue";
import Footer from "@/components/Adminpanel/Header/Footer.vue";
import UserEditForm from "@/components/Adminpanel/User/UserEditForm.vue";
import ContentHeader from "@/components/Adminpanel/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserEditForm,
    ContentHeader,
  },
  data() {
    return {
      user: [],
      isLoading: false,
    };
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      this.isLoading = true;
      this.$appAxios
        .get("/user/" + this.$route.params.id + "/get")
        .then((res) => {
          this.user = res.data.data;
        })
        .catch(() => {
          this.$router.push({ name: "AdminUser" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
