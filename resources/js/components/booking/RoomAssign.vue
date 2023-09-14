<template>
    <div class="container mt-10  px-8 ">

      <div class=" text-black text-2xl mx-2 font-semibold">All Booking</div>

      <button class="mt-5  mb-5 hover:underline"  onclick="history.back()">Go Back</button>

       <div>
          Room Number
       </div>
       <div>

       <input
       type="text"
       v-model="roomNumber"
       class="mb-5"
      />
       </div>

      <div>

        <button @click="roomAssignClick"
        class="rounded-full font-bold text-white px-4 py-3"
        style="background: #24b897">
          Assign Room
        </button>  
      </div>
      
     <div class="mb-3" v-show="mToast">
        <div class="ml-5 mt-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="info">
        <strong class="font-bold">Success!</strong>
        <span class="mr-3 mr-5 block sm:inline ">Room Assign Successfully. </span>
        
        <span v-on:click="toastCloseClick" class="ml-3 absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class=" ml-3 fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
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
      roomNumber:'',
      mToast:false,
    }
  },
  created() {        
      this.id = this.$route.params.id


      this.roomNumber = this.$route.params.roomNumber
  },
  methods: {
     
    roomAssignClick(){
      axios.get('/api/room-assign/'+this.id+'/'+this.roomNumber).then(response => {
        console.log(response)
        if(response.status=200){
          this.mToast = true
        }   
      })
    },
  
    toastCloseClick(){
            this.mToast=false
    },
     

  }
};

</script>
