<template>
  <div style="margin-bottom: 10px">
    <div style="text-align: center">
      <div class="header">Latest Update</div>
      <div class="sub-header">Don't miss out the latest updates</div>
      <img height="7" src="/separator.png" alt="separator" />
    </div>
    <el-row :gutter="20" justify="center">
      <el-col v-for="(update, id) in updates" :span="6" :key="id">
        <el-card shadow="hover" :body-style="{ padding: '0px' }">
          <img :src="update.image" alt="" height="300" />

          <div style="padding: 14px">
            <el-tag size="small" type="success" class="rounded">{{
              update.type
            }}</el-tag>
            <div class="bottom">
              <div type="text">
                {{ update.title }}
              </div>
            </div>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      updates: [
        {
          type: "Blog",
          title: "Step into the enchanting world of Vantawng Waterfall",
          image:
            "https://www.adotrip.com/public/images/areas/5e4120820f43a-Vantawng%20Falls%20Package%20Tour.jpg",
        },
        {
          type: "Events",
          title: "Chapchar kut is a festival celebrated during March...",
          image:
            "https://cdn.s3waas.gov.in/s371a3cb155f8dc89bf3d0365288219936/uploads/bfi_thumb/2019080131-olw9h54sbl51eovi8ly3tmkq9lkryj24csc8kqn35y.jpg",
        },
        {
          type: "News",
          title: "SOP for Reopening of Thenzawl Golf Resort",
          image: "https://www.northeasttoday.in/assets/resources/2020/08/0.jpg",
        },
      ],
    };
  },
};
</script>

<style scoped>
.rounded {
  border-radius: 10px !important;
}
</style>