<template>
  <div class="container">
    <div class="logo">
      <router-link :to="{ name: 'Index' }">
        <img :src="_Settings.logo" style="width:85px;  height:85px;" />
      </router-link>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_Settings"]),
  },
};
</script>
<style scoped>
.logo {
  margin: 30px auto;
}
</style>
