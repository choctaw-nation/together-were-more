import Swiper from 'swiper';
import { A11y, Mousewheel, FreeMode, Pagination } from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/free-mode';
import 'swiper/scss/pagination';
import '../styles/components/single/swiper.scss';
import { bounceSwiper } from './bounceSwiper';

new Swiper( '.swiper', {
	modules: [ A11y, Mousewheel, FreeMode, Pagination ],
	slidesPerView: 1,
	direction: 'horizontal',
	spaceBetween: 0,
	autoHeight: true,
	grabCursor: true,
	loop: false,
	freeMode: {
		enabled: true,
		sticky: true,
	},
	mousewheel: {
		enabled: true,
		forceToAxis: true,
	},
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
} );

bounceSwiper( 'profile-swiper', '.swiper', 'bounce-left-small' );
