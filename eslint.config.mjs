import eslint from '@eslint/js';
import wordpressPlugin from '@wordpress/eslint-plugin';
import { fixupConfigRules, includeIgnoreFile } from '@eslint/compat';
import prettierConfig from 'eslint-config-prettier';
import { globalIgnores, defineConfig } from 'eslint/config';
import { FlatCompat } from '@eslint/eslintrc';
import path from 'path';
import { fileURLToPath, URL } from 'url';

const gitignorePath = fileURLToPath(new URL('.gitignore', import.meta.url));

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const compat = new FlatCompat({
	baseDirectory: __dirname,
});

export default defineConfig([
	globalIgnores([
		'webpack.config.js',
		'wp-content/themes/**/src/js/gutenberg/mediapress-filters/types.ts',
	]),
	includeIgnoreFile(gitignorePath, 'Ignore .gitignore files'),
	prettierConfig,
	{
		extends: [
			...fixupConfigRules(
				compat.config(wordpressPlugin.configs.recommended)
			),
		],
		languageOptions: {
			parserOptions: {
				ecmaFeatures: {
					jsx: true, // enable JSX parsing
				},
			},
		},
		settings: {
			react: {
				version: 'detect',
			},
		},
	},
]);
