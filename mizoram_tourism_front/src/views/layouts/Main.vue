<template>
  <div class="common-layout">
    <el-container>
      <navbar />
      <router-view />
      <el-footer>
        <Footer />
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import navbar from "@/views/layouts/Navbar";
import Footer from "@/views/layouts/Footer";
export default {
  components: {
    navbar,
    Footer,
  },
};
</script>

<style scoped>
.el-footer {
  padding: 0px;
}
.el-main {
  padding: unset;
}
</style>