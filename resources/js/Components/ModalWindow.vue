<template>
  <div v-if="modelValue" class="modal-overlay">
    <div class="container center full-width">
      <form
        @submit.prevent="submitForm"
        class="form-control column-display gap40 center full-width"
      >
        <h2>{{ ModalWindowInputs.title }}</h2>
        <div class="column-display gap20 full-width">
          <input
            :type="props.type"
            class="modalInput"
            v-for="(item, index) in ModalWindowInputs['inputValues']"
            :key="index"
            :placeholder="item.placeholder"
            v-model="formData[item.name]"
          />
        </div>
        <div class="buttons for-over-length gap20 full-width">
          <button type="submit" class="buttonModal center">Создать</button>
          <button
            type="button"
            @click="$emit('close')"
            class="buttonModal center"
          >
            Отмена
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
  modelValue: Boolean,
  ModalWindowInputs: Object,
});

const emit = defineEmits(["update:modelValue", "close", "submit"]);

const formData = ref({
  title: "",
  cost: "",
});

const closeModal = () => {
  emit("update:modelValue", false);
  emit("close");
};

const submitForm = () => {
  emit("submit", formData.value);
  emit("update:modelValue", false);
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.form-control {
  background-color: white;
  padding: 50px;
  border-radius: 6px;
}

.modalInput {
  width: 100%;
  min-height: 60px;
  padding-left: 30px;
  border: 2px solid #9a9a9a;
}
h2 {
  font-weight: var(--bold);
}

.buttonModal {
  font-weight: var(--bold);
  max-width: 230px;
  width: 100%;
  min-height: 60px;
  background-color: #b1d4dd;
}
</style>
