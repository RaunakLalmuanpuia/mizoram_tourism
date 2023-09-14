<template>
    <div class="container mt-10  px-8  ">
        <div class="mb-6 text-black text-2xl mx-2 font-semibold">Rating List</div>
 
        


        <div>

<div
                  class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                  <table class="min-w-full">
                      <thead>
                            <tr>
                              <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Sl No.
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                            </tr>
                      </thead>
                      <tbody class="bg-white">
                        <tr>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 1</td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                        <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Operator'} }"  >
                                        Tour Operator
                                        </router-link>                  
                                  </div>
                        </td></tr>
                        <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 2</td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Lodge'}  }"  >
                                        Lodge
                                        </router-link>    
                                  </div>
                        </td></tr>                          
                         <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 3</td>
                           <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                       <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Guide'}  }"  >
                                        Tour Guide
                                        </router-link>
                                  </div>
                        </td></tr>                          
                         <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 4</td>
                           <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                     <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Agent'}  }" >
                                        Travel Agent
                                        </router-link>  
                                  </div>
                        </td></tr>
                        <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 5</td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Rental'}  }" >
                                    Car Rental
                                    </router-link>   
                                  </div>
                        </td></tr>
                         <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 6</td>
                           <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                     <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Restaurant'}  }" >
                                    Restaurant
                                    </router-link>  
                                  </div>
                        </td></tr>
                        <tr><td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"> 7</td>
                          <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                       <router-link  :to="{ name: 'ratingIndex', params:{MODEL:'Hotel'}  }"  >
                                        Hotel
                                        </router-link>
                                  </div>
                        </td></tr>                                                                       

                      </tbody>
                  </table>
              </div>
        </div>


    </div>
</template>

<script>
import axios from "axios";
export default {
  data(){
    return{
      data:{}
    }
  },
  created() {
             

    // axios.get("/api/quotes").then((result) => {
    //   console.log(result.data);
    // this.data = result.data.data;

    // })
  }
};

</script>
