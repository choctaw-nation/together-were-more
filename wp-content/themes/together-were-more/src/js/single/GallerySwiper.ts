import Swiper from 'swiper';
import { A11y, Mousewheel, Pagination, Navigation } from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/pagination';
import 'swiper/scss/navigation';
import { bootstrapBreakpoints } from '../utilities';

const gallerySwiper = document.querySelector<HTMLElement>('#gallery-swiper');
if (gallerySwiper) {
	new Swiper(gallerySwiper, {
		modules: [A11y, Pagination, Navigation, Mousewheel],
		slidesPerView: 1,
		direction: 'horizontal',
		spaceBetween: 20,
		autoHeight: true,
		grabCursor: true,
		loop: false,
		rewind: true,
		mousewheel: {
			enabled: true,
			forceToAxis: true,
		},
		pagination: {
			el: '.gallery-swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.gallery-swiper-button-next',
			prevEl: '.gallery-swiper-button-prev',
		},
		breakpoints: {
			[bootstrapBreakpoints.md]: {
				slidesPerView: 2,
				slidesPerGroup: 2,
			},
			[bootstrapBreakpoints.xl]: {
				slidesPerView: 3,
				slidesPerGroup: 3,
			},
		},
	});
}
