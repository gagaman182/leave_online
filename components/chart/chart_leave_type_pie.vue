<template>
  <div class="app">
    <apexchart
      height="400"
      type="pie"
      :options="chartOptions"
      :series="series"
    ></apexchart>
  </div>
</template>
<script>
import VueApexCharts from "vue-apexcharts";
import axios from "axios";
export default {
  components: {
    apexchart: VueApexCharts
  },
  props: {
    leavetypepie_years: null,
    leavetypepie_name: null,
    leavetypepie_data: null
  },
  data: () => ({
    series: [],
    chartOptions: {
      chart: {
        type: "pie"
      },
      labels: [],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {},
            legend: {
              position: "bottom"
            }
          }
        }
      ],
      colors: [
        "#33b2df",
        "#d4526e",
        "#13d8aa",
        "#A5978B",
        "#f9a3a4",
        "#f48024"
      ],
      dataLabels: {
        enabled: true,
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      legend: {
        position: "right",
        fontSize: "20px",
        fontFamily: "Kanit, sans-serif"
      },
      tooltip: {
        enabled: true,
        offsetX: 0,
        style: {
          fontSize: "16px",
          fontFamily: "Kanit, sans-serif"
        },
        shared: true
      },
      title: {
        text: "ปีงบ",
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      }
    }
  }),
  beforeMount() {
    this.series = this.leavetypepie_data;
    this.chartOptions.labels = this.leavetypepie_name;
    //เอา array แรกเลยใช้ [0]
    this.chartOptions.title.text = `ปีงบ ${this.leavetypepie_years[0]}`;
  }
};
</script>
