<template>
  <div class="container mt-10  px-8 ">
    <div class="mb-6 text-black text-2xl mx-2 font-semibold">Cancelled Bookings</div>
    <div class="mt-4">
      Select Month
      <br />
      <month-picker-input @change="changeOfMonth" v-model="selectedMonthAndYear" :default-month="currentMonth"
        :default-year="currentYear">
      </month-picker-input>
    </div>
    <div class="flex flex-col mt-8">
      <div class="w-full">
        Select Filter
      </div>
      <div class="flex flex-row content-center items-center">

        <div class="flex-col">
    <select v-model="this.$parent.cancelledFilterType" @change="changeFilterType" name="filterBy" id="filterBy"
        class="w-36 form-select appearance-none block  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        <option value="" selected disabled>Select Filter</option>
        <option value="name">Name</option>
        <option value="order_id">Order ID</option>
        <option value="phone">Phone</option>
        <option value="guest">Guest</option>
        <option value="date">Date</option> <!-- Add an option for date -->
    </select>
</div>
<div class="flex-col">
    <input v-if="this.$parent.cancelledFilterType == 'date'" v-model="this.$parent.cancelledSearchKey" type="text" name="key" id="key"
        placeholder="dd/mm/yyyy"
        class="w-full form-select appearance-none block  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
    <input v-else v-model="this.$parent.cancelledSearchKey" type="text" name="key" id="key"
        class="w-full form-select appearance-none block  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
</div>
        <div class="flex-col">
          <button @click="searchForBooking" class="bg-colorx p-2 rounded-r-lg">
            <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20px" height="20px">
              <path
                d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z" />
            </svg>
          </button>
        </div>
      </div>
      <br>
      <div class="p-4 rounded-xl bg-white">
        <a :href="'/download-lodge-cancelled-bookings?lodge_id=' + id + '&&month=' + selectedMonthAndYear.month + '&&year=' + selectedMonthAndYear.year"
          class="float-right px-4 py-1 bg-gray-800 hover:bg-gray-700 text-white mb-4">Download Excel</a>
        <table class="min-w-full">
          <thead>
            <tr>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Booking ID</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Name</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Contact</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Lodge/Room</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                No. of Rooms</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Check In/Check Out</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Amount</td>
              <td
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Cancelled At</td>
              <td v-if="user.role == 'admin'"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Action</td>
            </tr>
          </thead>
          <tbody class="bg-white">
            <tr v-for="(booking, index) in bookings" :key="index">
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center text-center hover:underline hover:text-blue-500">
                  <router-link v-if="booking.order_id != null"
                    :to="{ name: 'cancelledBookingDetail', params: { id: booking.order_id } }">
                    {{ booking.order_id }}
                  </router-link>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center text-center">
                  {{ booking.users.name }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center text-center">
                  {{ booking.users.phone }}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div v-if="booking.lodge_room_data != null" class="flex items-center text-center">
                  {{ booking.lodge_room_data.lodge_room_types.name }} in {{ booking.lodge_room_data.lodges.name }}
                </div>
                <div v-else class="flex items-center text-center text-red-500 font-extrabold">
                  Room/Lodge Deleted
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                {{ booking.number_of_room_require }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                {{ format_date(booking.check_in) }} to {{ format_date(booking.check_out) }}
              </td>
              <td v-if="booking.payment != null"
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                {{ booking.payment.amount }}
              </td>
              <td v-else class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">

              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                {{ formatDateTime(booking.cancelled_at) }}
              </td>
              <td v-if="user.role == 'admin'" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                <button @click="restoreCancellation(booking.id)"
                  class="px-4 py-1 bg-green-800 hover:bg-green-700 text-white">Restore</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full mt-10">
        <div class="flex flex-row justify-center items-center content-center">
          <div class="flex-col">
            <button v-if="previousLink != null" @click="changePage(previousLink)"
              class="pl-4 pr-4 rounded-l-lg p-2 bg-colorx text-white">Previous</button>
            <button v-else disabled class="pl-4 pr-4 rounded-l-lg p-2 bg-gray-500 text-white">Previous</button>
          </div>
          <div class="flex-col">
            <button disabled class="pl-4 pr-4 border-b border-t border-gray-500 p-2">
              Showing {{ fromData }} to {{ toData }} of {{ total }} records
            </button>
          </div>
          <div class="flex-col">
            <button v-if="nextLink != null" @click="changePage(nextLink)"
              class="pl-4 pr-4 rounded-r-lg p-2 bg-colorx text-white">Next</button>
            <button v-else disabled class="pl-4 pr-4 rounded-r-lg p-2 bg-gray-500 text-white">Next</button>
          </div>
        </div>
      </div>
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
      bookings: null,
      filtertype: '',
      previousLink: '',
      nextLink: '',
      fromData: 0,
      toData: 0,
      total: 0,
      hasLoading: false,
      isSearched: false,
      user: [],
      today: 0,
      currentMonth: "",
      selectedMonthAndYear: {},
      currentYear: "",
    }
  },
  created() {
    this.today = Date.now();
    const current = new Date();
    this.currentMonth = current.getMonth() + 1;
    this.currentYear = current.getFullYear();
  },
  mounted() {
    this.user = User;
    this.id = this.$route.params.id;
    this.searchForBooking();
  },
  methods: {
    changeOfMonth(date) {
      this.selectedMonthAndYear = date;
      this.searchForBooking();
    },
    changeFilterType() {
      this.filterType = this.$parent.cancelledFilterType;
    },
    format_date(value) {
      var date;
      if (value) {
        date = moment(String(value)).format('DD/MM/YYYY');
        if (date == 'Invalid date') {
          let splitDate = value.split('-');
          let convertedDate = splitDate[2] + '-' + splitDate[1] + '-' + splitDate[0];
          date = moment(String(convertedDate)).format('DD/MM/YYYY');
        }
        return date;
      }
    },
    formatDateTime(value) {
      var date;
      if (value) {
        date = moment(String(value)).format('DD/MM/YYYY h:mma');
        if (date == 'Invalid date') {
          return '';
        }
        return date;
      }
    },
    changePage(url) {
      if (this.isSearched == true) {
        this.continueSearching(url);
      } else {
        axios.get(url)
          .then((result) => {
            if (result.data.data == false) {
              this.hasLoading = false
            } else {
              this.bookings = result.data.data;
              console.log(result);
              this.hasLoading = false;
              if (result.data.next_page_url != null) {
                this.nextLink = result.data.next_page_url + '&lodge_id=' + this.id + "&month=" + this.selectedMonthAndYear.month + "&year=" + this.selectedMonthAndYear.year;
              } else {
                this.nextLink = null;
              }
              if (result.data.prev_page_url != null) {
                this.previousLink = result.data.prev_page_url + '&lodge_id=' + this.id + "&month=" + this.selectedMonthAndYear.month + "&year=" + this.selectedMonthAndYear.year;
              } else {
                this.previousLink = null;
              }
              this.fromData = result.data.from;
              this.toData = result.data.to;
              this.total = result.data.total;
            }
          })
      }
    },

    searchForBooking() {
      let self = this;
      self.isSearched = true;
      if (self.$parent.filterType != "" && self.$parent.searchKey != "") {
        axios.get('/api/search-for-cancelled-bookings?type=' + self.$parent.cancelledFilterType + '&key=' + self.$parent.cancelledSearchKey + '&lodge_id=' + this.id + "&month=" + this.selectedMonthAndYear.month + "&year=" + this.selectedMonthAndYear.year)
          .then((result) => {
            console.log(result.data.data)
            this.bookings = result.data.data
            this.nextLink = result.data.next_page_url;
            this.previousLink = result.data.prev_page_url;
            this.fromData = result.data.from;
            this.toData = result.data.to;
            this.total = result.data.total;
          })
          .catch((err) => {
            throw err;
          })
      } else {
        alert('Please select filter type and enter search key')
      }
    },

    restoreCancellation(id) {
      if (confirm("Do you really want to restore this booking?")) {
        axios.post("/api/restore-cancelled-booking/" + id).then((result) => {
          if (result.status == 200) {
            this.$router.go()
          }
        })
      }
    },
    continueSearching(url) {
      let self = this;
      if (self.$parent.filterType != "" && self.$parent.searchKey != "") {
        axios.get(url + '&type=' + self.$parent.cancelledFilterType + '&key=' + self.$parent.cancelledSearchKey + '&lodge_id=' + self.id + "&month=" + self.selectedMonthAndYear.month + "&year=" + self.selectedMonthAndYear.year)
          .then((result) => {
            self.bookings = result.data.data
            self.nextLink = result.data.next_page_url;
            self.previousLink = result.data.prev_page_url;
            self.fromData = result.data.from;
            self.toData = result.data.to;
            self.total = result.data.total;
          })
          .catch((err) => {
            throw err;
          })
      } else {
        alert('Please select filter type and enter search key')
      }
    }
  },
}
</script>