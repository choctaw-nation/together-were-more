/** @type {import('stylelint').Config} */
export default {
	extends: [ 'stylelint-config-standard-scss' ],
	rules: {
		'color-named': 'always-where-possible',
		'scss/at-function-pattern': [
			'^(-?[a-z][a-z0-9]*)(-[a-z0-9]+)*$',
			{
				message: 'Expected function name to be kebab-case',
			},
		],
		'scss/at-mixin-pattern': [
			'^(-?[a-z][a-z0-9]*)(-[a-z0-9]+)*$',
			{
				message: 'Expected mixin name to be kebab-case',
			},
		],
		'custom-property-pattern': [
			'^--(wp--[a-z]+(--[a-z0-9]+)*)|([a-z]+(-[a-z0-9]+)*)$',
			{
				message:
					'Custom properties must be kebab-case, or WordPress-style (--wp--preset--type--value)',
			},
		],
		'selector-class-pattern': [
			'^[a-z]+(?:-[a-z0-9]+)*(?:__(?:[a-z]+(?:-[a-z0-9]+)*))?(?:--(?:[a-z]+(?:-[a-z0-9]+)*))?$',
			{
				message:
					'Expected class selector to be kebab-case or BEM',
			},
		],
	},
	ignoreFiles: [
		'wp-content/themes/**/src/styles/abstracts/_bs_breakpoints.scss',
	],
	overrides: [
		{
			files: [ '**/*.scss' ],
			customSyntax: 'postcss-scss',
		},
		{
			files: [ '**/*.html', '**/*.php' ],
			customSyntax: 'postcss-html',
		},
		{
			files: [ '**/*.jsx', '**/*.tsx', '**/*.js', '**/*.ts' ],
			customSyntax: 'postcss-js',
		},
	],
};
