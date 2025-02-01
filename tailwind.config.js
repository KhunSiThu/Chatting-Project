/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./src/**/*.{html,js,php}",'node_modules/preline/dist/*.js',],
  theme: {
    extend: {},
  },
  plugins: [ require('preline/plugin'),require('daisyui'),],
}