<template>
  <v-container grid-list-xl fluid>
    <v-layout row wrap>
      <v-flex sm12>
        <div class="headline grey--text text--darken-1">
          <h3>
            <v-icon large>table_view</v-icon>
            สรุปวันลาของเจ้าหน้าที่เวชกรรมสังคม ร.พ.หาดใหญ่
          </h3>
        </div>
      </v-flex>

      <v-flex lg12 sm12>
        <v-widget title="สรุปวันลาประจำปี" icon="view_list " class="mt-3">
          <div slot="widget-content">
            <v-container fluid class="pa-0">
              <v-layout row wrap>
                <v-flex md6 sm6>
                  <div class="text-xs-center">
                    <v-subheader>เริ่ม</v-subheader>
                    <v-date-picker
                      color="#7579e7"
                      v-model="monthstart"
                      type="month"
                      locale="th"
                    ></v-date-picker>
                  </div>
                </v-flex>
                <v-flex md6 sm6>
                  <div class="text-xs-center">
                    <v-subheader>สิ้นสุด</v-subheader>
                    <v-date-picker
                      color="#7579e7"
                      v-model="monthend"
                      type="month"
                      locale="th"
                    ></v-date-picker>
                  </div>
                </v-flex>

                <v-flex md12 sm12>
                  <div class="text-xs-center">
                    <v-btn color="#51adcf" @click="addReport()" dark>
                      <v-icon medium>save_alt</v-icon>
                      <h4>ตกลง</h4></v-btn
                    >

                    <v-btn color="#686d76" @click="clearReport()" dark>
                      <v-icon medium>undo</v-icon>
                      <h4>ยกเลิก</h4></v-btn
                    >
                  </div>
                </v-flex>
              </v-layout>
            </v-container>
            <div class="text-center d-flex align-center justify-space-around">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn color="primary" dark v-bind="attrs" v-on="on">
                    Button
                  </v-btn>
                </template>
                <span>Tooltip</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <v-icon color="primary" dark v-bind="attrs" v-on="on">
                    mdi-home
                  </v-icon>
                </template>
                <span>Tooltip</span>
              </v-tooltip>

              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <span v-bind="attrs" v-on="on">This text has a tooltip</span>
                </template>
                <span>Tooltip</span>
              </v-tooltip>
            </div>
            <v-flex sm12 lg12> </v-flex>
            <div>
              <v-row justify="space-around">
                <v-toolbar card>
                  <v-text-field
                    v-model="search"
                    flat
                    solo
                    prepend-icon="search"
                    placeholder="ค้นหา"
                    hide-details
                    class="hidden-sm-and-down"
                  ></v-text-field>

                  <v-btn color="#35d0ba" dark>
                    <v-icon medium>import_export</v-icon>
                    <h4>
                      <export-excel :data="complex.items">
                        Excel
                        <img src="download_icon.png" />
                      </export-excel></h4
                  ></v-btn>
                </v-toolbar>
                <v-divider></v-divider>
                <v-data-table
                  v-model="complex.selected"
                  :headers="complex.headers"
                  :search="search"
                  :items="complex.items"
                  :rows-per-page-items="[
                    50,
                    100,
                    200,
                    { text: 'All', value: -1 }
                  ]"
                  class="elevation-1"
                  item-key="name"
                >
                  <template
                    #item.index="{ item }"
                    slot="items"
                    slot-scope="props"
                    :item.actions="{ item }"
                  >
                    <td>{{ props.item.num }}</td>
                    <td>{{ props.item.name }}</td>

                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColorLeaveALL(props.item.leaveday)"
                        >{{ props.item.leaveday }}</v-chip
                      >
                    </td>
                    <!-- <td>{{ props.item.leaveday }}</td> -->
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="
                          getColorLeaveRemove(props.item.leave_type1_total)
                        "
                        >{{ props.item.leave_type1_total }}</v-chip
                      >
                    </td>
                    <!-- <td>{{ props.item.leave_type1_total }}</td> -->
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type1)"
                        >{{ props.item.leave_type1 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type2)"
                        >{{ props.item.leave_type2 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type3)"
                        >{{ props.item.leave_type3 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type4)"
                        >{{ props.item.leave_type4 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type5)"
                        >{{ props.item.leave_type5 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type6)"
                        >{{ props.item.leave_type6 }}</v-chip
                      >
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        label
                        :color="getColor(props.item.leave_type7)"
                        >{{ props.item.leave_type7 }}</v-chip
                      >
                    </td>
                    <!-- <td>{{ props.item.leave_type1 }}</td> -->
                    <!-- <td>{{ props.item.leave_type2 }}</td>
                    <td>{{ props.item.leave_type3 }}</td>
                    <td>{{ props.item.leave_type4 }}</td>
                    <td>{{ props.item.leave_type5 }}</td>
                    <td>{{ props.item.leave_type6 }}</td>
                    <td>{{ props.item.leave_type7 }}</td> -->
                  </template>
                </v-data-table>
              </v-row>
            </div>
          </div>
        </v-widget>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import VWidget from "@/components/VWidget";
import axios from "axios";

export default {
  layout: "dashboard",
  name: "report",
  components: {
    VWidget
  },
  data: () => ({
    monthstart: null,
    monthend: null,
    search: "",
    complex: {
      selected: [],
      headers: [
        {
          text: "#",
          value: "num"
        },
        {
          text: "เจ้าหน้าที่",
          value: "name"
        },
        {
          text: "ลาพักผ่อนยกยอดมา",
          value: "leaveday"
        },
        {
          text: "ลาพักผ่อนคงเหลือ",
          value: "leave_type1_total"
        },
        {
          text: "พักผ่อน",
          value: "leave_type1"
        },
        {
          text: "ป่วย",
          value: "leave_type2"
        },
        {
          text: "ลากิจ",
          value: "leave_type3"
        },
        {
          text: "ราชการ",
          value: "leave_type4"
        },
        {
          text: "ลาคลอด",
          value: "leave_type5"
        },
        {
          text: "ลากิจเลี้ยงดูบุตร",
          value: "leave_type6"
        },
        {
          text: "สาย",
          value: "leave_type7"
        }
      ],
      items: [],
      leavedetails: null
    }
  }),
  mounted() {
    this.fetch_total_leave();
  },
  methods: {
    //แสดงข้อมูลการลา
    async fetch_total_leave() {
      await axios
        .get(`${this.$axios.defaults.baseURL}total_leave.php`)
        .then(response => {
          this.complex.items = response.data;
        });
    },
    addReport() {
      if (this.monthend < this.monthstart || !this.monthend || !this.monthend) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ระบุเดือนไม่ถูกต้อง",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        axios
          .get(`${this.$axios.defaults.baseURL}total_leave_month.php`, {
            params: {
              monthstart: this.monthstart,
              monthend: this.monthend
            }
          })
          .then(response => {
            this.complex.items = response.data;
          });
      }
    },
    clearReport() {
      this.monthstart = "";
      this.monthend = "";

      this.fetch_total_leave();
    },
    //สีใน column ประเภทวันลา
    getColor(status) {
      if (status > 0) return "#99b898";
      else return "#feceab";
    },
    getColorLeaveALL(status) {
      if (status > 0) return "#fe91ca";
      else return "#feceab";
    },
    getColorLeaveRemove(status) {
      if (status > 0) return "#26baee";
      else return "#feceab";
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
table.v-table tbody td {
  font-size: 20px !important;
}
</style>
