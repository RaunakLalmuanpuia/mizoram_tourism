<template>
  <nav class="relative bg-charcoal-black text-white">
    <div class="container mx-auto flex justify-between">
      <ul class="flex">
        <li class="pt-4">
          <img width="150" src="/icon.png" alt="icon" />
        </li>
        <li
          v-for="(item, id) in menuItems"
          :key="id"
          class="hoverable hover:border-b-2 hover:border-tourism-green"
        >
          <a
            href="#"
            class="
              relative
              block
              py-6
              px-4
              lg:p-6
              text-sm
              lg:text-base
              font-bold
              hover:border-b-2 hover:border-tourism-green
            "
          >
            {{ item.title }}
          </a>
          <menu-items :items="item.contents" />
        </li>
      </ul>
      <ul class="flex">
        <li class="relative block py-6 lg:p-4 text-sm lg:text-base font-bold">
          <button
            class="
              button
              bg-tourism-green
              rounded-full
              text-white
              pl-6
              pr-6
              pt-1
              pb-1
            "
          >
            Login
          </button>
        </li>
        <li class="relative block py-6 lg:p-4 text-sm lg:text-base font-bold">
          <button class="button rounded-lg text-white pl-2 pr-2 pt-1 pb-1">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </button>
        </li>
        <li class="relative block py-6 lg:p-4 text-sm lg:text-base font-bold">
          <button class="button rounded-lg text-white pl-2 pr-2 pt-1 pb-1">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
              />
            </svg>
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import MenuItems from "@/components/home/MenuItems";

export default {
  components: {
    MenuItems,
  },
  data() {
    return {
      menuItems: [
        {
          title: "Place to Visit",
          contents: [
            {
              subTitle: "Aizawl",
              description: "A beautiful hill city and the capital of Mizoram",
              link: "",
            },
            {
              subTitle: "Lunglei",
              description:
                "2nd largest city of Mizoram and is also the headquarters in Southern Mizoram",
              link: "",
            },
            {
              subTitle: "Siaha",
              description: "It is located in the southern tip of Mizoram",
              link: "",
            },
            {
              subTitle: "Champhai",
              description:
                "A bustling commercial town at the Indo - Myanmar border",
              link: "",
            },
            {
              subTitle: "Kolasib",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Serchhip",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Lawngtlai",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Mamit",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Khawzawl",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Hnahthial",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
            {
              subTitle: "Saitual",
              description:
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do",
              link: "",
            },
          ],
        },
        {
          title: "Things to Do",
          contents: [
            {
              subTitle: "Adventure",
              description: "",
              link: "",
            },
            {
              subTitle: "Culture",
              description: "",
              link: "",
            },
            {
              subTitle: "Events",
              description: "",
              link: "",
            },
            {
              subTitle: "Festivals",
              description: "",
              link: "",
            },
            {
              subTitle: "Nature",
              description: "",
              link: "",
            },
            {
              subTitle: "Park",
              description: "",
              link: "",
            },
            {
              subTitle: "Treking",
              description: "",
              link: "",
            },
            {
              subTitle: "Waterfall",
              description: "",
              link: "",
            },
          ],
        },
        {
          title: "Plan your Trip",
          contents: [
            {
              subTitle: "Where to Stay",
              description: "",
              link: "",
            },
            {
              subTitle: "Transportation",
              description: "",
              link: "",
            },
            {
              subTitle: "Tour Operator",
              description: "",
              link: "",
            },
            {
              subTitle: "Souvenir Shop",
              description: "",
              link: "",
            },
            {
              subTitle: "Tour Itenerary",
              description: "",
              link: "",
            },
            {
              subTitle: "Tour Operators",
              description: "",
              link: "",
            },
            {
              subTitle: "Festivals",
              description: "",
              link: "",
            },
            {
              subTitle: "Park",
              description: "",
              link: "",
            },
          ],
        },
        {
          title: "About",
          contents: [
            {
              subTitle: "Mizoram Tourism",
              description: "",
              link: "",
            },
          ],
        },
      ],
    };
  },
};
</script>

<style scoped>
.hoverable {
  position: static;
}

.hoverable > a:after {
  content: "\25BC";
  font-size: 10px;
  padding-left: 6px;
  position: relative;
  top: -1px;
}

.hoverable:hover .mega-menu {
  display: block;
}
</style>
