import './view.scss';
import { SwiperInit } from './shared/SwiperInit';

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
		console.error( e );
	}
}

document.addEventListener( 'DOMContentLoaded', initSwiper, { once: true } );
