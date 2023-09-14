<template>
<div>
    <div v-show="!lodgeCreated">
        <div class="mx-2 mt-10 ml-10 text-2xl font-semibold text-black underline decoration-solid">
            Lodge must be created</div>

    </div>
    <div v-show="lodgeCreated"  class="container px-8 mt-10 ">

      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Monthly Occupancy Statement</div>

        <div>
            <router-link
                :to="{ name: 'visitorDataReports' }"
                style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full ">
                Create Monthly Occupancy
            </router-link>
        </div>
        <hr>
        <div v-if="user.role=='admin'" class="grid grid-cols-3 p-3 mt-5 border-2 border-gray-100 border-solid">
          <div>
            <label for="year" class="inline-block mb-2 text-gray-700 form-label">
                  Month
            </label>
            <select v-model="filterMonth"
                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="" disabled>Select Month</option>
                <option
                    v-for="(month, i) in months"
                    :value="month"
                    :key="i"
                >{{ month }}</option>
            </select>
          </div>
          <div class="ml-3">
            <label for="month" class="inline-block mb-2 text-gray-700 form-label">
                Year
            </label>
            <select v-model="filterYear"
                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="" disabled>Select Year</option>
                <option value="none" >none</option>

                <option
                    v-for="n in 2100" :key="n"
                >{{ n+2010 }}</option>
            </select>
          </div>
          <div class="mt-2 ml-3">
          <button type="button" v-on:click="filterClick" style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full " >
              Filter
          </button>
          </div>

        </div>

      <div class="flex flex-col mt-8 ">
          <div class="py-2 -my-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
              <div
                  class="inline-block min-w-full align-middle border-b border-gray-200 shadow sm:rounded-lg ">
                  <table class="min-w-full ">
                      <thead>
                          <tr>
                              <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Sl No
                              </th>

                                <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Name of Facility
                              </th>
                              <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Month
                              </th>
                                <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Year
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
                          <tr v-for="(value,index) in data" :key="value.name">
                          <!-- <tr v-for="(value,index) in data"> -->
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{fromData+index}}
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.user.name}}
                                    <!-- {{ value.facility_name }} -->
                                  </div>

                              </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    {{value.month}}
                                  </div>

                              </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    {{value.year}}
                                  </div>

                              </td>
                              <td
                                  class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                  <router-link :to="{ name:'visitorDataReportDetail',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" >View</router-link>
                                  <!-- <router-link v-if="user.role=='admin'" :to="{ name:'visitorDataReports',params:{id:value.id}}" class="pl-2 text-indigo-400 hover:text-indigo-900" >Edit</router-link> -->

                              </td>
                          </tr>
                      </tbody>
                  </table>
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
</div>

</template>

<script>
import axios from "axios";
export default {
  data(){
    return{
      data:{},
      user:[],
      months:['none','January','February','March','April','May','June','July','August','September','October','November','December'],
      filterMonth:'none',
      filterYear:'none',
      lodgeCreated:false,
      hasLoading:true,
      searched: false,
      nextLink: '',
      previousLink: '',
      fromData: 0,
      toData: 0,
      total: 0,
      pages:null,
    }
  },
  created() {

    this.user = User

    //CHECK IF LODGE IS CREATED
    if(this.user.role=="admin" || this.user.role=="hotel"){
        this.lodgeCreated=true
    }else{
        axios.get("/api/lodge-user/"+this.user.id).then((result) => {
            if(result.data.length==0)
                this.lodgeCreated=false
            else
                this.lodgeCreated=true
        })
    }

    // axios.get("/api/occupancy-by-role/"+this.user.id).then((result) => {
    //     this.data = result.data.data;
    //     this.hasLoading=false

    // })
    this.searched = false;
    this.changePage("/api/occupancy-by-role/"+this.user.id)
  },
    methods: {
      changePage(url) {
          if (this.searched == true) {
            this.continueSearch(url);
          } else {
            axios.get(url)
              .then((result) => {
                if(result.data.data.length===0) this.noRecord=true
                else this.noRecord=false

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

                // console.log(result)
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

    filterClick(){
      this.filterMonth
      this.filterYear

      axios.get("/api/fiter/occupancy/"+this.filterMonth+"/"+this.filterYear).then((result)=>{
        this.data = result.data.data.data;
        this.hasLoading = false;
        this.nextLink = result.data.data.next_page_url;
        this.previousLink = result.data.data.prev_page_url;
        this.fromData = result.data.data.from;
        this.toData = result.data.data.to;
        this.total = result.data.data.total;
        this.pages = result.data.data.links;
        // console.log(result)
      })
    },


  }
};

</script>
