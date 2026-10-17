/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './templates/**/*.php',
    './woocommerce/**/*.php',
    './assets/js/**/*.js',
    './src/**/*.{html,js,php}'
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        white: '#ffffff',
        ivory: '#ffffff',
        maze: {
          black: '#000000',
          white: '#ffffff',
          ivory: '#ffffff',
          bg: '#ffffff',
          dark: '#111111',
          card: '#ffffff',
          border: '#000000',
          'border-light': '#e5e5e5',
          accent: '#000000',
          muted: '#262626',
          subtle: '#404040',
          light: '#ffffff'
        }
      },
      fontFamily: {
        sans: ['Outfit', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'sans-serif'],
        outfit: ['Outfit', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'sans-serif'],
        bebas: ['"Bebas Neue"', 'Impact', 'sans-serif'],
        display: ['"Bebas Neue"', 'Impact', 'sans-serif'],
        heading: ['"Bebas Neue"', 'Impact', 'sans-serif'],
        body: ['Outfit', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'sans-serif'],
        mono: ['Outfit', 'monospace']
      },
      letterSpacing: {
        ultra: '0.25em',
        widest: '0.15em'
      },
      boxShadow: {
        'brutal': '4px 4px 0px 0px #000000',
        'brutal-sm': '2px 2px 0px 0px #000000',
        'brutal-lg': '8px 8px 0px 0px #000000',
        'street': '0 4px 20px -2px rgba(0, 0, 0, 0.08)'
      }
    },
  },
  plugins: [],
}
