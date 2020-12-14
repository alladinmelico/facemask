const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
	purge: [
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.vue'
	],

	theme: {
		extend: {
			colors: {
				primary: '#F5DF4D',
				secondary: '#939597',
				'light-secondary': '#DCE0E3',
				'dark-secondary': '#606263',
				'light-primary': '#635A1F',
				'dark-primary': '#E3D78A'
			},
			fontFamily: {
				sans: ['Nunito', ...defaultTheme.fontFamily.sans]
			}
		}
	},

	variants: {
		opacity: ['responsive', 'hover', 'focus', 'disabled']
	},

	plugins: [require('@tailwindcss/ui')]
}
