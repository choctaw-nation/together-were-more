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
		.querySelectorAll( 'figure.wp-block-image img' )
		.forEach( ( img ) => {
			img.classList.add( 'fade-up-init' ); // Initial state
			observer.observe( img );
		} );

	document
		.querySelectorAll( '.wp-block-quote > *' )
		.forEach( ( blockquote ) => {
			blockquote.classList.add( 'fade-in-init' ); // Initial state
			observer.observe( blockquote );
		} );

	document
		.querySelectorAll( '[data-aos="fade-in"]' )
		.forEach( ( element ) => {
			observer.observe( element );
		} );
} );
