<template>
  <div class="container mt-10 px-8">
    <div class="mb-6 text-black text-2xl mx-2 font-semibold">
      User Lodge Assignment   
  
    </div>
    <div class="flex flex-col mt-8">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class=" align-middle  inline-block  min-w-full  shadow  overflow-hidden sm:rounded-lg border-b border-gray-200  ">
          <table class=" py-60 mb-60">
            <thead>
              <tr>
                <th class=" px-6  py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider " >
                  Sl No
                </th>
                <th class=" px-6  py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider " >
                  User Name
                </th>
                <th class=" px-6  py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider " >
                  Lodge
                </th>
                <th class=" px-6  py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider " >
                  Action
                </th> 
                 
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr v-for="(value,index) in data" :key="value.name">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ index+1 }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center">
                    {{ value.name }}
                  </div>
                </td>
                   
                <td class="w-60 px-6 py-4 whitespace-no-wrap border-b border-gray-200" >
                        <vSelect
                        v-model="lodge[index]"
                        :options="mLodge"
                        label="name"
                        ></vSelect>
                </td>


                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" >
                  <div class="flex items-center">
                     
                  </div>
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
import vSelect from 'vue-select';

export default {
      
  components:{
      vSelect,
    },
  data() {
    return {
      data: {},
      lodge:[],
      mLodge:'',

    };
  },
  created() {
  

    axios.get("/api/get-all-users").then((result) => {
      this.data = result.data.data;
    });
      
      
      axios.get("api/getOnlyLodgeName").then((result) => {
        this.mLodge = result.data.data
      })


   },
  methods : {
    statusChangedClick(id){
        axios.get("/api/check-user-status/"+id).then((result) => {

        console.log("My very data: "+result);
        })
    axios.get("/api/get-all-users").then((result) => {
      this.data = result.data.data;
    });

    },
    
  },
  computed: {
  }
};
</script>