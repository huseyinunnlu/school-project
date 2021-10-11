<template>
  <div class="card-header p-2">
    <ul class="nav nav-pills">
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'Profile',
          params: { username: username },
        }"
        data-toggle="tab"
        >Index</router-link
      >
      
      <router-link
        v-if="username == $store.getters._User.username"
        class="router-link py-0 px-2"
        :to="{ name: 'ProfileSettings' }"
        data-toggle="tab"
        >Settings</router-link
      >
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    username: {
      type: String,
      default:'test'
    },
  },
};
</script>
<style>
.router-link-active {
  color: black;
}
</style>
