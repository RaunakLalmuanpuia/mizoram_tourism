<template>
  <!-- component -->
  <div class="flex justify-center items-center mt-10 ">
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
      <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
        <p class="font-semibold text-gray-800">Report for the month of {{getMonthName(reportModel['report_month'])}}</p>
        <p class="font-semibold text-gray-800">Submitted On : {{format_date(reportModel['created_at'])}}</p>
      </div>
      <div class="flex flex-col px-6 py-5 bg-gray-50">
        <div class=" px-5 grid grid-cols-1 md:grid-cols-2">
          <div>
            <p class="mb-2 font-semibold text-gray-700">Total number of Guest Checked In</p>
            <p>Local: {{ reportModel['check_in_local'] }} </p>
            <p>Domestic: {{ reportModel['check_in_domestic'] }} </p>
            <p>NRI: {{ reportModel['check_in_nri'] }} </p>
            <p>Foreign: {{ reportModel['check_in_foreign'] }} </p>
          </div>
          <div>
            <p class="  mb-2 font-semibold text-gray-700">Total number of bed Night Spent</p>
            <p>Local: {{ reportModel['night_spent_local'] }} </p>
            <p>Domestic: {{ reportModel['night_spent_domestic'] }} </p>
            <p>NRI: {{ reportModel['night_spent_nri'] }} </p>
            <p>Foreign: {{ reportModel['night_spent_foreign'] }} </p>
          </div>
        </div>
        <hr />
        <div class="flex items-center mt-5 mb-3 space-x-4">
        </div>
        <div class="flex flex-row items-center justify-between p-5 bg-white border border-gray-200 rounded shadow-sm">
          <div>
            <div>
              <!-- HEAD -->
              <div class="mb-3 text-xl font-bold">Details of Visitor</div>
              <div class="grid invisible md:visible md:grid-cols-6 bg-emerald-50 text-xs font-semibold py-2 px-4">
                <div>Category</div>
                <div>Residence</div>
                <div>Guest</div>
                <div>Nights Spent</div>
                <div class="text-center">Leisures</div>
                <div class="text-center">Non Leisures</div>
              </div>
            </div>
            <!-- BODY -->
            <div v-for="(report, counter) in reportModel['report_details']" :key="counter">
              <div class="grid md:grid-cols-6 bg-gray-200 px-4 py-2 text-xs">
                <div><span class="visible md:hidden">Category: </span>{{ report.category }}</div>
                <div><span class="visible md:hidden">Residence: </span>{{ report.residence }}</div>
                <div><span class="visible md:hidden">Guest: </span>{{ report.number_of_guest }}</div>
                <div><span class="visible md:hidden">Night Spent: </span>{{ report.number_of_nights_spent }}</div>
                <div><span class="visible md:hidden">Leisure: </span>{{ report.leisure }}</div>
                <div><span class="visible md:hidden">Non Leisure: </span>{{ report.non_leisure }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
        <p class="font-semibold text-gray-600">{{reportModel['param1']}}</p>
        <button @click='okClick' class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
          Ok
        </button>
      </div>
    </div>
  </div>
</template>


<script>
import moment from 'moment';

  export default {
    data(){
      return{
        user:[],
        userName:'',
      }
    },
    created() {
      this.user = User

       axios.get("/api/gt-user/"+4).then((result) => {
          this.userName = result;
      });

    },
    props: [

       'reportModel',
       'reportName'
     ],

     methods:{
       okClick(){
         this.$emit('modal',false)
       },

      format_date(value){
            if (value) {
                return moment(String(value)).format('DD/MM/YYYY')
            }
      },
      getMonthName(value){
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var d = new Date(value);
        var monthName = months[d.getMonth()];
        return monthName + ' ' + d.getFullYear();
      }
     }
  }
  
</script>
