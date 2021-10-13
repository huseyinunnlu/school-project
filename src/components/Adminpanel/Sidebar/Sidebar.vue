<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link :to="{name:'AdminIndex'}" class="brand-link">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <SidebarUser />
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <div class="admin-pages" v-if="$store.getters._User.type == '1'">
            <li class="nav-header">Admin Pages</li>
            <li class="nav-item">
              <router-link :to="{name:'AdminUser'}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Users
                </p>
              </router-link>
            </li>
          </div>
          <div class="admin-pages">
            <li class="nav-header">User Pages</li>
            <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
          </div>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
import SidebarUser from "@/components/Adminpanel/Sidebar/SidebarUser.vue";
export default {
  components: {
    SidebarUser,
  },
};
</script>
