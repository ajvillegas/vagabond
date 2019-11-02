/**
 * Gulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 */

module.exports = {

	// Project options.
	projectURL: 'https://dev.pcc.com/cas211w/vagabondwp/', // Local project URL of your already running site.
	sslKey: '/Applications/MAMP/Library/OpenSSL/certs/dev.pcc.com.key', // Path to SSL localhost.key
	sslCert: '/Applications/MAMP/Library/OpenSSL/certs/dev.pcc.com.crt', // Path to SSL localhost.crt
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: './assets/css/scss/style.scss', // Path to main .scss file.
	bootstrapSRC: './assets/css/scss/bootstrap.scss', // Path to bootstrap.scss file.
	styleDestination: './', // Path to place the compiled CSS file. Default set to root folder.
	outputStyle: 'compact', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'.
	errLogToConsole: true,
	precision: 10,

	// Admin styles options.
	styleAdmin: './assets/css/scss/admin.scss', // Path to admin .scss file.
	styleAdminDest: './assets/css/', // Path to place the compiled CSS file.

	// Editor styles options.
	styleEditor: './assets/css/scss/editor-style.scss', // Path to editor styles .scss file.

	// JS Vendor options.
	jsVendorSRC: './assets/js/vendor/*.js', // Path to JS vendor folder.
	jsVendorDestination: './assets/js/', // Path to place the compiled JS vendors file.
	jsVendorFile: 'vendor', // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

	// JS Bootstrap options.
	jsBootstrapSRC: './assets/js/bootstrap/*.js', // Path to JS Bootstrap scripts folder.
	jsBootstrapDestination: './assets/js/', // Path to place the compiled JS Bootstrap scripts file.
	jsBootstrapFile: 'bootstrap', // Compiled JS custom file name.

	// JS Custom options.
	jsCustomSRC: './assets/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: './assets/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: 'custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: './assets/images/raw/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: './assets/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Watch files paths.
	watchBootstrap: './assets/css/scss/bootstrap.scss', // Path to custom Bootstrap scss file.
	watchStyles: './assets/css/scss/**/*.scss', // Path to all *.scss files inside scss folder and inside them.
	watchJsVendor: './assets/js/vendor/*.js', // Path to all vendor JS files.
	watchJsBootstrap: './assets/js/bootstrap/*.js', // Path to all Bootstrap JS files.
	watchJsCustom: './assets/js/custom/*.js', // Path to all custom JS files.
	watchPHP: './**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: 'vagabond', // Your textdomain here.
	translationFile: 'vagabond.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'Vagabond', // Package name.
	bugReport: 'https://www.alexisvillegas.com/contact/', // Where can users report bugs.
	lastTranslator: 'Alexis J. Villegas <alexis@ajvillegas.com>', // Last translator Email ID.
	team: 'Alexis J. Villegas <alexis@ajvillegas.com>', // Team's Email ID.

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
	BROWSERS_LIST: [
		'last 2 version',
		'> 1%',
		'ie >= 11',
		'last 1 Android versions',
		'last 1 ChromeAndroid versions',
		'last 2 Chrome versions',
		'last 2 Firefox versions',
		'last 2 Safari versions',
		'last 2 iOS versions',
		'last 2 Edge versions',
		'last 2 Opera versions'
	]
};
