import type React from 'react';

export default function SwiperVideoSlide( {
	children,
	innerBlocksProps,
	caption,
	captionStyles,
}: {
	children: React.ReactNode;
	innerBlocksProps: any;
	caption: string;
	captionStyles?: React.CSSProperties;
} ) {
	return (
		<figure { ...innerBlocksProps }>
			{ children }
			<figcaption style={ captionStyles }>{ caption }</figcaption>
		</figure>
	);
}
