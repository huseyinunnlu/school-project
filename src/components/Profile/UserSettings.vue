<template>
  <div class="card-body">
    <div class="tab-content">
      <div class="active tab-pane" id="settings">
        <div>
          <form class="form-horizontal" @submit.prevent="updateProfile()">
            <UserProfilePhoto />
            <div class="form-group row">
              <label for="fullName" class="col-sm-2 col-form-label"
                >Full Name</label
              >
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
                  id="fullName"
                  placeholder="Full Name"
                  v-model="form.fullName"
                />
                <small
                  v-if="errors.fullName"
                  v-text="errors.fullName[0]"
                  class="text-danger"
                ></small>
              </div>
            </div>
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
                <small
                  v-if="errors.username"
                  v-text="errors.username[0]"
                  class="text-danger"
                ></small>
              </div>
            </div>
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
                <small
                  v-if="errors.email"
                  v-text="errors.email[0]"
                  class="text-danger"
                ></small>
              </div>
            </div>
            <div class="form-group row">
              <label for="bio" class="col-sm-2 col-form-label">Biography</label>
              <div class="col-sm-10">
                <textarea
                  class="form-control"
                  id="bio"
                  placeholder="Biography"
                  v-model="form.bio"
                ></textarea>
                <small
                  v-if="errors.bio"
                  v-text="errors.bio[0]"
                  class="text-danger"
                ></small>
              </div>
            </div>
            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button
                  type="submit"
                  class="btn btn-primary"
                  :disabled="!form.fullName || !form.username || !form.email"
                  v-if="!isLoading"
                >
                  Update
                </button>
                <button type="submit" class="btn btn-primary" v-if="isLoading">
                  Updating
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import UserProfilePhoto from "@/components/Profile/UserProfilePhoto.vue";
export default {
  components: {
    UserProfilePhoto,
  },
  data() {
    return {
      form: {
        fullName: null,
        username: null,
        email: null,
        bio: null,
      },
      errors: [],
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(["_User"]),
  },
  mounted() {
    this.form.fullName = this._User.fullName;
    this.form.username = this._User.username;
    this.form.email = this._User.email;
    this.form.bio = this._User.bio;
  },
  methods: {
    updateProfile() {
      this.isLoading = true;
      this.errors = [];
      this.$appAxios
        .post("updateprofile", {
          fullName: this.form.fullName,
          username: this.form.username,
          email: this.form.email,
          bio: this.form.bio,
        })
        .then(() => {
          this.$store.state.User.user.fullName = this.form.fullName;
          this.$store.state.User.user.username = this.form.username;
          this.$store.state.User.user.email = this.form.email;
          this.$store.state.User.user.bio = this.form.bio;
          this.$notify({
            type: "success",
            title: "Profile successfully updated.",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "success",
            title: "Profile successfully updated.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
