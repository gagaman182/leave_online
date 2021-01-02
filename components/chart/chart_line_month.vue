<template>
  <div class="app">
    <apexchart
      type="line"
      height="500"
      width="98%"
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
    linemonth: null,
    linemonth_years: null,
    linemonth_name: null
  },
  data: () => ({
    series: [
      // {
      //   name: "10",
      //   data: [5, 6]
      // }
    ],
    chartOptions: {
      chart: {
        type: "line",
        dropShadow: {
          enabled: true,
          color: "#000",
          top: 18,
          left: 7,
          blur: 10,
          opacity: 0.2
        },
        toolbar: {
          show: false
        }
      },

      dataLabels: {
        enabled: true
      },
      stroke: {
        curve: "smooth"
      },
      title: {
        text: "",
        align: "left"
      },
      grid: {
        borderColor: "#e7e7e7",
        row: {
          colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
          opacity: 0.5
        }
      },
      markers: {
        size: 2
      },
      xaxis: {
        categories: [
          "ต.ค.",
          "พ.ย.",
          "ธ.ค.",
          "ม.ค.",
          "ก.พ.",
          "มี.ค.",
          "เม.ษ.",
          "พ.ค.",
          "มิ.ย.",
          "ก.ค.",
          "ส.ค.",
          "ก.ย."
        ],
        labels: {
          rotate: 45,
          style: {
            fontSize: "14px",
            fontFamily: "Kanit, sans-serif"
          }
        },
        title: {
          text: "เดือน",
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
            fontSize: "18px",
            fontFamily: "Kanit, sans-serif"
          }
        }
      },
      legend: {
        position: "bottom",
        fontSize: "18px",
        fontFamily: "Kanit, sans-serif"
      },
      colors: [
        "#33658a",
        "#86bbd8",
        "#758e4f",
        "#f6ae2d",
        "#f26419",
        "#90f1ef",
        "#931a25"
      ],
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
    this.series = this.linemonth;

    //เอา array แรกเลยใช้ [0]
    this.chartOptions.title.text = `ปีงบ ${this.linemonth_years[0]}`;
  }
};
</script>
