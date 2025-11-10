import { Swiper } from 'swiper';
import {
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
		modules: [ Pagination, A11y, FreeMode, Mousewheel ],
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

	return new Swiper( container as HTMLElement, {
		...parameters,
		...options,
	} );
}

