<template>
    <div class="mt-5">
        <router-link :to="{ name:'rooms',params:{id:lodge_id,district_id:district_id}}" class=" ml-5  hover:text-green-600" > Go Back</router-link>

         <div class="bg-white border border-gray-300   ml-5 p-8 px-24 w-200">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create Room</div>
            
            <div>
                    <!-- <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="district" class="form-label inline-block mb-2 text-gray-700">
                                District
                            </label>
                            
                            <select v-model="data.district_meta_data_id" 
                            @change="districtChange"
                            class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select District</option>
                                <option
                                    v-for="(district, i) in districts"
                                    :value="district['id']"
                                    :key="i"
                                >{{ district['district_name'] }}</option>
                            </select>

                        </div>
                    </div> -->

                    <!-- <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="lodges_id" class="form-label inline-block mb-2 text-gray-700">
                                Lodge
                            </label>
                            
                            <select v-model="data.lodges_id"
                            class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select Lodge</option>
                                <option
                                    v-for="(lodge, i) in lodges"
                                    :value="lodge['id']"
                                    :key="i"
                                >{{ lodge['name'] }}</option>
                            </select>

                        </div>
                    </div> -->

                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="lodge_room_types_id" class="form-label inline-block mb-2 text-gray-700">
                                Room Type
                            </label>
                            
                            <select v-model="data.lodge_room_types_id"
                            class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select Type</option>
                                <option
                                    v-for="(type, i) in types"
                                    :value="type['id']"
                                    :key="i"
                                >{{ type['name'] }}</option>
                            </select>

                        </div>
                    </div>

                    <div class="flex flex-col mb-2">
                        <div class="mb-3 xl:w-96">
                            <label for="amenities" class="form-label inline-block mb-2 text-gray-700">
                                Amenities
                            </label>
                            <!-- <Multiselect
                            v-model="selectedAmenities"
                            mode="tags"
                            :close-on-select="false"
                            :searchable="true"
                            :create-option="true"
                            :options="amenities"
                            /> -->

                            <vSelect multiple
                                v-model="selectedAmenities"
                                :options="amenities"
                            >
                            </vSelect>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="room_available" class="form-label inline-block mb-2 text-gray-700">
                                Rooms available
                            </label>
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="room_available"
                            placeholder="Amount"
                            v-model="data.room_available"
                            />
                            <div class="error" v-if="!isValidRoom">Rooms is invalid (only numerical)</div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="price" class="form-label inline-block mb-2 text-gray-700">
                                Price
                            </label>
                            <input @input="changeInputOne($event)" @change="changeInputOne($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="price"
                            placeholder="Price"
                            v-model="data.price"
                            />
                            <div class="error" v-if="!isValidPrice">Price is invalid (only numerical)</div>
                        </div>
                    </div>
                     <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="condition" class="form-label inline-block mb-2 text-gray-700">
                                Room Status
                            </label>
                            
                            <select v-model="data.param1"
                            class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select Status</option>
                                 <option
                                    v-for="(type, i) in condition"
                                    :value="type"
                                    :key="i"
                                >{{ type }}</option>
                         
                            </select>

                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Upload Image (Optional)
                            </label>
                           <div class="mb-2 font-bold">Image size must be less than 1 Mb</div>
                            <upload-media 
                            @media="logChange"
                            server="/api/upload"
                            >
                            </upload-media>
                        </div>
   
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="createRoom" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Submit
                        </button>
                    </div>

                     <div v-show="mToast">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline mr-5">Recheck the form.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>  
            
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from '@vueform/multiselect'
import {UploadMedia, UpdateMedia} from "vue-media-upload";
import vSelect from 'vue-select';

export default {
    components:{
        Multiselect,
        UploadMedia,
        UpdateMedia,
        vSelect,

    },
  data(){
    return{
      data:{
        district_meta_data_id:'',
        lodges_id:'',
        lodge_room_types_id:'',
        room_available:'',
        price:'',
        param1:'', //THIS IS USED FOR ROOM CONDITION. WEATHER THE ROOM IS AVAILABLE FOR USED OF UNDER MAINTAINANCE
      },
      districts:{},
      lodges:{},
      types:{},
        mRoom:{
            data:{},
            amenity:{},
            images:'',
        },
        selectedAmenities:[],
        amenities:[], 
        ImageData:{},
        mToast:false,
        condition:["Enable","Disable"],
        lodge_id:'',
        district_id:'',

        isValidPrice:true,
        isValidRoom:true,
        regex:/[0-9]/,

    }
  },
  created() {

        this.lodge_id = this.$route.params.lodge_id
        this.district_id = this.$route.params.district_id
        
        this.data.lodges_id = this.lodge_id
        this.data.district_meta_data_id = this.district_id
        
        //TODO: THE BELOW IS COMMENT OUT BECAUSE WE ALREADY KNOW THE LODGE ID
        // axios.get("/api/districts").then((result) => {
        //     console.log("My very data: "+result.data.data);
        //     this.districts = result.data.data;
        //  })



        axios.get("/api/lodge-room-type").then((result) => {
            console.log("My very data: "+result.data.data);
            this.types = result.data.data;
         })

        //GET THE AMENITIES
        axios.get("/api/amenities").then((result) => {
            console.log("My very amenities: "+result.data.data[0].name);
            for (let index = 0; index < result.data.data.length; ++index) {
                this.amenities.push(result.data.data[index].name);
            }
        })
  },
    methods: {
        createRoom(){
        
            if(this.isValidPrice && this.isValidRoom){

                this.mRoom.data = this.data
                this.mRoom.amenity = this.selectedAmenities
                this.mRoom.images = this.ImageData

                axios.post('/api/room',this.mRoom)
                    .then(response=>{
                    console.log(response.status)
                    if(response.status==200){
                        this.$router.push({
                            name:'rooms',
                            params:{id:this.lodge_id,district_id:this.district_id}
                        })
                    }

                })
                .catch(e=>{
                    console.log("This is the error:",e)
                    this.mToast=true

                })
            }
        },
        logChange (event) {
            console.log(event)
            this.ImageData=event
        },
        
        //TODO: THE BELOW IS COMMENT OUT BECAUSE WE ALREADY KNOW THE LODGE ID
        // districtChange(){
        //     axios.get("/api/getByDistrict/"+this.data.district_meta_data_id).then((result) => {
        //         console.log("My very data: "+result.data);
        //         this.lodges = result.data;
        //     })
        // },

        toastCloseClick(){
            this.mToast=false
        },

        changeInputOne(e){
            const number = e.target.value
            this.isValidPrice = /^\d+$/.test(number)
        },
        changeInputTwo(e){
            const number = e.target.value
            this.isValidRoom = /^\d+$/.test(number)
        }
    }
};

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style scoped>
.error{
  color:red;
}
</style>