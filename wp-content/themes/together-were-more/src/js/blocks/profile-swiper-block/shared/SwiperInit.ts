import { Swiper } from 'swiper';
import {
	Autoplay,
	Pagination,
	A11y,
	FreeMode,
	Mousewheel,
} from 'swiper/modules';
import type { SwiperOptions } from 'swiper/types';

/**
 * Initialize the slider.
 *
 * @see https://swiperjs.com/swiper-api#parameters
 */
export function SwiperInit(
	container: Node,
	options: SwiperOptions | null = null
): Swiper {
	const parameters = {
		modules: [Pagination, A11y, FreeMode, Mousewheel],
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		direction: 'horizontal',
		freeMode: true,
		mousewheel: {
			enabled: true,
			forceToAxis: true,
		},
		spaceBetween: 0,
		autoHeight: false,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	} as SwiperOptions;

	return new Swiper(container as HTMLElement, {
		...parameters,
		...options,
	});
}

/**
 * Converts passed params into Swiper options.
 * @param options The options to be passed to the Swiper instance.
 * @return SwiperOptions
 */
export function mergeParams(options: { [key: string]: any }): SwiperOptions {
	const parameters = {
		modules: [Autoplay, Pagination, A11y],
		autoHeight: options?.autoHeight ?? false,
		autoplay: options?.autoplay ?? false,
		centeredSlides: options?.centeredSlides ?? false,
		grabCursor: options?.grabCursor ?? false,
		simulateTouch: options?.simulateTouch ?? true,
		spaceBetween: options?.spaceBetween ?? 0,
		loop: options?.loop ?? false,
	} as SwiperOptions;
	if (options?.navigation.enabled) {
		parameters.navigation = {
			nextEl: `.swiper-${options.navigation.uuidClass}`,
			prevEl: `.swiper-${options.navigation.uuidClass} `,
			enabled: true,
		};
	}
	if (options?.pagination) {
		parameters.pagination = {
			el: '.swiper-pagination',
			clickable: true,
			enabled: true,
			type: 'bullets',
		};
	}
	if (options?.slidesPerGroup || options?.slidesPerView) {
		parameters.breakpoints = {
			991: {},
		};
		if (options?.slidesPerView) {
			parameters.breakpoints[991].slidesPerView = options.slidesPerView;
		}
		if (options?.slidesPerGroup) {
			parameters.breakpoints[991].slidesPerGroup = options.slidesPerGroup;
		}
	}
	return parameters;
}
