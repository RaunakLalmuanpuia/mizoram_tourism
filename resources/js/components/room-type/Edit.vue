<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Room Type</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteRoomType" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>
                
                </div>
                
            </div>
            <div class="mt-5" v-show="error">
                    <div>
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Delete Not Possible!</strong>
                        <span class="block sm:inline mr-5">Already used in Lodge Rooms.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>
                </div>
            <div>
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="name" class="form-label inline-block mb-2 text-gray-700"
                    >Name</label
                    >
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
                    id="name"
                    placeholder="eg: Delux"
                    v-model="data.name"
                    />
                </div>
            </div>
            
            <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="updateRoomType" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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
        error:false,

      
    }
   
  },
    created() {
        this.id = this.$route.params.id

          
        axios.get("/api/lodge-room-type/"+this.id).then((result) => {
            this.data.name = result.data.name;
        })
    },

    methods: {
        updateRoomType(){
            axios.put("/api/lodge-room-type/"+this.id,this.data).then((result) => {
            // this.data = result.data.data;
            if(result.status==200){
                  this.$router.push('./')
              }
            })
        },

        deleteRoomType(){
            if(confirm("Do you really want to delete?")){

                axios.get("/api/delete/room/"+this.id).then((result) => {
                // this.data = result.data.data;
                if(result.data==true){
                    this.$router.push('./')
                }else if (result.data==false){
                    this.error=true
                }
                })
            }
        },
        toastCloseClick(){
            this.error=false
         }
    }
  
}

</script>
