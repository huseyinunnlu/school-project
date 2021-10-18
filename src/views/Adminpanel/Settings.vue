<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Settings'" />
            <ComponentLoader v-if="isLoading" />
            <SettingsForm v-else />
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
import SettingsForm from "@/components/Adminpanel/Settings/SettingsForm.vue";
import ContentHeader from "@/components/Adminpanel/ContentHeader.vue";
import ComponentLoader from "@/components/Loaders/ComponentLoader.vue";

import { mapGetters } from "vuex";
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    SettingsForm,
    ComponentLoader,
    ContentHeader,
  },
  data() {
    return {
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(["_Settings"]),
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      this.isLoading = true;
      this.$appAxios
        .get("/settings")
        .then((res) => {
          this.$store.state.Settings.settings = res.data.data;
        })
        .catch(() => {
          this.$store.state.Settings.settings = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
