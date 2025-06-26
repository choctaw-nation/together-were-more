import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { icon } from './icon';
import './style.scss';
import './shared-styles.ts';
import Edit from './editor/edit';
import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';

registerBlockType( metadata.name, {
	icon,
	edit: Edit,
	save: () => <div { ...useBlockProps.save() }>saved content.</div>,
} );
