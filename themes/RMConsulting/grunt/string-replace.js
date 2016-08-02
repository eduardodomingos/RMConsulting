module.exports = {
	dist: {
		files: [{
			expand: false,
			src: 'assets/src/sass/components/_fonts.scss',
			dest: 'assets/src/sass/components/_fonts.scss'
		}],
		options: {
			replacements: [{
				pattern: /url\('Gotham/ig,
				replacement: 'url(\'../fonts/gotham/Gotham'
			},
			{
				pattern: /url\('..\/font\/icons-rm/ig,
				replacement: 'url(\'../fonts/icons/font/icons-rm'
			}]
		}
	}
};
