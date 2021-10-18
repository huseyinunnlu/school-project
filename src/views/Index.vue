<template>
  <body style="background-color:#222; width:100%; height:100%;">
    <Header />
    <div class="container">
      <div class="row">
        body
      </div>
    </div>
    <Footer />
  </body>
</template>
<script>
import Header from "@/components/Header/Header.vue";
import Footer from "@/components/Footer/Footer.vue";
export default {
  components: {
    Header,
    Footer
  },
};
</script>
