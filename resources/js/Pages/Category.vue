<template>
  <the-header></the-header>
  <div class="container column-display gap40 full-width">
    <Grafic :ChartData="ChartData"/>

    <div class="column-display gap20 full-width">
      <div class="flex gap15">
        <h2>{{ title }}</h2>
        <button @click="addExtence" class="addCar"></button>
      </div>
    </div>
    <div class="extence-section">
      <table>
        <thead>
          <tr>
            <th v-for="item in theadTitle" :key="item">{{ item }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in extences" :key="item.id">
            <td>{{ item.title }}</td>
            <td>{{ item.created_at }}</td>
            <td>{{ item.cost }}</td>
            <td class="center gap30">
              <Link
                :href="
                  route('editExtence', {
                    id: carId,
                    category: categoryId,
                    extence: item.id,
                  })
                "
              >
                <img src="" />
              </Link>

              <form @submit.prevent="deleteExtence(item.id)">
                <button type="submit" class="transparentBtn">
                  <img src="" alt="delete" />
                </button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import Grafic from '@/Components/Grafic.vue'
import { reactive, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import GraficVue from "@/Components/Grafic.vue";
const props = defineProps({
  categories: Object,
  extences: Array,
  id: String,
  category: String,
  ChartData: Object,
});

const extentces = ref(props.extences);
const title = props["categories"].title;
const theadTitle = ["Название", "Дата", "Сумма", "Действия"];
const carId = props.id;
const categoryId = props.category;

function reverseString(item) {
    return item.split('').reverse().join('');
}

function addExtence() {
  const title = prompt("Введите название расхода");
  const cost = prompt("Введите сумму расхода");

  router.post(
    route("addExtence", { id: carId, category: categoryId }),
    {
      title: title,
      cost: cost,
      car_id: carId,
      category_id: categoryId,
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        router.reload({ only: ["extentces"] });
      },
    }
  );
}

function deleteExtence(extenceId) {
  if (!confirm("Вы уверены, что хотите удалить этот расход?")) {
    return;
  }

  router.delete(
    route("destroyExtence", {
      id: carId,
      category: categoryId,
      extence: extenceId,
    }),
    {
      onSuccess: () => {
        extentces.value = extentces.value.filter(
          (item) => item.id !== extenceId
        );
      },
      onError: (errors) => {
        console.error("Ошибка удаления:", errors);
        alert(
          "Ошибка при удалении: " + (errors.message || "Неизвестная ошибка")
        );
      },
      preserveScroll: true,
    }
  );
}
</script>

<style scoped>
h2 {
  font-weight: var(--bold);
}
</style>

