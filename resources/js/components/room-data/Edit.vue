<template>
    <div class="mt-5">
     <router-link :to="{ name:'rooms',params:{id:lodge_id,district_id:district_id}}" class=" ml-5  hover:text-green-600" > Go Back</router-link>

        <div class="bg-white border border-gray-300 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Room</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteRoom" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>

                </div>
            </div>

            <div class="mt-5" v-show="error">
                <div>
                    <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Delete Not Possible!</strong>
                        <span class="block sm:inline mr-5">Already used in Booking.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="">

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
                                Room available
                            </label>
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="room_available"
                            placeholder="Room available"
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
                                Images (Optional)
                            </label>
                           <div class="mb-2 font-bold">Image size must be less than 1 Mb</div>                            
                            <UpdateMedia 
                            @saved-media= "SavedMedia"
                            @deleted-media= 'DeletedMedia'
                            @added-media = "AddedMedia"
                            
                            server='/api/upload' 
                            media_file_path='/post_images'
                            :media_server='mediaLink'/>
                        </div>
                    </div>

                    <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="updateRoom" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Update
                        </button>
                    </div>

                    <div v-show="mToast">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error in Amenities!</strong>
                        <span class="block sm:inline">Select only from the list.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Multiselect from '@vueform/multiselect'
import {UpdateMedia,UploadMedia} from "vue-media-upload";
import vSelect from 'vue-select';

export default {
    components:{
        Multiselect,
        UpdateMedia,
        UploadMedia,
        vSelect,

    },
  data(){
    return{
   
        id:null,
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
        amenities:[], 
        selectedAmenities:[],
        selectedAmenitiesTemp:[],

        mediaLink: '',
        savedMedia:[],
        addedMedia:[],
        deletedMedia:[],
        mRoom:{
            data:{},
            amenities:{},

            savedMedia:[],
            addedMedia:[],
            deletedMedia:[],
        },
        mToast:false,
        condition:["Enable","Disable"],
        lodge_id:'',
        district_id:'',

        isValidPrice:true,
        isValidRoom:true,
        regex:/[0-9]/,
        error:false,

    }
  },
    created() {
        this.id = this.$route.params.id
        this.mediaLink ='/api/media/room/'+this.id
        this.lodge_id = this.$route.params.lodge_id
        this.district_id = this.$route.params.district_id

         //GET THE AMENITIES
        axios.get("/api/amenities").then((result) => {
            for (let index = 0; index < result.data.data.length; ++index) {
                this.amenities.push(result.data.data[index].name);
            }

            //GET THE ROOM
            axios.get("/api/room/"+this.id).then((result) => {
                this.data.district_meta_data_id = result.data.district_meta_data_id;
                this.data.lodges_id = result.data.lodges_id;
                this.data.lodge_room_types_id = result.data.lodge_room_types_id;
                this.data.room_available = result.data.room_available;
                this.data.price = result.data.price;
                this.data.param1 = result.data.param1;
                
                this.selectedAmenitiesTemp = result.data.amenities;
                //GET USER SELECTED AMENITIES
                for (let index = 0; index < this.selectedAmenitiesTemp.length; ++index) {   
                    this.selectedAmenities.push(this.selectedAmenitiesTemp[index].name);
                }
            })
        })


        axios.get("/api/districts").then((result) => {
            this.districts = result.data.data;
         })

        axios.get("/api/lodges").then((result) => {
            this.lodges = result.data.data;
         })

        axios.get("/api/lodge-room-type").then((result) => {
            this.types = result.data.data;
         })
    },

    methods: {
        updateRoom(){
            if(this.isValidPrice && this.isValidRoom){
                    this.mRoom.data = this.data
                    this.mRoom.amenities = this.selectedAmenities
                    this.mRoom.addedMedia = this.addedMedia
                    this.mRoom.savedMedia = this.savedMedia
                    this.mRoom.deletedMedia = this.deletedMedia
                    axios.put("/api/room/"+this.id,this.mRoom).then((result) => {
                        if(result.status==200){
                            this.$router.push({
                                name:'rooms',
                                params:{id:this.lodge_id,district_id:this.district_id}
                            })
                        }
                    })
                    .catch(e=>{
                        this.mToast=true
                })
            }
        },

        deleteRoom(){
            if(confirm("Do you really want to delete?")){
                axios.get("/api/delete/room/"+this.id).then((result) => {
                if(result.data==true){
                     this.$router.push({
                        name:'rooms',
                        params:{id:this.lodge_id,district_id:this.district_id}
                    })
                }else{
                    this.error=true
                }
              })
            }
        },
        SavedMedia (event) {
            this.savedMedia=event
        },

        AddedMedia( event) {
            this.addedMedia=event
        },
        DeletedMedia (event){
            this.deletedMedia=event
        },
       toastCloseClick(){
            this.mToast=false
            this.error=false
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
  
}

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style scoped>
.error{
  color:red;
}
</style>