<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const page = usePage();
const show = ref(false);
const message = computed(() => page.props.flash.success);
const type = computed(() => page.props.flash.type || "success");

watch(
  message,
  (newVal) => {
    if (newVal) {
      show.value = true;
      setTimeout(() => (show.value = false), 3000);
    }
  },
  { immediate: true }
);
</script>

<template>
  <transition name="fade">
    <div v-if="show" :class="['notification', type]">
      {{ message }}
    </div>
  </transition>
</template>

<style scoped>
.notification {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 12px 24px;
  color: white;
  border-radius: 4px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.notification.success {
  background-color: #4caf50;
}

.notification.error {
  background-color: #f44336;
}

.notification.warning {
  background-color: #ff9800;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s, transform 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
