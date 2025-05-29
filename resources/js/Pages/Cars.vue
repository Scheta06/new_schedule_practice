<template>
  <div>
    <div class="profile-section flex">
      <div class="profile-photo full-width"></div>
      <div class="profile-info full-column-display full-width">
        <h2>

        </h2>
        <div class="emal"></div>
        <router-link to="">
          <button class="editProfile full-width">Редактировать профиль</button>
        </router-link>
      </div>
    </div>
    <div class="car-section column-display">
      <div>
        <h2>Мои автомобили</h2>
      </div>
      <div class="car-block flex flex-wrap full-width">
        <carCart v-for="item in fetchInfo" :key="item.id" :title="item.title" />
      </div>
    </div>
  </div>
</template>

<script setup>

import { onMounted } from "vue";
import carCart from "./../Components/Input.vue";
import api from "./../services/api.js";
import { ref, reactive } from "vue";
const email = ref("admin@bk.ru");
const fetchInfo = reactive([]);

</script>
