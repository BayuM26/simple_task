/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {
      animation: {
        blob: "blob 7s infinite",
      },
      keyframes : {
        blob: {
          "0%": {
            transform: "scale(1) translate(0px,0px)"
          },
          "33%": {
            transform: "scale(1.1) translate(30px,-50px)"
          },
          "66%": {
            transform: "scale(0.9) translate(-20px,20px)"
          },
          "100%": {
            transform: "scale(1) translate(0px,0px)"
          },
        }
      }
    },
  },
  themes: ["light"],
  plugins: [
    require('@tailwindcss/typography'),
    require("daisyui"),
  ],
}

