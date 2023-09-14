<template>
  <div class="container px-8 mt-10">
    <div class="mx-2 mb-6 text-2xl font-semibold text-black">Booking</div>
    <div class="flex flex-row justify-between w-full">
      <div class="flex-col">
        <div>
          <router-link
            :to="{ name: 'bookingCreate' }"
            style="background: #24b897"
            class="px-4 py-3 font-bold text-white rounded-full"
          >
            Create Booking
          </router-link>
        </div>
        <div class="mt-5">
          <div class="flex flex-wrap">
            <div>
              <label
                for="filterOne"
                class="inline-block mb-2 text-gray-700 form-label"
              >
                Select Status
              </label>
              <select
                v-model="filterOne"
                @change="filterChange"
                id="filterOne"
                class="w-36 form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              >
                <option value="" disabled>Select One</option>
                <option v-for="x in optionOne" :value="x.value" :key="x.value">
                  {{ x.text }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="flex-col text-center">
        <div class="p-6 bg-white rounded-lg">
          <div class="">
            {{ getMonthName() }}
          </div>
          <div class="text-4xl font-extrabold">
            {{ totalGuests }}
          </div>
          <div class="">Guests this month</div>
        </div>
      </div>
    </div>
    <div class="flex flex-col mt-8">
      <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="w-full">Select Filter</div>
        <div class="flex flex-row items-center content-center">
          <div class="flex-col">
            <div class="" v-if="filterType == 'date_range'">&nbsp;</div>
            <select
              v-model="this.$parent.filterType"
              @change="changeFilterType"
              name="filterBy"
              id="filterBy"
              class="w-36 form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            >
              <option value="" selected disabled>Select Filter</option>
              <option value="name">Name</option>
              <option value="order_id">Order ID</option>
              <option value="phone">Phone</option>
              <option value="guest">Guest</option>
              <option value="check_in">Date of Arrival</option>
              <option value="date_range">Date Range</option>
            </select>
          </div>
          <div class="flex-col">
            <input
              v-if="filterType == 'check_in'"
              v-model="this.$parent.searchKey"
              type="date"
              class="w-full form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            />
            <div v-else-if="filterType == 'date_range'" class="flex flex-row">
              <div class="flex-col">
                From: <br />
                <input
                  @change="updateRange"
                  v-model="dateRangeFrom"
                  type="date"
                  class="w-full form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                />
              </div>
              <div class="flex-col">
                To: <br />
                <input
                  @change="updateRange"
                  v-model="dateRangeTo"
                  type="date"
                  class="w-full form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                />
              </div>
            </div>
            <input
              v-else
              v-model="this.$parent.searchKey"
              type="text"
              name="key"
              id="key"
              class="w-full form-select appearance-none block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            />
          </div>
          <div class="flex-col">
            <div class="" v-if="filterType == 'date_range'">&nbsp;</div>
            <button
              @click="searchForBooking"
              class="p-2 rounded-r-lg bg-colorx"
            >
              <svg
                fill="#ffffff"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 30 30"
                width="20px"
                height="20px"
              >
                <path
                  d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"
                />
              </svg>
            </button>
          </div>
        </div>
        <br />
        <div
          class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg"
        >
          <table class="">
            <thead>
              <tr>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Order ID
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  User
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Phone
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Payment Mode
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Lodge
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Room Required
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Check In
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Check Out
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                >
                  Status
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  Action
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  Room Number
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  More
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  Cancel Booking
                </th>
              </tr>
            </thead>
            <div v-show="hasLoading" class="flex items-center justify-center">
              Loading
              <div class="w-8 h-8 spinner-border animate-spin" role="status">
                <span class="visually-hidden">.</span>
              </div>
            </div>
            <tbody class="bg-white">
              <tr v-for="(value, index) in data" :key="index">
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ value.order_id }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ value.users.name }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ value.users.phone }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    <!-- Mode-online/manual -->
                    <!-- {{ value.id }} -->
                    <!-- {{ value.users.id }} -->
                    <!-- {{ value.users.role === "citizen" ? "Online" : "Manual" }} -->
                    <!-- {{ value.users.role }} -->
                    <!-- {{ value.payment.amount === " " ? "Online" : "Manual" }} -->
                    {{ value.payment ? "Online" : "Manual" }}

                   
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    <div v-if="value.lodge_room_data == null">EMPTY</div>
                    <div v-else>
                      {{ value.lodge_room_data.lodge_room_types.name }},
                      {{ value.lodge_room_data.lodges.name }},
                      {{
                        value.lodge_room_data.district_meta_data.district_name
                      }}
                    </div>
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ value.number_of_room_require }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ format_date(value.check_in) }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    {{ format_date(value.check_out) }}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <div class="flex items-center">
                    <div v-if="value.param1 == 'Booked'" class="text-blue-600">
                      Booked
                    </div>
                    <div
                      v-else-if="value.param1 == 'In'"
                      class="text-green-600"
                    >
                      Checked In
                    </div>
                    <div
                      v-else-if="value.param1 == 'Out'"
                      class="text-black-600"
                    >
                      Checked Out
                    </div>
                  </div>
                </td>
                <td
                  class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200"
                >
                  <button
                    v-on:click="checkOutClick(value.id)"
                    class="px-4 py-3 text-sm font-bold text-white bg-black rounded-full"
                  >
                    Change Status
                  </button>
                </td>
                <td
                  class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                >
                  <p v-if="value.param2 == null">
                    <router-link
                      class="flex items-center mt-3 text-green-600 hover:underline"
                      :to="{
                        name: 'roomAssign',
                        params: { id: value.id, roomNumber: value.param2 },
                      }"
                    >
                      <span class="mx-3">Assign Room</span>
                    </router-link>
                  </p>
                  <p v-else>
                    <router-link
                      class="flex items-center mt-3 hover:underline"
                      :to="{
                        name: 'roomAssign',
                        params: { id: value.id, roomNumber: value.param2 },
                      }"
                    >
                      <span class="mx-3"> {{ value.param2 }}</span>
                    </router-link>
                  </p>
                </td>
                <td
                  class="px-6 py-4 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200"
                >
                  <router-link
                    :to="{
                      name: 'bookingGuest',
                      params: { id: value.users.id, bookingId: value.id },
                    }"
                    class="text-indigo-400 hover:text-indigo-900"
                  >
                    More</router-link
                  >
                  <br />
                  <!-- <router-link :to="{ name: 'editBooking', params: {id: value.id}}">Edit</router-link> -->
                </td>
                <td
                  class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200"
                >
                  <button
                    type="button"
                    v-on:click="deleteModel(value.id)"
                    class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-800 hover:shadow-lg focus:bg-red-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    Cancel
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Pagination Style -->
  <div
    class="flex items-center justify-between px-4 py-3 mx-8 bg-white border-t border-gray-200 sm:px-8"
  >
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ fromData }}</span>
          to
          <span class="font-medium">{{ toData }}</span>
          of
          <span class="font-medium">{{ total }}</span>
          results
        </p>
      </div>
      <div>
        <nav
          class="inline-flex -space-x-px rounded-md shadow-sm isolate"
          aria-label="Pagination"
        >
          <div v-for="(page, index) in pages">
            <div v-if="page['active']">
              <button
                @click="changePage(page['url'])"
                aria-current="page"
                class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-600 focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
              >
                {{ page["label"] }}
              </button>
            </div>
            <div v-else>
              <button
                @click="changePage(page['url'])"
                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                :disabled="!page['url']"
              >
                <div v-if="page['label'].includes('Previous')">Previous</div>
                <div v-else-if="page['label'].includes('Next')">Next</div>
                <div v-else>
                  {{ page["label"] }}
                </div>
              </button>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Pagination ends -->
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
  data() {
    return {
      data: null,
      id: "",
      user: [],
      hasLoading: true,
      filterOne: 1,
      previousLink: "",
      nextLink: "",
      fromData: 0,
      toData: 0,
      total: 0,
      searched: false,
      optionOne: [
        { value: "All", text: "Show All" },
        { value: "In", text: "Show Check-In" },
        { value: "Out", text: "Show Check-Out" },
        { value: "Booked", text: "Show Booked" },
        {value: "Manual", text: "Manual"},
        {value: "Online", text: "Online"},
      ],
      filterTwo: 1,
      optionTwo: [
        { value: 1, text: "Show Success" }, //"Confirmed"
        { value: 2, text: "Show Failure" }, //"Payment Failed"
        { value: 3, text: "Show Inite" }, //1
        { value: 4, text: "Show All" },
      ],
      filterType: "",
      searchKey: "",
      totalGuests: 0,
      dateRangeFrom: "",
      dateRangeTo: "",
      pages: null,
    };
  },
  created() {
    this.user = User;
    this.filterType = this.$parent.filterType;
    this.getTotalGuestsForMonth();
    this.searched = false;
    this.changePage("/api/userbooking/" + this.user.id + "?page=1");
    
  },
  methods: {
    changeFilterType() {
      this.filterType = this.$parent.filterType;
      if (this.filterType == "date_range") {
        this.updateRange();
      } else {
        this.$parent.searchKey = "";
      }
    },
    updateRange() {
      if (this.dateRangeFrom != "" && this.dateRangeTo != "") {
        this.$parent.searchKey =
          '{"dateRangeFrom": "' +
          this.dateRangeFrom +
          '", "dateRangeTo": "' +
          this.dateRangeTo +
          '"}';
      }
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
    changePage(url) {
      if (this.searched == true) {
        this.continueSearch(url);
      } else {
        axios.get(url).then((result) => {
          if (result.data.data == false) {
            this.hasLoading = false;
          } else {
            console.log(result.data.data.data);
            this.data = result.data.data.data;
            this.pages = result.data.data.links;
            this.hasLoading = false;
            this.nextLink = result.data.data.next_page_url;
            this.previousLink = result.data.data.prev_page_url;
            this.fromData = result.data.data.from;
            this.toData = result.data.data.to;
            this.total = result.data.data.total;
          }
        });
      }
    },
    turncate(text, length, suffix) {
      if (text == null) {
        return "";
      } else {
        if (text.length > length) {
          return text.substring(0, length) + suffix;
        } else {
          return text;
        }
      }
    },

    checkOutClick(id) {
      axios.get("/api/checkout/" + id).then((result) => {
        this.$router.go();
      });
      //code works without bottom code
      // axios.get("/api/bookings").then((result) => {
      //   this.data = result.data.data;
      // })
    },
    deleteModel(id) {
      if (confirm("Do you really want to cancel this booking?")) {
        axios.post("/api/cancel-booking/" + id).then((result) => {
          if (result.status == 200) {
            this.$router.go();
          }
        });
      }
    },

    filterChange() {
      this.filterOne;
      var url = "";

      switch (this.filterOne) {
        case "All":
          url = "/api/userbooking/";
          break;
        case "Booked":
          url = "/api/booking-status/Booked/";
          break;
        case "In":
          url = "/api/booking-status/In/";
          break;
        case "Out":
          url = "/api/booking-status/Out/";
          break;
          case "Manual":
          url = "/api/booking-status/Manual/";
          break;  
          case "Online":
          url = "/api/booking-status/Online/";
          break;  
      }

      axios.get(url + this.user.id).then((result) => {
        console.log(result.data.data.data);
        this.data = result.data.data.data;
        this.nextLink = result.data.data.next_page_url;
        this.previousLink = result.data.data.prev_page_url;
        this.fromData = result.data.data.from;
        this.toData = result.data.data.to;
        this.total = result.data.data.total;
        this.pages = result.data.data.links;
      });
    },

    continueSearch(url) {
      let self = this;
      if (self.$parent.filterType != "" && self.$parent.searchKey != "") {
        // if (self.$parent.filterType == 'date_range') {
        //   self.$parent.searchKey = '{"dateRangeFrom": "' + self.dateRangeFrom + '", "dateRangeTo": "' + self.dateRangeTo + '"}';
        // }
        axios
          .get(
            url +
              "&type=" +
              self.$parent.filterType +
              "&key=" +
              self.$parent.searchKey +
              "&userId=" +
              this.user.id
          )
          .then((result) => {
            this.data = result.data.data;
            this.nextLink = result.data.next_page_url;
            this.previousLink = result.data.prev_page_url;
            this.fromData = result.data.from;
            this.toData = result.data.to;
            this.total = result.data.total;
            this.pages = result.data.links;
          })
          .catch((err) => {
            throw err;
          });
      } else {
        alert("Please select filter type and enter search key");
      }
    },

    searchForBooking() {
      let self = this;
      self.searched = true;
      if (self.$parent.filterType != "" && self.$parent.searchKey != "") {
        // if (self.$parent.filterType == 'date_range') {
        //   self.$parent.searchKey = '{"dateRangeFrom": "' + self.dateRangeFrom + '", "dateRangeTo": "' + self.dateRangeTo + '"}';
        // }
        axios
          .get(
            "/api/search-for-booking?type=" +
              self.$parent.filterType +
              "&key=" +
              self.$parent.searchKey +
              "&userId=" +
              this.user.id
          )
          .then((result) => {
            this.data = result.data.data;
            this.nextLink = result.data.next_page_url;
            this.previousLink = result.data.prev_page_url;
            this.fromData = result.data.from;
            this.toData = result.data.to;
            this.total = result.data.total;
            this.pages = result.data.links;
          })
          .catch((err) => {
            throw err;
          });
      } else {
        alert("Please select filter type and enter search key");
      }
    },

    getMonthName() {
      var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      var d = new Date();
      var monthName = months[d.getMonth()];
      return monthName + " " + d.getFullYear();
    },

    getTotalGuestsForMonth() {
      var d = new Date();
      // var todaydate = d.getFullYear() + '/' + d.getMonth() + '/' + d.getDate();
      var todaydate = "2022/05/23";
      axios
        .get(
          "/api/total-guests-for-month?user_id=" +
            this.user.id +
            "&&date=" +
            todaydate
        )
        .then((res) => {
          this.totalGuests = res.data;
        })
        .catch((err) => {
          throw err;
        });
    },
  },
};
</script>