<template>
    <div class="container mt-10  px-8 ">

      <div class="mb-6 text-black text-2xl mx-2 font-semibold">Carousal</div>

        <div>
            <router-link 
        :to="{ name: 'carousalCreate' }"
             style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 ">
          Create Carousal
            </router-link>
        </div>
        <div v-show="mToast">
            <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Warning!</strong>
            <span class="block sm:inline mr-5">Maximum of five (5) can be enabled</span>
            <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>
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
                                  Status
                              </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">
                                Action
                                </th>
        
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
                              <td
                                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                  <!-- <router-link  to=#   class="text-indigo-600 hover:text-indigo-900">Edit</router-link> -->
                                  
                                  <button v-if="value.status==true" class="rounded-full font-bold text-green-500 border-solid border-2 border-green-500 p-2"  @click="statusChange(value.id,value.status)">Enabled</button>
                                  <button v-if="value.status==false" class="rounded-full font-bold text-red-600  border-solid border-2 border-red-500 p-2"  @click="statusChange(value.id,value.status)">Disabled</button>
                               
                              </td>
                               <td
                                  class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                  <!-- <router-link  to=#   class="text-indigo-600 hover:text-indigo-900">Edit</router-link> -->
                                  <router-link :to="{ name:'carousalEdit',params:{id:value.id}}" class="text-indigo-400 hover:text-indigo-900" > Edit</router-link>
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
      lessThanFive:'',
      temp:"hh",
      statusCount:"",
      mToast:false,
      hasLoading:true


    }
  },
  created() {
             

    axios.get("/api/carousal").then((result) => {
      console.log("My very data: "+result.data);
    this.data = result.data.data;
    this.hasLoading=false

    })

      //COUNT THE STATUS UP TO FIVE

    // axios.get("/api/status-count").then((result) =>{
          
    //       this.lessThanFive = result.data

    
    // })

  },
  methods: {
      statusChange(id,status){
        //COUNT THE STATUS UP TO FIVE
        if(status){
          axios.get("/api/carousal-status/"+id).then((result) =>{
              this.data = result.data.data;
            this.$router.go();

          })  
        }else{
          axios.get("/api/status-count").then((result) =>{
              this.statusCount = result.data
              if(this.statusCount<5){
                axios.get("/api/carousal-status/"+id).then((result) =>{
                this.data = result.data.data;
                 this.$router.go();

              }) 
              }else{
                console.log("Cannot enable more than 5")
                this.mToast=true
              }
          })
        }
      },
      toastCloseClick(){
          this.mToast=false
      }
  },
  
};

</script>
