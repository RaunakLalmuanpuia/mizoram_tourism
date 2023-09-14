<template>
<div class="relative">
 <!-- START -->
    <div>
        <div v-show="modalBackground" v-on:click="modalDisappear" class="absolute top-0 left-0 right-0 z-50 bg-black opacity-50 h-full w-full"></div>

        <div v-if="showHistoryModal" class="inline-block align-middle absolute top-2 left-0 right-0 z-50  "> 
            <HistoryModal 
                v-bind:reportModel="reportModel"
                v-bind:reportName="reportName"
                @modal="changeModal($event)"
                ></HistoryModal>
        </div>

    </div>
 <!-- END -->
    <div class="mt-10 ml-14">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 ">
            
            <div class="bg-slate-50 rounded-lg  border-solid border-2 border-neutral-300 p-6">
                <div class="font-medium w-28">
                    Lodge
                </div>
                <div class="text-2xl font-medium text-green-500">
                    {{data.totalLodge}}
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg  border-solid border-2 border-neutral-300 p-6">
                <div class="font-medium w-28">
                    Private Hotel
                </div>
                <div class="text-2xl font-medium text-green-500">
                    {{data.totalPrivateRegister}}
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg  border-solid border-2 border-neutral-300 p-6">
                <div class="font-medium w-28">
                    Destination
                </div>
                <div class="text-2xl font-medium text-green-500">
                    {{data.totalDestination}}
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg  border-solid border-2 border-neutral-300 p-6">
                <div class="font-medium w-28">
                    Pledge
                </div>
                <div class="text-2xl font-medium text-green-500">
                    {{data.totalPledge}}
                </div>
            </div>

            <div class="bg-slate-50 rounded-lg  border-solid border-2 border-neutral-300 p-6">
                <div class="font-medium w-28">
                    Citizen Register 
                </div>
                <div class="text-2xl font-medium text-green-500">
                    {{data.totalCitizenRegister}}
                </div>
            </div>
        </div>


        <div class="mt-10">

            <div class="flex flex-wrap">
                <div>
                    <button class="mr-3 rounded-full bg-slate-50 rounded-lg  border-solid border-2 border-slate-300
                     px-3 py-2 hover:drop-shadow-xl hover:border-emerald-600" 
                        v-bind:class="{'drop-shadow-xl':hasShadowVisitor,'border-emerald-600':hasBorderVisitor}"
                        @click="visitorDataClick">
                     Visitor Data 
                </button>
                </div>
                    
                <div>
                    <button class="rounded-full bg-slate-50 rounded-lg  border-solid border-2 border-slate-300 px-3 py-2 
                    hover:drop-shadow-xl hover:border-emerald-600"
                        v-bind:class="{'drop-shadow-xl':hasShadowOccupancy,'border-emerald-600':hasBorderOccupancy}"
                        @click="occupancyClick">
                    Occupancy
                    </button>
                </div>
                <div class="ml-2">
                    <month-picker-input 
                    @change="changeOfMonth" 
                    v-model="selectedMonthAndYear"
                    :default-month="currentMonth"
                    :default-year="currentYear"
                    ></month-picker-input>
                </div>
                
  
            </div>
        </div>

        <div v-show="showOccupancy"> 
            <div class="flex flex-wrap mt-10">
                <div style="background-color:#e6fffa" class="p-6 w-52 mr-5">
                    <div class="font-medium">
                        For {{selectedMonthAndYear.month}}
                    </div>
                    <div style="color:#24b897" class="text-2xl">
                        {{data.occupancySubmitForGivenMonthCount}}
                    </div>
                    <div style="color:#24b897" class="text-sm">
                        Submitted
                    </div>
                </div>

                <div style="background-color:#fff2eb" class="p-6 w-56  mr-5">
                    <div class="font-medium">
                        For {{selectedMonthAndYear.month}}
                    </div>
                    <div style="color:#f86d1c" class="text-2xl">
                        {{data.occupancyNotSubmitForGivenMonthCount}}
                    </div>
                    <div style="color:#f86d1c" class="text-sm">
                        Not Submitted
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Suite
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                       <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_Suite}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Deluxe
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_Deluxe}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Double
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_Double}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Single
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_Single}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Dormitory
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_Dormitory}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Hall/Other
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_ConferenceHall}}
                        </div>
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Convention/Other
                    </div>
                    <div class="font-medium text-blue-700 text-3xl">
                        <div  v-for="(occupancy) in data.grandTotal" :key="occupancy.id" 
                            class="font-medium text-blue-700 text-3xl">
                            {{occupancy.GRAND_TOTAL_ConventionHall}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <table class="table-auto">
                    <thead style="background-color:#e0f0f8">
                        <tr>
                            <th class="p-3 text-xs">Sl.No.</th>
                            <th class="p-3 text-xs">Facility Name</th>
                            <th class="p-3 text-xs">Date</th>
                            <th class="p-3 text-xs">Suite</th>
                            <th class="p-3 text-xs">Deluxe</th>
                            <th class="p-3 text-xs">Double</th>
                            <th class="p-3 text-xs">Single</th>
                            <th class="p-3 text-xs">Dormitory</th>
                            <th class="p-3 text-xs">Cottage</th>

                            <th class="p-3 text-xs">Hall/Other</th>
                            <th class="p-3 text-xs">Conven/Other</th> 
                            <th class="p-3 text-xs">View</th>
                            <th class="p-3 text-xs">Print</th>
                            <th class="p-3 text-xs">Delete</th> 

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="(occupancy,index) in data.occupancyList" :key="occupancy.id">
                            <td>{{index+1}}</td>
                            <td>{{occupancy.facility_name}}</td>
                            <td>{{occupancy.month}}, {{occupancy.year}}</td>
                            <td>{{occupancy.totalSuite }}</td>
                            <td>{{occupancy.totalDelux }}</td>
                            <td>{{occupancy.totalDouble }}</td>
                            <td>{{occupancy.totalSingle }}</td>
                            <td>{{occupancy.totalDormitory }}</td>
                            <td>{{occupancy.totalCottage }}</td>

                            <td>{{occupancy.totalConferenceHall }}</td>
                            <td>{{occupancy.totalConventionHall }}</td>
                            <td>
                                <router-link :to="{ name:'visitorDataReportDetail',params:{id:occupancy.id}}" class="hover:text-indigo-900" >View</router-link>
                            </td>
                            <td>
                                    <a target="_blank" class="hover:text-green-900" :href="'/api/download/occupancy/' + occupancy.id" >Print</a>

                            </td>
                            <td>
                                <a  class="hover:text-red-900" href="#" v-on:click="deleteOccupancy(occupancy.id)">Delete</a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>
 
        <!-- STARTING OF VISITOR DATA -->
        <div v-show="showVisitorData">
 
            <div class="flex flex-wrap mt-10">
                <div style="background-color:#e6fffa" class="p-6 w-52 mr-5">
                    <div class="font-medium">
                        For {{selectedMonthAndYear.month}}
                    </div>
                    <div style="color:#24b897" class="text-2xl">
                        {{data.reportSubmitForGivenMonthCount}}
                    </div>
                    <div style="color:#24b897" class="text-sm">
                        Submitted
                    </div>
                </div>

                <div style="background-color:#fff2eb" class="p-6 w-56  mr-5">
                    <div class="font-medium">
                        For {{selectedMonthAndYear.month}}
                    </div>
                    <div style="color:#f86d1c" class="text-2xl">
                        {{data.reportNotSubmitForGivenMonthCount}}
                    </div>
                    <div style="color:#f86d1c" class="text-sm">
                        Not Submitted
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Local
                    </div>
                    <div  v-for="(visitorData) in data.visitorDataList" :key="visitorData.id" 
                    class="font-medium text-blue-700 text-3xl">
                            {{visitorData.totalCheckInLocal}}
                    </div>
                    </div>
               

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Domestic
                    </div>
                     <div  v-for="(visitorData) in data.visitorDataList" :key="visitorData.id" 
                    class="font-medium text-blue-700 text-3xl">
                        {{visitorData.totalCheckInDomestic}}
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        NRI
                    </div>
                    <div  v-for="(visitorData) in data.visitorDataList" :key="visitorData.id" 
                    class="font-medium text-blue-700 text-3xl">
                        {{visitorData.totalCheckInNRI}}
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Foreign
                    </div>
                     <div  v-for="(visitorData) in data.visitorDataList" :key="visitorData.id" 
                    class="font-medium text-blue-700 text-3xl">
                        {{visitorData.totalCheckInForeign}}
                    </div>
                </div>

                <div class="p-3 w-32 text-left mr-5">
                    <div class="font-medium w-10 ">
                        Total
                    </div>
                    <div  v-for="(visitorData) in data.visitorDataList" :key="visitorData.id" 
                    class="font-medium text-blue-700 text-3xl">
                        {{visitorData.grandTotalVisitorReport}}

                    </div>
                </div>
            </div>
             
            <div class="my-5 w-72" v-show="mToastImage">
                <div class="ml-5 mt-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold"></strong>
                <span class="ml-3 block sm:inline ">Search not found!</span>
                <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
                </div>
            </div>
            <div class="mt-10">
                <table class="table-auto  ">
                    <thead style="background-color:#e0f0f8" >
                        <tr class="">
                            <th class="p-3 text-xs">Sl.No.</th>
                            <th class="p-3 text-xs">Facility Name</th>
                            <th class="p-3 text-xs">Local</th>
                            <th class="p-3 text-xs">Domestic</th>
                            <th class="p-3 text-xs">NRI</th>
                            <th class="p-3 text-xs">Foreign</th>
                            <th class="p-3 text-xs">Total</th>
                            <th class="p-3 text-xs">View</th>
                            <th class="p-3 text-xs">Print</th>
                            <th class="p-3 text-xs">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr v-for="(report,index) in data.reportSubmitForGivenMonth" :key="report.id" 
                             :class="{'bg-red-50':index%2}">

                            <td>{{index+1}}</td>
                            <td>{{report.facility_name||0}}</td>
                            <td>{{report.check_in_local ||0}}</td>
                            <td>{{report.check_in_domestic||0 }}</td>
                            <td>{{report.check_in_nri ||0}}</td>
                            <td>{{report.check_in_foreign||0 }}</td>
                            <td>{{ Number(report.check_in_local) + Number(report.check_in_domestic) + Number(report.check_in_nri) + Number(report.check_in_foreign) }} </td>
                            <td> 
                                <a href="#" class="hover:text-green-900" v-on:click="viewReport(report.id)">View</a>
                            </td>
                             <td>
                                 <a target="_blank" class="hover:text-green-900" :href="'/api/download/report/' + report.id" >Print</a>
                            </td>
                            <td>
                                <a href="#" class="hover:text-red-900" v-on:click="deleteReport(report.id)">Delete</a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>  
    </div>
</div>
</template>

<script>
import axios from "axios";
import { MonthPickerInput } from 'vue-month-picker'
import HistoryModal from './HistoryModal.vue';

export default {
     components: {
         HistoryModal,
         MonthPickerInput
     },
    data(){
        return{
            data:'',
            hasShadowVisitor:true,
            hasBorderVisitor:true,
            hasShadowOccupancy:false,
            hasBorderOccupancy:false,
            showOccupancy:false,
            showVisitorData:true,
            selectedMonthAndYear:{},
            selectedMonth:'',
            selectedMonthName:'',

            selectedYear:'',
            currentMonth:'',
            currentMonthName:'',
            currentYear:'',
            isVisitor:'',

            currentMonthAndReport:{
                mMonthIndex:'',
                mMonth:'',
                mYear:'',
                mIsVisitor:'',
                facility_name:'',
                search:null,
            },
            showing:true,

            modalBackground: false,
            showHistoryModal: false,
            reportModel:{},
            reportName:'',
            searchFacilityVisitorReportName:'',
            mToastImage:false,


        }
    },
    
    created(){
        const current = new Date();
        this.currentMonth = current.getMonth()+1
        
        this.currentYear = current.getFullYear()
        this.currentMonthName = current.getMonth()

        this.selectedMonth = this.currentMonth
        this.selectedMonthName = current.getMonth()

        this.isVisitor = true
        this.currentMonthAndReport.mMonth = this.currentMonthName
        this.currentMonthAndReport.mMonthIndex = this.selectedMonth
        this.currentMonthAndReport.mYear = this.selectedYear
        
        this.currentMonthAndReport.mIsVisitor = this.isVisitor

        axios.post("/api/dashboard",this.currentMonthAndReport).then((result) => {
            this.data= result.data
        })
    },

    methods:{
        visitorDataClick(){
            this.hasShadowVisitor=true
            this.hasBorderVisitor=true
            this.hasShadowOccupancy=false
            this.hasBorderOccupancy=false

            this.showOccupancy=false
            this.showVisitorData=true

            this.isVisitor = true
            this.currentMonthAndReport.mMonthIndex = this.selectedMonthAndYear.monthIndex
            this.currentMonthAndReport.mMonth = this.selectedMonthAndYear.month
            this.currentMonthAndReport.mYear = this.selectedMonthAndYear.year
            this.currentMonthAndReport.mIsVisitor = this.isVisitor
            axios.post("/api/dashboard",this.currentMonthAndReport).then((result) => {
                this.data= result.data
                if(this.data==""){
                    this.mToastImage = true
                }
            })

        },
        occupancyClick(){
            this.hasShadowVisitor=false
            this.hasBorderVisitor=false
            this.hasShadowOccupancy=true
            this.hasBorderOccupancy=true

            this.showOccupancy=true
            this.showVisitorData=false

            this.isVisitor = false

            this.currentMonthAndReport.mMonthIndex = this.selectedMonthAndYear.monthIndex
            this.currentMonthAndReport.mMonth = this.selectedMonthAndYear.month
            this.currentMonthAndReport.mYear = this.selectedMonthAndYear.year
            this.currentMonthAndReport.mIsVisitor = this.isVisitor
            axios.post("/api/dashboard",this.currentMonthAndReport).then((result) => {
                this.data= result.data
            })
        },
        changeOfMonth(date){
            this.selectedMonthAndYear=date

            this.currentMonthAndReport.mMonthIndex = this.selectedMonthAndYear.monthIndex
            this.currentMonthAndReport.mMonth = this.selectedMonthAndYear.month
            this.currentMonthAndReport.mYear = this.selectedMonthAndYear.year
            this.currentMonthAndReport.mIsVisitor = this.isVisitor

            axios.post("/api/dashboard",this.currentMonthAndReport).then((result) => {
                this.data= result.data
            })

        },
        changeModal(result){
            this.modalBackground = !this.modalBackground
            this.showHistoryModal = !this.showHistoryModal
        },
         modalDisappear(){

            this.modalBackground = !this.modalBackground
            this.showHistoryModal = !this.showHistoryModal


        },
          viewReport(reportId){
            //GET THE SINGLE REPORT

            this.showing = true
            this.modalBackground = true,
            this.showHistoryModal = true,

 
            axios.get("/api/reports/"+reportId).then((result) => {
                this.reportModel = result.data.data
                this.reportName=result.data.data.user.name

            });
        },
        print(reportId){

            axios.get("/api/download/report/"+reportId).then((result) => {

            })
        },
        

        searchFacilityVisitorReportClick(){
            
            //this.selectedMonthName = this.selectedMonthAndYear.month
            this.currentMonthAndReport.mMonthIndex = this.selectedMonthAndYear.monthIndex
            this.currentMonthAndReport.mMonth = this.selectedMonthAndYear.month
            this.currentMonthAndReport.mYear = this.selectedMonthAndYear.year
            this.currentMonthAndReport.mIsVisitor = this.isVisitor

            this.currentMonthAndReport.facility_name = this.searchFacilityVisitorReportName

            if(this.searchFacilityVisitorReportName==''){
                this.currentMonthAndReport.search = false
            }else{
                this.currentMonthAndReport.search = true
            }
            
            axios.post("/api/dashboard",this.currentMonthAndReport).then((result) => {
                this.data= result.data
            })
              
        },

        deleteReport(mReportId){
            if(confirm("Do you really want to delete?")){

                axios.delete("/api/reports/"+mReportId).then((result) => {
                if(result.status==200){
                    this.$router.go()
                }
                })
            }
        },
         deleteOccupancy(mOccupancyId){
            if(confirm("Do you really want to delete?")){

                axios.delete("/api/occupancy/"+mOccupancyId).then((result) => {
                if(result.status==200){
                    this.$router.go()
                }
                })
            }
        },
        toastCloseClick(){
            this.mToastImage=false
        }
    }
}
</script>