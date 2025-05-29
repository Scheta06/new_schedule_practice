<template>
  <div>
    <Link
      href="/cars:id"
      class="car-item full-column-display full-height full-width"
    >
      <div class="car-info-title">
        {{ mark }}
      </div>
      <div class="car-title">
        {{ title }}
      </div>
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
    title: String,
    mark: String
});
</script>
