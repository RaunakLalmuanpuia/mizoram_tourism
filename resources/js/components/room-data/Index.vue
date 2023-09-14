<template>
  <div class="container mt-10  px-8 ">
    <div class="mB-5">
      <router-link :to="{ name: 'roommenu' }" class=" ml-5  hover:text-green-600"> Go Back</router-link>

    </div>

    <div class="mt-5">
      <router-link :to="{ name: 'roomCreate', params: { lodge_id: lodge_id, district_id: district_id } }"
        style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 ">
        Create Room
      </router-link>
    </div>

    <div class="flex flex-col mt-8">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
          <table class="min-w-full">
            <thead>
              <tr>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Sl No
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  District
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Lodge
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Room Type
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Amenities
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Total Room
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Room Available
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Price
                </th>

                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>
              </tr>
            </thead>

            <div v-show="hasLoading" class="flex justify-center items-center">
              Loading
              <div class="spinner-border animate-spin  w-8 h-8 " role="status">
                <span class="visually-hidden">.</span>
              </div>
            </div>

            <tbody class="bg-white">
              <tr v-for="(value, index) in data" :key="value.id">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ index + 1 }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.district_meta_data.district_name }}
                  </div>

                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center ">
                    {{ value.lodges.name }}
                  </div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    <div class="text-red-800" v-if="value.lodge_room_types == null">
                      EMPTY
                    </div>
                    <div v-else>
                      {{ value.lodge_room_types.name }}
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center ">
                    <!-- {{value.amenities}} -->
              <tr v-for="amenity in value.amenities" :key="amenity.id">
                {{ amenity.name }},
              </tr>
        </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ value.room_available }}

          </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ value.room_available_now }}

          </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ value.price }}

          </div>
        </td>

        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
          <!-- <router-link  to=#   class="text-indigo-600 hover:text-indigo-900">Edit</router-link> -->
          <router-link :to="{ name: 'roomsEdit', params: { id: value.id, lodge_id: lodge_id, district_id: district_id } }"
            class="text-indigo-400 hover:text-indigo-900"> Edit</router-link>
        </td>
        </tr>



        </tbody>
        </table>
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
      data: null,
      user: [],
      id: '',
      hasLoading: true
    }
  },
  created() {
    this.user = User
    //TODO:THIS ID IS THE LODGE ID
    this.lodge_id = this.$route.params.id
    this.district_id = this.$route.params.district_id

    // axios.get("/api/room").then((result) => {
    axios.get("/api/filter-room-with-lodge/" + this.lodge_id).then((result) => {

      this.data = result.data.data;
      this.hasLoading = false

    })
  },
  methods: {
    turncate(text, length, suffix) {
      if (text == null) {
        return '';
      } else {
        if (text.length > length) {
          return text.substring(0, length) + suffix;
        } else {
          return text;
        }
      }
    },
  }
};

</script>
