<template>
  <div class="container mt-10 px-8 ">
    <button class="mt-10 ml-5" onclick="history.back()">Go Back</button>
    <div v-if="loading" class="flex justify-center items-center">
      Loading
      <div class="spinner-border animate-spin w-8 h-8 " role="status">
        <span class="visually-hidden">.</span>
      </div>
    </div>
    <div v-else>
      <div class="mb-6 text-black text-2xl mx-2 font-semibold">{{ id }}</div>
      <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
          <div
            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <div class="container mx-auto bg-white p-4">
              <div class="text-xl">Transaction Details</div>
              <hr>
              <table class="table w-full">
                <tr>
                  <td>Date</td>
                  <td>{{ details.txnDate }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ resultInfo.resultStatus }}</td>
                </tr>
                <tr>
                  <td>Amount</td>
                  <td>{{ details.txnAmount }}</td>
                </tr>
              </table>
              <br>
              <button @click="resentConfirmation" v-if='resultInfo.resultStatus == "TXN_SUCCESS"'
                class="bg-green-600 hover:bg-green-500 p-2 pl-4 pr-4 text-sm rounded-full text-white">Resend
                Confirmation</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios';
import { allowedNodeEnvironmentFlags } from 'process';
  export default{
    data(){
      return {
        id: null,
        details: [],
        loading: false,
        resultInfo: [],
      }
    },
    mounted(){
      this.id = this.$route.params.id;
      this.checkTransaction();
    },
    methods: {
      checkTransaction(){
        this.loading = true;
        axios.get('/api/check-status?orderId=' + this.id)
        .then((res) => {
          this.loading = false;
          this.details = res.data.response.response.body;
          this.resultInfo = this.details.resultInfo;
          if (this.resultInfo.resultStatus == 'TXN_FAILURE'){
            this.updateTransactionFailure(this.id);
          }
        })
        .catch((err) => {
          this.loading = false;
          throw err;
        })
      },
      updateTransactionFailure(id){
        this.loading = true;
        axios.post('/api/update-failed-transaction', {orderId: id})
        .then((res) => {
          if(res.data == 'saved'){
            alert('Transaction failed and was moved to archive');
            this.$router.push({name: 'failedPayments'});
          }else{
            this.loading = false;
          }
        })
        .then((err) => {
          this.loading = false;
          throw err;
        })
      },
      resentConfirmation(){
        this.loading = true;
        axios.post('/api/resend-confirmation', {
          orderId: this.id,
          currency: 'INR',
          status: 'TXN_SUCCESS',
          amount: this.details.txnAmount,
          transactionId: this.details.txnId,
        })
        .then((res) => {
          if(res.data.success == "Email resend successful"){
            alert('Confirmation Mail Sent Successfully')
          }
          this.loading = false;
          this.$router.push({name: 'failedPayments'});
        })
        .catch((err) => {
          this.loading = false;
          throw err;
        })
      }
    }
  }
</script>