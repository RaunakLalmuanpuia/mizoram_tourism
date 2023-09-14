<template>
    <div class="container px-8 mt-10 ">

      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Tag List</div>

        <div>
            <router-link
        :to="{ name: 'tagCreate' }"
             style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full ">
          Create Tag
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
                              <!-- <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  District
                              </th> -->
                            <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Tag Name
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
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{index+1}}
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.name}}
                                  </div>

                              </td>


                              <td
                                  class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                  <!-- <router-link  to="{value.id}"   class="text-indigo-600 hover:text-indigo-900">Edit</router-link> -->
                                  <router-link :to="{ name:'tagEdit',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" > Edit</router-link>
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
  data(){
    return{
      data:{},
      hasLoading:true

    }
  },
  created() {


    axios.get("/api/tags").then((result) => {
      // console.log(result.data);
      this.data = result.data.data;
      this.hasLoading=false
    })
  }
};

</script>
