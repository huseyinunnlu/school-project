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
                <UserProfile :_User="this.$store.getters._User"/>
                <UserAbout :_User="this.$store.getters._User"/>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <UserNavbar :username="this.$store.getters._User.username"/>
                  <UserSettings :_User="this.$store.getters._User"/>
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
import UserSettings from "@/components/Profile/UserSettings.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserAbout,
    UserSettings,
    UserNavbar,
  },
};
</script>
