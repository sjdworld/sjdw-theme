'use strict';

const { src, dest, parallel } = require('gulp');
const sass = require('gulp-dart-sass');
const rename = require('gulp-rename');
const merge = require('merge-stream');
const uglify = require('gulp-uglify');

// SASS Options.
const options = {
	outputStyle: 'compressed',
	silenceDeprecations: [
		'legacy-js-api', 'import', 'global-builtin',
		'color-functions', 'abs-percent', 'if-function'
	]
};

// Theme CSS.
function styles() {
	const theme = src('./assets/scss/base-style.scss')
		.pipe(sass(options).on('error', sass.logError))
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest('./assets/dist/'));

	const editor = src('./assets/scss/editor-style.scss')
		.pipe(sass(options).on('error', sass.logError))
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest('./assets/dist/'));

	const admin = src('./assets/scss/admin-style.scss')
		.pipe(sass(options).on('error', sass.logError))
		.pipe(rename({ suffix: '.min' }))
		.pipe(dest('./assets/dist/'));

	return merge(theme, editor, admin);
}

// Theme JS.
function scripts() {
	// Main.
	const main = src('./assets/js/main.js')
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(dest('./assets/dist/'));

	return main;
}

// Vendor Styles.
function vendor_styles() {
	// Bootstrap.
	const bootstrap = src('./assets/scss/vendor/bootstrap.scss')
		.pipe(sass(options).on('error', sass.logError))
		.pipe(rename({suffix: '.min'}))
		.pipe(dest('./assets/dist/bootstrap/'));

	return bootstrap;
}

// Vendor JS.
function vendor_scripts() {
	// Bootstrap.
    const bootstrap = src('./node_modules/bootstrap/dist/js/bootstrap.min.js')
        .pipe(dest('./assets/dist/bootstrap/'));

	return bootstrap;
}

exports.css = parallel(styles, vendor_styles);
exports.js = parallel(scripts, vendor_scripts);
exports.default = parallel(styles, vendor_styles, scripts, vendor_scripts);
