// import './view.scss';
/**
 * Shared Swiper config.
 */
import { SwiperInit } from './utilities/SwiperInit';
document.addEventListener( 'DOMContentLoaded', () => {
	const containers = document.querySelectorAll( '.swiper' );
	if ( ! containers.length ) {
		return;
	}

	// Loop through all sliders and assign Swiper object.
	containers.forEach( ( element ) => {
		try {
			SwiperInit( element, JSON.parse( element.dataset.swiper ) );
		} catch ( e ) {
			// eslint-disable-next-line no-console
			console.error( e );
			return;
		}
	} );
} );
