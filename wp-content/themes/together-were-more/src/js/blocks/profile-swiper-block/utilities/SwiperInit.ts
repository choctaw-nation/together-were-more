import { Swiper } from 'swiper';
import { Autoplay, Navigation, Pagination, A11y } from 'swiper/modules';
import type { SwiperOptions } from 'swiper/types';

/**
 * Initialize the slider.
 *
 * @see https://swiperjs.com/swiper-api#parameters
 */
export function SwiperInit(
	container: Node,
	options: SwiperOptions = {}
): Swiper {
	const parameters = mergeParams( options );
	return new Swiper( container as HTMLElement, parameters );
}

/**
 * Converts passed params into Swiper options.
 * @param options The options to be passed to the Swiper instance.
 * @returns SwiperOptions
 */
export function mergeParams( options: {
	[ key: string ]: any;
} ): SwiperOptions {
	const parameters = {
		modules: [ Autoplay, Navigation, Pagination, A11y ],
		autoHeight: options?.autoHeight ?? false,
		autoplay: options?.autoplay ?? false,
		centeredSlides: options?.centeredSlides ?? false,
		grabCursor: options?.grabCursor ?? false,
		simulateTouch: options?.simulateTouch ?? true,
		spaceBetween: options?.spaceBetween ?? 0,
		loop: options?.loop ?? false,
	} as SwiperOptions;
	if ( options?.navigation.enabled ) {
		parameters.navigation = {
			nextEl: `.swiper-${ options.navigation.uuidClass }`,
			prevEl: `.swiper-${ options.navigation.uuidClass } `,
			enabled: true,
		};
	}
	if ( options?.pagination ) {
		parameters.pagination = {
			el: '.swiper-pagination',
			clickable: true,
			enabled: true,
			type: 'bullets',
		};
	}
	if ( options?.slidesPerGroup || options?.slidesPerView ) {
		parameters.breakpoints = {
			991: {},
		};
		if ( options?.slidesPerView ) {
			parameters.breakpoints[ 991 ].slidesPerView = options.slidesPerView;
		}
		if ( options?.slidesPerGroup ) {
			parameters.breakpoints[ 991 ].slidesPerGroup =
				options.slidesPerGroup;
		}
	}
	return parameters;
}
