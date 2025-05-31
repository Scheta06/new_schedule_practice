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
              <h3 class="bold">{{ capitalize(item.fetchInfo) }}</h3>
            </div>
          </div>
          <div class="flex gap10">
            <Link href="/" class="edit-btn center full-width"
              >Редактировать</Link
            >
          </div>
        </div>
      </div>
      <div class="carInfo-categories-section">
        <div class="createAuto flex gap10 column-center">
          <h2>Категории расходов</h2>
          <form @submit.prevent="addNewCategory">
            <button type="submit" class="addCar"></button>
          </form>
        </div>
        <div class="carInfo-item-section flex flex-wrap gap40">
          <div
            :class="[
              counter >= 3 ? `${mainStyles} ${sideStyles}` : `${mainStyles}`,
            ]"
            v-for="item in categories"
            :key="item"
          >
            <div class="carInfo-item-photo"></div>
            <div class="carInfo-item-title">
              <h2>{{ item.title }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
const props = defineProps({
  carInfo: Object,
  user_id: Number,
  categories: Object,
  counter: Number,
});

const carInfo = reactive(props);

const id = carInfo.id;

const mainStyles = ref("carInfo-item full-column-display full-width");
const sideStyles = ref("carInfo-item-medium");

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

function capitalize(val) {
  return String(val).charAt(0).toUpperCase() + String(val).slice(1);
}

function addNewCategory() {
  const value = prompt("Название категории");

  if (value && value.trim() !== "") {
    axios
      .post(route("addCategory", ["id", id]), {
        title: value.trim(),
      })
      .then((response) => {
        window.location.reload();
      })
      .catch((error) => {
        alert("Ошибка при создании категории");
      });
  } else {
    alert("Категория не создана - название не может быть пустым");
  }
}
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

.createAuto > h2 {
  font-weight: var(--bold);
}
</style>