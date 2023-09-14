<template>
  <div class="">
    <button class="mt-10 ml-5" onclick="history.back()">Go Back</button>
    <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
      <div class="flex">
        <div class="mb-6 text-black text-2xl mx-2 font-semibold">Edit Notice</div>
        <div class="col-end-3">
          <button type="button" v-on:click="deleteModel"
            class=" px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Delete
          </button>
        </div>
      </div>
      <div>
        <div class="">
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="title" class="form-label inline-block mb-2 text-gray-700">
                Title
              </label>
              <input type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="title" placeholder="Title" v-model="data.title" />
            </div>
          </div>
          <div>
            <div class="mb-3 xl:w-96">
              <label for="category" class="form-label inline-block mb-2 text-gray-700">
                Categories
              </label>
              <select v-model="data.categories_id"
                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="" disabled>Select Category</option>
                <option v-for="(category, i) in categories" :value="category.id" :key="i">{{ category.name }}</option>
              </select>
            </div>
          </div>
          <div>
            <div class="mb-3 xl:w-96">
              <label for="body" class="form-label inline-block mb-2 text-gray-700">
                Body
              </label>
              <Editor api-key="fy8lkc5vaz5ap641c87afaqbq97eb9anpebuuqixhude8h9m" v-model="data.body"></Editor>
            </div>
          </div>
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <label for="images" class="form-label inline-block mb-2 text-gray-700">
                Image
              </label>
              <div class="mb-2 font-bold">Image size must be less than 1 Mb</div>
              <UpdateMedia @saved-media="SavedMedia" @deleted-media='DeletedMedia' @added-media="AddedMedia"
                server='/api/upload' media_file_path='/post_images' :media_server='mediaLink' />
            </div>
          </div>
          <div class="flex space-x-2 justify-center">
            <button type="button" v-on:click="updateModel"
              class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
              Update
            </button>
          </div>
          <div v-show="mToast">
            <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
              role="alert">
              <strong class="font-bold">Error in Tags!</strong>
              <span class="block sm:inline">Select only from the list.</span>
              <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20">
                  <title>Close</title>
                  <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
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
import { UpdateMedia, UploadMedia } from "vue-media-upload";
import Editor from '@tinymce/tinymce-vue';

export default {
  components: {
    UpdateMedia,
    UploadMedia,
    Editor,
  },
  data() {
    return {
      id: null,
      data: {
        title: '',
        body: '',
        categories_id: '',
      },
      mNotice: {
        data: {},
        savedMedia: [],
        addedMedia: [],
        deletedMedia: [],
      },
      ImageData: {},
      categories: {},
      mediaLink: '',
      savedMedia: [],
      addedMedia: [],
      deletedMedia: [],
      mToast: false,
    }
  },
  created() {
    this.id = this.$route.params.id
    this.mediaLink = '/api/media/notice/' + this.id

    axios.get("/api/notices/" + this.id).then((result) => {
      this.data.title = result.data.title;
      this.data.body = result.data.body;
      this.data.categories_id = result.data.categories_id;
    })
    //GET THE CATEGORY
    axios.get("/api/categories").then((result) => {
      this.categories = result.data.data
    })
  },

  methods: {
    updateModel() {
      this.mNotice.data = this.data
      this.mNotice.addedMedia = this.addedMedia
      this.mNotice.savedMedia = this.savedMedia
      this.mNotice.deletedMedia = this.deletedMedia

      axios.put("/api/notices/" + this.id, this.mNotice).then((result) => {
        if (result.status == 200) {
          this.$router.push('./')
        }
      })
    },

    deleteModel() {
      if (confirm("Do you really want to delete?")) {
        axios.delete("/api/notices/" + this.id).then((result) => {
          if (result.status == 200) {
            this.$router.push('./')
          }
        })
      }
    },
    SavedMedia(event) {
      this.savedMedia = event
    },
    AddedMedia(event) {
      this.addedMedia = event
    },
    DeletedMedia(event) {
      this.deletedMedia = event
    },
    toastCloseClick() {
      this.mToast = false
    },
  }
}

</script>
