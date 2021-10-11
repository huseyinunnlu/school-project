<template>
  <div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        <img
          class="profile-user-img img-fluid img-circle"
          :src="_User.profilePhoto"
          alt="User profile picture"
        />
      </div>
      <h3 class="profile-username text-center">{{ _User.username }}</h3>
      <p class="text-muted text-center">{{ _User.fullName }}</p>
    </div>
    <!-- /.card-body -->
  </div>
</template>
<script>
export default {
  props:['_User']
};
</script>
