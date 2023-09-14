<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Lodge</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteLodge" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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
                            <label for="name" class="form-label inline-block mb-2 text-gray-700">
                                Lodge name
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="name"
                            placeholder="Lodge Name"
                            v-model="data.name"
                            />
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
                            <label for="address" class="form-label inline-block mb-2 text-gray-700">
                                Address
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="address"
                            placeholder="Address"
                            v-model="data.address"
                            />
                        </div>
                    </div>
                    
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="phone" class="form-label inline-block mb-2 text-gray-700">
                                Phone
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="phone"
                            placeholder="Phone"
                            v-model="data.phone"
                            />
                        </div>
                    </div>

                    
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <label for="latlng" class="form-label inline-block mb-2 text-gray-700">
                                Lat Lng
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="latlng"
                            placeholder="latlng"
                            v-model="data.latlng"
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
                                Images
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
                        <button type="button" v-on:click="updateLodge" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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
                name:'',
                address:'',
                phone:'',
                latlng:'',        
                description:'',
             },
            districts:{},
            amenities:[], 
            selectedAmenities:[],
            selectedAmenitiesTemp:[],

            mediaLink: '',
            savedMedia:[],
            addedMedia:[],
            deletedMedia:[],
            mLodge:{
                data:{},
                amenities:{},
                user_id:'',

                savedMedia:[],
                addedMedia:[],
                deletedMedia:[],
            },
            mToast:false,
            user:[],
            error:false
        }
    },
    created() {
        this.user = User
        this.id = this.$route.params.id
        this.mediaLink ='/api/media/lodge/'+this.id
        axios.get("/api/districts").then((result) => {
            this.districts = result.data.data;
        })

         //GET THE AMENITIES
        axios.get("/api/amenities").then((result) => {
            for (let index = 0; index < result.data.data.length; ++index) {
                this.amenities.push(result.data.data[index].name);
            }

            //GET THE LODGES
            axios.get("/api/lodges/"+this.id).then((result) => {
                this.data.district_meta_data_id = result.data.district_meta_data_id;
                this.data.name = result.data.name;
                this.data.address = result.data.address;
                this.data.phone = result.data.phone;
                this.data.latlng = result.data.latlng;
                this.data.description = result.data.description;
             
                this.selectedAmenitiesTemp = result.data.amenities;

                //GET USER SELECTED AMENITIES
                for (let index = 0; index < this.selectedAmenitiesTemp.length; ++index) {
                    this.selectedAmenities.push(this.selectedAmenitiesTemp[index].name);
                }
            })
        })
    },

    methods: {
        updateLodge(){
            this.mLodge.data = this.data
            this.mLodge.amenities = this.selectedAmenities
            this.mLodge.user_id = this.user.id

            this.mLodge.addedMedia = this.addedMedia
            this.mLodge.savedMedia = this.savedMedia
            this.mLodge.deletedMedia = this.deletedMedia

            axios.put("/api/lodges/"+this.id,this.mLodge).then((result) => {
                if(result.status==200){
                    this.$router.push('./')
                }
            })
            .catch(e=>{
              this.mToast=true
              throw e;
          })
        },

        deleteLodge(){
            if(confirm("Do you really want to delete?")){

                axios.get("/api/delete/lodges/"+this.id).then((result) => {
                if(result.data==true){
                    this.$router.push('./')
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
        }

    }
  
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>