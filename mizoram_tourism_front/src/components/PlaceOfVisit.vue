<template>
  <el-card :body-style="{ padding: '0px' }" shadow="hover" class="my-card">
    <div class="card-title">
      <div>{{ title }}</div>
      <div>{{ district }} District</div>
    </div>
    <el-image fit="cover" style="height: 245px" :src="image"></el-image>
  </el-card>
</template>

<script>
export default {
  props: {
    image: String,
    title: String,
    district: String,
  },
};
</script>

<style scoped>
.card-title {
  z-index: 1;
  position: absolute;
  bottom: 0px;
  color: white;
  padding: 20px;
}
</style>