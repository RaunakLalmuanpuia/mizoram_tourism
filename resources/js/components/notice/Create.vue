<template>
  <div class="">
    <button class="mt-10 ml-5" onclick="history.back()">Go Back</button>
    <div class="bg-white border border-gray-300 ml-5 p-8 px-24 w-200">
      <div class="mb-6 text-black text-2xl mx-2 font-semibold">Create Notice</div>
      <div>
        <div class="flex">
          <div class="mb-3 xl:w-96">
            <label for="name" class="form-label inline-block mb-2 text-gray-700">
              Title
            </label>
            <input type="text"
              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              id="name" placeholder="Title" v-model="data.title" />
          </div>
        </div>
        <div>
          <div class="mb-3 xl:w-96">
            <label for="category" class="form-label inline-block mb-2 text-gray-700">
              Categories
            </label>
            <select v-model="data.categories_id"
              class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out  m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
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
            <label for="description" class="form-label inline-block mb-2 text-gray-700">
              Gallery Image
            </label>
            <div class="mb-2 font-bold">Image size must be less than 1 Mb</div>

            <upload-media @media="logChange" server="/api/upload">
            </upload-media>

          </div>

        </div>

        <div class="flex space-x-2 justify-center">
          <button type="button" v-on:click="createModel"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Submit
          </button>
        </div>


      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { UploadMedia, UpdateMedia } from "vue-media-upload";
import Editor from '@tinymce/tinymce-vue';

export default {
  components: {
    UploadMedia,
    UpdateMedia,
    Editor,
  },
  data() {
    return {
      data: {
        title: '',
        body: '',
        categories_id: '',
      },
      mNotice: {
        data: {},
        images: '',
      },
      ImageData: {},
      categories: {}
    }
  },
  created() {
    //GET THE CATEGORY
    axios.get("/api/categories").then((result) => {
      this.categories = result.data.data
      //console.log("My very Categoes: "+result.data.data[0].name);
      // for (let index = 0; index < result.data.data.length; ++index) {
      //     this.categories.push(result.data.data[index].name);
      // }
    })
  },
  methods: {
    createModel() {

      this.mNotice.data = this.data
      this.mNotice.images = this.ImageData

      axios.post('/api/notices', this.mNotice)
        .then(response => {
          if (response.status == 200) {
            this.$router.push('./')
          }
        })
        .catch(e => {

        })
    },
    logChange(event) {
      this.ImageData = event
    },

  }
};

</script>
