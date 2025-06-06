<template>
  <the-header></the-header>
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display full-width"
    >
      <h2>Изменить данные</h2>
      <div class="full-width column-display gap20">
        <input
          type="text"
          class="input"
          name="title"
          placeholder="Название"
          v-model="form.title"
        />
        <input
          type="text"
          class="input"
          name="cost"
          placeholder="Сумма"
          v-model="form.cost"
        />
      </div>
      <button type="submit" class="login">Изменить</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
const props = defineProps({
  extenceInfo: Object,
});

const extence = reactive(props.extenceInfo)[0];
console.log(extence)
const form = useForm({
  title: props.extenceInfo[0]?.title || "",
  cost: props.extenceInfo[0]?.cost || "",
});
const submit = () => {
  form.patch(route("updateExtence", {id: extence.car_id, category: extence.category_id, extence: extence.id}), {
    title: form.title,
    cost: form.cost,

  });
};
</script>

<style scoped>
h2 {
  font-weight: var(--bold);
}
</style>
