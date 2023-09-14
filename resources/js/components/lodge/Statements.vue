<template>
  <div class="container px-8 mt-10">
    <div class="text-4xl">Statement of {{ lodge }}</div>
    <div class="mt-4">
      Select Month
      <br />
      <month-picker-input @change="changeOfMonth" v-model="selectedMonthAndYear" :default-month="currentMonth"
        :default-year="currentYear"></month-picker-input>
    </div>
    <div class="p-4 mt-4 bg-white rounded-xl">
      <a :href="
        '/dowload-statement?lodge_id=' +
        id +
        '&&month=' +
        selectedMonthAndYear.month +
        '&&year=' +
        selectedMonthAndYear.year
      " class="float-right px-4 py-1 mb-4 text-white bg-gray-800 hover:bg-gray-700">Download Excel</a>
      <table class="table w-full mt-4">
        <thead>
          <tr>
            <th class="p-2 text-center border">Order ID</th>
            <th class="p-2 text-center border">Transaction Date</th>
            <th class="p-2 text-center border">Refund Date</th>
            <th class="p-2 text-center border">Check In Date</th>
            <th class="p-2 text-center border">Check Out Date</th>
            <th class="p-2 text-center border">Amount</th>
            <th class="p-2 text-center border">Payment Status</th>
            <th class="p-2 text-center border">Booking Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, index) in transactions" :key="index">
            <td class="p-2 text-center border">
              <router-link v-if="data[0].orderId != null" :to="{
                name: 'cancelledBookingDetail',
                params: { id: data[0].orderId },
              }">
                {{ data[0].orderId }}
              </router-link>
            </td>
            <td class="p-2 text-center border">
              {{ format_date(data[0].created_at) }}
            </td>
            <td class="p-2 text-center text-red-600 border">
              <!-- {{ data[0].status  }} -->
              <div class="" v-if="data[0].status == 'REFUNDED'">
                {{ format_date(data[0].updated_at) }}
              </div>
            </td>
            <td class="p-2 text-center border">
              {{ format_date(data[0].user_booking.check_in) }}
            </td>
            <td class="p-2 text-center border">
              {{ format_date(data[0].user_booking.check_out) }}
            </td>
            <td class="p-2 text-center border">{{ data[0].amount }}</td>
            <td class="p-2 text-center border">{{ data[0].status }}</td>
            <td v-if="data[0].user_booking.status != 1" class="p-2 text-center border">
              {{ data[0].user_booking.status }}
              <br>
              {{ data[0].user_booking.status == 'Cancelled' ? 'at ' + data[0].user_booking.cancelled_at : '' }}
            </td>
            <td v-else class="p-2 text-center border">
              Unconfirmed
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import { MonthPickerInput } from "vue-month-picker";

export default {
  components: {
    MonthPickerInput,
  },
  data() {
    return {
      id: null,
      loading: false,
      lodge: null,
      transactions: null,
      today: 0,
      currentMonth: "",
      selectedMonthAndYear: {},
      currentYear: "",
    };
  },
  created() {
    this.id = this.$route.params.id;
    this.today = Date.now();
    const current = new Date();
    this.currentMonth = current.getMonth() + 1;
    this.currentYear = current.getFullYear();
    // console.log(this.transactions);
  },
  methods: {
    changeOfMonth(date) {
      this.selectedMonthAndYear = date;
      this.getLodge();
    },
    format_date(value) {
      var date;
      if (value) {
        date = moment(String(value)).format("DD/MM/YYYY");
        if (date == "Invalid date") {
          let splitDate = value.split("-");
          let convertedDate =
            splitDate[2] + "-" + splitDate[1] + "-" + splitDate[0];
          date = moment(String(convertedDate)).format("DD/MM/YYYY");
        }
        return date;
      }
    },
    getLodge() {
      axios.get("/api/lodges/" + this.id).then((result) => {
        this.lodge = result.data.name;
      });

      axios
        .get(
          "/api/transactions?lodge_id=" +
          this.id +
          "&&month=" +
          this.selectedMonthAndYear.month +
          "&&year=" +
          this.selectedMonthAndYear.year
        )
        .then((result) => {
          this.transactions = result.data;
        })
        .catch((err) => {
          throw err;
        });
    },
    downloadExcel() { },
  },
};
</script>
