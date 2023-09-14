<template>
    <div class="m-4">

        <a  href="#"  @click="backClick()" class="text-green-600"> Back To Visitor Report</a>
        <!-- HEADING -->
        <div class="text-4xl font-bold my-5">Review Report</div> 

        <!-- MAIN -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">

            <!-- 1/3 -->
            <div class="col-span-2">
                <!-- two rows -->
                <div class="">
                    <!-- HOTEL NAME -->
                    <div>
                        <div class="grid grid-cols-5 gap-3 mb-5">
                            <div class="col-span-3 bg-white border-dashed border-2 border-sky-200 p-8 ">
                                <div class="text-xl font-bold">{{facilityName}}</div> 
                                <div></div>
                            </div>
                            <div class="col-span-2 bg-white border-dashed border-2 border-sky-200 py-8 px-3">
                                <div class="text-lg font-bold">{{ visitorData.report_month }}</div> 
                                <div>{{ mReportDay  }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- VISITOR DATA -->
                    <div class="mt-5 border border-2 border-sky-200">
                        <div class="bg-white p-8">
                            <div class="">
                                <a  href="#"  @click="backClick()" class="text-green-600"> Edit</a>
                            </div>
                            <div class="mt-5">Number of Guest Checked In</div>
                            <div class="grid grid-cols-3 gap-2 mt-3">
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.checkedInLocal||0}}
                                    </div>
                                    <div>
                                        Local
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.checkedInDomestic||0}}
                                    </div>
                                    <div>
                                        Domestic
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.checkedInNri||0}}
                                    </div>
                                    <div>
                                        NRI
                                    </div>
                                </div>
                               <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.checkedInForeign||0}}
                                    </div>
                                    <div>
                                        Foreign
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{ totalGuest }}
                                    </div>
                                    <div class="font-bold">
                                        Total
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">Total Number of Night Spent</div>
                            <div class="grid grid-cols-3 gap-2 mt-3">
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.nightSpentLocal||0}}
                                    </div>
                                    <div>
                                        Local
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.nightSpentDomestic||0}}
                                    </div>
                                    <div>
                                        Domestic
                                    </div>
                                </div>
                                <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.nightSpentNri||0}}
                                    </div>
                                    <div>
                                        NRI
                                    </div>
                                </div>
                               <div class="border py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{visitorData.nightSpentForeign||0}}
                                    </div>
                                    <div>
                                        Foreign
                                    </div>
                                </div>
                                <div class="border  py-1 pl-3 pr-2">
                                    <div class="text-lg font-bold">
                                        {{ totalNight }}
                                    </div>
                                    <div class="font-bold">
                                        Total
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- 2/3 -->
            <div class="col-span-3">
                <!-- DETAILS OF VISITOR -->
                <div class="bg-white p-8 ">
                    <div>
                        <div>
                        <!-- HEAD -->
                            <div class="mb-3 text-xl font-bold">Details of Visitor</div> 

                            <div class="grid invisible  md:visible md:grid-cols-6  bg-emerald-50 text-xs font-semibold py-2 px-4">
                                <div>Category</div>
                                <div>Residence</div>
                                <div>Guest</div>
                                <div>Nights Spent</div>
                                <div class="text-center">Leisures</div>
                                <div class="text-center">Non Leisures</div>

                            </div>

                        </div>
                        <!-- BODY -->
                        <div v-for="(report, counter) in detailedReports" :key="counter">
                            
                            <div class="grid md:grid-cols-6 bg-gray-200 px-4 py-2 text-xs">
                                <div><span class="visible md:hidden">Category: </span>{{ report.category }}</div>
                                <div><span class="visible md:hidden">Residence: </span>{{ report.residence }}</div>
                                <div><span class="visible md:hidden">Guest: </span>{{ report.numberOfGuest }}</div>
                                <div><span class="visible md:hidden">Night Spent: </span>{{ report.numberOfNightsSpent }}</div>
                               
                                <div><span class="visible md:hidden">Leisure: </span>{{ report.mLeisures }}</div>
                                <div><span class="visible md:hidden">Non Leisure: </span>{{ report.mNonLeisures }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        <div class="mt-5">
            
        </div>
        <router-link to="#" @click="createReport()" style="background:#24b897" class="rounded-full font-bold text-white  px-4 py-3 mt-10">
                        Send Report 
        </router-link>

        
    </div>
</template>
<script>
import axios from 'axios'


export default{
    
    data(){
        return{
          
            user:[],
            visitorData:{},
            detailedReports:[{}],
            
            leisures:'',

            totalGuest:'',
            totalNight:'',
            test:{},
            reportDay:'',
            mReportDay:'',
            userName:'',
            mLodgeName:"",
            facilityName:'',


        }
    },
    created() {
            //console.log(this.$route.params.detailedReports)
            this.user = User
            this.visitorData = JSON.parse(this.$route.params.visitorDataString)
            this.detailedReports = JSON.parse(this.$route.params.detailedReportsString)
            this.userName = JSON.parse(this.$route.params.userName)
            
            const date = new Date(this.visitorData.report_month)
            this.reportDay = date.getDay();
            switch(this.reportDay){
                case 1:this.mReportDay= "Monday";break;
                case 2:this.mReportDay= "Tuesday";break;
                case 3:this.mReportDay= "Wednesday";break;
                case 4:this.mReportDay= "Thursday";break;
                case 5:this.mReportDay= "Friday";break;
                case 6:this.mReportDay= "Saturday";break;
                case 7:this.mReportDay= "Sunday";break;
            }
            //console.log(this.detailedReports[0].leisures_holidaying)

            // CALCULATE THE TOTAL OF VISITOR DATA || IF NULL MAKE IT 0
            this.totalGuest = parseInt(this.visitorData.checkedInLocal)+parseInt(this.visitorData.checkedInDomestic)
            +parseInt(this.visitorData.checkedInNri)+parseInt(this.visitorData.checkedInForeign)
            this.totalNight = parseInt(this.visitorData.nightSpentLocal) +parseInt(this.visitorData.nightSpentDomestic)
            +parseInt(this.visitorData.nightSpentNri)+parseInt(this.visitorData.nightSpentForeign)

            // DETAILS OF VISITOR
            var leisuresTemp=''
            var nonLeisuresTemp=''

            for (let i = 0; i < this.detailedReports.length; i++){
                if(this.detailedReports[i].leisures_holidaying==true)
                    leisuresTemp = leisuresTemp + ' Holidaying '
                if(this.detailedReports[i].leisures_recreation==true)
                    leisuresTemp = leisuresTemp + ' Recreation '               
                if(this.detailedReports[i].leisures_sightseeing==true)  
                    leisuresTemp = leisuresTemp + ' Sightseeing '         
                if(this.detailedReports[i].leisures_others==true)      
                    leisuresTemp = leisuresTemp + ' Others '    
                
                if(this.detailedReports[i].nonLeisures_business==true)
                    nonLeisuresTemp = nonLeisuresTemp + ' Business '
                if(this.detailedReports[i].nonLeisures_religious==true)
                    nonLeisuresTemp = nonLeisuresTemp + ' Religious '               
                if(this.detailedReports[i].nonLeisures_education==true)  
                    nonLeisuresTemp = nonLeisuresTemp + ' Education '         
                if(this.detailedReports[i].nonLeisures_sports==true)      
                    nonLeisuresTemp = nonLeisuresTemp + ' Sports '  
                if(this.detailedReports[i].nonLeisures_health==true)
                    nonLeisuresTemp = nonLeisuresTemp + ' Health '
                if(this.detailedReports[i].nonLeisures_shopping==true)
                    nonLeisuresTemp = nonLeisuresTemp + ' Shopping '               
                if(this.detailedReports[i].nonLeisures_others==true)  
                    nonLeisuresTemp = nonLeisuresTemp + ' Others '         
 
                this.detailedReports[i].mLeisures = leisuresTemp
                leisuresTemp =''
                this.detailedReports[i].mNonLeisures = nonLeisuresTemp
                nonLeisuresTemp=''
            }

            // axios.get("api/getSingleLodgeName/3").then((result)=>{
            //      this.mLodgeName = result.data.data.name
            //     console.log("XXXXXXXXXXXXX")
            //     console.log(result)
            // })


            //this.leisures = detail

            //GET THE USER NAME
            axios.get("/api/facility-name/"+this.user.id).then((result) => {
                this.facilityName = result.data
            })

    },
    methods: {
            backClick(){

                this.$router.push({
                name: 'reports',
                params: {
                    visitorDataString: this.$route.params.visitorDataString,
                    detailedReportsString:this.$route.params.detailedReportsString
                },
                });
            },
            
            createReport(){

                const report = new Object()
                report.visitorData = this.visitorData
                report.detailedReports = this.detailedReports

                axios.post('/api/reports',report)
                .then((result) => {
                    // console.log("My Report: "+ result)
                }).catch(e=>{ })

                this.$router.push({
                    name: 'reports',
                });
            }
     },


}

</script>
