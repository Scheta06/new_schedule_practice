<template>
  <Link :href="route('carCart', { id: id })" class="carCart full-width">
    <h4>
      {{ title }}
    </h4>
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
  id: Number,
  title: String,
});
</script>

<style scoped>
.carCart > h4 {
  text-align: center;
  font-weight: var(--bold);
}
</style>
