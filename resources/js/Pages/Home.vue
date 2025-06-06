<template>
  <TheHeader></TheHeader>
  <div class="container">
    <Welcome v-if="!Auth"></Welcome>
    <Cars v-else ></Cars>
  </div>
</template>

<script setup>

import Welcome from "./../Components/Welcome.vue";
import TheHeader from "@/Components/TheHeader.vue";
import Cars from "@/Pages/Cars.vue";
</script>
