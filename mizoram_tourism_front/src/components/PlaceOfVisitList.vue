<template>
  <div>
    <div style="text-align: center">
      <div class="header">{{ title }}</div>
      <div class="sub-header">{{ subTitle }}</div>
      <img height="1" src="/separator.png" alt="separator" />
    </div>
    <el-row :gutter="20" justify="center">
      <el-col v-for="(interest, id) in interests" :key="id" :span="4">
        <place-of-visit
          :title="interest['title']"
          :district="interest['district']"
          :image="interest['image']"
        />
      </el-col>
    </el-row>
  </div>
</template>

<script>
import PlaceOfVisit from "../components/PlaceOfVisit";
export default {
  components: {
    PlaceOfVisit,
  },
  props: {
    title: String,
    subTitle: String,
    interests: Array,
  },
};
</script>
<style scoped>
.el-row {
  margin: unset !important;
}
</style>