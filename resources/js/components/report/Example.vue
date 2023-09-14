<template>
<div class="container">

     <div class="grid grid-flow-dense grid-cols-1 md:grid-cols-3 gap-3 mt-8">
        <div class="col-span-2">
            <!-- 2/3 OF THE PAGE -->
            <div class="flex flex-col bg-white p-8 mr-4 ml-3" >
                <div class="flex flex-row" @click="visitorDataClick">

                    <div class="mb-8 text-black text-4xl   font-semibold" >
                        Visitor data
                    </div>
                    <div class="pl-5">
                        <svg class="hover:bg-slate-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"/><path d="M12 12.586 8.707 9.293l-1.414 1.414L12 15.414l4.707-4.707-1.414-1.414L12 12.586z"/></svg>
                    </div>
                   
                </div>
                <div v-show="visitorDataShow">
                    <div class="flex flex-row divide-x">
                        <div class="basis-1/2 mr-4">
                            <!-- FORM PART 1 -->
                            <p>Total no. of Night Spent</p>
                            
                            <div class="grid grid-cols-2 mt-4">
                                <div class="mr-3 mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Local"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Domestic"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mr-3 mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="NRI"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Foreign"
                                    v-model="data.n"
                                    />
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <p class="font-semibold">Total</p>
                                <p class="font-bold text-2xl text-colorx">244</p>
                                <p class="text-zinc-400">guests had checked in</p>
                            </div>
                        </div>
                        <div class="basis-1/2 pl-4">
                            <!-- FORM PART 2 -->
                            <p>Number of Guests Checked In</p>
                            
                            <div class="grid grid-cols-2 mt-4">
                                <div class="mr-3 mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Local"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Domestic"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mr-3 mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="NRI"
                                    v-model="data.n"
                                    />
                                </div>
                                <div class="mb-3">
                                    <input
                                    type="text"
                                    class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                                    id="name"
                                    placeholder="Foreign"
                                    v-model="data.n"
                                    />
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <p class="font-semibold">Total</p>
                                <p class="font-bold text-2xl text-colorx">244</p>
                                <p class="text-zinc-400">guests had spent the night</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- Details of VISITOR -->
          
            <div class="bg-white p-8 mr-4 ml-3 mt-5">
                <div class="flex flex-row" @click="detailsOfVisitorsClick">
                    <div class="mb-8 text-black text-4xl   font-semibold" >
                        Details of Visitors
                    </div>
                    <div class="pl-5">
                        <svg class="hover:bg-slate-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"/><path d="M12 12.586 8.707 9.293l-1.414 1.414L12 15.414l4.707-4.707-1.414-1.414L12 12.586z"/></svg>
                    </div>
                </div>
              
                
                <div v-show="detailsOfVisitorsShow">   
                    <div class="previous"
                        v-for="(detailedReports, counter) in detailedReportss"
                        v-bind:key="counter">
                        <div class="mb-3 mt-4 text-gray-500 flex flex-row">
                            <div>{{counter+1}}. Fill the columns separately for each place of residence (district, state or country)
                            </div>
                            <!-- <span @click="deleteDetailsOfVisitors(counter)">xxxx</span> -->
                            <div class="ml-4 text-red-400" @click="deleteDetailsOfVisitors(counter)">
                                    Remove
                            </div>

                        </div>
                        <div class="border-dashed border-2 border-grey-400 p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 ">
                                <div class="mr-3 mb-3">
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="category"
                                        placeholder="Category"
                                        v-model="detailedReports.category"
                                        />
                                </div>
                                
                                <div class="mr-3 mb-3">
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="residence"
                                        placeholder="Place Of Residence"
                                        v-model="detailedReports.residence"
                                        />
                                </div>
                                <div class="mr-3 mb-3">
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="numberOfGuest"
                                        placeholder="No. of Guests"
                                        v-model="detailedReports.numberOfGuest"
                                        />
                                </div>
                                <div class="mr-3 mb-3">
                                    <input
                                        type="text"
                                        class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="numberOfNightsSpent"
                                        placeholder="No. Of Nights Spent"
                                        v-model="detailedReports.numberOfNightsSpent"
                                        />
                                </div>
                            </div>

                            <div class="mb-3 mt-2 text-gray-500">
                                Leisure
                            </div>
                            <div class="grid grid-cols-4">
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.holidaying">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Holidaying</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.recreation">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Recreation</label>
                                    </div>
                                </div>
                                <div>
                                <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.sightseeing">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Sightseeing</label>
                                    </div>
                                </div>
                                
                                <div>
                                <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.leisureOthers">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-2 text-gray-500">
                                Non - Leisure
                            </div>
                            <div class="grid grid-cols-5">
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.business">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Business</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.religious">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Religious</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.education">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Education</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.sports">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Sports</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.health">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Health</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.shopping">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Shopping</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="py-2 flex items-center bg-white bg-clip-padding border border-solid border-gray-300 pl-3 mr-3 mb-3">

                                        <input id="check" 
                                            aria-describedby="checkbox-2" 
                                            type="checkbox" 
                                            class="text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            v-model="detailedReports.nonLeisureOthers">
                                        <label for="check" class="ml-3 text-sm  text-gray-400">Others</label>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                    <button  class="text-green-600 mt-4" @click="addDetailsOfVisitors">+ Add New</button>
                </div>

            </div>  
               
            <div class="mt-5  ">
                <div class=" ">
                    <router-link to="#" style="background:#24b897" class="rounded-full font-bold text-white  px-4 py-3 ">
                        Send report
                    </router-link>
                </div>
            </div>
        </div>
        
        <!-- 1/3 OF THE PAGE -->
        <div class="basis-1/3">
            <div class="flex flex-col mr-4">
                <!-- TOP PART -->
                <div class="p-8 bg-white">
                    <div class="mb-8 text-black text-3xl   font-semibold">
                        Generate Report
                    </div>
                    <div class="flex flex-row  items-center">
                        <div class="mr-3">
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="name"
                            placeholder="From"
                            v-model="data.n"
                            />
                        </div>
                        <div class="mr-3">
                            <input
                            type="text"
                            class="form-control block w-full px-3 py-2 text-base font-normal  text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none "
                            id="name"
                            placeholder="To"
                            v-model="data.n"
                            />
                        </div>
                        <div>
                            <router-link to="#" style="background:#24b897" class="rounded-full font-bold text-white  px-4 py-3 ">
                                Download
                            </router-link>
                        </div>
                    </div>
                </div>
                
                <!-- TOP BOTTOM -->
                <div class="p-8">
                    <div class="flex flex-col">
                        <div class="mb-8 text-black text-3xl font-semibold transform transition-transform duration-200 ease-in-out">
                            Report History
                        </div>
                        <div class="text-stone-500   transition-all duration-500 ease-in-out">
                            No record...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

</div>
</template>

<script>

export default{
    data(){
        return{
            data:{},
            body:false,
            visitorDataShow:true,
            detailsOfVisitorsShow:false,

            detailedReportss:[{
                category:'', 
                residence:'', 
                numberOfGuest:'', 
                numberOfNightsSpent:'', 
                holidaying:'', 
                recreation:'', 
                sightseeing:'', 
                leisureOthers:'', 
                business:'', 
                religious:'', 
                education:'', 
                sports:'', 
                health:'', 
                shopping:'', 
                nonLeisureOthers:'', 

            }],
        }
    },
    methods: {
        accordianClick(){
            this.body = !this.body
        },
        visitorDataClick(){
            this.visitorDataShow = !this.visitorDataShow

        },
        detailsOfVisitorsClick(){
            this.detailsOfVisitorsShow = !this.detailsOfVisitorsShow
        },

        addDetailsOfVisitors(){
            

            this.detailedReportss.push({
                category:'', 
                residence:'', 
                numberOfGuest:'', 
                numberOfNightsSpent:'', 
                holidaying:'', 
                recreation:'', 
                sightseeing:'', 
                leisureOthers:'', 
                business:'', 
                religious:'', 
                education:'', 
                sports:'', 
                health:'', 
                shopping:'', 
                nonLeisureOthers:'',
            })
        },
        deleteDetailsOfVisitors(counter){
            if(confirm("Do you really want to delete?")){
                this.detailedReportss.splice(counter,1);
            }
        }
    },
}
</script>
