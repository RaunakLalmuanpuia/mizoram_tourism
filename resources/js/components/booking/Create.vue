<template>
  <div class="">
    <button class="mt-10 ml-5" onclick="history.back()">Go Back</button>
    <div class="p-8 px-24 ml-5 bg-white border border-gray-300 w-200">
      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Create Booking</div>
      <div>
        <div class="relative mb-3 mr-3">
          <div class="mb-3">
            <label for="room" class="inline-block mb-2 text-gray-700 form-label">
              Select District
            </label>
            <select v-model="selectedDistrict" @change="districtChange"
              class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              <option value="" disabled>Select District</option>
              <option v-for="(district, i) in mDISTRICTS" :value="district.id" :key="i">{{district.district_name}}
              </option>
            </select>
          </div>
        </div>

        <div class="relative mb-3 mr-3">
          <div class="mb-3">
            <label for="lodge" class="inline-block mb-2 text-gray-700 form-label">
              Select Lodge
            </label>

            <select v-model="selectedLodge" @change="lodgeChange"
              class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              <option value="" disabled>Select Lodge</option>
              <option v-for="(lodge, i) in mLODGES" :value="lodge.id" :key="i">{{lodge.name}}</option>
            </select>
          </div>
        </div>
        <div class="flex">
          <div class="mb-3 xl:w-96">
            <label for="check_in" class="inline-block mb-2 text-gray-700 form-label">
              Check in
            </label>
            <input @change="checkInChange" type="date"

              class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
              id="check_in" placeholder="check in date" v-model="data.check_in" />
          </div>
        </div>
        <div class="flex">
          <div class="mb-3 xl:w-96">
            <label for="check_out" class="inline-block mb-2 text-gray-700 form-label">
              Check Out
            </label>
            <input @change="checkOutChange" :disabled="disable" type="date"

              class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
              id="check_out" placeholder="check out data" v-model="data.check_out" />
          </div>
        </div>

        <div class="relative mb-3 mr-3">
          <div class="mb-3">
            <label for="room" class="inline-block mb-2 text-gray-700 form-label">
              Select Room
            </label>

            <select v-model="selectedRoom" @change="roomChange"
              class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              <option value="" disabled>Select Room</option>
              <option v-for="(room, i) in mROOMS" :value="room.id" :key="i">{{room.lodge_room_types.name}}</option>
            </select>
          </div>
        </div>

        <p class="text-green-600">{{currentAvailableRoom}}</p>

        <div class="relative mb-3 mr-3">
          <div class="mb-3">
            <label for="user" class="inline-block mb-2 text-gray-700 form-label">
              Select User
            </label>
            <vSelect v-model="data.users_id" :options="users" label="name" :reduce="name=>name.id"></vSelect>
          </div>
        </div>
        <div class="flex">
          <div class="mb-3 xl:w-96">
            <label for="number_of_room_require" class="inline-block mb-2 text-gray-700 form-label">
              Room Require
            </label>
            <select placeholder="test" v-model="data.number_of_room_require" class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
              <option v-for="i in available_room" :key="i" :value="i">{{ i }}</option>
            </select>
          </div>
        </div>
        <div class="flex">
          <div class="mb-3 xl:w-96">
            <label for="number_of_guest" class="inline-block mb-2 text-gray-700 form-label">
              Number of Guest
            </label>
            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
              id="number_of_guest" placeholder="eg: 1 or 2 or more" v-model="data.param3" />
            <div class="error" v-if="!isValidGuest">Guest Number is invalid (only numerical)</div>
          </div>
        </div>

        <p class="mb-4 text-green-600">{{ priceToPay }}</p>

        <div class="flex">
          <div class="mb-3 xl:w-96">


            <div class="">
              <button type="button"
                class="flex justify-start px-3 py-2 mb-2 ml-2 text-white bg-green-600 border rounded-md"
                @click="addMore()">
                Add Guest
              </button>
              <div class="mb-2" v-for="(course, index) in guests" :key="index">
                <div class="grid grid-rows-2 gap-2 px-2 pt-2 border-2 border-dashed border-grey-500 md:grid-cols-3">
                  <input v-model="course.first_name" placeholder="Name" class="w-full px-2 py-2 mr-2 border rounded" />
                  <input v-model="course.phone" placeholder="Phone" class="w-full px-2 py-2 mr-2 border rounded" />
                  <input v-model="course.email" placeholder="Email" class="w-full px-2 py-2 mr-2 border rounded" />
                  <button type="button" class="py-2 ml-2 text-white bg-red-600 border rounded-md" @click="remove(index)"
                    v-show="index != 0">
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-show="mAlert">
          <div class="relative px-4 py-3 mt-5 ml-5 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">Error in Room Require.</span>
            <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                  d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
              </svg>
            </span>
          </div>
        </div>

        <div class="flex justify-center space-x-2">
          <button :class="inputDisabled ? 'bg-gray-600 hover:bg-gray-600' : 'bg-blue-600'" :disabled="inputDisabled"
            type="button" v-on:click="createModel"
            class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Submit
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import vSelect from 'vue-select';

export default {
  components: {
    vSelect,

  },
  data() {
    return {
      inputDisabled: false,
      name: '',
      mAlert: false,
      available_room: 0,

      data: {
        lodge_room_data_id: '',
        users_id: '',
        number_of_room_require: 0,
        check_in: '',
        check_out: '',
        status: 'Confirmed',
        param1: 'Booked', //BEFORE COLUMN "checked_id" WAS USED . BUT NOW CHANGE TO "param1". THE VALUES ARE "Booked", "In", "Out"
        //param2 is used for room number assignment
        param3: 1,//USED FOR NUMBER OF GUEST
      },

      obj: {},
      rooms: [],
      users: [],
      value: null,

      guests: [
        {
          first_name: "",
          email: '',
          phone: '',
        },
      ],
      mDISTRICTS: {},
      mLODGES: {},
      mROOMS: {},

      selectedDistrict: '',
      selectedLodge: '',
      selectedRoom: '',

      isValidRoom: true,
      isValidGuest: true,

      regex: /[0-9]/,
      currentAvailableRoom: '',
      priceToPay: '',
      roomPrice: '',
      days: '',
      hasPrice: false,
      hasRequire: false,
      hasDays: false,
      hasGuest: true,
      disable: true,
      today: '',
      checkOutMin: '',


    }
  },


  created() {
    this.today = moment(new Date()).format("YYYY-MM-DD");
    this.checkOutMin = moment(this.today).add(1, 'days').format("YYYY-MM-DD");

    //1. GET DISTRICT NAME

    axios.get("/api/districts").then(result => {
      this.mDISTRICTS = result.data.data;
    })


    axios.get("/api/room").then(result => {
      this.rooms = result.data.data.data;
    })

    // axios.get("/api/get-all-users").then(result => {
    //   this.users = result.data.data.data;
    // })
    this.users = [User];

  },
  methods: {
    createModel() {
      if (this.isValidRoom && this.data.number_of_room_require != 0) {

        const booking = new Object()
        booking.data = this.data
        booking.guest = this.guests

        axios.post('/api/bookings', booking)
          .then(response => {
            this.obj = response
            this.available_room = response.data.data.available

            if (response.data.data != true) {
              this.mAlert = true
              this.available_room = response.data.data
            }

            else {
              if (response.status == 200) {
                this.$router.push('./')
              }
            }

          })
          .catch(e => {

          })
      }
    },

    toastCloseClick() {
      this.mAlert = false
    },


    addMore() {
      this.guests.push({
        first_name: '',
        email: '',
        phone: '',
      });
    },
    remove(index) {
      this.guests.splice(index, 1);
    },

    districtChange() {

      axios.get("/api/getByDistrict/" + this.selectedDistrict).then(result => {
        this.mLODGES = result.data;

      })
      this.data.number_of_room_require = 0;
      this.currentAvailableRoom = '';
      this.available_room = 0;
    },

    lodgeChange() {
      axios.get("/api/getTypeByLodge/" + this.selectedLodge).then(result => {
        this.mROOMS = result.data;
      })
      this.data.number_of_room_require = 0;
      this.currentAvailableRoom = '';
      this.available_room = 0;
    },
    roomChange() {
      this.data.lodge_room_data_id = this.selectedRoom
      this.data.number_of_room_require = 0;

      axios.get("/api/getRoomAvailable/" + this.data.lodge_room_data_id+"?check_in="+this.data.check_in+"&check_out="+this.data.check_out).then(result => {
        this.currentAvailableRoom = "Available Room: " + result.data.data.room_available_now;
        this.available_room = result.data.data.room_available_now;
        if (result.data.data.room_available_now == 0) {
          this.inputDisabled = true;
        } else {
          this.inputDisabled = false;
        }
        this.roomPrice = result.data.data.price;
        this.hasPrice = true
        this.calculatePrice()
      })
    },
    checkInChange() {
      this.data.number_of_room_require = 0;
      this.disable = false
      this.checkOutMin = moment(this.data.check_in).add(1, 'days').format("YYYY-MM-DD");
      this.data.check_out = this.checkOutMin;
      if(this.selectedRoom != ''){
        this.roomChange();
      }
    },
    checkOutChange() {
      this.data.number_of_room_require = 0;
      this.hasDays = true

      const start = moment(this.data.check_in)
      const end = moment(this.data.check_out)
      const diff = end.diff(start, "days")
      this.days = diff
      if (this.selectedRoom != '') {
        this.roomChange();
      }
      this.calculatePrice()
    },

    changeInputOne(e) {
      this.data.number_of_room_require = 0;
      const number = e.target.value
      this.isValidRoom = /^\d+$/.test(number)
      if (this.isValidRoom)
        this.hasRequire = true
      else
        this.hasRequire = false

      this.calculatePrice()
    },

    calculatePrice() {
      if (this.hasDays && this.hasPrice && this.hasRequire && this.hasGuest) {

        this.priceToPay = parseInt(this.days) * parseInt(this.roomPrice) * parseInt(this.data.number_of_room_require) //PARAM3 REPRESENT  NUMBER OF GUEST
        this.priceToPay = "Amount to Pay : Rs " + this.priceToPay
      }

    },
    numberOfGuestChange(e) {

      const number = e.target.value
      if (this.data.param3 == '') {
        this.data.param3 = 0
        this.hasGuest = true
      }
      else {
        this.isValidGuest = /^\d+$/.test(number)

        if (this.isValidGuest)
          this.hasGuest = true
        else
          this.hasGuest = false
      }

      this.calculatePrice()


    }
  }
};


</script>
<style scoped>
 .error {
   color: red;
 }
 </style>
