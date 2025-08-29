import './view.scss';
import { SwiperInit } from './shared/SwiperInit';
import { bounceSwiper } from '../../bounceSwiper';

function initSwiper() {
	const container = document.querySelector(
		'.wp-block-cno-twm-profile-swiper-block .swiper'
	);
	if ( ! container ) {
		return;
	}
	try {
		SwiperInit( container, {
			on: {
				slideChange: () => {
					const swipeText = document.getElementById( 'swipe-text' );
					if ( swipeText ) {
						swipeText.style.display = 'none';
					}
				},
			},
		} );
	} catch ( e ) {
		// eslint-disable-next-line no-console
		console.error( e );
	}
}

document.addEventListener(
	'DOMContentLoaded',
	() => {
		initSwiper();
		bounceSwiper( {
			containerId: 'profile-swiper',
			animationClass: 'bounce-left-small',
		} );
	},
	{ once: true }
);
