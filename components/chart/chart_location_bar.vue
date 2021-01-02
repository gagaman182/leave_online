<template>
  <div class="app">
    <apexchart
      type="bar"
      height="500"
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
    locationbar_years: null,
    locationbar_name: null,
    locationbar_data: null
  },
  data: () => ({
    series: [
      {
        data: []
      }
    ],
    chartOptions: {
      chart: {
        type: "bar"
      },
      plotOptions: {
        bar: {
          horizontal: true
        }
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      xaxis: {
        categories: [],
        labels: {
          style: {
            fontSize: "18px",
            fontFamily: "Kanit, sans-serif"
          }
        }
      },
      yaxis: {
        title: {
          text: "จำนวน",
          style: {
            fontSize: "16px",
            fontFamily: "Kanit, sans-serif"
          }
        },
        labels: {
          style: {
            fontSize: "16px",
            fontFamily: "Kanit, sans-serif"
          }
        }
      },
      colors: ["#ee6f57"],
      title: {
        text: "ปีงบ",
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      tooltip: {
        enabled: true,
        offsetX: 0,
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        },
        shared: true
      }
    }
  }),
  beforeMount() {
    this.series[0].data = this.locationbar_data;
    this.chartOptions.xaxis.categories = this.locationbar_name;
    // //เอา array แรกเลยใช้ [0]
    this.chartOptions.title.text = `ปีงบ ${this.locationbar_years[0]}`;
  }
};
</script>
