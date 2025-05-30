<template>
  <the-header></the-header>
  <div class="container">
    <div class="carInfo-section column-display gap100">
      <div class="carInfo-block flex gap40">
        <div class="car-photo full-width"></div>
        <div class="car-info full-column-display full-width">
          <h2>Данные об автомобиле</h2>
          <div class="column-display gap30">
            <div
              class="for-over-length"
              v-for="item in carInfoTitle"
              :key="item.title"
            >
              <h3>{{ item.title }}</h3>
              <h3 class="bold">{{ item.fetchInfo }}</h3>
            </div>
          </div>
          <div class="for-over-length gap10">
            <Link href="/" class="edit-btn center full-width"> Редактировать </Link>
            <Link href="/" class="edit-btn center full-width"> Добавить расход </Link>
          </div>
        </div>
      </div>
      <div class="carInfo-categories-section">
        <h2 class="bold">Расходы автомобиля</h2>
        <div class="carInfo-categories-block">
            
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
const props = defineProps({
  carInfo: Object,
});

const carInfo = reactive(props);

const carInfoTitle = reactive([
  {
    title: "Название",
    fetchInfo: props.carInfo[0].title,
  },
  {
    title: "Марка",
    fetchInfo: props.carInfo[0].mark.title,
  },
  {
    title: "Модель",
    fetchInfo: props.carInfo[0].pattern.title,
  },
  {
    title: "Поколение",
    fetchInfo: props.carInfo[0].generation.title,
  },
]);
</script>
<style scoped>
.car-info > .for-over-length {
  margin-top: var(--mrg40);
}
.car-info > h2 {
  font-weight: var(--bold);
}

.edit-btn {
    max-width: 300px;
}
</style>