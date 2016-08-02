module.exports = {
	js: {
		src: [
			'assets/src/js/vendors/modernizr-custom.js',
			'assets/src/js/vendors/tether.js',
			'assets/src/js/vendors/bootstrap.js',
			'assets/src/js/vendors/slick.js',
			'assets/src/js/vendors/jquery.responsiveTabs.js',
			'assets/src/js/main.js'
		],
		dest: 'assets/build/js/main.js',
	},
	fonts: {
		src: [
			'assets/src/fonts/icons/css/icons-rm.css',
			'assets/src/fonts/gotham/stylesheet.css'
		],
		dest: 'assets/src/sass/components/_fonts.scss'
	}
};
