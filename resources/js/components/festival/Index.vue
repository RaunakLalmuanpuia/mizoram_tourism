<template>
    <div class="container mt-10  px-8 ">

      <div class="mb-6 text-black text-2xl mx-2 font-semibold">Festivals</div>

        <div>
            <router-link 
        :to="{ name: 'festivalCreate' }"
             style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 ">
          Create Festival
            </router-link>
        </div>
        

      <div class="flex flex-col mt-8">
          <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
              <div
                  class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                  <table class="min-w-full">
                      <thead>
                          <tr>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Sl No
                              </th>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Name
                              </th>
                               <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Date
                              </th>
                
                                <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Description
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
                          <tr v-for="(value,index) in data" :key="value.id">
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
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.date}}
                                  </div>
                                 
                              </td>
                              
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{turncate(value.description,10,"...")  }}
                                  </div>
                                 
                              </td>
                              
                              <td
                                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                  <!-- <router-link  to=#   class="text-indigo-600 hover:text-indigo-900">Edit</router-link> -->
                                  <router-link :to="{ name:'festivalEdit',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" > Edit</router-link>
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
      data:null,
      hasLoading:true

    }
  },
  created() {
             

    axios.get("/api/festivals").then((result) => {
      console.log("My very data: "+result.data);
    this.data = result.data.data;
    this.hasLoading=false

    })
  },
  methods: {
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
  }
};

</script>
