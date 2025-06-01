<template>
  <Link
    :href="route(`${href}`, { id: car_id, category: category })"

  >
    <div class="carInfo-item-photo"></div>
    <div class="carInfo-item-title">
      <h2>{{ title }}</h2>
    </div></Link
  >
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
const mainStyles = ref("carInfo-item full-column-display full-width");
const sideStyles = ref("carInfo-item-medium");
const href = ref("CategoryCart");
const props = defineProps({
  title: String,
  car_id: Number,
  category: Number,
});
</script>
