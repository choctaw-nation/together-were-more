import Swiper from 'swiper';
import { A11y, Mousewheel, HashNavigation, FreeMode } from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/hash-navigation';
import 'swiper/scss/free-mode';
import '../styles/components/single/swiper.scss';

new Swiper( '.swiper', {
	modules: [ A11y, Mousewheel, HashNavigation, FreeMode ],
	slidesPerView: 1,
	direction: 'horizontal',
	spaceBetween: 5,
	autoHeight: false,
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
} );
