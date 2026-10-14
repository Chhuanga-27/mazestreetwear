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
          black: '#09090b',
          dark: '#111113',
          card: '#161619',
          border: 'rgba(255, 255, 255, 0.1)',
          'border-light': 'rgba(255, 255, 255, 0.2)',
          accent: '#ccff00', /* Streetwear acid volt accent */
          muted: '#8e8e93',
          light: '#f4f4f5'
        }
      },
      fontFamily: {
        sans: ['Space Grotesk', 'Inter', 'system-ui', '-apple-system', 'sans-serif'],
        mono: ['JetBrains Mono', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'monospace']
      },
      letterSpacing: {
        ultra: '0.25em',
        widest: '0.15em'
      },
      boxShadow: {
        'street': '0 0 25px -5px rgba(0, 0, 0, 0.7)',
        'glow': '0 0 20px -3px rgba(204, 255, 0, 0.25)',
        'glow-white': '0 0 20px -3px rgba(255, 255, 255, 0.15)'
      }
    },
  },
  plugins: [],
}
