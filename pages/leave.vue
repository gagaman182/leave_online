<template>
  <div id="page-alerts">
    <v-container grid-list-xl fluid>
      <v-widget title="บันทึกลา" icon="add_task ">
        <div slot="widget-content">
          <v-layout row wrap>
            <v-flex sm3 lg3>
              <v-autocomplete
                v-model="person_name_select"
                :items="person_name_name"
                dense
                filled
                label="เจ้าหน้าที่"
              ></v-autocomplete>

              <v-checkbox
                v-model="halfday"
                label="ลาหยุดครึ่งวัน"
                value="0.5"
              ></v-checkbox>

              <h3 v-if="idshow">ลำดับที่: {{ this.leave_id }}</h3>
            </v-flex>
            <v-flex sm3 lg3>
              <v-select
                :items="leave_type_items"
                v-model="leave_type"
                item-text="name"
                item-value="id"
                filled
                label="ประเภทการลา"
              ></v-select>
            </v-flex>
            <v-flex sm3 lg3>
              <v-subheader class="pa-0">วันเริ่ม</v-subheader>
              <v-date-picker
                v-model="datestart"
                color="#7579e7"
                locale="th-TH"
              ></v-date-picker>
            </v-flex>
            <v-flex sm3 lg3>
              <v-subheader class="pa-0">วันสิ้นสุด</v-subheader>
              <v-date-picker
                v-model="dateend"
                color="#7579e7"
                locale="th-TH"
              ></v-date-picker>
            </v-flex>
            <v-flex sm12 lg12>
              <v-btn v-if="btnsave" color="#51adcf" @click="addleave()" dark>
                <v-icon medium>save_alt</v-icon>
                <h4>บันทึก</h4></v-btn
              >
              <v-btn v-if="idshow" color="#dd9866" @click="updateleave()" dark>
                <v-icon medium>edit</v-icon>
                <h4>แก้ไข</h4></v-btn
              >
              <v-btn v-if="idshow" color="#c56183" @click="removeleave()" dark>
                <v-icon medium>delete_forever</v-icon>
                <h4>ลบ</h4></v-btn
              >
              <v-btn color="#686d76" @click="cleartext()" dark>
                <v-icon medium>undo</v-icon>
                <h4>ยกเลิก</h4></v-btn
              ></v-flex
            >
            <v-flex sm12 lg12>
              <v-divider></v-divider>
            </v-flex>
            <v-flex sm12 lg12>
              <v-card>
                <v-card-title>
                  <v-icon> calendar_today </v-icon>
                  <h3>
                    ข้อมูลการลา
                  </h3></v-card-title
                >

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
                </v-toolbar>
                <v-divider></v-divider>
                <v-card-text class="pa-0">
                  <v-data-table
                    v-model="complex.selected"
                    :headers="complex.headers"
                    :search="search"
                    :sort-by="['id']"
                    :sort-desc="[true]"
                    :items="complex.items"
                    :rows-per-page-items="[
                      10,
                      25,
                      50,
                      { text: 'All', value: -1 }
                    ]"
                    class="elevation-1"
                    item-key="name"
                    :sort-desc.sync="sortDesc"
                    @update:sort-by="handleSortBy"
                  >
                    <template
                      slot="items"
                      slot-scope="props"
                      :item.actions="{ item }"
                    >
                      <td>{{ props.item.id }}</td>
                      <td>{{ props.item.person_name }}</td>
                      <!-- <td>{{ props.item.leave_type }}</td> -->
                      <td>
                        <v-chip :color="getColor(props.item.leave_type)">{{
                          props.item.leave_type
                        }}</v-chip>
                      </td>
                      <td>{{ props.item.datestart }}</td>
                      <td>{{ props.item.dateend }}</td>
                      <td>
                        <v-checkbox
                          disabled
                          :input-value="props.item.halfday"
                        ></v-checkbox>
                      </td>
                      <td>
                        <v-btn
                          outline
                          round
                          color="cyan lighten-2"
                          small
                          @click="person_id(props.item.id)"
                        >
                          <v-icon>add_task</v-icon>
                        </v-btn>
                      </td>
                    </template>
                  </v-data-table>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </div>
      </v-widget>
    </v-container>
  </div>
</template>

<script>
import VWidget from "@/components/VWidget";
import axios from "axios";
export default {
  layout: "dashboard",
  name: "leave",
  components: {
    VWidget
  },
  data: () => ({
    person_name_select: null,
    person_name: null,
    person_name_name: null,
    leave_type: null,
    leave_type_items: [],
    datestart: null,
    dateend: null,
    message: null,
    leave_id: null,
    idshow: false,
    btnsave: true,
    search: "",
    complex: {
      selected: [],
      headers: [
        {
          text: "ลำดับที่",
          value: "id",
          sortable: false
        },
        {
          text: "เจ้าหน้าที่",
          value: "person_name",
          sortable: false
        },
        {
          text: "ประเภทการลา",
          value: "leave_type",
          sortable: false
        },
        {
          text: "วันเริ่ม",
          value: "datestart",
          sortable: false
        },
        {
          text: "วันสิ้นสุด",
          value: "dateend",
          sortable: false
        },
        {
          text: "ลาครึ่งวัน",
          value: "halfday",
          sortable: false
        },
        {
          text: "แก้ไข",
          value: "",
          sortable: false
        }
      ],
      items: [],
      leavedetails: null
    },
    halfday: ""
  }),
  mounted() {
    this.fetch_person();
    this.fetch_leave_type();
    this.fetch_leave_add_data();
  },
  methods: {
    handleSortBy(newColumnName) {
      if (newColumn !== "id") {
        this.$nextTick(() => {
          this.sortDesc = true;
        });
      }
    },
    addleave() {
      if (
        this.dateend < this.datestart ||
        (!this.person_name_select ||
          !this.leave_type ||
          !this.datestart ||
          !this.dateend)
      ) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ระบุข้อมูลไม่ครบหรือระบุไม่ถูกต้อง",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        axios
          .post(`${this.$axios.defaults.baseURL}leave_add.php`, {
            person_name_select: this.person_name_select,
            leave_type: this.leave_type,
            datestart: this.datestart,
            dateend: this.dateend,
            halfday: this.halfday
          })
          .then(response => {
            this.message = response.data;
            if (this.message[0].message === "เพิ่มข้อมูลสำเร็จ") {
              this.$swal({
                title: "สถานะการเพิ่ม",
                text: this.message[0].message,
                icon: "success",
                confirmButtonText: "ตกลง"
              });
              this.cleartext();
              this.fetch_leave_add_data();
              this.basic.dialog = false;
            } else {
              this.$swal({
                title: "สถานะการเพิ่ม",
                text: this.message[0].message,
                icon: "error",
                confirmButtonText: "ตกลง"
              });
            }
          });
      }
    },
    //แสดงข้อมูลประเภทการลา
    async fetch_leave_type() {
      await axios
        .get(`${this.$axios.defaults.baseURL}leave_type.php`)
        .then(response => {
          this.leave_type_items = response.data;
        });
    },
    //แสดงข้อมูลบุคคล
    async fetch_person() {
      await axios
        .get(`${this.$axios.defaults.baseURL}person.php`)
        .then(response => {
          this.person_name = response.data;
          this.person_name_name = this.person_name.map(item => item.name);
          // console.log(this.person_name_name);
        });
    },
    //แสดงข้อมูลการลา
    async fetch_leave_add_data() {
      await axios
        .get(`${this.$axios.defaults.baseURL}leave_add_data.php`)
        .then(response => {
          this.complex.items = response.data;
        });
    },

    cleartext() {
      this.person_name_select = "";
      this.leave_type = "";
      this.datestart = "";
      this.dateend = "";
      this.leave_id = "";
      this.halfday = "";
      this.idshow = false;
      this.btnsave = true;
    },
    // แสดงคนตาม id
    async person_id(item) {
      this.idshow = true;
      this.btnsave = false;
      this.leave_id = item;
      await axios
        .get(`${this.$axios.defaults.baseURL}leave_edit.php`, {
          params: {
            leaveid: item
          }
        })
        .then(response => {
          this.leavedetails = response.data;
          this.leavedetails.forEach(leavedetail => {
            this.person_name_select = leavedetail.person_name;
            this.leave_type = leavedetail.leave_type;
            this.datestart = leavedetail.datestart;
            this.dateend = leavedetail.dateend;
            this.halfday = leavedetail.halfday;
          });

          window.scrollTo(0, 0);
        });
    },
    //แก้ไขวันลา

    updateleave: function() {
      if (!this.leave_id) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ไม่พบข้อมูล",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        axios
          .put(`${this.$axios.defaults.baseURL}leave_update.php`, {
            id: this.leave_id,
            person_name_select: this.person_name_select,
            leave_type: this.leave_type,
            datestart: this.datestart,
            dateend: this.dateend,
            halfday: this.halfday
          })
          .then(response => {
            this.message = response.data;
            if (this.message[0].message === "แก้ไขข้อมูลสำเร็จ") {
              this.$swal({
                title: "สถานะการแก้ไข",
                text: this.message[0].message,
                icon: "success",
                confirmButtonText: "ตกลง"
              });
              this.cleartext();
              this.fetch_leave_add_data();
            } else {
              this.$swal({
                title: "สถานะการแก้ไข",
                text: this.message[0].message,
                icon: "error",
                confirmButtonText: "ตกลง"
              });
            }
          });
      }
    },
    removeleave() {
      if (!this.leave_id) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ไม่พบข้อมูล",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        this.$swal({
          title: "คุณแน่ใจว่าต้องการลบข้อมูลนี้?",
          text: "ลำดับที่: " + this.leave_id,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#51adcf",
          cancelButtonColor: "#686d76",
          confirmButtonText: "ลบ",
          cancelButtonText: "ยกเลิก"
        }).then(result => {
          if (result.isConfirmed) {
            axios
              .put(`${this.$axios.defaults.baseURL}leave_delete.php`, {
                id: this.leave_id
              })
              .then(response => {
                this.message = response.data;

                if (this.message[0].message === "ลบข้อมูลสำเร็จ") {
                  this.$swal({
                    title: "สถานะการลบ",
                    text: this.message[0].message,
                    icon: "success",
                    confirmButtonText: "ตกลง"
                  });
                  this.cleartext();
                  this.fetch_leave_add_data();
                } else {
                  this.$swal({
                    title: "สถานะการลบ",
                    text: this.message[0].message,
                    icon: "error",
                    confirmButtonText: "ตกลง"
                  });
                }
              });
          }
        });
      }
    },
    //สีใน column ประเภทก่ารลา
    getColor(status) {
      if (status == "พักผ่อน") return "#ffbe0b";
      else if (status == "ป่วย") return "#fb5607";
      else if (status == "ลากิจ") return "#ff006e";
      else if (status == "ราชการ") return "#8338ec";
      else if (status == "ลาคลอด") return "#ffa5a5";
      else if (status == "ลากิจเลี้ยงดูบุตร") return "#3a86ff";
      else if (status == "สาย") return "#007ea7";
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
  font-size: 18px !important;
}
.v-input {
  font-size: 1.6em;
}
</style>
