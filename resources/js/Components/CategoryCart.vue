<template>
  <div>
    <Link :href="route(`${href}`, { id: car_id, category: category })">
      <div class="carInfo-item-photo"></div>
    </Link>
    <div class="carInfo-item-title full-center-row-display">
      <h2>{{ title }}</h2>
      <form @submit.prevent="deleteCategory" method="DELETE" class="center-column">
        <button type="submit" class="carInfo-item__destroyBtn"></button>
      </form>
    </div>
  </div>
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

function deleteCategory() {
  router.delete(
    route("deleteCategory", { id: props.car_id, category: props.category })
  );
}
</script>
