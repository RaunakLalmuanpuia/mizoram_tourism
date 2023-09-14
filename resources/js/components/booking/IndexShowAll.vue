<template>
    <div class="container mt-10  px-8 ">

      <div class=" text-black text-2xl mx-2 font-semibold">All Booking</div>

      <button class="mt-5 ml-5"  onclick="history.back()">Go Back</button>

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
                                  User
                              </th>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Phone
                              </th>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Lodge
                              </th>
                                <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Room Required
                              </th>
                                <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Check In
                              </th>
                                <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Check Out
                              </th>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Payment Status
                              </th>
                              <th
                                  class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                  Status
                              </th>
                              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Action</th>
                              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Guest</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Delete </th>

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
                                    {{value.users.name}} 
                                  </div>
                                 
                              </td>
                               <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.users.phone}} 
                                  </div>
                                 
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    <div v-if="value.lodge_room_data==null">
                                      EMPTY
                                    </div>
                                    <div v-else>
                                      {{value.lodge_room_data.lodge_room_types.name}}, {{value.lodge_room_data.lodges.name}}, {{value.lodge_room_data.district_meta_data.district_name}}
                                    </div>
                            <!-- {{value.lodge_room_data.lodges_id}}  -->

                                  </div>  
                              </td>
                              
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.number_of_room_require}}
                                  </div>
                                 
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    {{value.check_in}}

                                  </div>  
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    {{value.check_out}}
                                  </div>  
                              </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    <p v-if="value.status==1">Payment Incomplete</p>
                                    <p v-else>{{value.status}}</p>
                                  </div>  
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center ">
                                    
                                  <div  v-if="value.param1=='Booked'" class="text-blue-600">Booked</div>
                                  <div v-else-if="value.param1=='In'" class="text-green-600">Checked In</div>
                                  <div v-else-if="value.param1=='Out'" class="text-black-600">Checked Out</div>


                                </div>  
                              </td>
                              <td
                                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                  <button v-on:click="checkOutClick(value.id)" class="bg-black rounded-full font-bold text-white  px-4 py-3 ">Change Status</button>         
                              </td> 

                              <td
                                   class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">

                                    <router-link :to="{ name:'bookingGuest',params:{id:value.users.id}}" class="text-indigo-400 hover:text-indigo-900" > Guest</router-link>

                              </td>
                                 <td
                                   class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <button type="button" v-on:click="deleteModel(value.id)" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-800 hover:shadow-lg focus:bg-red-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Delete
                                </button>
 
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
      id:'',
      user:[],
      hasLoading:true,
      filterOne:1,
      optionOne:[
        {value:"All",text:'Show All'},
        {value:"In",text:'Show Check-In'},
        {value:"Out",text:'Show Check-Out'},
        {value:"Booked",text:'Show Booked'},
        
      ],
      filterTwo:1,
      optionTwo:[
        {value:1,text:'Show Success'}, //"Confirmed"
        {value:2,text:'Show Failure'}, //"Payment Failed"
        {value:3,text:'Show Inite'}, //1
        {value:4,text:'Show All'},
        
      ],
    }
  },
  created() {        
    this.user = User

    axios.get("/api/userbooking-all/"+this.user.id).then((result) => {
        if(result.data.data==false){
          this.hasLoading=false
        }else{
          console.log("My very data: "+result.data.data);
        this.data = result.data.data;
        this.hasLoading=false;

        }
     
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

    checkOutClick(id){
        axios.get("/api/checkout/"+id).then((result) => {
        console.log("My very data: "+result);
        this.$router.go();

      })

      axios.get("/api/bookings").then((result) => {
        console.log("My very data: "+result.data.data);
        this.data = result.data.data;
      })

    },

  
    deleteModel(id){
        
      if(confirm("Do you really want to delete?")){

          axios.delete("/api/bookings/"+id).then((result) => {
            // this.data = result.data.data;
            if(result.status==200){
                this.$router.go()
            }
          })
      }
  },

  

     

  }
};

</script>
