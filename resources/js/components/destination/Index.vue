<template>
    <div class="container px-8 mt-10 ">

      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Top Destination</div>

        <div>
            <router-link
              :to="{ name: 'destinationCreate' }"
              style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full ">
                Create Top Destination
            </router-link>
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
                                    District
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Destination Name
                                </th>
                                  <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Distance From Airport
                                </th>
                                  <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Tags
                                </th>
                                  <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Description
                                </th>
                                  <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Image
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>
                            </tr>
                        </thead>
                            <div v-show="hasLoading" class="flex items-center justify-center">
                              Loading
                              <div class="w-8 h-8 spinner-border animate-spin " role="status">
                                  <span class="visually-hidden">.</span>
                              </div>
                          </div>

                        <tbody class="bg-white">
                            <tr v-for="(value,index) in data" :key="value.id">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                      {{fromData+index}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                      {{value.district_meta_data.district_name}}
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center ">
                                      {{value.destination_name}}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                      {{value.distance}}
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center ">
                                      <!-- {{turncate(value.tags,10,"...")  }} -->
                                        <tr v-for="tag in value.tags" :key="tag.id">
                                          {{tag.name}},

                                        </tr>

                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center ">
                                      {{turncate(value.description,10,"...")  }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center ">
                                      <!-- {{value.images }} -->
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <router-link :to="{ name:'destinationsEdit',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" > Edit</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
              </div>
          </div>
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
export default {
  data(){
    return{
      data:null,
      hasLoading:true,
      searched: false,
      nextLink: '',
      previousLink: '',
      fromData: 0,
      toData: 0,
      total: 0,
      pages: null,
    }
  },
  created() {
    this.user = User;
    this.searched = false;
    this.changePage("/api/destinations/");
  },
  methods: {
    changePage(url) {
      if (this.searched == true) {
        this.continueSearch(url);
      } else {
        axios.get(url)
          .then((result) => {
            if (result.data.data == false) {
              this.hasLoading = false
            } else {
              this.pages = result.data.data.links;
              this.data = result.data.data.data;
              this.hasLoading = false;
              this.nextLink = result.data.data.next_page_url;
              this.previousLink = result.data.data.prev_page_url;
              this.fromData = result.data.data.from;
              this.toData = result.data.data.to;
              this.total = result.data.data.total;
            }
          })
      }
    },
    turncate (text, length, suffix) {
      if(text==null){
        return '';
      }else{
        if (text.length > length) {
            return text.substring(0, length) + suffix;
        } else {
            return text;
        }
      }
    },
    continueSearch(url) {
      let self = this;
      if (self.$parent.filterType != "" && self.$parent.searchKey != "") {
        axios.get(url + '&type=' + self.$parent.filterType + '&key=' + self.$parent.searchKey + '&userId=' + this.user.id)
          .then((result) => {
            this.data = result.data.data
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
        alert('Please select filter type and enter search key')
      }
    },
  }
};

</script>
