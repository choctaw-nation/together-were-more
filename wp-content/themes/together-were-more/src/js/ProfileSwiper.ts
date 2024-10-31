import Swiper from 'swiper';
import {
	A11y,
	Mousewheel,
	HashNavigation,
	FreeMode,
	Pagination,
} from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/hash-navigation';
import 'swiper/scss/free-mode';
import 'swiper/scss/pagination';
import '../styles/components/single/swiper.scss';
import { bounceSwiper } from './bounceSwiper';

new Swiper( '.swiper', {
	modules: [ A11y, Mousewheel, HashNavigation, FreeMode, Pagination ],
	slidesPerView: 1,
	direction: 'horizontal',
	spaceBetween: 5,
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
	hashNavigation: {
		watchState: true,
	},
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
} );

bounceSwiper( 'profile-swiper', '.swiper', 'bounce-left-small' );
