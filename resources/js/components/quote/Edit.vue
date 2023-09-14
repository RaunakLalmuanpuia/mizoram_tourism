<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Quote</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteQuote" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>

                </div>
            </div>
            
            <div>
             <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="district" class="form-label inline-block mb-2 text-gray-700">
                                Ditrict
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
                            <label for="quote" class="form-label inline-block mb-2 text-gray-700">
                                Quote
                            </label>
                            <textarea
                            class="
                                form-control
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                            "
                            id="quote"
                            placeholder="quote"
                            v-model="data.quote"
                            rows="5"
                            ></textarea>
                        </div>
                    </div>
            
            <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="updateQuote" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Update
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
   
      id:null,
      data: 
        {
            quote:'',
            district_meta_data_id:''
        },
        districts:{},
      
    }
   
  },
    created() {
        this.id = this.$route.params.id

          
        axios.get("/api/quotes/"+this.id).then((result) => {
        console.log(result.data.name);
            this.data.quote = result.data.quote;
            this.data.district_meta_data_id = result.data.district_meta_data_id;
        })

        axios.get("/api/districts").then((result) => {
        console.log("My very data: "+result.data.data[0].district_name);
        this.districts = result.data.data;
         })
    },

    methods: {
        updateQuote(){
            axios.put("/api/quotes/"+this.id,this.data).then((result) => {
            console.log(result.data.name);
            // this.data = result.data.data;
            if(result.status==200){
                  this.$router.push('./')
              }
            })
        },

        deleteQuote(){
            if(confirm("Do you really want to delete?")){

                axios.delete("/api/quotes/"+this.id).then((result) => {
                console.log(result.data.name);
                // this.data = result.data.data;
                if(result.status==200){
                    this.$router.push('./')
                }
                })
            }
        }
    }
  
}

</script>
