/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*.{html,php}",
    "./src/**/*.{html,php,js}",
    "./admin/**/*.{html,php}"
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#D31310',
        'secondary': '#730303',
        'background': '#F7F7F2',
        'accent': '#C4B58C'
      },
    },
  },
  plugins: [],
}

