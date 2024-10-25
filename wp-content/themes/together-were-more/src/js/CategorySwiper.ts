import '../styles/components/category-swiper.scss';
import { bounceSwiper } from './bounceSwiper';

import Swiper from 'swiper';
import { A11y, Mousewheel, FreeMode } from 'swiper/modules';
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/free-mode';

new Swiper( '#category-preview .swiper', {
	modules: [ A11y, Mousewheel, FreeMode ],
	slidesPerView: 1,
	spaceBetween: 20,
	grabCursor: true,
	loop: false,
	autoHeight: false,
	freeMode: {
		enabled: true,
		sticky: true,
	},
	resistance: false,
	mousewheel: {
		enabled: true,
		forceToAxis: true,
	},
	on: {
		activeIndexChange: makeHeadlineTextInvisible,
	},
} );

const bootstrapBreakpoints = {
	xs: 0,
	sm: 576,
	md: 767.02,
	lg: 991.02,
	xl: 1200.02,
	xxl: 1400.02,
};

/**
 * Toggles the opacity of the headline when the slider is/isn't on slide 1. Only fires on desktop sizes.
 *
 * @param {Swiper} ev - The Swiper instance
 * @returns void
 */
function makeHeadlineTextInvisible( ev: Swiper ) {
	const headline = document.querySelector(
		'#category-preview p.display-1'
	) as HTMLParagraphElement;

	const isMobile = window.innerWidth < bootstrapBreakpoints.lg;
	if ( ! headline ) {
		return;
	}
	if ( ! isMobile && ev.activeIndex ) {
		headline.style.opacity = '0';
	} else {
		headline.style.opacity = '1';
	}
}

bounceSwiper( 'category-preview', '.swiper' );
