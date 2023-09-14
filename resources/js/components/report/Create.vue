<template>
<div>
<div v-show="!lodgeCreated">
    <div class="mx-2 mt-10 ml-10 text-2xl font-semibold text-black underline decoration-solid">
        Lodge must be created</div>

</div>

<div v-show="lodgeCreated" class="relative">

 <!-- START -->
    <div>
        <div v-show="modalBackground" v-on:click="modalDisappear" class="absolute top-0 left-0 right-0 z-50 w-full h-full bg-black opacity-50"></div>

        <div v-if="showHistoryModal" class="absolute left-0 right-0 z-50 top-2 ">
            <HistoryModal
                v-bind:reportModel="reportModel"
                v-bind:reportName="reportName"
                @modal="changeModal($event)"
                ></HistoryModal>
        </div>
    </div>
 <!-- END -->
      <div class="grid grid-cols-1 gap-3 mt-8 grid-flow-dense md:grid-cols-3">
        <div class="col-span-2">
            <!-- 2/3 OF THE PAGE -->
            <div class="flex flex-col p-8 ml-3 mr-4 bg-white" >
                <!-- VISITOR DATA -->
                <a href="#">
                    <div class="flex flex-row" @click="visitorDataClick">

                        <div class="mb-8 text-4xl font-semibold text-black" >
                            Visitor data
                        </div>
                        <div class="pl-5">
                            <svg class="hover:bg-slate-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"/><path d="M12 12.586 8.707 9.293l-1.414 1.414L12 15.414l4.707-4.707-1.414-1.414L12 12.586z"/></svg>
                        </div>
                    </div>
                </a>
                <div v-show="visitorDataShow">
                    <!-- <div class="mb-3">
                        Facility Name <span style="color:red">*</span>:

                           <div>
                               <vSelect class="w-30"
                            v-model="visitorData.lodges_id"
                            :options="mLodges"
                            label="name"
                            :reduce="name=>name.id"
                            ></vSelect>
                           </div>
                    </div> -->
                    <div class="mb-3">
                        Report Date: <input type="date" class="border border-gray-300 border-solid rounded" v-model="visitorData.report_month">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:divide-x">

                        <div class="mr-4">
                            <!-- FORM PART 1 -->
                            <p>Number of Guests Checked In</p>
                            <div class="grid grid-cols-2 mt-4">
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputOne($event)" @change="changeInputOne($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="checkedInLocal"
                                    placeholder="Local"
                                    v-model="visitorData.checkedInLocal"
                                    />
                                    <label for="checkedInLocal"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Local
                                    </label>
                                    <div class="error" v-if="!isValidOne">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3">
                            <input @input="changeInputTwo($event)" @change="changeInputTwo($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="checkedInDomestic"
                                    placeholder="Domestic"
                                    v-model="visitorData.checkedInDomestic"
                                    />
                                     <label for="checkedInDomestic"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Domestic
                                    </label>
                                    <div class="error" v-if="!isValidTwo">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputThree($event)" @change="changeInputThree($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="checkedInNri"
                                    placeholder="NRI"
                                    v-model="visitorData.checkedInNri"
                                    />
                                     <label for="checkedInNri"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >NRI
                                    </label>
                                    <div class="error" v-if="!isValidThree">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3">
                            <input @input="changeInputFour($event)" @change="changeInputFour($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="checkedInForeign"
                                    placeholder="Foreign"
                                    v-model="visitorData.checkedInForeign"
                                    />
                                     <label for="checkedInForeign"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Foreign
                                    </label>
                                    <div class="error" v-if="!isValidFour">Invalid input (only numerical)</div>

                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="font-semibold">Total</p>
                                <p class="text-2xl font-bold text-colorx">{{ Number(visitorData.checkedInLocal) + Number(visitorData.checkedInDomestic) + Number(visitorData.checkedInNri)  + Number(visitorData.checkedInForeign) }}</p>
                                <p class="text-zinc-400">guests had checked in</p>
                            </div>
                        </div>
                        <div class="md:pl-4">
                            <!-- FORM PART 2 -->
                            <p>Total no. of Night Spent</p>

                            <div class="z-10 grid grid-cols-2 mt-4">
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputFive($event)" @change="changeInputFive($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="nightSpentLocal"
                                    placeholder="Local"
                                    v-model="visitorData.nightSpentLocal"
                                    />
                                     <label for="nightSpentLocal"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Local
                                    </label>
                                    <div class="error" v-if="!isValidFive">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3">
                            <input @input="changeInputSix($event)" @change="changeInputSix($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="nightSpentDomestic"
                                    placeholder="Domestic"
                                    v-model="visitorData.nightSpentDomestic"
                                    />
                                     <label for="nightSpentDomestic"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Domestic
                                    </label>
                                    <div class="error" v-if="!isValidSix">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputSeven($event)" @change="changeInputSeven($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="nightSpentNri"
                                    placeholder="NRI"
                                    v-model="visitorData.nightSpentNri"
                                    />
                                     <label for="nightSpentNri"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >NRI
                                    </label>
                                    <div class="error" v-if="!isValidSeven">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3">
                            <input @input="changeInputEight($event)" @change="changeInputEight($event)"
                                    type="number"
                                    class="peer block w-full px-3 py-3.5 text-base
                                    font-normal  text-gray-700 bg-white bg-clip-padding
                                    border border-solid border-gray-300 rounded transition
                                    ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                    focus:border-blue-600 focus:outline-none
                                    placeholder-transparent"
                                    id="nightSpentForeign"
                                    placeholder="Foreign"
                                    v-model="visitorData.nightSpentForeign"
                                    />
                                     <label for="nightSpentForeign"
                                    class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                    >Foreign
                                    </label>
                                    <div class="error" v-if="!isValidEight">Invalid input (only numerical)</div>

                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="font-semibold">Total</p>
                                <p class="text-2xl font-bold text-colorx">{{ Number(visitorData.nightSpentLocal) + Number(visitorData.nightSpentDomestic) + Number(visitorData.nightSpentNri)  + Number(visitorData.nightSpentForeign) }}</p>
                                <p class="text-zinc-400">guests had spent the night</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Details of VISITOR -->

            <div class="p-8 mt-5 ml-3 mr-4 bg-white">
                <a href="#">
                    <div class="flex flex-row" @click="detailsOfVisitorsClick">
                        <div class="mb-8 text-4xl font-semibold text-black" >
                            Details of Visitors
                        </div>
                        <div class="pl-5">
                            <svg class="hover:bg-slate-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z"/><path d="M12 12.586 8.707 9.293l-1.414 1.414L12 15.414l4.707-4.707-1.414-1.414L12 12.586z"/></svg>
                        </div>
                    </div>
                </a>
                <div v-show="detailsOfVisitorsShow">
                    <div>
                        <div class="flex flex-row mt-4 mb-3 text-gray-500">
                            <div>Fill the columns separately for each place of residence (district, state or country)
                            </div>

                        </div>
                        <div class="p-4 border-2 border-dashed border-grey-400">
                            <div class="grid grid-cols-1 md:grid-cols-2 ">
                                <!-- <div class="relative mb-3 mr-3">
                                    <input required
                                        type="text"
                                        class="peer block w-full px-3 py-3.5 text-base font-normal
                                        text-gray-700 bg-white bg-clip-padding border border-solid
                                         border-gray-300 rounded transition ease-in-out m-0
                                         focus:text-gray-700 focus:bg-white focus:border-blue-600
                                          focus:outline-none
                                          placeholder-transparent"
                                        id="category"
                                        placeholder="Category"
                                        v-model="detailedReports.category"
                                        />
                                        <label for="category"
                                        class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                        >Category
                                        </label>
                                </div> -->

                                <div class="relative mb-3 mr-3">
                                    <div class="mb-3">
                                        <label for="category" class="inline-block mb-2 text-gray-700 form-label">
                                            Category
                                        </label>

                                        <select v-model="detailedReports.category"
                                        @change="categoryChange"
                                        class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                            <option value="" disabled>Select Category</option>
                                            <option
                                                v-for="(category, i) in categories"
                                                :value="category"
                                                :key="i"
                                            >{{ category }}</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="relative mb-3 mr-3">
                                    <div class="mb-3 ">
                                        <label for="residence" class="inline-block mb-2 text-gray-700 form-label">
                                            Place of Residence
                                        </label>

                                        <select v-model="detailedReports.residence"
                                        class="form-select appearance-none block w-full  px-3 py-1.5 text-base  font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                            <option value="" disabled>Select Residence</option>
                                            <option
                                                v-for="(residence, i) in residences"
                                                :value="residence['name']"
                                                :key="i"
                                            >{{ residence['name'] }} ({{ residence['code'] }})</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputNine($event)" @change="changeInputNine($event)"
                                        type="number"
                                        class="peer block w-full px-3 py-3.5 text-base font-normal
                                        text-gray-700 bg-white bg-clip-padding border border-solid
                                         border-gray-300 rounded transition ease-in-out m-0
                                         focus:text-gray-700 focus:bg-white focus:border-blue-600
                                          focus:outline-none
                                          placeholder-transparent"
                                          id="numberOfGuest"
                                        placeholder="No. of Guests"
                                        v-model="detailedReports.numberOfGuest"
                                        />
                                          <label for="numberOfGuest"
                                        class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                        >No. of Guests
                                        </label>
                                     <div class="error" v-if="!isValidNine">Invalid input (only numerical)</div>

                                </div>
                                <div class="relative mb-3 mr-3">
                            <input @input="changeInputTen($event)" @change="changeInputTen($event)"
                                        type="number"
                                        class="peer block w-full px-3 py-3.5 text-base font-normal
                                        text-gray-700 bg-white bg-clip-padding border border-solid
                                         border-gray-300 rounded transition ease-in-out m-0
                                         focus:text-gray-700 focus:bg-white focus:border-blue-600
                                          focus:outline-none
                                          placeholder-transparent"
                                           id="numberOfNightsSpent"
                                        placeholder="No. Of Nights Spent"
                                        v-model="detailedReports.numberOfNightsSpent"
                                        />
                                          <label for="numberOfNightsSpent"
                                        class="absolute left-0 ml-3 text-sm text-gray-500 transition-all -top-1 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3"
                                        >No. Of Nights Spent
                                        </label>
                             <div class="error" v-if="!isValidTen">Invalid input (only numerical)</div>

                                </div>
                            </div>

                            <div class="mt-2 mb-3 text-gray-500">
                                Leisure
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4">
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="holidaying"
                                            value="Holidaying"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.leisures_holidaying">
                                        <label for="holidaying" class="ml-3 text-sm text-gray-400">Holidaying</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="recreation"
                                            value="Recreation"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.leisures_recreation">
                                        <label for="recreation" class="ml-3 text-sm text-gray-400">Recreation</label>
                                    </div>
                                </div>
                                <div>
                                <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="sightseeing"
                                            value="Sightseeing"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.leisures_sightseeing">
                                        <label for="sightseeing" class="ml-3 text-sm text-gray-400">Sightseeing</label>
                                    </div>
                                </div>

                                <div>
                                <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="leisureOther"
                                            value="Others Leisure"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.leisures_others">
                                        <label for="leisureOther" class="ml-3 text-sm text-gray-400">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 mb-3 text-gray-500">
                                Non - Leisure
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-5">
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="business"
                                            value="Business"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_business">
                                        <label for="business" class="ml-3 text-sm text-gray-400">Business</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="religious"
                                            value="Religious"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_religious">
                                        <label for="religious" class="ml-3 text-sm text-gray-400">Religious</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="education"
                                            value="Education"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_education">
                                        <label for="education" class="ml-3 text-sm text-gray-400">Education</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="sports"
                                            value="Sports"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_sports">
                                        <label for="sports" class="ml-3 text-sm text-gray-400">Sports</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="health"
                                            value="Health"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_health">
                                        <label for="health" class="ml-3 text-sm text-gray-400">Health</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="shopping"
                                            value="Shopping"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_shopping">
                                        <label for="shopping" class="ml-3 text-sm text-gray-400">Shopping</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center py-2 pl-3 mb-3 mr-3 bg-white border border-gray-300 border-solid bg-clip-padding">

                                        <input id="nonLeisureOthers"
                                            value="Other Non-Leisure"
                                            type="checkbox"
                                            class="accent-teal-500"
                                            v-model="detailedReports.nonLeisures_others">
                                        <label for="nonLeisureOthers" class="ml-3 text-sm text-gray-400">Others</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="grid-flow-row ">
                        <button  v-show="detailsOfVisitorAddButton" class="mt-4 mb-5 text-green-600 hover:underline underline-offset-2" @click="addDetailsOfVisitors">+ Add New</button>
                        <button  v-show="detailsOfVisitorUpdateButton" class="mt-4 mb-5 ml-5 text-orange-400 hover:underline underline-offset-2" @click="updateDetailsOfVisitors">+ Update</button>
                    </div>
                    <div>
                        <div>
                        <!-- HEAD -->
                            <div class="grid invisible px-4 py-2 text-xs font-semibold md:visible md:grid-cols-6 bg-emerald-50">
                                <div>Category</div>
                                <div>Residence</div>
                                <div>Guest</div>
                                <div>Nights Spent</div>
                                <div class="text-center">Actions</div>
                            </div>
                            <div class="">

                            </div>

                        </div>
                        <!-- BODY -->
                        <div v-for="(report, counter) in detailedReports" :key="counter">

                            <div class="grid px-4 py-2 text-xs bg-gray-200 md:grid-cols-6">
                                <div><span class="visible md:hidden">Category: </span>{{ report.category }}</div>
                                <div><span class="visible md:hidden">Residence: </span>{{ report.residence }}</div>
                                <div><span class="visible md:hidden">Guest: </span>{{ report.numberOfGuest }}</div>
                                <div><span class="visible md:hidden">Night Spent: </span>{{ report.numberOfNightsSpent }}</div>
                                <div>
                                    <div class="grid grid-cols-3 gap-0.5">

                                        <div>
                                            <a @click="reportEditClick(counter)" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs>  <clipPath id="iyr83lowxa">  <path data-name="Rectangle 1853" transform="translate(1190 263)" style="stroke:#707070;fill:#4a4a4a" d="M0 0h16v16H0z"/> </clipPath></defs> <g data-name="Group 277"><path data-name="Rectangle 1854" style="fill:none" d="M0 0h24v24H0z"/>  <g data-name="Mask Group 192" transform="translate(-1186 -259)" style="clip-path:url(#iyr83lowxa)">  <path data-name="Path 690" d="M15.823 3.355A3.145 3.145 0 0 0 14.39 1.4 3.265 3.265 0 0 0 9.9 2.494l-5.3 8.732-.045.082v.453l.925.562 3.237 1.959.925.553c.136-.063.218-.109.227-.109l.218-.118.018-.018 5.359-8.85a3.206 3.206 0 0 0 .359-2.385zM9.548 13.737l-3.953-2.393 5.05-8.334.018-.036a2.328 2.328 0 0 1 1.46-1.061 2.324 2.324 0 0 1 1.786.272 2.257 2.257 0 0 1 1.025 1.4 2.142 2.142 0 0 1 .018.988 2.364 2.364 0 0 1-.281.725l-.073.118z" style="fill:#4a4a4a" transform="translate(1187.767 262.08)"/> <path data-name="Path 691" d="m9.72 13.846-.172-.109-3.953-2.393-.19-.118a.593.593 0 0 0-.626-.1l-.181.1-.045.027v.508c.009.444.036 1.387.082 2.3.1 2.53.145 2.566.345 2.72l.181.136.218-.054c.19-.045 3.382-1.6 4.262-2.031.136-.063.218-.109.227-.109l.218-.118.014-.005v-.018l.009-.245c-.009-.255-.209-.382-.389-.491zm-4.1 1.931c-.054-.843-.118-2.457-.145-3.446l3.237 1.959c-.878.427-2.312 1.125-3.09 1.488z" style="fill:#4a4a4a" transform="translate(1187.767 262.08)"/> <path data-name="Rectangle 1858" transform="rotate(-58.774 834.183 -931.232)" style="fill:#4a4a4a" d="M0 0h.907v5.595H0z"/></g></g></svg>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#" @click="deleteMyDetail(counter)">
                                                <img
                                                src="/image/dustbin.png"
                                                class="object-scale-down"
                                                alt="Dust"
                                                style="width:24"
                                                />
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div v-show="mToast">
                    <div class="relative px-4 py-3 mt-5 ml-5 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        <strong class="font-bold">Error in Date!</strong>
                        <span class="block sm:inline">Fill the Facility Name and the Date</span>
                        <span v-on:click="toastCloseClick" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="w-6 h-6 text-red-500 fill-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                </div>
            <div class="mt-5 ml-2 ">
                <div class="">
                    <router-link to="#" @click="createReport()" style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full ">
                    <!-- <router-link :to="{name:'reportSubmit',params:{id:eg}}" style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full "> -->
                        Proceed
                    </router-link>

                </div>


            </div>

        </div>

        <!-- 1/3 OF THE PAGE -->
        <div class="basis-1/3">
            <div class="flex flex-col mr-4">
                <!-- TOP PART -->
                 <div class="p-8 bg-white">
                    <div class="mb-8 text-3xl font-semibold text-black">
                        Generate Report
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="grid grid-rows-2">
                            <div>
                                From
                            </div>
                            <div>
                                <input class="border border-gray-300 border-solid rounded "  type="date"    v-model="reportFrom">

                            </div>
                        </div>
                        <div class="grid grid-rows-2">
                            <div>
                                To
                            </div>
                            <div>
                                <input class="border border-gray-300 border-solid rounded "  type="date"  v-model="reportTo">
                            </div>
                        </div>

                    </div>
                    <div class="mt-5">
                            <router-link to="#" @click="generateReportClick" style="background:#24b897" class="px-4 py-3 font-bold text-white rounded-full ">
                                Generate
                            </router-link>
                    </div>




                </div>

                <!-- TOP BOTTOM -->
                <div class="p-8">
                    <div class="flex flex-col">
                        <div class="mb-8 text-3xl font-semibold text-black ">
                            Report History
                        </div>
                        <div v-show="hasLoading" class="flex items-center justify-center">
                            Loading
                            <div class="w-8 h-8 spinner-border animate-spin " role="status">
                                <span class="visually-hidden">.</span>
                            </div>
                        </div>

                        <div v-show="noRecord" class="text-stone-500">
                            No record...
                        </div>
                        <div>
                            <div v-for="(visitorData, counter) in serverVisitorData" :key="counter">

                                <div class="grid grid-cols-4 mb-3 divide-y">
                                   <div class="col-span-3 ">
                                        <div class="text-xl font-semibold text-black">
                                        {{visitorData.user.name}}, {{ getMonthAndYear(visitorData.report_month) }}
                                       </div>
                                       <div class="text-sm text-gray-800">
                                        Submitted on: {{format_date(visitorData.created_at)}}
                                       </div>
                                   </div>
                                   <div class="col-span-1 ">
                                       <a href="#" v-on:click="viewReport(visitorData.id)">View</a>
                                   </div>
                                   <hr>
                                </div>
                            </div>
                            <div class="w-full mt-10">
                              <div class="flex flex-row items-center content-center justify-center">
                                <div class="flex-col">
                                  <button v-if="previousLink != null" @click="changePage(previousLink)"
                                    class="p-2 pl-4 pr-4 text-white rounded-l-lg bg-colorx">Previous</button>
                                  <button v-else disabled class="p-2 pl-4 pr-4 text-white bg-gray-500 rounded-l-lg">Previous</button>
                                </div>
                                <div class="flex-col">
                                  <button disabled class="p-2 pl-4 pr-4 border-t border-b border-gray-500">
                                    Showing {{ fromData }} to {{ toData }} of {{ total }} records
                                  </button>
                                </div>
                                <div class="flex-col">
                                  <button v-if="nextLink != null" @click="changePage(nextLink)"
                                    class="p-2 pl-4 pr-4 text-white rounded-r-lg bg-colorx">Next</button>
                                  <button v-else disabled class="p-2 pl-4 pr-4 text-white bg-gray-500 rounded-r-lg">Next</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


</template>

<script>
import axios from 'axios'
import moment from 'moment';
import vSelect from 'vue-select';

import HistoryModal from './HistoryModal.vue';

export default{
  components: {
    HistoryModal,
    vSelect,
    },
    data(){
        return{

            data:{},
            body:false,
            visitorDataShow:true,
            detailsOfVisitorsShow:true,

            visitorData:{
                user_id:'',
                //lodges_id:'',

                checkedInLocal:'',
                checkedInDomestic:'',
                checkedInNri:'',
                checkedInForeign:'',
                nightSpentLocal:'',
                nightSpentDomestic:'',
                nightSpentNri:'',
                nightSpentForeign:'',
                report_month: new Date().toISOString().substr(0, 10),

            },
            totalGuest:'999',
            totalNightSpent:'',

            detailedReports:[{
                category:'',
                residence:'',
                numberOfGuest:'',
                numberOfNightsSpent:'',

                leisures_holidaying:false,
                leisures_recreation:false,
                leisures_sightseeing:false,
                leisures_others:false,

                nonLeisures_business :false,
                nonLeisures_religious :false,
                nonLeisures_education :false,
                nonLeisures_sports :false,
                nonLeisures_health :false,
                nonLeisures_shopping :false,
                nonLeisures_others :false,

            }],

            detailsOfVisitorUpdateButton:false,
            detailsOfVisitorAddButton:true,
            tempDetailsOfVisitorsIndex:'',
            serverVisitorData:null,
            noRecord:true,

            reportModel:{},
            showing:true,

            modalBackground: false,
            showHistoryModal: false,
            categories:["Local","Domestic","NRI","Foreign"],
            residences:{},

            reportFrom:'',
            reportTo:'',
            user:[],
            mToast:false,
            reportName:'',
            lodgeCreated:false,
            isValidOne:true,
            isValidTwo:true,
            isValidThree:true,
            isValidFour:true,
            isValidFive:[],
            isValidSix:true,
            isValidSeven:true,
            isValidEight:true,
            isValidNine:true,
            isValidTen:true,
            regex:/[0-9]/,
            hasLoading:true,
            searched: false,
            nextLink: '',
            previousLink: '',
            fromData: 0,
            toData: 0,
            total: 0,

         }
    },
    mounted() {

    },
    created() {
        this.mToast = false
        //REMOVE INDEX 0 IN DETAILEDREPORTS
        this.detailedReports.splice(0,1)
        this.user = User

        try{
        this.visitorData = JSON.parse(this.$route.params.visitorDataString)
        this.detailedReports = JSON.parse(this.$route.params.detailedReportsString)
        }catch(err){ }

        //CHECK IF LODGE IS CREATED
        if(this.user.role=="admin" || this.user.role=="hotel"){
            this.lodgeCreated=true
        }else{
            axios.get("/api/lodge-user/"+this.user.id).then((result) => {
                if(result.data.length==0)
                    this.lodgeCreated=false
                else
                    this.lodgeCreated=true
            })
        }
        // DOWNLOAD REPORT HISTORY
        // axios.get("/api/getAllReports/"+this.user.id).then((result) => {
        //     if(result.data.data.length===0)
        //         this.noRecord=true
        //     else this.noRecord=false
        //     this.serverVisitorData = result.data.data;
        //     this.hasLoading=false

        // })
        this.searched = false;
        this.changePage("/api/getAllReports/" +this.user.id)
    },


    methods: {
        changePage(url) {
          if (this.searched == true) {
            this.continueSearch(url);
          } else {
            axios.get(url)
              .then((result) => {
                if(result.data.data.length===0) this.noRecord=true
                else this.noRecord=false

                if (result.data.data == false) {
                  this.hasLoading = false
                } else {
                  this.serverVisitorData = result.data.data.data;
                  this.hasLoading = false;
                  this.nextLink = result.data.data.next_page_url;
                  this.previousLink = result.data.data.prev_page_url;
                  this.fromData = result.data.data.from;
                  this.toData = result.data.data.to;
                  this.total = result.data.data.total;
                }

                console.log(result)
              })
          }
        },
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
            this.detailedReports.push({
                category:this.detailedReports.category,
                residence:this.detailedReports.residence,
                numberOfGuest:this.detailedReports.numberOfGuest,
                numberOfNightsSpent:this.detailedReports.numberOfNightsSpent,
                leisures_holidaying:this.detailedReports.leisures_holidaying,
                leisures_recreation:this.detailedReports.leisures_recreation,
                leisures_sightseeing:this.detailedReports.leisures_sightseeing,
                leisures_others:this.detailedReports.leisures_others,

                nonLeisures_business:this.detailedReports.nonLeisures_business,
                nonLeisures_religious:this.detailedReports.nonLeisures_religious,
                nonLeisures_education:this.detailedReports.nonLeisures_education,
                nonLeisures_sports:this.detailedReports.nonLeisures_sports,
                nonLeisures_health:this.detailedReports.nonLeisures_health,
                nonLeisures_shopping:this.detailedReports.nonLeisures_shopping,
                nonLeisures_others:this.detailedReports.nonLeisures_others,

            }),

            this.detailedReports.category=""
            this.detailedReports.residence=""
            this.detailedReports.numberOfGuest=""
            this.detailedReports.numberOfNightsSpent=""

            this.detailedReports.leisures_holidaying=false
            this.detailedReports.leisures_recreation=false
            this.detailedReports.leisures_sightseeing=false
            this.detailedReports.leisures_others=false

            this.detailedReports.nonLeisures_business =false
            this.detailedReports.nonLeisures_religious =false
            this.detailedReports.nonLeisures_education =false
            this.detailedReports.nonLeisures_sports =false
            this.detailedReports.nonLeisures_health =false
            this.detailedReports.nonLeisures_shopping =false
            this.detailedReports.nonLeisures_others =false


        },

        deleteDetailsOfVisitors(counter){
            this.detailedReports.splice(counter,1);
        },

        deleteMyDetail(counter){
            this.detailedReports.splice(counter,1)

                if(counter==0){

                this.detailsOfVisitorUpdateButton=false
                this.detailsOfVisitorAddButton=true
            }
        },

        reportEditClick(counter){
            this.detailedReports.category = this.detailedReports[counter].category
            this.detailedReports.residence = this.detailedReports[counter].residence
            this.detailedReports.numberOfGuest = this.detailedReports[counter].numberOfGuest
            this.detailedReports.numberOfNightsSpent = this.detailedReports[counter].numberOfNightsSpent

            this.detailedReports.leisures_holidaying = this.detailedReports[counter].leisures_holidaying
            this.detailedReports.leisures_recreation = this.detailedReports[counter].leisures_recreation
            this.detailedReports.leisures_sightseeing = this.detailedReports[counter].leisures_sightseeing
            this.detailedReports.leisures_others = this.detailedReports[counter].leisures_others

            this.detailedReports.nonLeisures_business = this.detailedReports[counter].nonLeisures_business
            this.detailedReports.nonLeisures_religious = this.detailedReports[counter].nonLeisures_religious
            this.detailedReports.nonLeisures_education = this.detailedReports[counter].nonLeisures_education
            this.detailedReports.nonLeisures_sports = this.detailedReports[counter].nonLeisures_sports
            this.detailedReports.nonLeisures_health = this.detailedReports[counter].nonLeisures_health
            this.detailedReports.nonLeisures_shopping = this.detailedReports[counter].nonLeisures_shopping
            this.detailedReports.nonLeisures_others = this.detailedReports[counter].nonLeisures_others

            this.tempDetailsOfVisitorsIndex = counter
            this.detailsOfVisitorUpdateButton=true
            this.detailsOfVisitorAddButton = false

        },

        updateDetailsOfVisitors(){
            this.detailedReports[this.tempDetailsOfVisitorsIndex].category = this.detailedReports.category
            this.detailedReports[this.tempDetailsOfVisitorsIndex].residence = this.detailedReports.residence
            this.detailedReports[this.tempDetailsOfVisitorsIndex].numberOfGuest = this.detailedReports.numberOfGuest
            this.detailedReports[this.tempDetailsOfVisitorsIndex].numberOfNightsSpent = this.detailedReports.numberOfNightsSpent

            this.detailedReports[this.tempDetailsOfVisitorsIndex].leisures_holidaying = this.detailedReports.leisures_holidaying
            this.detailedReports[this.tempDetailsOfVisitorsIndex].leisures_recreation = this.detailedReports.leisures_recreation
            this.detailedReports[this.tempDetailsOfVisitorsIndex].leisures_sightseeing = this.detailedReports.leisures_sightseeing
            this.detailedReports[this.tempDetailsOfVisitorsIndex].leisures_others = this.detailedReports.leisures_others

            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_business = this.detailedReports.nonLeisures_business
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_religious = this.detailedReports.nonLeisures_religious
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_education = this.detailedReports.nonLeisures_education
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_sports = this.detailedReports.nonLeisures_sports
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_health = this.detailedReports.nonLeisures_health
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_shopping = this.detailedReports.nonLeisures_shopping
            this.detailedReports[this.tempDetailsOfVisitorsIndex].nonLeisures_others = this.detailedReports.nonLeisures_others

            this.tempDetailsOfVisitorsIndex = null
            this.detailsOfVisitorUpdateButton=false
            this.detailsOfVisitorAddButton = true

            this.detailedReports.category=""
            this.detailedReports.residence=""
            this.detailedReports.numberOfGuest=""
            this.detailedReports.numberOfNightsSpent=""
            this.detailedReports.leisures_holidaying=false
            this.detailedReports.leisures_recreation=false
            this.detailedReports.leisures_sightseeing=false
            this.detailedReports.leisures_others=false

            this.detailedReports.nonLeisures_business =false
            this.detailedReports.nonLeisures_religious =false
            this.detailedReports.nonLeisures_education =false
            this.detailedReports.nonLeisures_sports =false
            this.detailedReports.nonLeisures_health =false
            this.detailedReports.nonLeisures_shopping =false
            this.detailedReports.nonLeisures_others =false
        },

        createReport(){
            if(this.isValidOne && this.isValidTwo && this.isValidThree && this.isValidFour
            && this.isValidFive && this.isValidSix && this.isValidSeven && this.isValidEight
            && this.isValidNine && this.isValidTen ){

                if(this.visitorData.report_month==''){
                    this.mToast = true;
                }else{
                    //visitorData.report_month
                    this.visitorData.user_id = this.user.id;

                    let visitorDataString = JSON.stringify(this.visitorData)
                    let detailedReportsString = JSON.stringify(this.detailedReports)
                    let userName = JSON.stringify(this.user.name)
                    this.$router.push({
                        name: 'reportSubmit',
                        params: {
                            visitorDataString: visitorDataString,
                            detailedReportsString:detailedReportsString,
                            userName:userName,

                        },
                    });
                }
            }
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

        changeModal(result){
            this.modalBackground = !this.modalBackground
            this.showHistoryModal = !this.showHistoryModal
        },

        //<select v-model="detailedReports.category"

        categoryChange(){
            axios.get("/api/residence/"+this.detailedReports.category).then((result) => {
                this.residences = result.data;
            })
        },

        generateReportClick(){
          axios.get("/api/report/between/"+this.reportFrom+"/"+this.reportTo)
              .then((result) => {
                if(result.data.data.length===0) this.noRecord=true
                else this.noRecord=false

                if (result.data.data == false) {
                  this.hasLoading = false
                } else {
                  this.serverVisitorData = result.data.data.data;
                  this.hasLoading = false;
                  this.nextLink = result.data.data.next_page_url;
                  this.previousLink = result.data.data.prev_page_url;
                  this.fromData = result.data.data.from;
                  this.toData = result.data.data.to;
                  this.total = result.data.data.total;
                }
              })
            // axios.get("/api/report/between/"+this.reportFrom+"/"+this.reportTo).then( (result) => {
            //     this.serverVisitorData = null
            //     this.serverVisitorData = result.data.data;
            // })
        },

        format_date(value){
            if (value) {
                return moment(String(value)).format('DD-MM-YYYY')
            }
        },

        getMonthAndYear(value){
            if (value) {
                return moment(String(value)).format('MMM, YYYY')
            }
        },

        toastCloseClick(){
            this.mToast=false
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
        changeInputFive(e){
            const number = e.target.value
            this.isValidFive = /^\d+$/.test(number)
        },
        changeInputSix(e){
            const number = e.target.value
            this.isValidSix = /^\d+$/.test(number)
        },
        changeInputSeven(e){
            const number = e.target.value
            this.isValidSeven = /^\d+$/.test(number)
        },
        changeInputEight(e){
            const number = e.target.value
            this.isValidEight = /^\d+$/.test(number)
        },
        changeInputNine(e){
            const number = e.target.value
            this.isValidNine = /^\d+$/.test(number)
        },
        changeInputTen(e){
            const number = e.target.value
            this.isValidTen = /^\d+$/.test(number)
        },
    },
 }
</script>
