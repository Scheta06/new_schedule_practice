<template>
  <the-header></the-header>
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display full-width"
    >
      <h2>Изменить данные для расхода: {{ extence.title }}</h2>
      <div class="full-width column-display gap20">
        <input
          type="text"
          class="input"
          name="title"
          placeholder="Название"
          :value="extence.title"
        />
        <input
          type="text"
          class="input"
          name="cost"
          placeholder="Сумма"
          :value="extence.cost"
        />
      </div>
      <button type="submit" class="login">Изменить</button>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
const props = defineProps({
  extenceInfo: Object,
});

const extence = reactive(props.extenceInfo)[0];
</script>

<style scoped>
h2 {
  font-weight: var(--bold);
}
</style>
