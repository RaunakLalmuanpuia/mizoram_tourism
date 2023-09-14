<template>
  <div class="p-6 mega-menu mb-16 sm:mb-0 shadow-xl bg-charcoal-black-500">
    <div class="container mx-auto w-full flex flex-wrap">
      <ul
        v-for="(item, id) in items"
        :key="id"
        class="
          px-4
          w-full
          sm:w-1/2
          lg:w-1/4
          pb-6
          pt-6
          lg:pt-3
          hover:border-b hover:border-tourism-green
        "
      >
        <div class="flex items-center">
          <h3 class="font-bold text-xl text-white text-bold mb-2">
            {{ item.subTitle }}
          </h3>
        </div>
        <p class="text-gray-100 text-sm">
          {{ item.description }}
        </p>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "MenuItems",
  props: {
    items: Array,
  },
};
</script>

<style scoped >
.mega-menu {
  display: none;
  left: 0;
  position: absolute;
  text-align: left;
  width: 100%;
  z-index: 100;
}

/* #toggle Class Styles
  –––––––––––––––––––––––––––––––––––––––––––––––––– */

.toggleable > label:after {
  content: "\25BC";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}

.toggle-input {
  display: none;
}
.toggle-input:not(checked) ~ .mega-menu {
  display: none;
}

.toggle-input:checked ~ .mega-menu {
  display: block;
}

.toggle-input:checked + label {
  color: white;
  background: #2c5282; /*@apply bg-blue-800 */
}

.toggle-input:checked ~ label:after {
  content: "\25B2";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}
</style>