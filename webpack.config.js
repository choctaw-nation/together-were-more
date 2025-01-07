const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );

const THEME_NAME = 'together-were-more';
const THEME_DIR = `/wp-content/themes/${ THEME_NAME }`;

const appNames = [ 'home', 'single' ];

module.exports = {
	...defaultConfig,
	...{
		entry: () => {
			return {
				global: `.${ THEME_DIR }/src/index.js`,
				'vendors/bootstrap': `.${ THEME_DIR }/src/js/vendors/bootstrap.js`,
				'vendors/lite-vimeo': `.${ THEME_DIR }/src/js/vendors/lite-vimeo.js`,
				'modules/who-we-are': `.${ THEME_DIR }/src/js/WhoWeAre.ts`,
				'modules/current-feature': `.${ THEME_DIR }/src/styles/components/current-feature.scss`,
				'modules/category-swiper': `.${ THEME_DIR }/src/js/CategorySwiper.ts`,
				'modules/video-modal-trigger': `.${ THEME_DIR }/src/js/VideoModalTrigger.ts`,
				'pages/profile-swiper': `.${ THEME_DIR }/src/js/single/ProfileSwiper.ts`,
				'pages/gallery-swiper': `.${ THEME_DIR }/src/js/single/GallerySwiper.ts`,
				...addEntries( appNames, 'pages' ),
			};
		},

		output: {
			path: __dirname + `${ THEME_DIR }/dist`,
			filename: `[name].js`,
		},
		plugins: [
			...defaultConfig.plugins,
			new RemoveEmptyScriptsPlugin( {
				stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS,
			} ),
		],
	},
};

/**
 * Helper function to add entries to the entries object. It takes an array of strings in either kebab-case or snake_case and returns an object with the key as the entry name and the value as the path to the entry file.
 * @param {array} array - Array of strings
 * @param {string} type - The type of entry. Either 'pages' or 'styles'
 */
function addEntries( array, type ) {
	if ( ! Array.isArray( array ) ) {
		throw new Error( `Expecting an array, received ${ typeof array }!` );
	}
	if ( 0 >= array.length ) {
		return {};
	}
	const entries = {};
	array.forEach( ( asset ) => {
		const assetOutput = snakeToCamel( asset );
		if ( type === 'styles' ) {
			entries[
				`pages/${ assetOutput }`
			] = `.${ THEME_DIR }/src/styles/pages/${ asset }.scss`;
		} else if ( type === 'pages' ) {
			entries[
				`pages/${ assetOutput }`
			] = `.${ THEME_DIR }/src/js/${ asset }/index.ts`;
		} else {
			throw new Error(
				`Invalid type! Expected "styles" or "pages", received "${ type }"`
			);
		}
	} );
	return entries;
}

/** A simple utility class to alter strings from kebab-case or snake_case to camelCase
 *
 * @param {string} str - The string to be converted
 */
function snakeToCamel( str ) {
	return str.replace( /([-_][a-z])/g, ( group ) =>
		group.toUpperCase().replace( '-', '' ).replace( '_', '' )
	);
}
