<template>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <p class="text-muted" v-html="_User.bio"></p>
    </div>
    <!-- /.card-body -->
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_User"]),
  },
};
</script>
