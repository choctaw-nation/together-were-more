import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';
import SwiperVideoSlide from './SwiperVideoSlide';

export default function Save({ attributes }) {
	const blockProps = useBlockProps.save();
	const { children, ...innerBlocksProps } =
		useInnerBlocksProps.save(blockProps);
	return (
		<SwiperVideoSlide
			innerBlocksProps={innerBlocksProps}
			caption={attributes.videoCaption}
			captionStyles={attributes.captionStyles}
		>
			{children}
		</SwiperVideoSlide>
	);
}
