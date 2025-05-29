<template>
  <TheHeader></TheHeader>
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display full-width"
    >
      <h1>Регистрация</h1>
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
      <button class="login" type="submit">Зарегистрироваться</button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
const inputValues = reactive([
  {
    placeholder: "Фамилия",
    name: "surname",
    type: "text",
  },
  {
    placeholder: "Имя",
    name: "name",
    type: "text",
  },
  {
    placeholder: "Отчество",
    name: "patronymic",
    type: "text",
  },
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
  {
    placeholder: "Повтор пароля",
    name: "password_confirmation",
    type: "password",
  },
]);

const form = useForm({
  surname: "",
  name: "",
  patronymic: "",
  email: "",
  password: "",
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset(["password", 'password_confirmation']),
  });
};
</script>
