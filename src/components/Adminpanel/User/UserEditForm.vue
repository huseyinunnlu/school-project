<template>
  <form class="form-horizontal" @submit.prevent="updateUser()">
    <div class="form-group row">
      <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="fullName"
          placeholder="Full Name"
          v-model="form.fullName"
        />
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.fullName"
      v-text="errors.fullname[0]"
    ></small>
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="username"
          placeholder="Username"
          v-model="form.username"
        />
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.username"
      v-text="errors.username[0]"
    ></small>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          id="email"
          placeholder="Email"
          v-model="form.email"
        />
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.email"
      v-text="errors.email[0]"
    ></small>
    <div class="form-group row">
      <label for="bio" class="col-sm-2 col-form-label">Biography</label>
      <div class="col-sm-10">
        <textarea
          class="form-control"
          id="bio"
          placeholder="Biography"
        ></textarea>
      </div>
    </div>
    <small class="text-danger" v-if="errors.bio" v-text="errors.bio[0]"></small>
    <div class="form-group row">
      <label for="accType" class="col-sm-2 col-form-label">Account Type</label>
      <div class="col-sm-10">
        <select id="accType" v-model="form.accType" class="form-control">
          <option :value="'0'">User</option>
          <option :value="'1'">Admin</option>
        </select>
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.accType"
      v-text="errors.accType[0]"
    ></small>

    <div class="change-password my-3">
      <div class="header my-5">
        <h3 class="text-center">Change Password</h3>
      </div>

      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label"
          >Change Password</label
        >
        <div class="col-sm-10">
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="Password"
            v-model="form.password"
          />
        </div>
      </div>
      <small
        class="text-danger"
        v-if="errors.password"
        v-text="errors.password[0]"
      ></small>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button v-if="!isLoading" type="submit" class="btn btn-success btn-sm">Update</button>
        <button v-else disabled type="submit" class="btn btn-success btn-sm">Updating...</button>
      </div>
    </div>
  </form>
</template>
<script>
import CryptoJs from "crypto-js";
export default {
  props: {
    user: {
      type: Array,
    },
  },
  data() {
    return {
      form: {
        fullName: null,
        username: null,
        email: null,
        bio: null,
        password: null,
        accType: 0,
      },
      isLoading: false,
      errors: [],
    };
  },
  created() {
    this.form.fullName = this.user.fullName;
    this.form.username = this.user.username;
    this.form.email = this.user.email;
    this.form.bio = this.user.bio;
    this.form.accType = this.user.type;
  },
  methods: {
    updateUser() {
      this.isLoading = true;
      let password = null;
      if (this.form.password) {
        password = CryptoJs.SHA256(this.form.password).toString();
      }
      this.$appAxios
        .post("/user/update", {
          id: this.user.id,
          fullName: this.form.fullName,
          username: this.form.username,
          email: this.form.email,
          bio: this.form.bio,
          type: this.form.accType,
          password: password,
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "User successfully updated",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "User didn't updated",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
