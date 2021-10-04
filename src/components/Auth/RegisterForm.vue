<template>
  <form method="post" @submit.prevent="register()">
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Full name"
        v-model="fullName.value"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user"></span>
        </div>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="fullName.errors.length > 0"
      v-text="fullName.errors[0]"
    ></small>

    <div class="input-group mt-3">
      <input
        type="text"
        class="form-control"
        placeholder="User name"
        v-model="username.value"
      />
      <div class="input-group-append">
        <div class="input-group-text" v-if="username.isLoading">
          <span>Verifing...</span>
        </div>
        <div class="input-group-text" v-else-if="username.isUseable">
          <span class="text-success">
            Verified <i class="fas fa-check"></i>
          </span>
        </div>
        <div class="input-group-text" v-else>
          <span
            v-show="username.value"
            style="cursor:pointer;"
            @click="checkUsername()"
            class="text-danger"
          >
            Verify <i class="fas fa-times"></i>
          </span>
        </div>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="username.errors.length > 0"
      v-text="username.errors[0]"
    ></small>

    <div class="input-group mt-3">
      <input
        type="text"
        class="form-control"
        placeholder="Email"
        v-model="email.value"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="email.errors.length > 0"
      v-text="email.errors[0]"
    ></small>

    <div class="input-group mt-3">
      <input
        type="password"
        class="form-control"
        placeholder="Password"
        v-model="password.value"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="password.errors.length > 0"
      v-text="password.errors[0]"
    ></small>

    <div class="input-group mt-3">
      <input
        type="password"
        class="form-control"
        placeholder="Retype password"
        v-model="password_confirmation.value"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="password_confirmation.errors.length > 0"
      v-text="password_confirmation.errors[0]"
    ></small>

    <div class="row mt-3">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="agreeTerms" name="terms" value="agree" />
          <label for="agreeTerms">
            I agree to the
            <a
              class="text-primary ml-1"
              style="cursor:pointer;"
              data-toggle="modal"
              data-target="#exampleModal"
              >terms</a
            >
          </label>
          <RegisterTos />
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button
          v-if="!isLoading"
          type="submit"
          class="btn btn-primary btn-block"
          :disabled="
            !fullName.value ||
              !email.value ||
              !password.value ||
              !password_confirmation.value ||
              !username.isUseable ||
              !username.value
          "
        >
          Register
        </button>
        <button class="btn btn-primary btn-block" v-else disabled>Registering...</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</template>
<script>
import RegisterTos from "@/components/Auth/RegisterTos.vue";
import CryptoJs from "crypto-js";

export default {
  components: {
    RegisterTos,
  },
  data() {
    return {
      fullName: {
        value: null,
        errors: [],
      },
      username: {
        value: null,
        errors: [],
        isUseable: false,
        isLoading: false,
      },
      email: {
        value: null,
        errors: [],
      },
      password: {
        value: null,
        errors: [],
      },
      password_confirmation: {
        value: null,
        errors: [],
      },
      isLoading: false,
    };
  },
  methods: {
    register() {
      this.isLoading = true;
      const validateEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const valiatePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
      const validateFullName = /^([a-z']+(-| )?)+$/i;
      const validateUsername = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
      this.fullName.errors = [];
      this.username.errors = [];
      this.email.errors = [];
      this.password.errors = [];
      this.password_confirmation.errors = [];
      if (this.fullName.value.length > 30) {
        this.fullName.errors.unshift(
          "Fullname field not be greather than 30 characters."
        );
      }
      if (!validateFullName.test(this.fullName.value)) {
        this.fullName.errors.unshift("Please enter valid fullname.");
      }
      if (!validateUsername.test(this.username.value)) {
        this.username.errors.unshift("Please enter valid username.");
      }
      if (this.username.value.length < 5 && !this.username.value.length > 25) {
        this.username.errors.unshift(
          "Username must be between 5 and 25 characters."
        );
      }
      if (!validateEmail.test(this.email.value)) {
        this.email.errors.unshift("Please enter valid email.");
      }
      if (this.password.value.length < 8 && this.password.value.length > 25) {
        this.password.errors.unshift(
          "Password must be between 8 and 25 characters."
        );
      }
      if (!valiatePassword.test(this.password.value)) {
        this.password.errors.unshift("Please enter valid password.");
      }
      if (this.password.value !== this.password_confirmation.value) {
        this.password.errors.unshift("Passwords not matching.");
      }
      if (
        this.fullName.errors.length == 0 &&
        this.email.errors.length == 0 &&
        this.password.errors.length == 0 &&
        this.password_confirmation.errors.length == 0 &&
        this.username.errors.length == 0
      ) {
        this.$appAxios
          .post("/register", {
            username: this.username.value,
            fullName: this.fullName.value,
            password: CryptoJs.SHA256(this.password.value).toString(),
            email: this.email.value,
            password_confirmation: CryptoJs.SHA256(
              this.password_confirmation.value
            ).toString(),
          })
          .then(() => {
            this.$notify({
              type: "success",
              title: "Successfully registered redirecting...",
            });
            this.fullName.value = null;
            this.username.value = null;
            this.password.value = null;
            this.email.value = null;
            this.password_confirmation.value = null;
            this.username.isUseable = false;
            this.username.isLoading = false;
            this.$router.push({ name: "Login" });
          })
          .catch((err) => {
            if (err.response.data.errors.email[0]) {
              this.email.errors.unshift(err.response.data.errors.email[0]);
            }
            this.$notify({
              type: "error",
              title: "Didn't registered",
            });
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        this.$notify({
          type: "error",
          title: "Didnt registered",
        });
        this.isLoading = false;
      }
    },
    checkUsername() {
      this.username.isLoading = true;
      this.username.errors = [];
      const validateUsername = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
      if (!validateUsername.test(this.username.value)) {
        this.username.errors.unshift("Please enter valid username.");
        this.username.isLoading = false;
        return;
      }
      if (this.username.value.length < 5 && !this.username.value.length > 25) {
        this.username.errors.unshift(
          "Username must be between 5 and 25 characters."
        );
        this.username.isLoading = false;
        return;
      }
      this.$appAxios
        .post("/checkusername", {
          username: this.username.value,
        })
        .then(() => {
          this.username.isUseable = true;
        })
        .catch((err) => {
          this.username.isUseable = false;
          this.username.errors.push(err.response.data.message);
        })
        .finally(() => {
          this.username.isLoading = false;
        });
    },
  },
  watch: {
    "username.value": function() {
      this.username.isUseable = false;
    },
  },
};
</script>
