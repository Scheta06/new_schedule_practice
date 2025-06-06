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
            <button class="danger edit-btn center full-width " @click="deleteCar">Удалить автомобиль</button>
          </div>
        </div>
      </div>
      <div class="carInfo-categories-section">
        <div
          class="createAuto flex gap10 column-center"
          v-if="categories.length !== 0"
        >
          <h2>Категории расходов</h2>
          <form @submit.prevent="addNewCategory">
            <button type="submit" class="addCar"></button>
          </form>
        </div>
        <div
          class="flex center column-display gap20"
          v-if="categories.length === 0"
        >
          <h2>Здесь пока что нет категорий</h2>
          <form @submit.prevent="addNewCategory" class="center full-width">
            <button type="submit" class="addCarNothing full-width">
              Добавить
            </button>
          </form>
        </div>
        <div class="selectCategory" v-if="categories.length !== 0">
          <input
            type="text"
            class="input"
            placeholder="Введите название категории"
            v-model="searchQuery"
          />
        </div>
        <div class="carInfo-item-section flex flex-wrap gap20">
          <CategoryCart
            :class="
              categories.length >= 3
                ? `${mainStyles} ${sideStyles}`
                : mainStyles
            "
            v-for="item in filteredCategories"
            :key="item.id"
            :title="item.title"
            :car_id="id"
            :category="item.id"
          >
          </CategoryCart>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import CategoryCart from "@/Components/CategoryCart.vue";
import { ref, reactive, computed, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
const props = defineProps({
  carInfo: Object,
  user_id: Number,
  categories: Object,
});

const carInfo = reactive(props);
const id = carInfo["carInfo"][0].id;

const isModalOpen = ref(false);

const mainStyles = ref("carInfo-item full-column-display full-width");
const sideStyles = ref("carInfo-item-medium");

const carInfoTitle = [
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
];

const deleteCar = () => {
  if (!confirm("Вы уверены, что хотите удалить автомобиль?")) {
    return;
  }

  router.delete(
    route("deleteCar", {
      id: id,
      preserveScroll: true,
    })
  );
};

const searchQuery = ref("");
const filteredCategories = computed(() => {
  if (!searchQuery.value) return Object.values(props.categories);

  return Object.values(props.categories).filter((category) =>
    category.title.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

function capitalize(val) {
  return String(val).charAt(0).toUpperCase() + String(val).slice(1);
}

function addNewCategory() {
  const value = prompt("Название категории");

  if (value && value.trim() !== "") {
    router.post(route("addCategory", ["id", id]), {
      title: value.trim(),
      car_id: id,
    });
  }
}
</script>
<style scoped>
.car-info > .for-over-length {
  margin-top: var(--mrg40);
}
h2 {
  font-weight: var(--bold);
}

.createAuto > h2 {
  font-weight: var(--bold);
}

.selectCategory {
  margin-top: var(--mrg40);
  max-width: 450px;
  max-height: 60px;
}

.addCarNothing {
  max-width: 350px;
  min-height: 60px;
  font-weight: var(--bold);
}

.carInfo-categories-section > .flex > h2 {
    text-align: center;
}
</style>
