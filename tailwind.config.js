const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './**/*.php',
    './templates/**/*.php',
    './assets/js/**/*.js'
  ],
  theme: {
    container: {
      center: true,
      padding: '1rem'
    },
    extend: {
      colors: {
        primary: '#1d4ed8',
        secondary: '#9333ea',
        gray: '#6b7280'
      },
      fontSize: {
        sm: ['14px', '1.5'],
        base: ['16px', '1.75'],
        lg: ['20px', '1.75'],
        xl: ['24px', '1.75']
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans]
      }
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')
  ]
}
