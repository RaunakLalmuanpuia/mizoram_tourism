<template>
  <el-carousel trigger="click" height="500px">
    <el-carousel-item v-for="(image, k) in images" :key="k">
      <el-image
        class="my-carousel"
        style="width: 100%"
        fit="contain"
        :src="image"
      ></el-image>
    </el-carousel-item>
  </el-carousel>
</template>
<script>
export default {
  props: {
    images: Array,
  },
};
</script>

<style scoped>
.my-carousel {
  clip-path: url("/curve.svg") !important;
}
</style>
