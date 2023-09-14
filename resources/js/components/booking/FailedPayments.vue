<template>
  <div class="m-4">
    <div class="text-2xl">Unconfirmed Bookings</div>
    <div class="flex flex-row content-center items-center mt-4">
      <div class="flex-col">
        <select v-model="this.$parent.unconfirmedFilterType" name="filterBy" id="filterBy"
          class="w-36 form-select appearance-none block  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
          <option value="" selected disabled>Select Filter</option>
          <option value="name">Name</option>
          <option value="order_id">Order ID</option>
          <option value="phone">Phone</option>
        </select>
      </div>
      <div class="flex-col">
        <input v-model="this.$parent.unconfirmedSearchKey" type="text" name="key" id="key"
          class="w-full form-select appearance-none block  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
      </div>
      <div class="flex-col">
        <button
          @click="fetchData('/api/failed-payments/?page=1&user_id='+this.user.id+'&key='+this.$parent.unconfirmedSearchKey+'&type='+this.$parent.unconfirmedFilterType)"
          class="bg-colorx p-2 rounded-r-lg">
          <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="20px" height="20px">
            <path
              d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z" />
          </svg>
        </button>
      </div>
    </div>
    <div class="bg-white rounded p-4 mt-4 w-full">
      <table class="table w-full">
        <thead>
          <tr>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Order ID</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Name</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Email</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Phone</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Lodge</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Room Required</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Period</th>
            <th
              class="p-4 border-b border-gray-200 bg-gray-50 text-center leading-4 text-sm text-gray-500 uppercase tracking-wider">
              Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(booking, index) in bookings" :key="index">
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{ booking.order_id
            }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{ booking.users.name
            }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{
            booking.users.email }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{
            booking.users.phone }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">
              {{ booking.lodge_room_data.lodge_room_types.name }} in
              <br>
              {{ booking.lodge_room_data.lodges.name }}
            </td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{
            booking.number_of_room_require }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider">{{
            format_date(booking.check_in) }} to {{ format_date(booking.check_out) }}</td>
            <td class="border-b border-gray-200 bg-white text-center p-4 leading-4 tracking-wider text-xs">
              <router-link :to="{name: 'failedPaymentDetail', params: {id: booking.order_id}}"
                class="bg-colorx hover:bg-green-400 text-white p-2">Track Payment</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="w-full mt-10">
      <div class="flex flex-row justify-center items-center content-center">
        <div class="flex-col">
          <button v-if="previousLink != null"
            @click="fetchData(previousLink+'&user_id='+user.id+'&key='+this.unconfirmedSearchKey+'&type='+this.unconfirmedFilterType)"
            class="pl-4 pr-4 rounded-l-lg p-2 bg-colorx text-white">Previous</button>
          <button v-else disabled class="pl-4 pr-4 rounded-l-lg p-2 bg-gray-500 text-white">Previous</button>
        </div>
        <div class="flex-col">
          <button disabled class="pl-4 pr-4 border-gray-500 p-2">
            Showing {{ fromData }} to {{ toData }} of {{ total }} records
          </button>
        </div>
        <div class="flex-col">
          <button v-if="nextLink != null"
            @click="fetchData(nextLink+'&user_id='+user.id+'&key='+this.unconfirmedSearchKey+'&type='+this.unconfirmedFilterType)"
            class="pl-4 pr-4 rounded-r-lg p-2 bg-colorx text-white">Next</button>
          <button v-else disabled class="pl-4 pr-4 rounded-r-lg p-2 bg-gray-500 text-white">Next</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import moment from 'moment';

  export default{
    data(){
      return {
        user: null,
        bookings: [],
        previousLink: '',
        nextLink: '',
        fromData: 0,
        toData: 0,
        total: 0,
      }
    },
    mounted(){
      this.user = User;
      this.fetchData("/api/failed-payments/?page=1&user_id=" + this.user.id + '&key=&type=');
    },
    methods: {
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
      fetchData(url){
        axios.get(url)
        .then((res) => {
          this.bookings = res.data.data;
          this.nextLink = res.data.next_page_url;
          this.previousLink = res.data.prev_page_url;
          this.fromData = res.data.from;
          this.toData = res.data.to;
          this.total = res.data.total;
        })
        .catch((err) => {
          throw err;
        });
      }
    }
  }
</script>