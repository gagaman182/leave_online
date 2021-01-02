<template>
  <div id="page-alerts">
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg9 sm12>
          <v-widget title="เจ้าหน้าที่" icon="account_box ">
            <div slot="widget-content">
              <v-card>
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
                    :items="complex.items"
                    :rows-per-page-items="[
                      10,
                      25,
                      50,
                      { text: 'All', value: -1 }
                    ]"
                    class="elevation-1"
                    item-key="name"
                  >
                    <template
                      slot="items"
                      slot-scope="props"
                      :item.actions="{ item }"
                    >
                      <td>{{ props.item.id }}</td>
                      <td>{{ props.item.name }}</td>
                      <td>{{ props.item.occupation }}</td>
                      <td>{{ props.item.location }}</td>
                      <td>{{ props.item.position }}</td>
                      <td>{{ props.item.leaveday }}</td>
                      <td>
                        <v-btn
                          outline
                          round
                          color="cyan lighten-2"
                          small
                          @click="person_id(props.item.id)"
                        >
                          <v-icon>how_to_reg</v-icon>
                        </v-btn>
                        <!-- <v-btn depressed outline icon fab dark color="pink" small>
                        <v-icon>delete</v-icon>
                      </v-btn> -->
                      </td>
                    </template>
                  </v-data-table>
                </v-card-text>
              </v-card>
            </div>
          </v-widget>
        </v-flex>
        <v-flex lg3 sm12>
          <v-widget title="เพิ่ม/แก้ไข" icon="how_to_reg ">
            <div slot="widget-content">
              <v-col cols="12" sm="6" class="d-flex ">
                <h3>ลำดับที่:{{ personid }}</h3>
                <v-spacer></v-spacer>
                <v-btn color="#7579e7" @click="openAddPerson()" dark>
                  <v-icon medium>person_add</v-icon>
                  <h4>เพิ่ม</h4>
                </v-btn>
              </v-col>

              <v-col cols="12" sm="6">
                <v-text-field
                  label="ชื่อ-สกุล"
                  v-model="namedetail"
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-select
                  :items="occupation_list"
                  v-model="occupation"
                  item-text="name"
                  item-value="id"
                  filled
                  label="ตำแหน่ง"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6">
                <v-select
                  :items="position_list"
                  v-model="position"
                  item-text="name"
                  item-value="id"
                  filled
                  label="ประเภท"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6">
                <v-select
                  :items="location_list"
                  v-model="location"
                  item-text="name"
                  item-value="id"
                  filled
                  label="หน่วยงาน"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6">
                <v-text-field
                  type="number"
                  class="inputPrice"
                  v-model="leaveday"
                  label="วันลาผักผ่อนสะสม"
                >
                </v-text-field>
              </v-col>

              <v-spacer></v-spacer>
              <v-col cols="12" sm="6" class="d-flex ">
                <v-btn color="#51adcf" @click="updatePerson()" dark>
                  <v-icon medium>save_alt</v-icon>
                  <h4>บันทึก</h4></v-btn
                >
                <v-btn color="#c56183 " @click="deletePerson()" dark>
                  <v-icon medium>delete_forever</v-icon>
                  <h4>ลบ</h4></v-btn
                ></v-col
              >
            </div>
          </v-widget>
        </v-flex>

        <v-flex lg4>
          <div slot="widget-content">
            <v-dialog v-model="basic.dialog" persistent max-width="500px">
              <v-card>
                <v-toolbar color="#7579e7" dark class="headline">
                  <v-icon medium>person_add</v-icon>
                  <h4>เพิ่มข้อมูล</h4></v-toolbar
                >

                <v-divider></v-divider>
                <v-card-text>
                  <v-container grid-list-md>
                    <v-layout wrap>
                      <v-flex xs12 sm12 md12>
                        <v-text-field
                          label="ชื่อ-สกุล"
                          v-model="namedetail_add"
                          outlined
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm12 md12>
                        <v-select
                          :items="occupation_list"
                          v-model="occupation_add"
                          item-text="name"
                          item-value="id"
                          filled
                          label="ตำแหน่ง"
                        ></v-select>
                      </v-flex>
                      <v-flex xs12 sm12 md12>
                        <v-select
                          :items="position_list"
                          v-model="position_add"
                          item-text="name"
                          item-value="id"
                          filled
                          label="หน่วยงาน"
                        ></v-select>
                      </v-flex>
                      <v-flex xs12 sm12 md12>
                        <v-select
                          :items="location_list"
                          v-model="location_add"
                          item-text="name"
                          item-value="id"
                          filled
                          label="ประเภท"
                        ></v-select>
                      </v-flex>
                      <v-flex xs12 sm12 md12>
                        <v-text-field
                          type="number"
                          class="inputPrice"
                          v-model="leaveday_add"
                          label="วันลาผักผ่อนสะสม"
                        >
                        </v-text-field>
                      </v-flex>
                    </v-layout>
                  </v-container>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="#51adcf" flat @click.native="addPerson">
                    <v-icon medium>save_alt</v-icon>บันทึก</v-btn
                  >
                  <v-btn color="#686d76" flat @click.native="closeAddPerson"
                    ><v-icon medium>close</v-icon>ปิด</v-btn
                  >
                </v-card-actions>
              </v-card>
            </v-dialog>
          </div>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import VWidget from "@/components/VWidget";
import axios from "axios";
export default {
  layout: "dashboard",
  name: "person",
  components: {
    VWidget
  },
  data: () => ({
    search: "",
    complex: {
      selected: [],
      headers: [
        {
          text: "ลำดับที่",
          value: "id"
        },
        {
          text: "ชื่อ-สกุล",
          value: "name"
        },
        {
          text: "ตำแหน่ง",
          value: "occupation"
        },
        {
          text: "หน่วยงาน",
          value: "location"
        },
        {
          text: "ประเภท",
          value: "position"
        },
        {
          text: "วันลาพักผ่อนสะสม",
          value: "leaveadd"
        },
        {
          text: "แก้ไข",
          value: ""
        }
      ],
      items: []
    },
    personid: null,
    namedetail: null,
    namedetail_add: null,
    person: [],
    person_id_detail: null,
    occupation: null,
    occupation_add: null,
    occupation_list: [],
    location: null,
    location_add: null,
    location_list: [],
    position: null,
    position_add: null,
    position_list: [],
    leaveday: null,
    leaveday_add: null,
    message: null,

    basic: {
      dialog: false
    },
    fullscreen: {
      dialog: false,
      notifications: false,
      sound: true,
      widgets: false
    },
    scrollable: {
      name: "",
      dialog: false
    }
  }),
  mounted() {
    this.fetch_person();
    this.fetch_occupation();
    this.fetch_position();
    this.fetch_location();
  },
  methods: {
    //แสดงข้อมูลบุคคล
    async fetch_person() {
      await axios
        .get(`${this.$axios.defaults.baseURL}person.php`)
        .then(response => {
          this.complex.items = response.data;
          console.log(this.complex.items);
        });
    },
    // แสดงคนตาม id
    async person_id(item) {
      await axios
        .get(`${this.$axios.defaults.baseURL}person_edit.php`, {
          params: {
            personid: item
          }
        })
        .then(response => {
          // this.person_id_detail = response.data;
          const datadetials = response.data;
          datadetials.forEach(datadetial => {
            this.personid = datadetial.id;
            this.namedetail = datadetial.name;
            this.occupation = datadetial.occupation;
            this.location = datadetial.location;
            this.position = datadetial.position;
            this.leaveday = datadetial.leaveday;
          });
        });
    },
    //แสดงข้อมูลหน่วยตำแหน่ง
    async fetch_occupation() {
      await axios
        .get(`${this.$axios.defaults.baseURL}occupation.php`)
        .then(response => {
          this.occupation_list = response.data;
        });
    },
    //แสดงข้อมูลหน่วยงาน
    async fetch_position() {
      await axios
        .get(`${this.$axios.defaults.baseURL}position.php`)
        .then(response => {
          this.position_list = response.data;
        });
    },
    //แสดงข้อมูลประเภท
    async fetch_location() {
      await axios
        .get(`${this.$axios.defaults.baseURL}location.php`)
        .then(response => {
          this.location_list = response.data;
        });
    },

    //แก้ไขคน

    updatePerson: function() {
      if (!this.personid) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ไม่พบข้อมูล",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        axios
          .put(`${this.$axios.defaults.baseURL}person_update.php`, {
            id: this.personid,
            namedetail: this.namedetail,
            occupation: this.occupation,
            location: this.location,
            position: this.position,
            leaveday: this.leaveday
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
              this.fetch_person();
            } else {
              this.$swal({
                title: "สถานะการแก้ไข",
                text: this.message[0].message,
                icon: "error",
                confirmButtonText: "ตกลง"
              });

              // $nuxt._router.push("/dashboard");
            }
          });
      }
    },
    cleartext() {
      this.personid = "";
      this.namedetail = "";
      this.occupation = "";
      this.location = "";
      this.position = "";
      this.leaveday = "";

      this.namedetail_add = "";
      this.occupation_add = "";
      this.location_add = "";
      this.position_add = "";
      this.leaveday_add = "";
    },
    openAddPerson() {
      this.basic.dialog = true;
    },
    closeAddPerson() {
      this.basic.dialog = false;
      this.namedetail_add = "";
      this.occupation_add = "";
      this.location_add = "";
      this.position_add = "";
      this.leaveday_add = "";
    },
    //เพิ่มข้อมูล
    addPerson() {
      if (
        !this.namedetail_add ||
        !this.occupation_add ||
        !this.location_add ||
        !this.position_add
      ) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "กรอกข้อมูลไม่ครบ",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        axios
          .post(`${this.$axios.defaults.baseURL}person_add.php`, {
            namedetail: this.namedetail_add,
            occupation: this.occupation_add,
            location: this.location_add,
            position: this.position_add,
            leaveday: this.leaveday_add
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
              this.fetch_person();
              this.basic.dialog = false;
            } else {
              this.$swal({
                title: "สถานะการเพิ่ม",
                text: this.message[0].message,
                icon: "error",
                confirmButtonText: "ตกลง"
              });

              // $nuxt._router.push("/dashboard");
            }
          });
      }
    },

    deletePerson() {
      if (!this.personid) {
        this.$swal({
          title: "แจ้งเตือน",
          text: "ไม่พบข้อมูล",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else {
        this.$swal({
          title: "คุณแน่ใจว่าต้องการลบข้อมูลนี้?",
          text:
            "ลำดับที่: " + this.personid + " ชื่อ-นามสกุล: " + this.namedetail,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#51adcf",
          cancelButtonColor: "#686d76",
          confirmButtonText: "ลบ",
          cancelButtonText: "ยกเลิก"
        }).then(result => {
          if (result.isConfirmed) {
            axios
              .put(`${this.$axios.defaults.baseURL}person_delete.php`, {
                id: this.personid
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
                  this.fetch_person();
                } else {
                  this.$swal({
                    title: "สถานะการลบ",
                    text: this.message[0].message,
                    icon: "error",
                    confirmButtonText: "ตกลง"
                  });

                  // $nuxt._router.push("/dashboard");
                }
              });
          }
        });
      }
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
