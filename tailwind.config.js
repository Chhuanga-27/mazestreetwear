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
        maze: {
          black: '#000000',
          white: '#ffffff',
          dark: '#111111',
          card: '#ffffff',
          border: '#000000',
          'border-light': '#e5e5e5',
          accent: '#000000',
          muted: '#737373',
          subtle: '#a3a3a3',
          light: '#f5f5f5'
        }
      },
      fontFamily: {
        sans: ['Didot', 'Didot Regular', 'Didot LT STD', 'Hoefler Text', 'Bodoni MT', 'Georgia', 'serif'],
        mono: ['Didot', 'Didot Regular', 'Didot LT STD', 'Georgia', 'serif'],
        serif: ['Didot', 'Didot Regular', 'Didot LT STD', 'Hoefler Text', 'Bodoni MT', 'Georgia', 'serif'],
        didot: ['Didot', 'Didot Regular', 'Didot LT STD', 'Georgia', 'serif'],
        'didot-title': ['Didot Title', 'Didot', 'Didot Regular', 'Georgia', 'serif']
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
