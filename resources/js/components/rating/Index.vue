<template>
    <div class="container mt-10  px-8  ">
         <button style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 " onclick="history.back()">Go Back</button>

      <div class="mb-6 text-black text-2xl mx-2 font-semibold">{{ fromOtherSide }}</div>

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
                                    Address
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Rating
                                </th>
                                <!-- <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th> -->
                          </tr>
                      </thead>
                        <div v-show="hasLoading" class="flex justify-center items-center">
                            Loading
                            <div class="spinner-border animate-spin  w-8 h-8 " role="status">
                                <span class="visually-hidden">.</span>
                            </div>
                        </div>

                      <tbody class="bg-white">
                          <tr v-for="value in data" :key="value.name">
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.id}}
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.name}}
                                  </div>
                                 
                              </td>

                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.address}}
                                  </div>
                                 
                              </td>
                                 <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.phone_one}}
                                  </div>
                                 
                              </td>

                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.rating}}
                                  </div>
                                 
                              </td>
                              <!-- <td
                                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                  <router-link :to="{ name:'quotesEdit',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" > Edit</router-link>
                              </td> -->
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
    props:['MODEL'],

    data(){
    return{
      data:{},
      fromOtherSide:'',
      mRoute:'',
      hasLoading:true

    }
  },
  mounted() {
    if(this.MODEL){
        this.fromOtherSide = this.MODEL

        switch(this.fromOtherSide){
        case 'Operator':this.mRoute="/api/all-operators-rating";break;
        case 'Lodge':this.mRoute="/api/all-lodges-rating";break;
        case 'Guide':this.mRoute="/api/all-guides-rating";break;
        case 'Agent':this.mRoute="/api/all-agents-rating";break;
        case 'Rental':this.mRoute="/api/all-rentals-rating";break;
        case 'Restaurant':this.mRoute="/api/all-restaurants-rating";break;
        case 'Hotel':this.mRoute="/api/all-hotels-rating";break;
        }
    
        axios.get(this.mRoute).then((result) => {
        console.log(result.data);
        this.data = result.data.data;
        this.hasLoading=false

        })

    }
  },
  created() {
    console.log(this.fromOtherSide);
    
  }
};

</script>
