<template>
   <div>
        <a  href="#"  @click="backClick()" class="text-green-600"> Back To Visitor Report</a>
         <div class="ml-4 mb-6 text-black text-2xl mx-2 font-semibold">
            Detail Report of Montly Occupancy Statement   
        </div>
       
         <div class="ml-5 grid grid-cols-1 md:grid-cols-5 gap-3">

          
            <div class="col-span-2">
            
                <div class="">
             
                    <div>
                        <div class="grid grid-cols-5 gap-3 mb-5">
                            <div class="col-span-3 bg-white border-dashed border-2 border-sky-200 p-8 ">
                                <div class="text-xl font-bold">{{data.users_id}}</div> 
                                <div>
                                    {{ data.location }}, {{data.district }}
                                </div>
                            </div>
                            <div class="col-span-2 bg-white border-dashed border-2 border-sky-200 py-8 px-3">
                                <div class="text-lg font-bold"></div> 
                                <div>{{data.month }}, {{data.year }}</div>
                            </div>
                        </div>
                    </div>

                     
                    <div class="mt-5 border border-2 border-sky-200">
                        <div class="bg-white p-8">
                            <div class="mt-5">Number of Room Available</div>
                            <div class="grid grid-cols-3 gap-2 mt-3">
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{data.total_rooms||0}}
                                    </div>
                                    <div>
                                        Total Rooms
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{data.total_beds||0}}
                                    </div>
                                    <div>
                                        Total Beds
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{data.total_beds_dormitory||0}}
                                    </div>
                                    <div>
                                        Total Beds (Dormitory)
                                    </div>
                                </div>
                               <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{data.any_other_lodging||0}}
                                    </div>
                                    <div>
                                        Any Other Lodging
                                    </div>
                                </div>
                                 
                            </div>
                             

                        </div>
                    </div>

                </div>

            </div>

           
           <div>

               
           </div>
            
            <div class="col-span-3">
                
                <div class="bg-white p-8 ">
                    <div>
                        <div>
                        
                            <div class="mb-3 text-xl font-bold">Details of Monthly Occupancy</div> 

                            <div class="grid invisible  md:visible md:grid-cols-9  bg-emerald-50 text-xs font-semibold py-2 px-4">
                                <div>Date</div>
                                <div>Suite</div>
                                <div>Deluxe</div>
                                <div>Double Room</div>
                                <div>Single Room</div>
                                <div>Dormitory</div>
                                <div>Cottage</div>
                                <div>Conference Hall</div>
                                <div>Convention Hall</div>
                            </div>
                        </div>
                    <div v-for="(report, counter) in occupancy_details" :key="counter">
                            
                            <div class="grid md:grid-cols-9 bg-gray-200 px-4 py-2 text-xs">
                                
                                <div class="mr-5"><span class="visible md:hidden">Date: </span>{{ report.date }}</div>
                                <div class="ml-3"><span class="visible md:hidden">Suite: </span>{{ report.suite }}</div>
                                <div><span class="visible md:hidden">Deluxe: </span>{{ report.deluxe }}</div>
                                <div><span class="visible md:hidden">Double Room: </span>{{ report.double_room }}</div>
                                <div><span class="visible md:hidden">Single Room: </span>{{ report.single_room }}</div>
                                <div><span class="visible md:hidden">Dormitory: </span>{{ report.dormitory }}</div>
                                <div><span class="visible md:hidden">Cottage: </span>{{ report.param1 }}</div>
                                <div><span class="visible md:hidden">Conference Hall: </span>{{ report.conference_hall }}</div>
                                <div><span class="visible md:hidden">Convention Hall: </span>{{ report.convention_hall }}</div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>



        </div>
        <div class="flex space-x-2 justify-center mb-5 mt-5 ">
            <div>
                <button type="button" v-on:click="backClick"   class="bg-amber-400 rounded-full font-bold text-white  px-4 py-3 " >
                    Edit
                </button>
            </div>
            <div>
                <button type="button" v-on:click="createModel" style="background:#24b897" class=" rounded-full font-bold text-white  px-4 py-3 " >
                    Submit
                </button>
            </div>
        </div>
   </div>
</template>


<script>
import axios from "axios";
 

export default {
  data(){
    return{
        data:{},
        id:'',
        reports:{},
        data:{},
        occupancy_details:[],

    }
  },
  created() {

    this.id = this.$route.params.id

    this.reports = JSON.parse(this.$route.params.reports)
    this.data = this.reports.report
    this.occupancy_details = this.reports.reportDetails

    // axios.get("/api/occupancy/"+this.id).then((result) => {
    //     console.log(result.data);
    //     this.data = result.data.data;
    // })


  },
  


  methods: {
     backClick(){

        this.$router.push({
        name: 'visitorDataReports',
        params: {
            report: this.$route.params.reports,
        },
        });
            
    },

    createModel(){

               
            const reports = new Object()
            reports.report =  this.data
            reports.reportDetails = this.occupancy_details

             axios.post('/api/occupancy',reports)
            .then(response=>{
              if(response.data.data!=true){
                  this.mAlert = true
              }else{
                  if(response.status==200){
                    this.$router.push('./visitor-data-report-list')
              }
            }
              
          })
          .catch(e=>{
               
          })
    },

  }
};

</script>
