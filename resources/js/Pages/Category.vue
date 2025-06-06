<template>
  <the-header></the-header>
  <div class="container column-display gap40 full-width">
    <Grafic :ChartData="ChartData" />
    <div class="column-display gap20 full-width">
      <div class="column-display gap20">
        <h2>{{ title }}</h2>
        <div
          class="actionSection flex center gap20 full-width"
          v-if="extentces.length !== 0"
        >
          <button @click="isModalOpen = true" class="modalWindow">
            Добавить расход
          </button>
          <ModalWindow
            v-model="isModalOpen"
            :ModalWindowInputs="ModalWindowInputs"
            @close="isModalOpen = false"
            @submit="handleSubmit"
          ></ModalWindow>
          <select class="modalWindow" v-model="amountSort" @change="handleSort">
            <option value="">Сортировать по дате</option>
            <option value="asc">От новой к давней</option>
            <option value="desc">От давней к новой</option>
          </select>
          <form
            @submit.prevent="deleteCategory"
            method="DELETE"
            class="center full-width"
          >
            <button type="submit" class="modalWindow danger">
              Удалить категорию
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="extence-section">
      <div
        class="full-width center column-display gap20"
        v-if="extentces.length == 0"
      >
        <h2>Здесь пока что нет расходов</h2>
        <button @click="isModalOpen = true" class="modalWindow addExtence">
          Добавить расход
        </button>
        <ModalWindow
          v-model="isModalOpen"
          :ModalWindowInputs="ModalWindowInputs"
          @close="isModalOpen = false"
          @submit="handleSubmit"
        ></ModalWindow>
      </div>
      <div class="table-container">
        <table v-if="extentces.length !== 0">
          <thead>
            <tr>
              <th v-for="item in theadTitle" :key="item">{{ item }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in extentces" :key="item.id">
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
                  <svg
                    width="32"
                    height="32"
                    viewBox="0 0 32 32"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M28.415 9.17144L22.8288 3.58644C22.643 3.40067 22.4225 3.25331 22.1799 3.15277C21.9372 3.05223 21.6771 3.00049 21.4144 3.00049C21.1517 3.00049 20.8916 3.05223 20.6489 3.15277C20.4062 3.25331 20.1857 3.40067 20 3.58644L4.58626 19.0002C4.39973 19.1852 4.25185 19.4055 4.15121 19.6482C4.05057 19.8909 3.99917 20.1512 4.00001 20.4139V26.0002C4.00001 26.5306 4.21072 27.0393 4.5858 27.4144C4.96087 27.7895 5.46958 28.0002 6.00001 28.0002H27C27.2652 28.0002 27.5196 27.8948 27.7071 27.7073C27.8947 27.5198 28 27.2654 28 27.0002C28 26.735 27.8947 26.4806 27.7071 26.2931C27.5196 26.1055 27.2652 26.0002 27 26.0002H14.415L28.415 12.0002C28.6008 11.8145 28.7481 11.594 28.8487 11.3513C28.9492 11.1086 29.001 10.8485 29.001 10.5858C29.001 10.3231 28.9492 10.063 28.8487 9.82034C28.7481 9.57766 28.6008 9.35716 28.415 9.17144ZM17 9.41394L19.0863 11.5002L8.50001 22.0864L6.41376 20.0002L17 9.41394ZM6.00001 26.0002V22.4139L9.58626 26.0002H6.00001ZM12 25.5864L9.91501 23.5002L20.5 12.9139L22.5863 15.0002L12 25.5864ZM24 13.5864L18.415 8.00019L21.415 5.00019L27 10.5864L24 13.5864Z"
                      fill="#343330"
                    />
                  </svg>
                </Link>

                <form @submit.prevent="deleteExtence(item.id)">
                  <button type="submit" class="transparentBtn">
                    <svg
                      width="23"
                      height="23"
                      viewBox="0 0 23 23"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <rect
                        width="4.06581"
                        height="28.4607"
                        rx="2.03291"
                        transform="matrix(0.707107 0.707107 -0.707117 0.707097 20.125 0.000488281)"
                        fill="#343330"
                      />
                      <rect
                        width="4.06581"
                        height="28.4607"
                        rx="2.03291"
                        transform="matrix(0.707107 -0.707107 0.707097 0.707117 0.000244141 2.875)"
                        fill="#343330"
                      />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>

import ModalWindow from "@/Components/ModalWindow.vue";
import Grafic from "@/Components/Grafic.vue";
import { reactive, ref, watch } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
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
const isModalOpen = ref(false);
const dateSort = ref("");
const amountSort = ref("");

const ModalWindowInputs = reactive({
  title: "Добавление расхода",
  inputValues: [
    {
      placeholder: "Название",
      name: "title",
    },
    {
      placeholder: "Сумма",
      name: "cost",
    },
  ],
  buttonValues: [
    {
      title: "Создать",
    },
    {
      title: "Отмена",
    },
  ],
});

const handleSort = async () => {
  if (dateSort.value) {
    if (dateSort.value === "asc") {
      extentces.value.sort(
        (a, b) => new Date(a.raw_created_at) - new Date(b.raw_created_at)
      );
    } else {
      extentces.value.sort(
        (a, b) => new Date(b.raw_created_at) - new Date(a.raw_created_at)
      );
    }
    amountSort.value = "";
  } else if (amountSort.value) {
    if (amountSort.value === "asc") {
      extentces.value.sort((a, b) => a.cost - b.cost);
    } else {
      extentces.value.sort((a, b) => b.cost - a.cost);
    }
    dateSort.value = "";
  } else {
    try {
      const response = await axios.get(
        route("extences.sort", {
          id: carId,
          category: categoryId,
          sort_by: "created_at",
          direction: "asc",
        })
      );
      extentces.value = response.data;
    } catch (error) {
      console.error("Ошибка при загрузке данных:", error);
    }
  }
};

const handleSubmit = (formData) => {
  router.post(
    route("addExtence", { id: carId, category: categoryId }),
    {
      title: formData.title,
      cost: formData.cost,
      car_id: carId,
      category_id: categoryId,
    },
    {
      preserveScroll: false,
      onSuccess: (response) => {
        const newExtence = {
          id: response.props.extences[response.props.extences.length - 1].id,
          title: formData.title,
          cost: formData.cost,
          created_at: new Date().toISOString().split("T")[0],
        };
        extentces.value.push(newExtence);
      },
    }
  );
};

const deleteCategory = () => {
  if (!confirm("Вы уверены, что хотите удалить категорию?")) {
    return;
  }

  router.delete(
    route("deleteCategory", {
      id: carId,
      category: categoryId,
      preserveScroll: true,
    })
  );
};

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
form {
  max-width: 350px;
}

h2 {
  font-weight: var(--bold);
}

.actionSection {
  padding: 30px;
  background-color: var(--color7);
  border-radius: 6px;
}

select {
  border-radius: 6px;
  padding-left: 30px;
  font-weight: normal;
}

.addExtence {
  background-color: var(--color7);
}

@media (max-width: 768px) {
  .actionSection {
    justify-content: center;
    flex-wrap: wrap;
    max-width: 100%;
  }

  .modalWindow {
    max-width: 100%;
  }
}
</style>

