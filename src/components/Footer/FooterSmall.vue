<template>
  <footer>
    <div class="container d-flex flex-column">
      <FooterBig />
      <FooterSmall />
    </div>
  </footer>
</template>
<script>
import FooterBig from "@/components/Footer/FooterBig.vue";
export default {
  components: {
    FooterBig,
  },
};
</script>
