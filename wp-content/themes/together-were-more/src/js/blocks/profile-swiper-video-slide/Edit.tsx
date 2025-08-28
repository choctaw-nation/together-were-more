import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';
import SwiperVideoSlide from './SwiperVideoSlide';
import BlockControls from './BlockControls';

export default function Edit(props) {
	const blockProps = useBlockProps();
	const { children, ...innerBlocksProps } = useInnerBlocksProps(blockProps, {
		allowedBlocks: ['cno-lite-vimeo/cno-plugin-lite-vimeo-block'],
		defaultBlock: {
			name: 'cno-lite-vimeo/cno-plugin-lite-vimeo-block',
		},
		directInsert: true,
		orientation: 'horizontal',
		template: [['cno-lite-vimeo/cno-plugin-lite-vimeo-block']],
		renderAppender: false,
		templateInsertUpdatesSelection: true,
	});
	return (
		<>
			<BlockControls {...props} />
			<SwiperVideoSlide
				innerBlocksProps={innerBlocksProps}
				caption={props.attributes.videoCaption}
				captionStyles={props.attributes.captionStyles}
			>
				{children}
			</SwiperVideoSlide>
		</>
	);
}
