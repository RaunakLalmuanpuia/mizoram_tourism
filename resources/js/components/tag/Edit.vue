<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 p-8 ml-5 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Room Type</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteQuote" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>

                </div>
            </div>
            
            <div>
             <div class="flex">
                      
                    </div>
                     <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="tag" class="form-label inline-block mb-2 text-gray-700">
                                Tag
                            </label>
                            <input
                            type="text"
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
                            id="tag"
                            placeholder="tag"
                            v-model="data.name"
                            />
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
            name:'',
        },
        districts:{},
      
    }
   
  },
    created() {
        this.id = this.$route.params.id
          
        axios.get("/api/tags/"+this.id).then((result) => {
        console.log(result.data.name);
            this.data.name = result.data.name;
        })
 
    },

    methods: {
        updateQuote(){
            axios.put("/api/tags/"+this.id,this.data).then((result) => {
            console.log(result.data.name);
            // this.data = result.data.data;
            if(result.status==200){
                  this.$router.push('./')
              }
            })
        },

        deleteQuote(){

            if(confirm("Do you really want to delete?")){

                axios.delete("/api/tags/"+this.id).then((result) => {
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
