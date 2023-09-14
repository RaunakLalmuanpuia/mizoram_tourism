    <template>
    <div class="">
        <a  href="#"  @click="backToList()" class="text-green-600"> Go Back</a>
        <div class="bg-white border border-gray-300 ml-5 px-2 w-200">
            <div class="mb-6 text-black text-2xl mx-2 font-semibold">Monthly Occupancy Statement</div>
            
            <div>
                    <h3>Name of User : {{ user.name }}  </h3> 
                      
                    <div class="grid grid-rows-2 md:grid-cols-3 gap-2 mt-3 border border-solid border-2 p-3">
                        <!-- <div class="mb-3 ">
                            <label for="facility" class="form-label inline-block mb-2 text-gray-700">
                                Name of Facility <span style="color:red">*</span>
                            </label>
                          
                            <div>
                               <vSelect class="w-30"
                            v-model="report.lodges_id"
                            :options="mLodges"
                            label="name"
                            :reduce="name=>name.id"
                            ></vSelect>
                           </div>
                        </div> -->
                        <div class="mb-3  ">
                            <label for="location" class="form-label inline-block mb-2 text-gray-700">
                                Location <span style="color:red">*</span>
                            </label>
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="location"
                            placeholder="Location"
                            v-model="report.location"
                            />
                        </div>
                        <div class="mb-3  ">
                            <label for="district" class="form-label inline-block mb-2 text-gray-700">
                                District
                            </label>
                            <select v-model="report.district"
                          
                                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select District</option>
                                <option
                                    v-for="(district, i) in districts"
                                    :value="district.id"
                                    :key="i"
                                >{{ district.district_name }}</option>
                            </select>
                        </div>
                       
                         <div class="mb-3 ">
                            <label for="year" class="form-label inline-block mb-2 text-gray-700">
                                 Month<span style="color:red">*</span>
                            </label>
                            <select v-model="report.month"
                                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select Month</option>
                                <option
                                    v-for="(month, i) in months"
                                    :value="month"
                                    :key="i"
                                >{{ month }}</option>
                            </select>
                        </div>
                         <div class="mb-3 ">
                            <label for="month" class="form-label inline-block mb-2 text-gray-700">
                                Year  <span style="color:red">*</span>
                            </label>
                            <select v-model="report.year"
                                class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="" disabled>Select Year</option>
                                <option
                                    v-for="n in 2100" :key="n"
                                    
                                    
                                >{{ n+2010 }}</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="mt-2 grid grid-rows-1 md:grid-cols-4 gap-2 mt-3 border border-solid border-2 p-3">
                        <div class="relative mr-3 mb-3">
                            <input @input="changeInputOne($event)" @change="changeInputOne($event)"
                            type="text"
                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                            id="total_rooms"
                            v-model="report.total_rooms"
                            />
                            <label for="total_rooms"
                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                            >Total Rooms
                            </label>
                                    <div class="error" v-if="!isValidOne">Invalid input (only numerical)</div>
                        
                        </div>  
                        <div class="relative mr-3 mb-3">
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                            type="text"
                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                            id="total_beds"
                            v-model="report.total_beds"
                            />
                            <label for="total_beds"
                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                            >Total Beds
                            </label>
                                    <div class="error" v-if="!isValidTwo">Invalid input (only numerical)</div>

                        </div> 
                        <div class="relative mr-3 mb-3">
                            <input @input="changeInputThree($event)" @change="changeInputThree($event)"
                            type="text"
                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                            id="total_beds_dormitory"
                            v-model="report.total_beds_dormitory"
                            />
                            <label for="total_beds_dormitory"
                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                            >Total Beds (Dormitory)
                            </label>
                                    <div class="error" v-if="!isValidThree">Invalid input (only numerical)</div>

                        </div> 
                        <div class="relative mr-3 mb-3">
                            <input @input="changeInputFour($event)" @change="changeInputFour($event)"
                            type="text"
                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                            id="any_other_lodging"
                            v-model="report.any_other_lodging"
                            />
                            <label for="any_other_lodging"
                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                            >Any Other Lodging
                            </label>
                             <div class="error" v-if="!isValidFour">Invalid input (only numerical)</div>

                        </div> 
                        
                         
                    </div>
                   
                    <div class="flex">
                        <div class="mb-3">
                        
                            <div class="mt-4">
                               

                                <div class="border-solid border-2 border-grey-500 p-3">

                                
                                    <div class="mb-2 " v-for="(report, index) in report_details" :key="index">
                                         {{ index+1 }}.
                                        <div class="border-dashed border-2 border-grey-500 grid grid-rows-2 md:grid-cols-5 gap-2 pt-2 px-2">
                                       
                                           
                                        <div class="relative mr-3 mb-3">
                                    <input 
                                            type="date"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="date"
                                            v-model="report.date"
                                            />
                                            <label for="date"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Date
                                            </label>

                                        </div> 


                                        <div class="relative mr-3 mb-3">
                                        <input  
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="suite"
                                            v-model="report.suite"
                                            />
                                            <label for="suite"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Suite
                                            </label>
 
                                        </div> 

                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="deluxe"
                                            v-model="report.deluxe"
                                            />
                                            <label for="deluxe"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Deluxe
                                            </label>
                                        </div> 

                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="double_room"
                                            v-model="report.double_room"
                                            />
                                            <label for="double_room"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Double Room
                                            </label>
                                        </div>                                                                      
                                        
                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="single_room"
                                            v-model="report.single_room"
                                            />
                                            <label for="single_room"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Single Room
                                            </label>
                                        </div> 

                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="dormitory"
                                            v-model="report.dormitory"
                                            />
                                            <label for="dormitory"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Dormitory
                                            </label>
                                        </div> 

                                        <!-- FOR COTTAGE THE COLUMN PARAM1 IS USED -->
                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="cottage"
                                            v-model="report.param1"
                                            />
                                            <label for="cottage"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Cottage
                                            </label>
                                        </div> 


                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="conference_hall"
                                            v-model="report.conference_hall"
                                            />
                                            <label for="conference_hall"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Conference Hall/Other
                                            </label>
                                        </div> 

                                        <div class="relative mr-3 mb-3">
                                            <input
                                            type="text"
                                            class="peer block w-full px-3 py-3.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white  focus:border-blue-600 focus:outline-none  placeholder-transparent"
                                            id="convention_hall"
                                            v-model="report.convention_hall"
                                            />
                                            <label for="convention_hall"
                                            class="absolute left-0 -top-0 text-gray-500 text-sm ml-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 transition-all"
                                            >Convention Hall/Other
                                            </label>
                                        </div>    
                                    

                                        <button
                                            type="button"
                                            class=" mb-2 rounded-md border bg-red-600 text-white"
                                            @click="remove(index)"
                                            v-show="index != 0"
                                        >
                                            Remove
                                        </button>
                                        </div>

                                           
                                    </div>

                                     <div>
                                            <button class="text-green-600 mt-4 mb-5 hover:underline underline-offset-2" @click="addMore">+ Add Row</button>
                                        </div>
                                </div>
                            </div>
                         


                        </div>
                    </div>
                <div v-show="mAlert" class="mt-5 mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline mr-3">Enter All *</span>
                    <span class="absolute top-0 bottom-0 right-0  " v-on:click="closeInfo">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                <div class="flex space-x-2 justify-center mb-5">
                    <button type="button" v-on:click="createModel" style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 " >
                        Preview
                    </button>
                </div>


                
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import vSelect from 'vue-select';
 
  export default {
    components:{
        vSelect,

    },
    data(){
        return{
            name:'',
            mAlert:false,

            data:{
            
            },
            user:[],
            districts:[],
            months:['January','February','March','April','May','June','July','August','September','October','November','December'],
            report:{
                users_id:'',
                //lodges_id:'',
                location:'',
                district:'',
                month:'',
                year:'',

                total_rooms: '',
                total_beds: '',
                total_beds_dormitory: '',
                any_other_lodging: '',
            },
            report_details: [
                {
                date: '',
                suite: '',
                deluxe: '',
                double_room: '',
                single_room: '',
                dormitory: '',
                param1:'',//THIS IS COTTAGE
                conference_hall: '',
                convention_hall:'',
                },
            ],

            mREPORT:{},
            mLodges:'',
                        isValidOne:true,
            isValidTwo:true,
            isValidThree:true,
            isValidFour:true,
 
            regex:/[0-9]/,

        }
    },

    
created() {
    this.user = User;

    axios.get("/api/districts").then(result => {
      this.districts = result.data.data;
    })

    axios.get("/api/room").then(result => {
      this.rooms = result.data.data;
    })
    
    axios.get("/api/getOnlyLodgeName").then((result) => {
            this.mLodges = result.data.data
    })

    try{
        this.mREPORT = JSON.parse(this.$route.params.report)
            this.report = this.mREPORT.report
            this.report_details = this.mREPORT.reportDetails
        
        
    }catch(err){ }

    // try{
    //     let id = JSON.parse(this.$route.params.id)
    //         axios.get("/api/occupancy/"+id).then(result => {
    //             this.rooms = result.data.data;
    //             this.report = result.data.data
    //             this.report_details = result.data.data.occupancy_details
    //         })
        
    // }catch(err){ }
 
},
  methods: {
      createModel(){

          if(this.isValidOne && this.isValidTwo && this.isValidThree && this.isValidFour){
            this.report.users_id = this.user.id


            if(this.report.location==''||this.report.month==''||this.report.year==''){
                this.mAlert =true
            }else {
                const reports = new Object()
                reports.report = this.report
                reports.reportDetails = this.report_details
                
                let reportDataString = JSON.stringify(reports);
                this.$router.push({
                    name:'occupancyPreview',
                    params:{
                        reports: reportDataString,
                    }
                })

            }
          }

      },
  
 

        addMore() {
            this.report_details.push({
                date: '',
                suite: '',
                deluxe: '',
                double_room: '',
                single_room: '',
                dormitory: '',
                param1:'',//THIS IS COTTAGE
                conference_hall: '',
                convention_hall: '',
            });
            },
        remove(index) {
        this.report_details.splice(index, 1);
        },

        closeInfo(){
            this.mAlert = false
        },
        backToList(){
             this.$router.push({
                name:'visitorDataReportList',
               
            })
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
};


</script> 
 