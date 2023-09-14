<template>
  <div class="">
    <button class="mt-10 ml-5" onclick="history.back()">Go Back</button>
    <div class="bg-white border border-gray-300 p-8 px-24 w-200">
      <div class="flex">
        <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Booking</div>
      </div>

      <div>
        <div class="">
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="district" class="form-label inline-block mb-2 text-gray-700">
                District
              </label>

              <select v-model="data.district_meta_data_id"
                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">

                <option value="" disabled>Select District</option>
                <option v-for="(district, i) in districts" :value="district['id']" :key="i">
                  {{ district['district_name'] }}</option>
              </select>

            </div>
          </div>
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="destination_name" class="form-label inline-block mb-2 text-gray-700">
                Destination name
              </label>
              <input type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                id="destination_name" placeholder="Destination Name" v-model="data.destination_name" />
            </div>
          </div>
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="distance" class="form-label inline-block mb-2 text-gray-700">
                Distance
              </label>
              <input type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                id="distance" placeholder="Distance" v-model="data.distance" />
            </div>
          </div>
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="tags" class="form-label inline-block mb-2 text-gray-700">
                Tags
              </label>
              <input type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                id="tags" placeholder="Tags" v-model="data.tags" />
            </div>
          </div>

          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="description" class="form-label inline-block mb-2 text-gray-700">
                Description
              </label>
              <textarea rows="4" type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                id="description" placeholder="Description" v-model="data.description">
                            </textarea>
            </div>
          </div>


          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="images" class="form-label inline-block mb-2 text-gray-700">
                Image
              </label>
              <input type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                id="images" placeholder="image link" v-model="data.images" />
            </div>
          </div>


          <div class="flex space-x-2 justify-center">
            <button type="button" v-on:click="updateDestination"
              class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
              Update
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {

      id: null,
      data: {
        district_meta_data_id: '',
        destination_name: '',
        distance: '',
        tags: '',
        description: '',
        images: '',
      },
      districts: {},

    }

  },
  created() {
    this.id = this.$route.params.id


    axios.get("/api/destinations/" + this.id).then((result) => {
      console.log(result.data.name);
      this.data.district_meta_data_id = result.data.district_meta_data_id;
      this.data.destination_name = result.data.destination_name;
      this.data.distance = result.data.distance;
      this.data.tags = result.data.tags;
      this.data.description = result.data.description;
      this.data.images = result.data.images;

    })

    axios.get("/api/districts").then((result) => {
      console.log("My very data: " + result.data.data[0].district_name);
      this.districts = result.data.data;
    })
  },

  methods: {
    updateDestination() {
      axios.put("/api/destinations/" + this.id, this.data).then((result) => {
        console.log(result.data.name);
        // this.data = result.data.data;
        if (result.status == 200) {
          this.$router.push('./')
        }
      })
    },

    deleteDestination() {
      if (confirm("Do you really want to delete?")) {

        axios.delete("/api/destinations/" + this.id).then((result) => {
          console.log(result.data.name);
          // this.data = result.data.data;
          if (result.status == 200) {
            this.$router.push('./')
          }
        })
      }
    }
  }

}

</script>
