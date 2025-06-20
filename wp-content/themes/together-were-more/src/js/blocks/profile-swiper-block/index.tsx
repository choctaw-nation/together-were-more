import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { icon } from './icon';
import './style.scss';
// import edit from './edit';
// import save from './save';

registerBlockType( metadata.name, {
	icon,
	edit: () => {
		return <p>Hello from the editor!</p>;
	},
	save: () => null,
} );
