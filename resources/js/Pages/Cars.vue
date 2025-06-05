<template>
  <TheHeader></TheHeader>
  <div class="container">
    <div class="profile column-display">
      <div class="user-section flex gap40">
        <div class="user-photo full-width"></div>
        <div class="user-info full-column-display">
          <h2>
            {{ fullName }}
          </h2>
          <div>
            <h4>
              {{ email }}
            </h4>
          </div>
          <Link :href="route('editProfile')" class="edit-btn center">Изменить пароль</Link>
        </div>
      </div>
      <div class="userCars-section column-display gap40 full-width">
        <div class="createAuto flex gap10">
          <h2>Мои автомобили</h2>
          <Link
          :href="route(`${href}`)"
          :carInfo="newCar"
           class="addCar"></Link>
        </div>
        <div :class="[carsInfo.length >= 4 ? `${mainStyles} ${justifySB}`: `${mainStyles}`]">
          <CarCart
            v-for="item in carsInfo"
            :key="item.id"
            :id="item.id"
            :title="item.title"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useToast } from 'vue-toastification';
import { reactive, ref } from "vue";
import CarCart from "@/Components/carCart.vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  email: String,
  carsInfo: {
    type: Object,
    required: true,
  },
  counter: Number,
});

const mainStyles = ref('flex flex-wrap gap40');
const justifySB = ref('for-over-length');

const href = ref("newCar");
const newCar = reactive({
    title: 'Новый автомобиль',
    inputValue: [
        {
            name: 'title',
            placeholder: 'Название (необязательно)',
            type: 'text',
        },
        {
            name: 'mark_id',
            placeholder: 'Марка',
        },
        {
            name: 'pattern_id',
            placeholder: 'Модель',
        },
        {
            name: 'pattern_id',
            placeholder: 'Поколение',
        },
    ]
});

const fullName = `
${capitalize(props.user.surname)}
${capitalize(props.user.name)}
${capitalize(props.user.patronymic)}`;

const email = props.email;

function capitalize(item) {
  return item[0].toUpperCase() + item.substring(1);
}
</script>

<style scoped>
.user-info > h2 {
  font-weight: var(--bold);
}

.profile {
  gap: 100px;
}

.createAuto > h2 {
  font-weight: var(--bold);
}
</style>
