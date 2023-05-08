<script setup>
import navBar from "./components/navBar.vue";
import login from "./components/login.vue";
import signup from "./components/signup.vue";
import { RouterView, RouterLink } from "vue-router";
</script>

<template>
  <navBar />
  <RouterView />
  <!-- <login /> -->
  <!-- <signup /> -->
</template>

<style scoped></style>
