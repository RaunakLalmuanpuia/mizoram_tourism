<template>
  <div class="container px-8 mt-10">
    <div class="mx-2 mb-6 text-2xl font-semibold text-black">
      User List
    </div>
    <div>
      <router-link :to="{ name: 'userCreate' }" style="background: #24b897"
        class="px-4 py-3 font-bold text-white rounded-full">Create User</router-link>
    </div>

    <div class="mt-5 ">
      <span> Filter By: </span>
      <select v-model="filterValue" @change="onRoleChange"
        class="form-select appearance-none block w-1/6  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        <option value="" disabled>Select Filter</option>
        <option v-for="(role, i) in roles" :value="role['value']" :key="i">{{ role['label'] }} </option>
      </select>
    </div>

    <div class="w-2/4 mt-4">
      <span>Search By:</span>
      <div class="grid grid-cols-4">
        <div class="col-span-1">
          <select v-model="searchType"
            class="form-select appearance-none block w-full px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option value="name">Name</option>
            <option value="email">Email</option>
            <option value="phone">Phone</option>
          </select>
        </div>
        <div class="col-span-2">
          <input type="text" v-model="searchKey"
            class="w-full appearance-none block px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Search">
        </div>
        <div class="col-span-1">
          <button @click="searchUsers" class="bg-green-700 hover:bg-green-600 text-white px-2 py-[0.4rem] rounded">Search</button>
        </div>
      </div>
    </div>

    <div class="flex flex-col mt-8">
      <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div
          class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
          <table class="min-w-full">
            <thead>
              <tr>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Sl No
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Name
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Email
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Phone
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Role
                </th>
                <th
                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wide text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                  Status
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>

                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Edit</th>

                <!-- <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                  Action
                </th> -->
              </tr>
            </thead>

            <div v-show="hasLoading" class="flex items-center justify-center">
              Loading
              <div class="w-8 h-8 spinner-border animate-spin " role="status">
                <span class="visually-hidden">.</span>
              </div>
            </div>

            <tbody class="bg-white">
              <tr v-for="(value,index) in data" :key="value.name">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ fromData+index }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.name }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.email }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.phone }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.role }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center ">
                    <div class="text-green-600" v-if="value.approved==true">Approved</div>
                    <div v-else-if="value.approved==false" class="text-red-600"> Reject</div>
                    <div v-else-if="value.approved==null" class="text-black-600"> Null</div>
                  </div>
                </td>
                <td
                  class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                  <button v-on:click="statusChangedClick(value.id)"
                    class="px-4 py-3 font-bold text-white bg-black rounded-full ">Change Status</button>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    <router-link :to="{ name: 'userEdit', params: { id: value.id } }"
                      class="text-indigo-400 hover:text-indigo-900">
                      Edit
                    </router-link>
                  </div>
                </td>
                <!-- <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200 " >
                  <router-link
                    :to="{ name: 'amenityEdit', params: { id: value.id } }"
                    class="text-indigo-400 hover:text-indigo-900">
                      Edit
                  </router-link>
                </td> -->
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <div class="w-full mt-10">
        <div class="flex flex-row items-center content-center justify-center">
          <div class="flex-col">
            <button v-if="previousLink != null" @click="changePage(previousLink)"
              class="p-2 pl-4 pr-4 text-white rounded-l-lg bg-colorx">Previous</button>
            <button v-else disabled class="p-2 pl-4 pr-4 text-white bg-gray-500 rounded-l-lg">Previous</button>
          </div>
          <div class="flex-col">
            <button disabled class="p-2 pl-4 pr-4 border-t border-b border-gray-500">
              Showing {{ fromData }} to {{ toData }} of {{ total }} records
            </button>
          </div>
          <div class="flex-col">
            <button v-if="nextLink != null" @click="changePage(nextLink)"
              class="p-2 pl-4 pr-4 text-white rounded-r-lg bg-colorx">Next</button>
            <button v-else disabled class="p-2 pl-4 pr-4 text-white bg-gray-500 rounded-r-lg">Next</button>
          </div>
        </div>
      </div> -->
      </div>
    </div>
  </div>
  <!-- Pagination Style -->
  <div class="flex items-center justify-between px-4 py-3 mx-8 bg-white border-t border-gray-200 sm:px-8">
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{fromData}}</span>
          to
          <span class="font-medium">{{ toData }}</span>
          of
          <span class="font-medium">{{ total }}</span>
          results
        </p>
      </div>
      <div>
        <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
          <div v-for="(page, index) in pages" >
            <div v-if="page['active']">
              <button @click="changePage(page['url'])" aria-current="page" class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-600 focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                  {{ page["label"] }}
              </button>
            </div>
            <div v-else >
              <button
                @click="changePage(page['url'])"
                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                :disabled="!page['url']"
              >
                <div v-if="page['label'].includes('Previous')" >
                  Previous
                </div>
                <div v-else-if="page['label'].includes('Next')" >
                  Next
                </div>
                <div v-else >
                  {{ page['label'] }}
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
import vSelect from 'vue-select';

export default {

  components: {
    vSelect,
  },
  data() {
    return {
      searchKey: '',
      searchType: 'name',
      data: null,
      lodge: [],
      roles: [
        {
          'label': 'All',
          'value': 'all'
        },
        {
          'label': 'Lodge',
          'value': 'lodge'
        },
        {
          'label': 'Hotel',
          'value': 'hotel'
        },
        {
          'label': 'Citizen',
          'value': 'citizen'
        },
        {
          'label': 'Admin',
          'value': 'admin'
        },
      ],
      filterValue: '',

      hasLoading:true,
      searched: false,
      nextLink: '',
      previousLink: '',
      fromData: 0,
      toData: 0,
      total: 0,
      pages: null,
    };
  },
  created() {
    // this.getUsers();
    // this.changePage('/api/get-all-users?searchType='+this.searchType+'&searchKey='+this.searchKey)
    this.changePage('/api/get-all-users')
  },
  methods: {
    searchUsers(){
      this.searched = true
      const url = '/api/get-all-users?searchType='+this.searchType+'&&searchKey='+this.searchKey
      axios.get(url)
          .then((result) => {
            if (result.data.data == false) {
              this.hasLoading = false
            } else {
              this.data = result.data.data.data;
              this.hasLoading = false;
              this.nextLink = result.data.data.next_page_url;
              this.previousLink = result.data.data.prev_page_url;
              this.fromData = result.data.data.from;
              this.toData = result.data.data.to;
              this.total = result.data.data.total;
              this.pages = result.data.data.links;
            }
            // console.log(this.nextLink)
            // console.log(this.previousLink)
            // console.log( result )
          })
    },
    // getUsers(){
    //   this.hasLoading = true;
      // axios.get('/api/get-all-users?searchType='+this.searchType+'&searchKey='+this.searchKey)
    //   .then((result) => {
    //     this.data = result.data.data;
    //     this.hasLoading = false;
    //   })
    //   .catch((err)=>{
    //     throw err;
    //   })
    // },
    changePage(url) {
      if (this.searched == true) {
        this.continueSearch(url);
      } else {
        axios.get(url)
          .then((result) => {
            if (result.data.data == false) {
              this.hasLoading = false
            } else {
              this.data = result.data.data.data;
              this.hasLoading = false;
              this.nextLink = result.data.data.next_page_url;
              this.previousLink = result.data.data.prev_page_url;
              this.fromData = result.data.data.from;
              this.toData = result.data.data.to;
              this.total = result.data.data.total;
              this.pages = result.data.data.links;
            }
          })
      }
    },

    continueSearch(url){
      if(this.searchType != '' && this.searchKey != ''){
        axios.get(url + '&searchType=' + this.searchType + '&searchKey='+ this.searchKey)
          .then((result) => {
            if (result.data.data == false) {
              this.hasLoading = false
            } else {
              this.data = result.data.data.data;
              this.hasLoading = false;
              this.nextLink = result.data.data.next_page_url;
              this.previousLink = result.data.data.prev_page_url;
              this.fromData = result.data.data.from;
              this.toData = result.data.data.to;
              this.total = result.data.data.total;
              this.pages = result.data.data.links;
            }
          })
      }
    },

    statusChangedClick(id) {
      axios.get("/api/check-user-status/" + id).then((result) => {
        this.$router.go();
      })

      // axios.get("/api/get-all-users").then((result) => {
      //   this.data = result.data.data;
      // });
      this.changePage("/api/get-all-users")
    },

    onRoleChange() {
      // axios.get("/api/user-filter/" + this.filterValue).then((result) => {
      //   this.data = result.data.data;
      // });
      this.changePage("/api/user-filter/" + this.filterValue)
    },

  },
  computed: {
  }
};
</script>
