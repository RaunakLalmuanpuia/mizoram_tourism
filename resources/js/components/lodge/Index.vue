<template>
  <div class="container mt-10  px-8 ">
    <div class="mb-6 text-black text-2xl mx-2 font-semibold">Lodge</div>
    <div>
      <router-link v-if="userHasLodge == false" :to="{ name: 'lodgeCreate' }" style="background:#24b897"
        class=" rounded-full font-bold text-white  px-4 py-3 ">
        Create Lodge
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
                  Lodge Name
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Amenities
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Address
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Phone
                </th>
                <th
                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Description
                </th>

                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">View</th>
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
                    {{ value.name }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
              <tr v-for="amenity in value.amenities" :key="amenity.id">
                {{ amenity.name }},
              </tr>
        </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ turncate(value.address, 10, "...") }}
          </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ value.phone }}
          </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
          <div class="flex items-center ">
            {{ turncate(value.description, 10, "...") }}
          </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
          <router-link :to="{ name: 'lodgesEdit', params: { id: value.id } }"
            class="text-indigo-400 hover:text-indigo-900">Edit</router-link>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
          <router-link :to="{ name: 'lodgeRevenue', params: { id: value.id } }"
            class="text-indigo-400 hover:text-indigo-900">Statements</router-link>
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
      userHasLodge: '',
      hasLoading: true

    }
  },
  created() {
    this.user = User
    axios.get("/api/filter-lodge-with-role/" + this.user.id).then((result) => {
      this.data = result.data.data;
      this.hasLoading = false

    })

    if (this.user.role != "admin") {
      axios.get("/api/userHasLodge/" + this.user.id).then((result) => {
        this.userHasLodge = result.data.data
      })
    } else {
      this.userHasLodge = true
    }
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
