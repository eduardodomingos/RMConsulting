module.exports = {
	js_vendors: {
		expand: true,
		flatten: true,
		src: [
			'bower_components/tether/dist/js/tether.js',
			'bower_components/bootstrap/dist/js/bootstrap.js',
			'bower_components/slick-carousel/slick/slick.js',
			'bower_components/responsive-tabs/js/jquery.responsiveTabs.js'

		],
		dest: 'assets/src/js/vendors/'
	},
	picturefill: {
		expand: true,
		flatten: true,
		src: [
			'assets/src/js/vendors/picturefill.js'
		],
		dest: 'assets/build/js/'
	},
	img: {
		expand: true,
		flatten: true,
		src: 'assets/src/img/*',
		dest: 'assets/build/img'
	},
	fonts: {
		expand: true,

		//flatten: true,
		cwd: 'assets/src/fonts',
		src: '**/*',
		dest: 'assets/build/fonts'
	}
};
