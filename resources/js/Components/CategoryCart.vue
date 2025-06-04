<template>
  <Link :href="route(`${href}`, { id: car_id, category: category })">
    <div class="carInfo-item-title full-center-row-display">
      <h2>{{ title }}</h2>
      <form
        @submit.prevent="deleteCategory"
        method="DELETE"
        class="center-column"
      >
        <button type="submit" class="carInfo-item__destroyBtn">
            <svg
              width="23"
              height="23"
              viewBox="0 0 23 23"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect
                width="4.06581"
                height="28.4607"
                rx="2.03291"
                transform="matrix(0.707107 0.707107 -0.707117 0.707097 20.125 0.000488281)"
                fill="#343330"
              />
              <rect
                width="4.06581"
                height="28.4607"
                rx="2.03291"
                transform="matrix(0.707107 -0.707107 0.707097 0.707117 0.000244141 2.875)"
                fill="#343330"
              />
            </svg>
          </button>
      </form>
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

function deleteCategory() {
  router.delete(
    route("deleteCategory", { id: props.car_id, category: props.category })
  );
}
</script>
