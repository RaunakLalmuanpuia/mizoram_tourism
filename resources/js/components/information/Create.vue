<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create Information Center</div>
            
            <div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="title" class="form-label inline-block mb-2 text-gray-700">
                                Title
                            </label>
                            <input
                            type="text"
                            class="form-control  block w-full  px-3 py-1.5
                                text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="title"
                            placeholder="Title"
                            v-model="data.title"
                            />
                        </div>
                    </div>
                    <div>
                        <div class="mb-3 xl:w-96">
                            <label for="sub_title" class="form-label inline-block mb-2 text-gray-700">
                                Sub Title
                            </label>
                            <input
                            type="text"
                            class="form-control  block w-full  px-3 py-1.5
                                text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="sub_title"
                            placeholder="Sub Title"
                            v-model="data.sub_title"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Description
                            </label>
                            <textarea
                            type="text"
                            class="form-control  block w-full  px-3 py-1.5
                                text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="description"
                            placeholder="Description"
                            v-model="data.description"
                            rows="9"
                            ></textarea>
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 xl:w-96">
                            <label for="phone_one" class="form-label inline-block mb-2 text-gray-700">
                                Phone one
                            </label>
                            <input
                            type="text"
                            class="form-control  block w-full  px-3 py-1.5
                                text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="phone_one"
                            placeholder="Phone One"
                            v-model="data.phone_one"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="mb-3 xl:w-96">
                            <label for="phone_two" class="form-label inline-block mb-2 text-gray-700">
                                Phone Two
                            </label>
                            <input
                            type="text"
                            class="form-control  block w-full  px-3 py-1.5
                                text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="phone_two"
                            placeholder="Phone Two"
                            v-model="data.phone_two"
                            />
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
        data:{
            title:'',
            sub_title:'',
            description:'',
            phone_one:'',
            phone_two:'',
      },
      
    }
  },
  created() {
          
  },
  methods: {
      createModel(){
          axios.post('/api/informations',this.data)
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
