<template>
  <the-header></the-header>
  <div class="container center">
    <form
      @submit.prevent="submit"
      class="form-control column-display  full-width"
    >
      <h1>Новый автомобиль</h1>
      <input
        type="text"
        v-model="form.title"
        placeholder="Название автомобиля (необязательно)"
        class="input"
      />
      <select v-model="form.mark_id" @change="loadPatterns" class="input">
        <option value="">Выберите марку</option>
        <option v-for="mark in marks" :key="mark.id" :value="mark.id">
          {{ mark.title }}
        </option>
      </select>

      <select
        v-model="form.pattern_id"
        @change="loadGenerations"
        :disabled="!form.mark_id"
        class="input"
      >
        <option value="">Выберите модель</option>
        <option
          v-for="pattern in patterns"
          :key="pattern.id"
          :value="pattern.id"
        >
          {{ pattern.title }}
        </option>
      </select>

      <select
        v-model="form.generation_id"
        :disabled="!form.pattern_id"
        class="input"
      >
        <option value="">Выберите поколение</option>
        <option
          v-for="generation in generations"
          :key="generation.id"
          :value="generation.id"
        >
          {{ generation.title }}
        </option>
      </select>

      <button type="submit" class="edit-btn full-width">Создать</button>
    </form>
  </div>
</template>

<script setup>

import { ref, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  user_id: Number,
  marks: Array,
  patterns: Array,
  generations: Array,
});

const form = useForm({
  title: "",
  user_id: props.user_id,
  mark_id: null,
  pattern_id: null,
  generation_id: null,
});

const patterns = ref(props.patterns);
const generations = ref(props.generations);

const loadPatterns = async () => {
  if (!form.mark_id) {
    patterns.value = [];
    form.pattern_id = null;
    return;
  }

  try {
    const response = await axios.get(route("api.patterns"), {
      params: { mark_id: form.mark_id },
    });
    patterns.value = response.data;
    form.pattern_id = null;
    form.generation_id = null;
  } catch (error) {
    console.error("Error loading patterns:", error);
  }
};

const loadGenerations = async () => {
  if (!form.pattern_id) {
    generations.value = [];
    form.generation_id = null;
    return;
  }

  try {
    const response = await axios.get(route("api.generations"), {
      params: { pattern_id: form.pattern_id },
    });
    generations.value = response.data;
    form.generation_id = null;
  } catch (error) {
    console.error("Error loading generations:", error);
  }
};

const submit = () => {
  form.post(route("newCar.store"));
};
</script>
