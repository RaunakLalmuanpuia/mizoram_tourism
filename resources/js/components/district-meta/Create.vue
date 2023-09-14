<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300  ml-5 p-8 px-24 w-200 ">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create District</div>
            
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
                            <label for="description" class="form-label inline-block  text-gray-700">
                                Upload Image
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

                        <button type="button" v-on:click="createDistrict" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Submit
                        </button>
                    </div>
                    
            
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {UploadMedia, UpdateMedia} from "vue-media-upload";

export default {
    components:{
        UploadMedia,
        UpdateMedia
    },
  data(){
    return{
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
      images:'',
      mDistrict:{
          data:{},
          images:'',
      },

      ImageData:[],
      temp_imageSize:'',
      isValidOne:true,
        isValidTwo:true,
        isValidThree:true,

        regex:/[0-9]/,

    }
  },
  created() {
          
  },
  methods: {
      createDistrict(){
           if(this.isValidOne && this.isValidTwo && this.isValidThree  ){

                this.mDistrict.data = this.data
                this.mDistrict.images = this.ImageData
                axios.post('/api/districts',this.mDistrict)
                .then(response=>{
                    console.log(response.status)
                    if(response.status==200){
                        this.$router.push('./')
                    }
                })
                .catch(e=>{
                    
                })
           }
      },
      logChange (event) {
        this.ImageData=event
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
  },

};

</script>
