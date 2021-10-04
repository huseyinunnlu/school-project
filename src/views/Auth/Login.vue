<template>
  <body class="hold-transition login-page">
    <div class="login-box my-3">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

            <LoginForm />

          <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <router-link :to="{ name: 'Register' }" class="text-center"
              >Register a new membership</router-link
            >
          </p>
        </div>
      </div>
    </div>
  </body>
</template>
<script> 
import LoginForm from '@/components/Auth/LoginForm.vue'
export default {
    components: {
        LoginForm,
    }
}
</script>
