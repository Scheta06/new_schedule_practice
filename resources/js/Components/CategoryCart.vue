<template>
  <div class="flex-wrap">
    <Link :href="route(`${href}`, { id: car_id, category: category })">
      <div class="carInfo-item-title">
        <h2>{{ title }}</h2>
      </div>
    </Link>
    <div class="actionBlock flex gap30 full-width">
      <Link
        :href="route(`${href}`, { id: car_id, category: category })"
        class="carInfo-action_btn center danger"
        >Подробнее</Link
      >
      <form
        @submit.prevent="deleteCategory"
        method="DELETE"
        class="center full-width"
      >
        <button type="submit" class="carInfo-action_btn center danger">
          Удалить
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const href = ref("CategoryCart");
const props = defineProps({
  title: String,
  car_id: Number,
  category: Number,
});

const deleteCategory = () => {
  if (!confirm("Вы уверены, что хотите удалить категорию?")) {
    return;
  }

  router.delete(
    route("deleteCategory", {
      id: props.car_id,
      category: props.category,
      preserveScroll: true,
    })
  );
};
</script>

<style scoped>
.carInfo-action_btn {
  width: 100%;
  min-height: 60px;
  max-width: 200px;
  border-radius: 4px;
  font-size: var(--font-size3);
  font-weight: var(--bold);
}

.actionBlock {
  max-width: 420px;
}

h2 {
  transition: all 0.3s ease;
}

h2:hover {
  color: orange;
}
</style>
