const SLIDE_ATTRIBUTES = {
	align: 'center',
	className: 'swiper-slide',
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
	{},
	[
		[
			'core/paragraph',
			{
				placeholder: 'Quote text here',
				fontSize: 'h5',
				fontFamily: 'script',
				align: 'center',
				color: 'white',
			}, // your default attributes
		],
	],
];

const TEMPLATE = [
	[
		[
			SWIPER_SLIDE,
			{
				...SLIDE_ATTRIBUTES,
				metadata: {
					name: 'Slide 1',
				},
			},
			[ IMAGE_SLIDE ],
		],
		[
			SWIPER_SLIDE,
			{
				...SLIDE_ATTRIBUTES,
				metadata: {
					name: 'Slide 2 (Quote)',
				},
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
