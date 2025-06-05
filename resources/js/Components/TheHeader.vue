<template>
  <header class="header full-center-length">
    <Link :href="route('myCars')" class="logotype">
      {{ logoTitle }}
    </Link>
    <button class="nav-bar-btn full-column-display" @click="visible = !visible" @keydown.right="visible = !visible">
      <div class="nav-bar-row" v-for="item in 3" :key="item"></div>
    </button>
    <div class="nav-bar full-height" v-if="visible">
      <ul class="column-display gap30">
        <li class="list-item" v-for="item in links" :key="item">
          <Link :href="route(`${item.href}`)" :method="item.method">
            {{ item.title }}
          </Link>
        </li>
      </ul>
    </div>
  </header>
</template>

<script setup>
import { ref, reactive } from "vue";
const logoTitle = ref("MyCar");
const visible = ref(false);
import { Link } from "@inertiajs/vue3";

const links = reactive([
    {
        title: 'Мой профиль',
        href: 'myCars',
        method: 'GET'
    },
    {
        title: 'Выйти',
        href: 'logout',
        method: 'POST'
    },
]);
</script>

<style scoped>
li.list-item > button, li.list-item > a {
    font-weight: var(--bold);
    font-size: var(--font-size2);
}
</style>
