import Swiper from 'swiper';
import {
	A11y,
	Mousewheel,
	FreeMode,
	Pagination,
	Navigation,
} from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/free-mode';
import 'swiper/scss/pagination';
import 'swiper/scss/navigation';
import '../styles/components/single/swiper.scss';
import { bounceSwiper } from './bounceSwiper';
import { bootstrapBreakpoints } from './utilities';

const profileSwiper = document.querySelector< HTMLElement >(
	'#profile-swiper .swiper'
);
if ( profileSwiper ) {
	new Swiper( profileSwiper, {
		modules: [ A11y, Mousewheel, FreeMode, Pagination ],
		slidesPerView: 'auto',
		direction: 'horizontal',
		spaceBetween: 0,
		autoHeight: false,
		grabCursor: true,
		loop: false,
		freeMode: {
			enabled: true,
			sticky: false,
		},
		mousewheel: {
			enabled: true,
			forceToAxis: true,
		},
		pagination: {
			el: '.profile-swiper-pagination',
			clickable: true,
		},
	} );
	bounceSwiper( 'profile-swiper', '.swiper', 'bounce-left-small' );
}
const gallerySwiper =
	document.querySelector< HTMLElement >( '#gallery-swiper' );
if ( gallerySwiper ) {
	new Swiper( gallerySwiper, {
		modules: [ A11y, Pagination, Navigation, Mousewheel ],
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
			[ bootstrapBreakpoints[ 'md' ] ]: {
				slidesPerView: 2,
				slidesPerGroup: 2,
			},
			[ bootstrapBreakpoints[ 'lg' ] ]: {
				slidesPerView: 3,
				slidesPerGroup: 3,
			},
		},
	} );
}
