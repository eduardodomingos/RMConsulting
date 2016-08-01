module.exports = {
	options: {
		processors: [
			require('autoprefixer')({browsers: 'last 5 versions'}),
			require('cssnano')() // minify the result
		]
	},
	dist: {
		src: 'assets/build/css/main.css'
	}
};
