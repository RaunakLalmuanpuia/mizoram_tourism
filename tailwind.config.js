module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'colorx': '#24b897',
        'charcoal-black': '#15191e',
        'charcoal-black-500': '#19282e',
        'tourism-green': '#40cc6f',
        'light-green': '#eff7f9',
        'light-orange': '#F1E59F',
        'whitish-gray': '#aaaaaa',
        'light-gray': '#4a4a4a',
        'card-border': '#eeeeee',
        'booking-card': '#f5fdff',
        'booking-card-500': '#cdedf5',
        'weather-bg': '#CFE4FF',
        'signup-border': '#d1d1d1',
        'ilp-background': '#21252b',
        'reg-background': '#f4f9f5',
        'district-outline': '#ececec',
        'danger': '#ff7575',
        'pale-yellow': '#fefff8',
        'booking-background-solid': '#f2fcff',
        'orange': '#f86d1c',
        'footer-line': '#282D33',
      },
      fontFamily: {
        'kushan': ['Kaushan Script', 'cursive'],
      },
      backgroundImage: {
        'spot-pattern': "url('/image/box.png')",
        'booking-background': "url('/image/lodge.jpg')",
      }
    },
    screens: {
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '850px',
      // => @media (min-width: 850px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('@tailwindcss/line-clamp'),
  ],
}
