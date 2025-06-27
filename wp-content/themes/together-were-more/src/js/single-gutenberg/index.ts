import '../../styles/pages/single-gutenberg.scss';
document.addEventListener( 'DOMContentLoaded', () => {
	// Animation observer
	const observer = new IntersectionObserver(
		( entries, observer ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const target = entry.target;
					target.classList.add( 'animate' );
					observer.unobserve( target ); // Remove observer after animation
				}
			} );
		},
		{
			threshold: 0.2, // Trigger when 10% of the element is visible
		}
	);

	// Observe elements
	document
		.querySelectorAll(
			'figure.wp-block-image img:not(.wp-block-cno-twm-profile-swiper-block img)'
		)
		.forEach( ( img ) => {
			// Exclude if any ancestor is .wp-block-cno-twm-profile-swiper-block
			if ( ! img.closest( '.wp-block-cno-twm-profile-swiper-block' ) ) {
				img.classList.add( 'fade-up-init' ); // Initial state
				observer.observe( img );
			}
		} );

	document
		.querySelectorAll(
			'.wp-block-quote > *:not(.wp-block-cno-twm-profile-swiper-block *)'
		)
		.forEach( ( blockquote ) => {
			if (
				! blockquote.closest( '.wp-block-cno-twm-profile-swiper-block' )
			) {
				blockquote.classList.add( 'fade-in-init' ); // Initial state
				observer.observe( blockquote );
			}
		} );

	document
		.querySelectorAll(
			'[data-aos="fade-in"]:not(.wp-block-cno-twm-profile-swiper-block [data-aos="fade-in"])'
		)
		.forEach( ( element ) => {
			if (
				! element.closest( '.wp-block-cno-twm-profile-swiper-block' )
			) {
				observer.observe( element );
			}
		} );
	const swipeText = document.getElementById( 'swipe-text' );
	if ( swipeText ) {
		swipeText.classList.add( 'fade-in-init' ); // Initial state
		observer.observe( swipeText );
	}
} );
