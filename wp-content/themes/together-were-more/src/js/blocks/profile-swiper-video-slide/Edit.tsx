import {
	useInnerBlocksProps,
	useBlockProps,
	RichText,
} from '@wordpress/block-editor';

export default function Edit( props ) {
	const blockProps = useBlockProps();
	const { children, ...innerBlocksProps } = useInnerBlocksProps( blockProps, {
		allowedBlocks: [ 'cno-lite-vimeo/cno-plugin-lite-vimeo-block' ],
		directInsert: true,
		orientation: 'horizontal',
		template: [ [ 'cno-lite-vimeo/cno-plugin-lite-vimeo-block' ] ],
		renderAppender: false,
		templateInsertUpdatesSelection: true,
	} );
	return (
		<>
			<figure { ...innerBlocksProps }>
				{ children }
				<RichText
					tagName="figcaption"
					value={ props.attributes.videoCaption }
					onChange={ ( newValue ) =>
						props.setAttributes( { videoCaption: newValue } )
					}
					placeholder="Add a short video caption..."
				/>
			</figure>
		</>
	);
}
