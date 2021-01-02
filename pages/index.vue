<template>
  <v-container grid-list-xl fluid>
    <v-layout row wrap>
      <v-flex sm12>
        <div class="headline grey--text text--darken-1">
          <h3>
            <v-icon large>dashboard</v-icon>
            กราฟแสดงข้อมูลการลาของเจ้าหน้าที่เวชกรรมสังคม
          </h3>
        </div>
      </v-flex>
      <v-flex lg6 sm12>
        <v-card color="#eeecda">
          <v-responsive>
            <h3 class=" pa-3">
              <v-icon large>bar_chart</v-icon>
              แสดงตามประเภทการลา
            </h3>
          </v-responsive>
          <v-card-text>
            <div>
              <chartLeaveTypePie
                v-if="loadleavetypepie"
                :leavetypepie_years="leavetypepie_years"
                :leavetypepie_name="leavetypepie_name"
                :leavetypepie_data="leavetypepie_data"
              ></chartLeaveTypePie>
            </div>
          </v-card-text>
          <v-divider></v-divider>
        </v-card>
      </v-flex>
      <v-flex lg6 sm12>
        <v-card color="#eeecda">
          <v-responsive>
            <h3 class=" pa-3">
              <v-icon large>bar_chart</v-icon>
              แสดงตามประเภทเจ้าหน้าที่/ประเภทการลา
            </h3>
          </v-responsive>
          <v-card-text>
            <div>
              <chartPositionStacked
                v-if="loadpositionstacked"
                :positionstacked="positionstacked"
                :positionstacked_years="positionstacked_years"
              ></chartPositionStacked>
            </div>
          </v-card-text>
          <v-divider></v-divider>
        </v-card>
      </v-flex>
      <v-flex lg12 sm12>
        <v-card color="#eeecda">
          <v-responsive>
            <h3 class=" pa-3">
              <v-icon large>bar_chart</v-icon>
              แสดงตามประเภทหน่วยงาน
            </h3>
          </v-responsive>
          <v-card-text>
            <div>
              <chartLocationBar
                v-if="loadlocationbar"
                :locationbar_years="locationbar_years"
                :locationbar_name="locationbar_name"
                :locationbar_data="locationbar_data"
              ></chartLocationBar>
            </div>
          </v-card-text>
          <v-divider></v-divider>
        </v-card>
      </v-flex>
      <v-flex lg12 sm12>
        <v-card color="#eeecda">
          <v-responsive>
            <h3 class=" pa-3">
              <v-icon large>bar_chart</v-icon>
              แสดงตามตามเดือน
            </h3>
          </v-responsive>
          <v-card-text>
            <div>
              <chartlineMonth
                v-if="loadlinemonth"
                :linemonth="linemonth"
                :linemonth_name="linemonth_name"
                :linemonth_years="linemonth_years"
              ></chartlineMonth>
            </div>
          </v-card-text>
          <v-divider></v-divider>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import VWidget from "@/components/VWidget";
import chartLeaveTypePie from "@/components/chart/chart_leave_type_pie.vue";
import chartPositionStacked from "@/components/chart/chart_position_stacked.vue";
import chartLocationBar from "@/components/chart/chart_location_bar.vue";
import chartlineMonth from "@/components/chart/chart_line_month.vue";

import axios from "axios";
export default {
  layout: "dashboard",
  name: "index",
  components: {
    VWidget,
    chartLeaveTypePie,
    chartPositionStacked,
    chartLocationBar,
    chartlineMonth
  },
  data: () => ({
    loadleavetypepie: false,
    leavetypepie: null,
    leavetypepie_years: null,
    leavetypepie_name: null,
    leavetypepie_data: null,
    loadpositionstacked: false,
    positionstacked: null,
    positionstacked_years: null,
    loadlocationbar: false,
    locationbar: null,
    locationbar_years: null,
    locationbar_name: null,
    locationbar_data: null,
    loadlinemonth: false,
    linemonth: null,
    linemonth_years: null,
    linemonth_name: null,
    linemonth_data: null
  }),
  mounted() {
    this.chart_leave_type_pie();
    this.chart_position_stacked();
    this.chart_location_bar();
    this.chart_line_month();
  },
  methods: {
    //chart pie leave type
    async chart_leave_type_pie() {
      await axios
        .get(`${this.$axios.defaults.baseURL}chart_leave_type_pie.php`)
        .then(response => {
          this.loadleavetypepie = true;
          this.leavetypepie = response.data;

          this.leavetypepie_years = this.leavetypepie.map(item => item.years);
          this.leavetypepie_name = this.leavetypepie.map(item => item.name);
          this.leavetypepie_data = this.leavetypepie.map(item => item.leaveall);
        });
    },
    //chart stacked position
    async chart_position_stacked() {
      await axios
        .get(`${this.$axios.defaults.baseURL}chart_position_stacked.php`)
        .then(response => {
          this.loadpositionstacked = true;
          this.positionstacked = response.data;
          this.positionstacked_years = this.positionstacked.map(
            item => item.years
          );
        });
    },
    //chart location bar
    async chart_location_bar() {
      await axios
        .get(`${this.$axios.defaults.baseURL}chart_location_bar.php`)
        .then(response => {
          this.loadlocationbar = true;
          this.locationbar = response.data;
          this.locationbar_years = this.locationbar.map(item => item.years);
          this.locationbar_name = this.locationbar.map(item => item.name);
          this.locationbar_data = this.locationbar.map(item => item.leaveall);
        });
    },
    //chart location bar
    async chart_line_month() {
      await axios
        .get(`${this.$axios.defaults.baseURL}chart_line_month.php`)
        .then(response => {
          this.loadlinemonth = true;
          this.linemonth = response.data;

          this.linemonth_years = this.linemonth.map(item => item.years);
          this.linemonth_name = this.linemonth.map(item => item.name);

          // this.linemonth_data = this.linemonth.map(item => item.leaveall);
        });
    }
  }
};
</script>
<style scoped>
h2,
h3,
span,
v-col,
div {
  font-family: "Prompt", sans-serif;
}
.hidden {
  visibility: hidden;
}
</style>
