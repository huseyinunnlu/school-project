<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="addUser"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group row">
              <label for="fullName" class="col-sm-2 col-form-label"
                >Full Name</label
              >
              <div class="col-sm-10">
                <input type="text"
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
              <label for="username" class="col-sm-2 col-form-label"
                >Username</label
              >
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
              <label for="password" class="col-sm-2 col-form-label"
                >Password</label
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
            <small
              class="text-danger"
              v-if="errors.bio"
              v-text="errors.bio[0]"
            ></small>
            <div class="form-group row">
              <label for="accType" class="col-sm-2 col-form-label"
                >Account Type</label
              >
              <div class="col-sm-10">
                <select
                  id="accType"
                  v-model="form.accType"
                  class="form-control"
                >
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
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="
              !form.fullName ||
                !form.username ||
                !form.email ||
                form.password.length < 8 ||
                form.password.length > 25
            "
            v-if="!isLoading"
            @click="addUser"
          >
            Add User
          </button>
          <button disabled class="btn btn-primary" v-if="isLoading">
            Adding...
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CryptoJs from "crypto-js";
export default {
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
  methods: {
    addUser() {
      this.isLoading = true;
      this.$appAxios
        .post("/user/add", {
          fullName: this.form.fullName,
          username: this.form.username,
          email: this.form.email,
          bio: this.form.bio,
          password: CryptoJs.SHA256(this.form.password).toString(),
          password_confirmation: CryptoJs.SHA256(this.form.password).toString(),
          accType: this.form.accType,
        })
        .then((res) => {
          this.form.fullName = null;
          this.form.username = null;
          this.form.email = null;
          this.form.bio = null;
          this.form.password = null;
          this.form.accType = 0;
          this.$store.state.Users.users.unshift(res.data.user);
          this.$notify({
            type: "success",
            title: res.data.message,
          });
        })
        .catch(err => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "User didn't added",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
