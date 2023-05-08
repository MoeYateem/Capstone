<template>
  <categories />
  <newsletter />
  <contactUs />
</template>

<script>
import ContactUs from "./contactUs.vue";
import categories from "./categories.vue";
import newsletter from "./newsletter.vue";

export default {
  components: {
    ContactUs,
    categories,
    newsletter,
  },
};
</script>
