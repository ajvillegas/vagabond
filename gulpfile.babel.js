/* eslint camelcase: "off" */

/**
 * Load Gulp configuration file.
 *
 * Customize your project in the gulp.config.js file.
 */
const config = require( './gulp.config.js' );

/**
 * Load Plugins.
 *
 * Load gulp plugins and pass semantic names to them.
 */
const gulp = require( 'gulp' ); // Gulp of-course.

// CSS related plugins.
const sass = require( 'gulp-sass' ); // Gulp plugin for Sass compilation.
const minifycss = require( 'gulp-uglifycss' ); // Minifies CSS files.
const beautify = require( 'gulp-beautify' ); // Beautifies CSS, JS and HTML files.
const autoprefixer = require( 'gulp-autoprefixer' ); // Autoprefixing magic.
const mmq = require( 'gulp-merge-media-queries' ); // Combine matching media queries into one.
const rtlcss = require( 'gulp-rtlcss' ); // Generates RTL stylesheet.

// JS related plugins.
const concat = require( 'gulp-concat' ); // Concatenates JS files.
const uglify = require( 'gulp-uglify' ); // Minifies JS files.
const babel = require( 'gulp-babel' ); // Compiles ESNext to browser compatible JS.
const eslint = require( 'gulp-eslint' ); // Lints and fixes JS code using ESLint.

// Image related plugins.
const imagemin = require( 'gulp-imagemin' ); // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Utility related plugins.
const rename = require( 'gulp-rename' ); // Renames files e.g. style.css -> style.min.css.
const lineec = require( 'gulp-line-ending-corrector' ); // Consistent Line Endings for non UNIX systems.
const filter = require( 'gulp-filter' ); // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require( 'gulp-sourcemaps' ); // Maps code in a compressed file back to it’s original position in a source file.
const notify = require( 'gulp-notify' ); // Sends message notification to you.
const browserSync = require( 'browser-sync' ).create(); // Reloads browser and injects CSS.
const wpPot = require( 'gulp-wp-pot' ); // For generating the .pot translation file.
const sort = require( 'gulp-sort' ); // Recommended to prevent unnecessary changes in pot-file.
const cache = require( 'gulp-cache' ); // Cache files in stream for later use.
const remember = require( 'gulp-remember' ); //  Adds all the files it has ever seen back into the stream.
const plumber = require( 'gulp-plumber' ); // Prevent pipe breaking caused by errors from gulp plugins.
const beep = require( 'beepbeep' ); // Makes a console beep sound.
const removeEmptyLines = require( 'gulp-remove-empty-lines' ); // Removes empty lines from files.
const gulpIf = require( 'gulp-if' ); // Runs gulp stream conditionally.
const strip = require( 'gulp-strip-comments' ); // Removes comments from files.
const args = require( 'yargs' ).argv; // Parse CLI arguments.

/**
 * Define conditional variables.
 *
 * Parse CLI arguments to use with the stylesDIST task.
 */
const stylesheet = 'rtl' === args.stylesheet ? './style-rtl.css' : './style.css'; // Main stylesheet source.
const isCompact = 'compact' === args.output; // Stylesheet output.

/**
 * Custom Error Handler.
 *
 * @param Mixed err
 */
const errorHandler = r => {
	notify.onError( '\n\n❌  ===> ERROR: <%= error.message %>\n' )( r );
	beep();
};

/**
 * Task: `browser-sync`.
 *
 * Live reloads, CSS injections and localhost tunneling.
 *
 * @param {Mixed} done Done.
 * @link http://www.browsersync.io/docs/options/
 */
const browsersync = done => {
	browserSync.init({
		proxy: config.projectURL,
		https: {
			key: config.sslKey,
			cert: config.sslCert
		},
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = done => {
	browserSync.reload();
	done();
};

/**
 * Task: `bootstrapCSS`.
 *
 * Compiles Bootstrap SASS and autoprefixes CSS.
 *
 * This task does the following:
 *  1. Gets the source Bootstrap SCSS file
 *  2. Compiles SASS to CSS
 *  3. Autoprefixes it
 *  4. Writes Sourcemaps for it
 *  5. Generates bootstrap.css
 *  6. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'bootstrapCSS', () => {
	return gulp
		.src( config.bootstrapSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: 'compressed',
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( lineec() ) // Consistent line endings for non UNIX systems.
		.pipe( gulp.dest( config.styleAdminDest ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads bootstrap.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> BOOTSTRAP CSS — completed!\n', onLast: true }) );
});

/**
 * Task: `styles`.
 *
 * Compiles SASS and autoprefixes CSS.
 *
 * This task does the following:
 *  1. Gets the source SCSS file
 *  2. Compiles SASS to CSS
 *  3. Autoprefixes it
 *  4. Writes Sourcemaps for it
 *  5. Generates style.css
 *  6. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'styles', () => {
	return gulp
		.src( config.styleSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe( sourcemaps.init() )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( sourcemaps.write( './' ) )
		.pipe( lineec() ) // Consistent line endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES — completed!\n', onLast: true }) );
});

/**
 * Task: `stylesRTL`.
 *
 * Compiles SASS, autoprefixes it and generates an RTL stylesheet.
 *
 * This task does the following:
 *  1. Gets the source SCSS file
 *  2. Compiles SASS to CSS
 *  4. Autoprefixes it
 *  5. Writes sourcemaps for it
 *  6. Renames the CSS file with suffix -rtl and generates sty-rtl.css
 *  7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'stylesRTL', () => {
	return gulp
		.src( config.styleSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe( sourcemaps.init() )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( rename({ suffix: '-rtl' }) ) // Append "-rtl" to the filename.
		.pipe( rtlcss() ) // Convert to RTL.
		.pipe( sourcemaps.write( './' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.css or style-rtl.css, if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES RTL — completed!\n', onLast: true }) );
});

/**
 * Task: `stylesDIST`.
 *
 * Merges media queries and prepares the CSS for distribution.
 *
 * This task does the following:
 *  1. Gets the source CSS file (style.css or style-rtl.css)
 *  2. Merges media queries
 *  3. Beautifies the CSS file
 *  4. Conditionally minifies the CSS file
 *  5. Conditionally removes empty lines
 *  6. Injects CSS or reloads the browser via browserSync
 *
 * Example command: `gulp stylesDIST --output compact --stylesheet rtl`.
 */
gulp.task( 'stylesDIST', () => {
	return gulp
		.src( stylesheet, { allowEmpty: true }) // Conditionally load stylesheet.
		.pipe( plumber( errorHandler ) )
		.pipe( mmq({ log: true }) ) // Merge Media Queries.
		.pipe(
			beautify.css({
				indent_with_tabs: true,
				end_with_newline: true
			})
		)
		.pipe(
			gulpIf(
				isCompact,
				minifycss({
					maxLineLen: 10,
					cuteComments: true
				})
			)
		)
		.pipe( gulpIf( isCompact, removeEmptyLines() ) ) // Remove empty lines.
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES DIST — completed!\n', onLast: true }) );
});

/**
 * Task: `stylesAdmin`.
 *
 * Compiles SASS, autoprefixes it, and minifies admin CSS.
 *
 * This task does the following:
 *  1. Gets the source SCSS file
 *  2. Compiles SASS to CSS
 *  3. Autoprefixes it
 *  4. Beautifies the CSS file and generates admin.css
 *  5. Renames the CSS file with suffix .min.css
 *  6. Minifies the CSS file and generates admin.min.css
 *  7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'stylesAdmin', () => {
	return gulp
		.src( config.styleAdmin, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe(
			beautify.css({
				indent_with_tabs: true,
				end_with_newline: true
			})
		)
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleAdminDest ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads admin.css if that is enqueued.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 0 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleAdminDest ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads admin.min.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES ADMIN — completed!\n', onLast: true }) );
});

/**
 * Task: `stylesEditor`.
 *
 * Compiles SASS, autoprefixes it, and minifies editor CSS.
 *
 * This task does the following:
 *  1. Gets the source SCSS file
 *  2. Compiles SASS to CSS
 *  3. Autoprefixes it
 *  4. Beautifies the CSS file and generates editor-style.css
 *  5. Renames the CSS file with suffix .min.css
 *  6. Minifies the CSS file and generates editor-style.min.css
 *  7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'stylesEditor', () => {
	return gulp
		.src( config.styleEditor, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe(
			beautify.css({
				indent_with_tabs: true,
				end_with_newline: true
			})
		)
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleAdminDest ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads admin.css if that is enqueued.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 0 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleAdminDest ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads admin.min.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES EDITOR — completed!\n', onLast: true }) );
});

// Helper function to check if ESLint has run the fix.
function isFixed( file ) {
	return null !== file.eslint && file.eslint.fixed;
}

/**
 * Task: `vendorsJS`.
 *
 * Concatenates, lints, fixes and uglifies vendor JS scripts.
 *
 * This task does the following:
 *  1. Gets the source folder for JS vendor files
 *  2. Concatenates all the files and generates vendor.js
 *  3. Lints and fixes the code in the vendor.js file
 *  4. Renames the JS file with suffix .min.js
 *  5. Uglifes/Minifies the JS file and generates vendor.min.js
 */
gulp.task( 'vendorsJS', () => {
	return gulp
		.src( config.jsVendorSRC, { since: gulp.lastRun( 'vendorsJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe( strip({ ignore: /.*eslint.*/g }) ) // Strip comments except ESLint configuration comments.
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsVendorSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsVendorFile + '.js' ) )
		.pipe(
			eslint({
				fix: true
			})
		)
		.pipe( eslint.format() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulpIf( isFixed, gulp.dest( config.jsVendorDestination ) ) )
		.pipe( eslint.failAfterError() )
		.pipe(
			rename({
				basename: config.jsVendorFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsVendorDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> VENDOR JS — completed!\n', onLast: true }) );
});

/**
 * Task: `bootstrapJS`.
 *
 * Concatenates, lints, fixes and uglifies Bootstrap JS scripts.
 *
 * This task does the following:
 *  1. Gets the source folder for JS Bootstrap files
 *  2. Concatenates all the files and generates bootstrap.min.js
 *  3. Uglifes/Minifies the JS file and updates bootstrap.min.js
 */
gulp.task( 'bootstrapJS', () => {
	return gulp
		.src([ './assets/js/bootstrap/util.js', './assets/js/bootstrap/collapse.js', './assets/js/bootstrap/dropdown.js' ], {
			since: gulp.lastRun( 'bootstrapJS' )
		}) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe( remember( config.jsBootstrapSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsBootstrapFile + '.min.js' ) )
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsBootstrapDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> BOOTSTRAP JS — completed!\n', onLast: true }) );
});

/**
 * Task: `customJS`.
 *
 * Concatenates, lints, fixes and uglifies custom JS scripts.
 *
 * This task does the following:
 *  1. Gets the source folder for JS custom files
 *  2. Concatenates all the files and generates custom.js
 *  3. Lints and fixes the code in the custom.js file
 *  4. Renames the JS file with suffix .min.js
 *  5. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task( 'customJS', () => {
	return gulp
		.src( config.jsCustomSRC, { since: gulp.lastRun( 'customJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe( strip({ ignore: /.*eslint.*/g }) ) // Strip comments except ESLint configuration comments.
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsCustomSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsCustomFile + '.js' ) )
		.pipe(
			eslint({
				fix: true
			})
		)
		.pipe( eslint.format() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulpIf( isFixed, gulp.dest( config.jsCustomDestination ) ) )
		.pipe( eslint.failAfterError() )
		.pipe(
			rename({
				basename: config.jsCustomFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsCustomDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> CUSTOM JS — completed!\n', onLast: true }) );
});

/**
 * Task: `images`.
 *
 * Minifies PNG, JPEG, GIF and SVG images.
 *
 * This task does the following:
 *  1. Gets the source of images raw folder
 *  2. Minifies PNG, JPEG, GIF and SVG images
 *  3. Generates and saves the optimized images
 *
 * This task will run only once, if you want to run it
 * again, do it with the command `gulp images`.
 *
 * Read the following to change these options.
 * @link https://github.com/sindresorhus/gulp-imagemin
 */
gulp.task( 'images', () => {
	return gulp
		.src( config.imgSRC )
		.pipe(
			cache(
				imagemin([
					imagemin.gifsicle({ interlaced: true }),
					imagemin.jpegtran({ progressive: true }),
					imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
					imagemin.svgo({
						plugins: [ { removeViewBox: true }, { cleanupIDs: false } ]
					})
				])
			)
		)
		.pipe( gulp.dest( config.imgDST ) )
		.pipe( notify({ message: '\n\n✅  ===> IMAGES — completed!\n', onLast: true }) );
});

/**
 * Task: `clear-images-cache`.
 *
 * Deletes the images cache. When running the next `images` task,
 * each image will be regenerated.
 */
gulp.task( 'clearCache', function( done ) {
	return cache.clearAll( done );
});

/**
 * Task: `translate`.
 *
 * WP POT translation file generator.
 *
 * This task does the following:
 *  1. Gets the source of all the PHP files
 *  2. Sorts files in stream by path or any custom sort comparator
 *  3. Applies wpPot with the variable set at the top of this file
 *  4. Generates a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task( 'translate', () => {
	return gulp
		.src( config.watchPHP )
		.pipe( sort() )
		.pipe(
			wpPot({
				domain: config.textDomain,
				package: config.packageName,
				bugReport: config.bugReport,
				lastTranslator: config.lastTranslator,
				team: config.team
			})
		)
		.pipe( gulp.dest( config.translationDestination + '/' + config.translationFile ) )
		.pipe( notify({ message: '\n\n✅  ===> TRANSLATE — completed!\n', onLast: true }) );
});

/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task(
	'default',
	gulp.parallel(
		'bootstrapCSS',
		'styles',
		'stylesAdmin',
		'stylesEditor',
		'vendorsJS',
		'bootstrapJS',
		'customJS',
		'images',
		browsersync,
		() => {
			gulp.watch( config.watchPHP, reload ); // Reload on PHP file changes.
			gulp.watch( config.watchBootstrap, gulp.parallel( 'bootstrapCSS' ) ); // Reload on Bootstrap SCSS file changes.
			gulp.watch( config.watchStyles, gulp.parallel( 'styles', 'stylesAdmin', 'stylesEditor' ) ); // Reload on SCSS file changes.
			gulp.watch( config.watchJsVendor, gulp.series( 'vendorsJS', reload ) ); // Reload on vendorsJS file changes.
			gulp.watch( config.watchJsBootstrap, gulp.series( 'bootstrapJS', reload ) ); // Reload on bootstrapJS file changes.
			gulp.watch( config.watchJsCustom, gulp.series( 'customJS', reload ) ); // Reload on customJS file changes.
			gulp.watch( config.imgSRC, gulp.series( 'images', reload ) ); // Reload on raw image file changes.
		}
	)
);
