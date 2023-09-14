<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit District</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteDistrict" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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
                <div class="flex">
                    <div class="mb-3 xl:w-96">
                            <label for="district_name" class="form-label inline-block mb-2 text-gray-700">
                                Name
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="district_name"
                            placeholder="District name"
                            v-model="data.district_name"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="population" class="form-label inline-block mb-2 text-gray-700">
                                Population
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="population"
                            placeholder="Population"
                            v-model="data.population"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="altitude" class="form-label inline-block mb-2 text-gray-700">
                                Altitude (in meter)

                            </label>
                            <input @input="changeInputOne($event)" @change="changeInputOne($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="altitude"
                            placeholder="Altitude"
                            v-model="data.altitude"
                            />
                             <div class="error" v-if="!isValidOne">Invalid input (only numerical)</div>

                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="latitude" class="form-label inline-block mb-2 text-gray-700">
                                Latitude
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="latitude"
                            placeholder="eg: 27.232323"
                            v-model="data.latitude"
                            />
                        </div>
                    </div>
                       <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="longitude" class="form-label inline-block mb-2 text-gray-700">
                                Longitude
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="longitude"
                            placeholder="eg:92.23232"
                            v-model="data.longitude"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="area" class="form-label inline-block mb-2 text-gray-700">
                                Area (in sq km)
                            </label>
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="area"
                            placeholder="Area"
                            v-model="data.area"
                            />
                              <div class="error" v-if="!isValidTwo">Invalid input (only numerical and decimal value upto two)</div>
                           
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="airport" class="form-label inline-block mb-2 text-gray-700">
                               Distance from Airport (in km)
                            </label>
                            <input @input="changeInputThree($event)" @change="changeInputThree($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="airport"
                            placeholder="Airport"
                            v-model="data.airport"
                            />
                             <div class="error" v-if="!isValidThree">Invalid input (only numerical)</div>

                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="weather_forecast" class="form-label inline-block mb-2 text-gray-700">
                                Weather Forecast
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="weather_forecast"
                            placeholder="Weather Forecast"
                            v-model="data.weather_forecast"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Description
                            </label>
                            <textarea rows="4"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="description"
                            placeholder="Description"
                            v-model="data.description"
                            >
                            </textarea>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Upload Image
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
                    <button type="button" v-on:click="updateDistrict" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Update
                    </button>
                </div>
              
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {UpdateMedia,UploadMedia} from "vue-media-upload";

export default {
    components:{
        UpdateMedia,
        UploadMedia,
    },

  data(){
    return{
        id:null,
      
        data:{
            district_name:'',
            altitude:'',
            population:'',
            area:'',
            airport:'',
            weather_forecast:'',
            description:'',
            latitude:'',
            longitude:'',
        },
        mediaLink: '',
        savedMedia:[],
        addedMedia:[],
        deletedMedia:[],
        mDistrict:{
            data:{},

            savedMedia:[],
            addedMedia:[],
            deletedMedia:[],
        },

        weee:'',
        error:false,
      isValidOne:true,
        isValidTwo:true,
        isValidThree:true,

        regex:/[0-9]/,

    }

  },
    created() {
        this.id = this.$route.params.id
        this.mediaLink ='/api/media/'+this.id
          
        axios.get("/api/districts/"+this.id).then((result) => {
        console.log(result.data.name);
            this.data.district_name = result.data.district_name;
            this.data.altitude = result.data.altitude;
            this.data.population = result.data.population;
            this.data.area = result.data.area;
            this.data.airport = result.data.airport;
            this.data.weather_forecast = result.data.weather_forecast;
            this.data.description = result.data.description;
            this.data.latitude = result.data.latitude;
            this.data.longitude = result.data.longitude;


        })      
 
    },

    methods: {
        updateDistrict(){
            if(this.isValidOne && this.isValidTwo && this.isValidThree  ){

                this.mDistrict.data = this.data
                this.mDistrict.addedMedia = this.addedMedia
                this.mDistrict.savedMedia = this.savedMedia
                this.mDistrict.deletedMedia = this.deletedMedia

                axios.put("/api/districts/"+this.id,this.mDistrict).then((result) => {
                console.log(result.data.name);
                // this.data = result.data.data;
                if(result.status==200){
                    this.$router.push('./')
                }else if (result.data==false){
                    this.error = true
                }
                })
            }
        },

        deleteDistrict(){
            if(confirm("Do you really want to delete?")){
                axios.get("/api/delete/district/"+this.id).then((result) => {
                    
                     if(result.data==true){
                        this.$router.push('./')
                    }else if(result.data==false){
                        this.error=true
                    }
                })
            }
        },

        SavedMedia (event) {
            console.log("THIS IS THE Saved media",event)
            this.savedMedia=event
           // this.weee=event
        },

        AddedMedia( event) {
            console.log("THIS IS THE ADDED MEDIA".event)

          //  console.log("IOIOIO: ".event)
            this.addedMedia=event
           // this.weee=event
        },
        DeletedMedia (event){
            console.log("The Dewww@lete: ".event)
            this.deletedMedia=event

        },
           toastCloseClick(){
            this.error=false
         },

          changeInputOne(e){
            const number = e.target.value
            this.isValidOne = /^\d+$/.test(number)
        },
        changeInputTwo(e){
            const number = e.target.value
            this.isValidTwo = /^(?:\d*\.\d{1,2}|\d+)$/.test(number)
        },
        changeInputThree(e){
            const number = e.target.value
            this.isValidThree = /^\d+$/.test(number)
        },

    }
}

</script>
