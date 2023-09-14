<template>
    <div class="">
        <button class="mt-10 ml-5"  onclick="history.back()">Go Back</button>
        <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
            <div class="flex">
                <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit How to Get to Mizoram</div>
                <div class="col-end-3">
                    <button type="button" v-on:click="deleteModel" class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                            Delete
                    </button>

                </div>
            </div>
            
            <div>
            <div>

                <div class="flex">
                    <div class="mb-3 xl:w-96">
                        <label for="means" class="form-label inline-block mb-2 text-gray-700">
                            By Means of
                        </label>
                        <input
                        type="text"
                        class=" form-control block w-full px-3 py-1.5
                            text-base  font-normal text-gray-700 bg-white bg-clip-padding
                            border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                        id="means"
                        placeholder="Means of"
                        v-model="data.means"
                        />
                    </div>
                </div>
                <div class="flex">
                    <div class="mb-3 xl:w-96">
                        <label for="description" class="form-label inline-block mb-2 text-gray-700">
                            Description
                        </label>
                        <textarea
                        type="text"
                        class=" form-control block w-full px-3 py-1.5
                            text-base  font-normal text-gray-700 bg-white bg-clip-padding
                            border border-solid border-gray-300 rounded transition   ease-in-out  m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                        id="description"
                        placeholder="Description"
                        v-model="data.description"
                        rows="4"
                        ></textarea>
                    </div>
                </div>   
                <div class="flex">
                    <div class="mb-3 xl:w-96">
                        <label for="description" class="form-label inline-block mb-2 text-gray-700">
                            Upload Image
                        </label>

                        <UpdateMedia 
                        @saved-media= "SavedMedia"
                        @deleted-media= 'DeletedMedia'
                        @added-media = "AddedMedia"
                        
                        server='/api/upload' 
                        media_file_path='/post_images'
                        :media_server='mediaLink'/>

                    </div>
                </div>
  

            </div>
            <div class="flex space-x-2 justify-center">
                <button type="button" v-on:click="updateModel" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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
            means:'',
            description:'',
        },

        mDistance:{
            data:{},

            savedMedia:[],
            addedMedia:[],
            deletedMedia:[],
        },
        
        mediaLink: '',
        savedMedia:[],
        addedMedia:[],
        deletedMedia:[],
    }
  },
      created() {
        this.id = this.$route.params.id
        this.mediaLink ='/api/media/distance/'+this.id
          
        axios.get("/api/distances/"+this.id).then((result) => {
        console.log(result.data.name);
            this.data.means = result.data.means;
            this.data.description = result.data.description;

        })   
  },

    methods: {
        updateModel(){
            this.mDistance.data = this.data
            this.mDistance.addedMedia = this.addedMedia
            this.mDistance.savedMedia = this.savedMedia
            this.mDistance.deletedMedia = this.deletedMedia

            axios.put("/api/distances/"+this.id,this.mDistance).then((result) => {
            console.log(result.data.name);
            // this.data = result.data.data;
            if(result.status==200){
                  this.$router.push('./')
              }
            })
        },
  
        deleteModel(){
            if(confirm("Do you really want to delete?")){
                axios.delete("/api/distances/"+this.id).then((result) => {
                    console.log(result.data.name);
                    //this.data = result.data.data;
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

          //  console.log("IOIOIO: ".event)
            this.addedMedia=event
           // this.weee=event
        },
        DeletedMedia (event){
            console.log("The Dewww@lete: ".event)
            this.deletedMedia=event

        },
  }
  
}

</script>
