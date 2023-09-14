<template>
  <div style="background-color: #eff7f9; padding: 10px">
    <div style="text-align: center">
      <div class="header">Glimpse Of District</div>
      <div class="sub-header">Know more about Mizoram</div>
      <img height="7" src="/separator.png" alt="separator" />
    </div>
    <el-row :gutter="20" justify="center">
      <el-col :span="10">
        <el-image style="height: 500px" src="/mizoram_map.png"></el-image>
      </el-col>
      <el-col :span="10">
        <div class="leading-image"></div>
        <div class="description">
          <div class="description-title">Aizawl</div>
          <div>
            A beautiful hill city, Aizawl, the capital of Mizoram is situated at
            about 1132 metres above sea level. Flanked on the north by the lofty
            peaks of Durtlang, the hill city is set on ridges of steep hills
            overlooking the sylvan valley of the river Tlawng in the west and of
            the river Tuirial in the east and south.
          </div>
          <div class="description-footer">— Read More</div>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<style scoped>
.leading-image {
  top: 4rem;
  left: 50rem;
  width: 500px;
  height: 400px;
  z-index: 1;
  position: absolute;
  background-image: url("https://www.hotelsinagra.com/wp-content/uploads/2020/11/a-birds-eye-view-of-the-lovely-city-of-aizawl-in-mizoram.jpg");
  background-position: center;
}
.description {
  padding-right: 20px;
  padding-bottom: 100px;
  padding-top: 100px;
  padding-left: 10rem;
  float: right;
  width: 50%;
  background: rgb(213, 244, 223);
  background: radial-gradient(
    circle,
    rgba(213, 244, 223, 1) 21%,
    rgba(255, 255, 255, 1) 48%,
    rgba(248, 242, 208, 1) 85%
  );
}

.description-title {
  font-weight: bold;
  font-size: 22px;
  margin-bottom: 20px;
}
.description-footer {
  margin-top: 20px;
}
</style>