module.exports = {
	sass: {
		files: "assets/src/sass/**/*.scss",
		tasks: ["sass","postcss"]
	},
	js: {
		files: "assets/src/js/*.js",
		tasks: ["concat:js"]
	}
};
