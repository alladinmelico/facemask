const path = require('path')

module.exports = {
	resolve: {
		alias: {
			'@': path.resolve('resources/js')
		}
	},
	optimization: {
		concatenateModules: false,
		providedExports: false,
		usedExports: false
	}
}
