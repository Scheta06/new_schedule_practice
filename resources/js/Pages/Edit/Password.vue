<template>
  <the-header></the-header>
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display gap40 full-width"
    >
      <h2>Изменение пароля</h2>
      <div class="full-width column-display gap20">
        <input
          v-for="item in inputValues"
          :key="item.name"
          type="password"
          :placeholder="item.title"
          :name="item.name"
          v-model="form[item.name]"
          class="input"
        />
        <div v-if="form.errors.current_password" class="error">
          {{ form.errors.current_password }}
        </div>
        <div v-if="form.errors.new_password" class="error">
          {{ form.errors.new_password }}
        </div>
      </div>

      <button class="login" type="submit" :disabled="form.processing">
        {{ form.processing ? "Обновление..." : "Изменить" }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";

const inputValues = reactive([
  {
    title: "Текущий пароль",
    name: "current_password",
  },
  {
    title: "Новый пароль",
    name: "new_password",
  },
  {
    title: "Повтор нового пароля",
    name: "new_password_confirmation",
  },
]);

const form = useForm({
  current_password: "",
  new_password: "",
  new_password_confirmation: "",
});

function submit() {
  form.patch(route("updateProfile"), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      // Можно добавить уведомление об успехе
    },
    onError: (errors) => {
      console.log("Ошибки валидации:", errors);
    },
  });
}
</script>

<style scoped>
h2 {
  font-weight: var(--bold);
}
.error {
  color: red;
  font-size: 14px;
  margin-top: -15px;
  margin-bottom: 10px;
}
</style>
