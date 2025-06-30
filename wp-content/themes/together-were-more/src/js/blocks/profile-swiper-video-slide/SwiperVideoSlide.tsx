import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';

export default function SwiperVideoSlide( {
	editorView = false,
	caption,
}: {
	editorView: boolean;
	caption: string;
} ) {
	const { children, ...innerBlocksProps } = editorView
		? useInnerBlocksProps( useBlockProps(), {
				allowedBlocks: [ 'cno-lite-vimeo/cno-plugin-lite-vimeo-block' ],
				defaultBlock: {
					name: 'cno-lite-vimeo/cno-plugin-lite-vimeo-block',
				},
				directInsert: true,
				orientation: 'horizontal',
				template: [ [ 'cno-lite-vimeo/cno-plugin-lite-vimeo-block' ] ],
				renderAppender: false,
				templateInsertUpdatesSelection: true,
		  } )
		: useInnerBlocksProps.save( useBlockProps.save() );
	const captionStyles = editorView ? {} : {};
	return (
		<figure { ...innerBlocksProps }>
			{ children }
			<figcaption style={ captionStyles }>{ caption }</figcaption>
		</figure>
	);
}
