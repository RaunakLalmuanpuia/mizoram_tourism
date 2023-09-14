<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
       
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create Top Destination</div>
            
            <div>
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
                            <label for="destination_name" class="form-label inline-block mb-2 text-gray-700">
                                Destination name
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="destination_name"
                            placeholder="Destination Name"
                            v-model="data.destination_name"
                            />
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="distance" class="form-label inline-block mb-2 text-gray-700">
                                Distance From Aizawl (in kilometer)
                            </label>
                            <input @input="changeInputOne($event)" @change="changeInputOne($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="distance"
                            placeholder="Distance"
                            v-model="data.distance"
                            />

                             <div class="error" v-if="!isValidOne">Invalid input (only numerical)</div>

                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="nearest_lodge" class="form-label inline-block mb-2 text-gray-700">
                                Distance From Nearest Lodge (in kilometer)
                            </label>
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="nearest_lodge"
                            placeholder="8"
                            v-model="data.nearest_tourist_lodge_distance"
                            />
                             <div class="error" v-if="!isValidTwo">Invalid input (only numerical)</div>

                        </div>
                    </div>
                     <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="walking_distance" class="form-label inline-block mb-2 text-gray-700">
                                Walking distance (in minutes)
                            </label>
                            <input @input="changeInputThree($event)" @change="changeInputThree($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="walking_distance"
                            placeholder="10"
                            v-model="data.walking_distance"
                            />
                             <div class="error" v-if="!isValidThree">Invalid input (only numerical)</div>

                        </div>
                    </div>
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="altitude" class="form-label inline-block mb-2 text-gray-700">
                                Altitude (in meter)
                            </label>
                            <input @input="changeInputFour($event)" @change="changeInputFour($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="altitude"
                            placeholder="1619"
                            v-model="data.altitude"
                            />
                                 <div class="error" v-if="!isValidFour">Invalid input (only numerical)</div>

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
                    <div class="flex flex-col mb-2">
                        <div class="mb-3 xl:w-96">
                            <label for="tags" class="form-label inline-block text-gray-700">
                                Tags
                            </label>
                           
                        </div>
                        
                           <!-- <Multiselect
                            v-model="selectedTags"
                            mode="tags"
                            :close-on-select="false"
                            :searchable="true"
                            :create-option="true"
                            :options="tags"
                            /> -->

                            <vSelect multiple
                                v-model="selectedTags"
                                :options="tags"
                            >
                            </vSelect>
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

                    <!-- <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="destination_banner" class="form-label inline-block mb-2 text-gray-700">
                                Banner Image
                            </label>

                                <input type="file"  @change="onFileChange" />



                            <div id="preview">
                                <img v-if="url" :src="url" />
                            </div>
                        </div>
                    </div> -->

                    
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="description" class="form-label inline-block mb-2 text-gray-700">
                                Gallery Image
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
                        <button type="button" v-on:click="createModel" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Submit
                        </button>
   
                    </div>
                    
             

                     <div v-show="mToast">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error in Tags!</strong>
                        <span class="block sm:inline">Select only from the list.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>
                    <div v-show="mToastImage">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="ml-3 block sm:inline ">At least One Image must be select.</span>
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
            destination_name:'',
            distance:'',
            description:'',
            destination_banner:'',
            latitude:'',
            longitude:'',
            altitude:'',
            nearest_tourist_lodge_distance:'',
            walking_distance:'',

        },

        districts:{},
        selectedTags:[],
        tags:[],

        mTopDestination:{
            data:{},
            tag:{},
            images:'',
        },

        ImageData:{},
        mToast:false,
        mToastImage:false,

        isValidOne:true,
        isValidTwo:true,
        isValidThree:true,
        isValidFour:true,

        regex:/[0-9]/,

    }
  },
    created() {
        //GET THE DISTRICT
        axios.get("/api/districts").then((result) => {
            console.log("My very data: "+result.data.data[0].district_name);
            this.districts = result.data.data;
        })

        //GET THE TAGS
        axios.get("/api/tags").then((result) => {
            console.log("My very data: "+result.data.data[0].name);
            
            for (let index = 0; index < result.data.data.length; ++index) {
                this.tags.push(result.data.data[index].name);
            }
        })
  },
    methods: {
        createModel(){
            if(this.isValidOne && this.isValidTwo && this.isValidThree && this.isValidFour){
                this.mTopDestination.data = this.data
                this.mTopDestination.tag = this.selectedTags
                this.mTopDestination.images = this.ImageData

                if(this.ImageData.length!=0){
                    axios.post('/api/destinations',this.mTopDestination)
                .then(response=>{
                    console.log(response.status)
                    if(response.status==200){
                        this.$router.push('./')
                    }else{
                        console.log("EROOR!")
                    }
                })
                .catch(e=>{
                        console.log("This is the error:",e)
                        this.mToast=true

                })
                }else{
                    this.mToastImage=true
                }
            }
        },
        logChange(event) {
            this.ImageData=event
            console.log("HOMIE")
            console.log(event)
        },
        toastCloseClick(){
            this.mToast=false
            this.mToastImage=false
        },
        changeInputOne(e){
            const number = e.target.value
            this.isValidOne = /^\d+$/.test(number)
        },
        changeInputTwo(e){
            const number = e.target.value
            this.isValidTwo = /^\d+$/.test(number)
        },
        changeInputThree(e){
            const number = e.target.value
            this.isValidThree = /^\d+$/.test(number)
        },
        changeInputFour(e){
            const number = e.target.value
            this.isValidFour = /^\d+$/.test(number)
        },
        // onFileChange(e) {
        //   //  console.log("selected file: ",e.target.files[0]);
        //     this.data.destination_banner = e.target.files[0];  
        //    // this.image = e.target.files[0];
        //   }   
    },
};

</script>
<style src="@vueform/multiselect/themes/default.css"></style>
