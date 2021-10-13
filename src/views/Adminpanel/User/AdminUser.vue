<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
          <div class="row">
              <div class="col-10 offset-1">
                  <UserListHeader />
                  <UserList />
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
import UserList from "@/components/Adminpanel/User/UserList.vue";
import UserListHeader from "@/components/Adminpanel/User/UserListHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserList,
    UserListHeader,
  },
};
</script>
