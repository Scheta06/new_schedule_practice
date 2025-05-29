<template>
  <div class="full-width">
    <input
      :type="type"
      :name="name"
      :placeholder="placeholder"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="input"
    />
  </div>
</template>

<script setup>
defineProps({
  title: String,
  type: String,
  name: String,
  placeholder: String,
  modelValue: [String, Number],
});
</script>

<style scoped>
</style>
