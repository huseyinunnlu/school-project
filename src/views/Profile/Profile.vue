<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="row py-4">
              <div class="col-md-3">
                <div class="sidebar-loader" v-if="isLoading">
                  <UserSidebarLoader />
                </div>
                <div class="user-sidebar" v-else>
                  <UserProfile :_User="user" />
                  <UserAbout :_User="user" />
                </div>
              </div>
              <div class="col-md-9">
                <div class="card" v-if="isLoading">
                  <div class="card-body">
                    <h1 class="text-center">Loading...</h1>
                  </div>
                </div>
                <div class="card" v-else>
                  <UserNavbar :username="user.username" />
                  <UserContent :_User="user" />
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <Footer />
    </div>
  </body>
</template>
<script>
import Navbar from "@/components/Adminpanel/Header/Navbar.vue";
import Sidebar from "@/components/Adminpanel/Sidebar/Sidebar.vue";
import Footer from "@/components/Adminpanel/Header/Footer.vue";
import UserProfile from "@/components/Profile/UserProfile.vue";
import UserAbout from "@/components/Profile/UserAbout.vue";
import UserContent from "@/components/Profile/UserContent.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
import UserSidebarLoader from "@/components/Profile/UserSidebarLoader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserAbout,
    UserContent,
    UserNavbar,
    UserSidebarLoader
  },
  data() {
    return {
      user: [],
      isLoading: false,
    };
  },
  created() {
    if (this.$route.params.username != this.$store.getters._User.username) {
      this.getUser();
    } else {
      this.user = this.$store.getters._User;
    }
  },
  methods: {
    getUser() {
      this.isLoading = true;
      this.$appAxios
        .post("/getuser", {
          username: this.$route.params.username,
        })
        .then((res) => {
          this.user = res.data;
        })
        .catch(() => {
          this.$router.push({ name: "Index" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
