<template>
  <div class="chart-container">
    <canvas ref="chartCanvas"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { Chart } from "chart.js/auto";

const props = defineProps({
  ChartData: Object,
});

const chartCanvas = ref(null);
let myChart = null;

const prepareData = () => {
  if (!props.ChartData?.data) return { labels: [], datasets: [] };

  const monthNames = [
    "Январь",
    "Февраль",
    "Март",
    "Апрель",
    "Май",
    "Июнь",
    "Июль",
    "Август",
    "Сентябрь",
    "Октябрь",
    "Ноябрь",
    "Декабрь",
  ];

  const monthKeys = [
    "january",
    "february",
    "march",
    "april",
    "may",
    "june",
    "july",
    "august",
    "september",
    "october",
    "november",
    "december",
  ];

  return {
    labels: monthNames,
    datasets: [
      {
        label: props.ChartData.title || "Данные",
        data: monthKeys.map((key) => props.ChartData.data[key]),
        borderColor: "red",
        backgroundColor: "red",
        tension: 0.4,
      },
    ],
  };
};

const renderChart = () => {
  if (myChart) {
    myChart.destroy();
  }

  const chartData = prepareData();

  if (chartCanvas.value) {
    myChart = new Chart(chartCanvas.value, {
      type: "line",
      data: chartData,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: props.ChartData.title || "График",
          },
        },
      },
    });
  }
};

onMounted(renderChart);
watch(() => props.ChartData, renderChart, { deep: true });
</script>
