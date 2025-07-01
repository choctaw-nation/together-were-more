const SLIDE_ATTRIBUTES = {
	align: 'center',
	className: 'swiper-slide swiper-slide__media',
	templateLock: 'all',
	lock: { move: true, remove: true },
	layout: {
		type: 'constrained',
		orientation: 'vertical',
	},
	style: {
		spacing: {
			padding: {
				top: 'var:preset|spacing|large',
				bottom: 'var:preset|spacing|large',
				left: 'var:preset|spacing|large',
				right: 'var:preset|spacing|large',
			},
			margin: {
				top: 'var:preset|spacing|none',
				bottom: 'var:preset|spacing|none',
			},
		},
	},
};

/**
 * This is the default block we'll use for our slide.
 */
const SWIPER_SLIDE = 'core/group';

/**
 * These are the default inner blocks we'll use
 * when our DEFAULT_BLOCK is inserted.
 */
const IMAGE_SLIDE = [ 'core/image', {} ];
const QUOTE_SLIDE = [
	'core/quote',
	{
		spacing: {
			padding: {
				top: 'var:preset|spacing|xl',
				bottom: 'var:preset|spacing|xl',
				left: 'var:preset|spacing|base',
				right: 'var:preset|spacing|base',
			},
		},
	},
	[
		[
			'core/paragraph',
			{
				placeholder: 'Quote text here',
				fontSize: 'h2',
				textColor: 'white',
				fontFamily: 'script',
				align: 'center',
			}, // your default attributes
		],
	],
];

const TEMPLATE = [
	[
		SWIPER_SLIDE,
		{
			...SLIDE_ATTRIBUTES,
			metadata: {
				name: 'Slide 1 (Image)',
			},
			className: 'swiper-slide swiper-slide__media',
		},
		[ IMAGE_SLIDE ],
	],
	[
		SWIPER_SLIDE,
		{
			...SLIDE_ATTRIBUTES,
			metadata: { name: 'Slide 2 (Quote)' },
			className: 'swiper-slide swiper-slide__quote',
			style: {
				spacing: {
					padding: {},
				},
				background: {
					backgroundImage: {
						url: '/wp-content/uploads/2024/10/black-bg-chevron-noise.jpg',
						id: 89,
						source: 'file',
						title: 'black-bg-chevron-noise',
					},
					backgroundSize: 'cover',
				},
			},
			backgroundColor: 'black',
			textColor: 'white',
		},
		[ QUOTE_SLIDE ],
	],
	[
		SWIPER_SLIDE,
		{
			...SLIDE_ATTRIBUTES,
			metadata: {
				name: 'Slide 3 (Video)',
			},
			layout: {
				type: 'flex',
				orientation: 'vertical',
			},
		},
		[ [ 'cno/twm-profile-swiper-video-slide' ] ],
	],
	[
		SWIPER_SLIDE,
		{
			...SLIDE_ATTRIBUTES,
			metadata: {
				name: 'Slide 4 (Image)',
			},
		},
		[ IMAGE_SLIDE ],
	],
	[
		SWIPER_SLIDE,
		{
			...SLIDE_ATTRIBUTES,
			metadata: {
				name: 'Slide 5 (Image)',
			},
		},
		[ IMAGE_SLIDE ],
	],
];

export const innerBlocksArgs = {
	allowedBlocks: [ 'core/group' ],
	defaultBlock: {
		name: SWIPER_SLIDE,
		attributes: { ...SLIDE_ATTRIBUTES, metadata: { name: 'Slide' } },
	},
	directInsert: true,
	orientation: 'horizontal',
	template: TEMPLATE,
	renderAppender: false,
	templateInsertUpdatesSelection: true,
};
