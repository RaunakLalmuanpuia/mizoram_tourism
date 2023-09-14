<template>
  <div class="home">
    <!-- <custom-carousel :images="images" /> -->
    <div class="container m-auto">
      <!-- <place-of-visit-list
      :title="'Place to Visit'"
      :subTitle="'Explore Mizoram'"
      :interests="placeOfVisits"
    /> -->
      <greeting />
      <!-- <district-glimpse /> -->
      <latest-update />
      <live-the-moment />
    </div>
  </div>
</template>

<script>
// import CustomCarousel from "../components/CustomCarousel";
// import PlaceOfVisitList from "../components/PlaceOfVisitList";
import Greeting from "../components/home/Greeting";
// import DistrictGlimpse from "../components/home/DistrictGlimpse";
import LatestUpdate from "../components/home/LatestUpdate";
import LiveTheMoment from "../components/home/LiveTheMoment";

export default {
  name: "Home",
  components: {
    // CustomCarousel,
    // PlaceOfVisitList,
    Greeting,
    // DistrictGlimpse,
    LatestUpdate,
    LiveTheMoment,
  },
  data() {
    return {
      images: [
        "https://images.unsplash.com/photo-1533587851505-d119e13fa0d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
        "https://images.unsplash.com/photo-1528127269322-539801943592?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
        "https://images.unsplash.com/photo-1619943416088-88f7e2b6a887?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1514&q=80",
        "https://images.unsplash.com/photo-1623678254109-e7eb91f97bf4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1676&q=80",
      ],
      placeOfVisits: [
        {
          title: "Hangi Lunglen Tlang",
          district: "Aizawl",
          image: "https://pbs.twimg.com/media/FDKa_jnVEAEABb9.jpg",
        },
        {
          title: "Dilpui",
          district: "Serchhip",
          image: "https://pbs.twimg.com/media/FB0LAEGVcAMkboM.jpg",
        },
        {
          title: "Vantawng Falls",
          district: "Serchhip",
          image:
            "https://cdn.s3waas.gov.in/s371a3cb155f8dc89bf3d0365288219936/uploads/bfi_thumb/2018080738-olw9h1diahgx997rbc0b4cdi7xie8a27grpd69lswa.jpg",
        },
        {
          title: "Mawmrang Tlang",
          district: "Saitual",
          image:
            "https://1.bp.blogspot.com/-PJRKORBHuS4/YOsVMNdezzI/AAAAAAAA2jI/_X4tt-9iV5sH_7Zs51aR9R-DMTKfdXnAACLcBGAsYHQ/s2048/20210508_164503.jpg",
        },
        {
          title: "Champhai Paddy Field",
          district: "Champhai",
          image:
            "https://theaizawlpost.org/wp-content/uploads/2021/01/17-4.jpg",
        },
      ],
    };
  },
};
</script>

