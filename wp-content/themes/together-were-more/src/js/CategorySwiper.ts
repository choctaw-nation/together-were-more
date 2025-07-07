import '../styles/components/category-swiper.scss';
import { bounceSwiper } from './bounceSwiper';

import Swiper from 'swiper';
import { A11y, Mousewheel, FreeMode, Pagination } from 'swiper/modules';
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/free-mode';
import 'swiper/scss/pagination';

new Swiper( '#category-preview .swiper', {
	modules: [ A11y, Mousewheel, FreeMode, Pagination ],
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
		init: addPaddingToContainer,
	},
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
	a11y: {
		enabled: true,
	},
} );

/**
 * Toggles the opacity of the headline when the slider is/isn't on slide 1. Only fires on desktop sizes.
 *
 * @param {Swiper} ev - The Swiper instance
 * @returns void
 */
function makeHeadlineTextInvisible( ev: Swiper ) {
	const headlineEls = document.querySelectorAll< HTMLParagraphElement >(
		'#category-preview .col-lg-6 > p'
	);

	if ( ! headlineEls.length ) {
		return;
	}
	headlineEls.forEach( ( headline ) => {
		if ( ev.activeIndex ) {
			headline.style.opacity = '0';
		} else {
			headline.style.opacity = '1';
		}
	} );
}

function addPaddingToContainer( swiper: Swiper ) {
	const container = document.getElementById(
		'category-preview'
	) as HTMLElement;
	if ( ! container ) {
		return;
	}
	const swiperHeight = swiper.el.clientHeight;
	container.style.height = `calc(6rem + ${ swiperHeight }px)`;
}

bounceSwiper( { containerId: 'category-preview' } );
