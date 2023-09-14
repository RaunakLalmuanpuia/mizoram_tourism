<template>
    <div class="container px-8 ">
      <button class="mt-10 ml-5 hover:text-green-600 hover:underline"  onclick="history.back()">Go Back</button>
      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Payment Details <a class="p-2 pl-4 pr-4 text-sm text-white bg-green-600 rounded-full hover:bg-green-500" :href="'/receipt?' + paymentDetails.orderId">Receipt</a></div>

        <div class="mb-5">
            <table class="text-center border ">
                <tbody class="border-b">
                    <tr class="bg-white border-b">
                        <th class="px-6 py-2 text-sm font-medium text-gray-900 border-r whitespace-nowrap">Order ID</th>
                        <td class="px-6 py-2 text-sm font-light text-gray-900 border-r whitespace-nowrap">{{paymentDetails.orderId}}</td>
                    </tr>
                    <tr class="bg-white border-b">
                        <th class="px-6 py-2 text-sm font-medium text-gray-900 border-r whitespace-nowrap">Amount</th>
                        <td class="px-6 py-2 text-sm font-light text-gray-900 border-r whitespace-nowrap">{{paymentDetails.amount}}</td>
                    </tr>
                    <tr class="bg-white border-b">
                        <th class="px-6 py-2 text-sm font-medium text-gray-900 border-r whitespace-nowrap">Payment Date</th>
                        <td class="px-6 py-2 text-sm font-light text-gray-900 border-r whitespace-nowrap">{{dateTime(paymentDetails.created_at)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      <div class="mx-2 mb-6 text-2xl font-semibold text-black">Guest List History</div>
      <div class="flex flex-col mt-8">
          <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
              <div
                  class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                  <table class="min-w-full">
                      <thead>
                          <tr>
                              <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Sl No
                              </th>
                              <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Name
                              </th>
                              <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Phone
                              </th>
                                <th
                                  class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                  Email
                              </th>

                          </tr>
                      </thead>
                      <tbody class="bg-white">
                          <tr v-for="(value,index) in data" :key="value.id">
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{index+1}}
                                  </div>
                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.first_name}}
                                  </div>

                              </td>
                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center ">
                                    {{ value.phone }}
                                  </div>
                              </td>

                              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                  <div class="flex items-center">
                                    {{value.email}}
                                  </div>

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
import moment from 'moment';

export default {
  data(){
    return{
      data:null,
      id:'',
      bookingId:'',
      paymentDetails:{},

    }
  },
  created() {
    this.id = this.$route.params.id
    this.bookingId = this.$route.params.bookingId

    axios.get("/api/guest-list/"+this.bookingId).then((result) => {
      this.data = result.data.data;
    })

    axios.get("/api/payment-details/"+this.bookingId).then((result)=>{

       if(result.data.data==null){
            this.paymentDetails.created_at ="na";
            this.paymentDetails.amount = "na";
            this.paymentDetails.orderId =result.data.orderId;
             // Push the router with 'Manual' payment method

        }else{
            this.paymentDetails = result.data.data;
            // Push the router with 'Online' payment method
        
        }
    })

  },
  methods: {
    turncate (text, length, suffix) {
          if(text==null){
            return '';
          }else{
            if (text.length > length) {
                return text.substring(0, length) + suffix;
            } else {
                return text;
            }
          }
    },
    dateTime(value) {
      return moment(value).format('DD-MM-YYYY');
    },
  }
};

</script>
