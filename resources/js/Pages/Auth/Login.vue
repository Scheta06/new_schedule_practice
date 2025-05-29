<template>
  <TheHeader />
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display full-width"
    >
      <h1>Авторизация</h1>
      <div class="full-width column-display gap20">
        <Input
          v-for="item in inputValues"
          :key="item.title"
          v-model="form[item.name]"
          :placeholder="item.placeholder"
          :type="item.type"
          :name="item.name"
        ></Input>
      </div>
      <button type="submit" class="login">Войти</button>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import { useForm } from "@inertiajs/vue3";

const inputValues = reactive([
  {
    placeholder: "E-mail",
    name: "email",
    type: "email",
  },
  {
    placeholder: "Пароль",
    name: "password",
    type: "password",
  },
]);

const form = useForm({
  email: "",
  password: "",
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset("password"),
  });
};
</script>
