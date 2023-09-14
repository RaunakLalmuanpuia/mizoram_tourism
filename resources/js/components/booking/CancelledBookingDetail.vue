<template>
  <div class="container mt-10 px-8">
    <button class="mt-10 ml-5" onclick="history.back()">Back</button>
    <div v-if="loading">
      Loading
      <div class="spinner-border animate-spin w-8 h-8" role="status">
        <span class="visually-hidden">.</span>
      </div>
    </div>
    <div v-else>
      <div class="mb-6 text-black text-2xl mx-2 font-semibold">{{ id }}</div>
      <div class="flex flex-col mt-8">
        <div
          class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
        >
          <div
            class="
              align-middle
              inline-block
              min-w-full
              shadow
              overflow-hidden
              sm:rounded-lg
              border-b border-gray-200
            "
          >
            <div class="container mx-auto bg-white p-4">
              <div class="text-xl">Transaction Details</div>
              <hr />
              <table class="w-full">
                <tr>
                  <td>Date</td>
                  <td>{{ details.txnDate }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td v-if="refundAmount > 0">REFUNDED</td>
                  <td v-else>
                    {{ resultInfo.resultStatus }}
                  </td>
                </tr>
                <tr>
                  <td>Amount</td>
                  <td>{{ details.txnAmount }}</td>
                </tr>
              </table>
              <br />
              <!-- <button @click="initiateRefund" v-if='resultInfo.resultStatus == "TXN_SUCCESS"'
                class="bg-green-600 hover:bg-green-500 p-2 pl-4 pr-4 text-sm rounded-full text-white">Refund</button> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      id: null,
      details: [],
      loading: false,
      resultInfo: [],
      refundAmount: 0,
    };
  },
  mounted() {
    this.id = this.$route.params.id;
    this.checkTransaction();
  },
  methods: {
    checkTransaction() {
      this.loading = true;
      axios
        .get("/api/check-status?orderId=" + this.id)
        .then((res) => {
          this.details = res.data.response.response.body;
          this.resultInfo = this.details.resultInfo;
          this.loading = false;
          this.refundAmount = res.data.response.response.body.refundAmt;
          if (this.refundAmount > 0) {
            this.updatePayment("REFUNDED");
          } else {
            this.updatePayment(this.resultInfo.resultStatus);
          }
        })
        .catch((err) => {
          this.loading = false;
          throw err;
        });
    },
    updatePayment(status) {
      this.loading = true;
      axios
        .post("/api/initiate-refund", {
          orderId: this.id,
          status: status,
        })
        .then((res) => {
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          throw err;
        });
    },
  },
};
</script>