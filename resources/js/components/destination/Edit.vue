<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Destination</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteDestination" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>

                </div>
            </div>
            
            <div>
                <div class="">
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
                                Distance From Airport (in kilometer)
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
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="altitude"
                            placeholder="1619"
                            v-model="data.altitude"
                            />
                        </div>
                    </div>

                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="latitude" class="form-label inline-block mb-2 text-gray-700">
                                Latitude
                            </label>
                            <input @input="changeInputFour($event)" @change="changeInputFour($event)"
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="latitude"
                            placeholder="Latitude"
                            v-model="data.latitude"
                            />
                                 <div class="error" v-if="!isValidFour">Invalid input (only numerical)</div>

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
                            placeholder="Longitude"
                            v-model="data.longitude"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col mb-2">
                        <div class="mb-3 xl:w-96">
                            <label for="tags" class="form-label inline-block mb-2 text-gray-700">
                                Tags
                            </label>
                            
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
                            <label for="images" class="form-label inline-block mb-2 text-gray-700">
                                Image
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




                    <div v-show="mToast">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error in Tags!</strong>
                        <span class="block sm:inline">Select only from the list.</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>
                   <div class="mb-3" v-show="mToastImage">
                        <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="mr-3 block sm:inline ">At least One Image must be select.</span>
                        <span v-on:click="toastCloseClick" class="ml-3 absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class=" ml-3 fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    </div>
                                        <div class="flex space-x-2 justify-center">
                        <button type="button" v-on:click="updateDestination" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Update
                        </button>
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
            destination_name:'',
            distance:'',
            description:'',
            latitude:'',
            longitude:'',
            altitude:'',
            nearest_tourist_lodge_distance:'',
            walking_distance:'',

        },
        districts:{},
        tags:[],
        selectedTags:[],
        selectedTagsTemp:[],
        mTopDestination:{
            data:{},
            tag:{},
            
            savedMedia:[],
            addedMedia:[],
            deletedMedia:[],
        },
        mediaLink: '',
        savedMedia:[],
        addedMedia:[],
        deletedMedia:[],
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
        this.id = this.$route.params.id

         this.mediaLink ='/api/media/destination/'+this.id

        //GET THE DISTRICT
        axios.get("/api/districts").then((result) => {
            console.log("My very data: "+result.data.data[0].district_name);
            this.districts = result.data.data;
        })
 
        //GET THE TAGS
        axios.get("/api/tags").then((result) => {
            console.log("My very data: "+result.data.data);
            
            for (let index = 0; index < result.data.data.length; ++index) {
                this.tags.push(result.data.data[index].name);
            }

            //GET THE DESTINATIONS
            axios.get("/api/destinations/"+this.id).then((result) => {
                console.log(result.data.name)
                this.data.district_meta_data_id = result.data.district_meta_data_id
                this.data.destination_name = result.data.destination_name
                this.data.distance = result.data.distance
                this.data.description = result.data.description
                this.data.latitude = result.data.latitude;
                this.data.longitude = result.data.longitude;
                 this.data.altitude = result.data.altitude
                this.data.nearest_tourist_lodge_distance = result.data.nearest_tourist_lodge_distance;
                this.data.walking_distance = result.data.walking_distance;

                this.selectedTagsTemp  = result.data.tags
                
                //GET USER SELECTED TAGS
                for (let index = 0; index < this.selectedTagsTemp.length; ++index) {
                    console.log("INDISIED JOB")
                    this.selectedTags.push(this.selectedTagsTemp[index].name);
                }
            })
        })
    },

    methods: {
        updateDestination(){
            if(this.isValidOne && this.isValidTwo && this.isValidThree && this.isValidFour){

                this.mTopDestination.data = this.data
                this.mTopDestination.tag = this.selectedTags
            
                this.mTopDestination.addedMedia = this.addedMedia
                this.mTopDestination.savedMedia = this.savedMedia
                this.mTopDestination.deletedMedia = this.deletedMedia
                
                if(this.addedMedia.length!=0 || this.savedMedia.length!=0  ){
                    axios.put("/api/destinations/"+this.id,this.mTopDestination).then((result) => {
                    console.log(result.data.name);
                    // this.data = result.data.data;
                    if(result.status==200){
                        this.$router.push('./')
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

        deleteDestination(){
            if(confirm("Do you really want to delete?")){

                axios.delete("/api/destinations/"+this.id).then((result) => {
                console.log(result.data.name);
                // this.data = result.data.data;
                if(result.status==200){
                    this.$router.push('./')
                }
                })
            }
        },

        SavedMedia (event) {
            console.log("THIS IS THE Saved media")
            this.savedMedia=event
           // this.weee=event
        },

        AddedMedia( event) {
            console.log("THIS IS THE ADDED MEDIA".event)

            // console.log("IOIOIO: ".event)
            this.addedMedia=event
           // this.weee=event
        },
        
        DeletedMedia (event){
            console.log("The Dewww@lete: ".event)
            this.deletedMedia=event

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

    }
  
}

</script>
<style src="@vueform/multiselect/themes/default.css"></style>