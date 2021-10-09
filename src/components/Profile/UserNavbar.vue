<template>
    <div class="card-header p-2">
      <ul class="nav nav-pills">
          <router-link
            class="router-link py-0 px-2"
            :to="{
              name: 'Profile',
              params: { username: $store.getters._User.username }}"
            data-toggle="tab">Index</router-link>
          <router-link
            class="router-link py-0 px-2"
            :to="{name: 'ProfileSettings'}"
            data-toggle="tab">Settings</router-link>
      </ul>
    </div>
</template>
<style>
.router-link-active{
  color: black;
}
</style>
