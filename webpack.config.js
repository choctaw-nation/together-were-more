const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );

const THEME_NAME = 'together-were-more';
const THEME_DIR = `/wp-content/themes/${ THEME_NAME }`;

const blockEditor = [ 'editDefaultBlocks', 'mediapressCustomFilters' ];
const appNames = [ 'home', 'single', 'single-gutenberg' ];

module.exports = {
	...defaultConfig,
	...{
		entry: () => {
			return {
				...defaultConfig.entry(),
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
				...addEntries( blockEditor, 'admin' ),
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
 * @param {string[]} fileNames - Array of strings
 * @param {'pages'|'styles'|'admin'|'blocks'} type - The type of entry. Either 'pages' or 'styles'
 */
function addEntries( fileNames, type ) {
	if ( ! Array.isArray( fileNames ) ) {
		throw new Error(
			`Expecting an array, received ${ typeof fileNames }!`
		);
	}
	if ( 0 >= fileNames.length ) {
		return {};
	}
	const entries = {};
	const typeOutput = {
		styles: {
			outputDir: ( assetOutput ) => `pages/${ assetOutput }`,
			path: ( asset ) =>
				`.${ THEME_DIR }/src/styles/pages/${ asset }.scss`,
		},
		pages: {
			outputDir: ( assetOutput ) => `pages/${ assetOutput }`,
			path: ( asset ) => `.${ THEME_DIR }/src/js/${ asset }/index.ts`,
		},
		admin: {
			outputDir: ( assetOutput ) => `admin/${ assetOutput }`,
			path: ( asset ) => `.${ THEME_DIR }/src/js/gutenberg/${ asset }.ts`,
		},
		blocks: {
			outputDir: ( assetOutput ) => `theme-blocks/${ assetOutput }/index`,
			path: ( asset ) =>
				`.${ THEME_DIR }/src/js/blocks/${ asset }/index.tsx`,
		},
	};
	fileNames.forEach( ( fileName ) => {
		const assetOutput = snakeToCamel( fileName );
		if ( Object.hasOwn( typeOutput, type ) ) {
			const output = typeOutput[ type ];
			if ( type === 'blocks' ) {
				entries[ output.outputDir( fileName ) ] =
					output.path( fileName );
			} else {
				entries[ output.outputDir( assetOutput ) ] =
					output.path( fileName );
			}
		} else {
			throw new Error(
				`Invalid type! Expected one of ${ Object.keys(
					typeOutput
				).join( ', ' ) }, received "${ type }"`
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
