<template>
  <div class="app">
    <apexchart
      type="bar"
      height="390"
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
    positionstacked: null,
    positionstacked_years: null
  },
  data: () => ({
    series: [],
    chartOptions: {
      chart: {
        type: "bar",

        stacked: true,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: true
        }
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              position: "bottom",
              offsetX: -10,
              offsetY: 0
            }
          }
        }
      ],
      plotOptions: {
        bar: {
          horizontal: false
        }
      },
      xaxis: {
        categories: [
          "พักผ่อน",
          "ป่วย",
          "ลากิจ",
          "ราชการ",
          "ลาคลอด",
          "ลากิจเลี้ยงดูบุตร",
          "สาย"
        ],
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
      dataLabels: {
        enabled: true,
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      legend: {
        position: "bottom",
        fontSize: "20px",
        fontFamily: "Kanit, sans-serif"
      },
      fill: {
        opacity: 1
      },
      title: {
        text: "ปีงบ",
        style: {
          fontSize: "18px",
          fontFamily: "Kanit, sans-serif"
        }
      },
      colors: [
        "#9d0191",
        "#fd3a69",
        "#fecd1a",
        "#120078",
        "#ffa45b",
        "#008891",
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
    this.series = this.positionstacked;
    // this.chartOptions.xaxis.categories = this.positionstacked_name;
    // //เอา array แรกเลยใช้ [0]
    this.chartOptions.title.text = `ปีงบ ${this.positionstacked_years[0]}`;
  }
};
</script>
