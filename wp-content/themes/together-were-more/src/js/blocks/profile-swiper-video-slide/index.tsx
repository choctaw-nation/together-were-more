import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

import './style.scss';
import Edit from './Edit';
import Save from './Save';

registerBlockType(metadata.name, {
	edit: Edit,
	save: Save,
});
