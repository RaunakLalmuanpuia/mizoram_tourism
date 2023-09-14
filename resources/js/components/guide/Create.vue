<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create Guide</div>
            
            <div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="name" class="form-label inline-block mb-2 text-gray-700">
                                Name
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="name"
                            placeholder="Name"
                            v-model="data.name"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="license" class="form-label inline-block mb-2 text-gray-700">
                                License
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="license"
                            placeholder="License"
                            v-model="data.license"
                            />
                        </div>
                    </div>
                    
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="address" class="form-label inline-block mb-2 text-gray-700">
                                Address
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="address"
                            placeholder="Address"
                            v-model="data.address"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="district" class="form-label inline-block mb-2 text-gray-700">
                                District
                            </label>
                            <select v-model="data.district_meta_data_id"
                            class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select District</option>
                                <option
                                    v-for="(district, i) in districts"
                                    :value="district['id']"
                                    :key="i"
                                >{{ district['district_name'] }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="phone_one" class="form-label inline-block mb-2 text-gray-700">
                                Phone One
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="phone_one"
                            placeholder="Phone One"
                            v-model="data.phone_one"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="phone_two" class="form-label inline-block mb-2 text-gray-700">
                                Phone Two
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="phone_two"
                            placeholder="phone Two"
                            v-model="data.phone_two"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="email" class="form-label inline-block mb-2 text-gray-700">
                                Email
                            </label>
                            <input
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="email"
                            placeholder="Email"
                            v-model="data.email"
                            />
                        </div>
                    </div>          
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Description
                            </label>
                            <textarea
                            type="text"
                            class=" form-control block w-full px-3 py-1.5
                                text-base  font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="description"
                            placeholder="Description"
                            v-model="data.description"
                            rows="4"
                            ></textarea>
                        </div>
                    </div>     


                    <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="createModel" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Submit
                            </button>
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
        districts:{},

        data:{
            name:'',
            license:'',
            address:'',
            district_meta_data_id:'',
            phone_one:'',
            phone_two:'',
            email:'',
            description:'',
        },
      
    }
  },
  created() {
        axios.get("/api/districts").then((result) => {
            console.log("My very data: "+result.data.data[0].district_name);
            this.districts = result.data.data;
        })
  },
  methods: {
      createModel(){
          axios.post('/api/guides',this.data)
          .then(response=>{
              console.log(response.status)
              if(response.status==200){
                  this.$router.push('./')
              }
          })
          .catch(e=>{
               
          })
      }
  }
};

</script>
