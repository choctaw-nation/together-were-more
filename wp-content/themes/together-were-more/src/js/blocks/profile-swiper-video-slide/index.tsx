import { registerBlockType } from '@wordpress/blocks';
import { useInnerBlocksProps, useBlockProps, RichText } from '@wordpress/block-editor';
import metadata from './block.json';

import './style.scss';
import Edit from './Edit';

registerBlockType( metadata.name, {
	edit: Edit,
	save: ( { attributes } ) => {
		const blockProps = useBlockProps.save();
		const { children, ...innerBlocksProps } =
		useInnerBlocksProps.save( blockProps );
		return (
			<figure { ...innerBlocksProps }>
				{ children }
				<RichText.Content
					tagName="figcaption"
					value={ attributes.videoCaption }
				/>
			</figure>

		);
	},
} );
