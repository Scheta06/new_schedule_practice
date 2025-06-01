<template>
  <the-header></the-header>
  <div class="container column-display gap40">
    <div class="category-grafic-block full-width"></div>

    <h2>{{ title }}</h2>


    <div class="extence-section">
      <table>
        <thead>
          <tr>
            <th v-for="item in theadTitle" :key="item">{{ item }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in extences" :key="item">
              <td>{{ item.title }}</td>
              <td>{{ item.created_at }}</td>
              <td>{{ item.cost }}</td>
              <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
const props = defineProps({
  categories: String,
  extences: Object,
});

const extences = reactive(props.extences);

const title = props["categories"].title;

const theadTitle = [
    'Название',
    'Дата',
    'Сумма',
    'Действия',
];

console.log(props);
</script>

<style scoped>
h2 {
  font-weight: var(--bold);
}
</style>

