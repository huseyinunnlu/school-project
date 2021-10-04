<template>
  <div class="hold-transition register-page">
    <div class="pt-2">
      <div class="register-box py-2">
        <div class="register-logo">
          <router-link :to="{name:'Index'}"><b>Mod</b>Hub</router-link>
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            <RegisterForm />
            <SocialRegister />
            
            <router-link :to="{name:'Login'}" class="text-center"
              >I already have a membership</router-link
            >
          </div>
          <!-- /.form-box -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import RegisterForm from "@/components/Auth/RegisterForm.vue";
import SocialRegister from "@/components/Auth/SocialRegister.vue";

export default {
  components: {
    RegisterForm,
    SocialRegister,
  },
};
</script>
