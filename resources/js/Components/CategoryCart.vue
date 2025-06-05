<template>
  <Link :href="route(`${href}`, { id: car_id, category: category })">
    <div class="carInfo-item-title full-center-row-display">
      <h2>{{ title }}</h2>
    </div>
  </Link>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const href = ref("CategoryCart");
const props = defineProps({
  title: String,
  car_id: Number,
  category: Number,
});


</script>
