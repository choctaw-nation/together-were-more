import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';

registerBlockType( metadata.name, {
	edit: ( { attributes, setAttributes } ) => {
		return <p>A video & caption slide will go here</p>;
	},
	save: () => (
		<div
			{ ...useInnerBlocksProps(
				useBlockProps.save( { className: 'profile-swiper-block' } )
			) }
		/>
	),
} );
