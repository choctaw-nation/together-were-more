/**
 * Bounces a swiper by triggering some CSS classes when it's scrolled into view
 *
 * @param containerId the ID of the container element (no #)
 * @param swiperClass the swiper element class (defaults to `.swiper`). Must include leading `.`
 * @param animationClass the animation CSS class to add
 */
export function bounceSwiper( args: {
	containerId: string;
	swiperClass?: string;
	animationClass?: 'bounce-left' | 'bounce-left-small';
} ) {
	const { containerId, swiperClass, animationClass } = {
		containerId: args.containerId,
		swiperClass: args.swiperClass || '.swiper',
		animationClass: args.animationClass || 'bounce-left',
	};
	const swiperContainer = document.getElementById( containerId );
	if ( ! swiperContainer ) {
		console.error(
			"Bounce Swiper Error: Couldn't find expected element!",
			swiperContainer
		);
		return;
	}
	const swiper = swiperContainer.querySelector< HTMLElement >( swiperClass );
	if ( ! swiper ) {
		console.error(
			"Bounce Swiper Error: Couldn't find expected elements!",
			swiper
		);
		return;
	}
	const ANIMATION_DURATION = 1000 * 0.75;
	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const className = animationClass || 'bounce-left';
					swiper.classList.add( className );
					// Remove the class after the animation to allow it to re-trigger
					setTimeout( () => {
						swiper.classList.remove( 'bounce-left' );
					}, ANIMATION_DURATION );
				}
			} );
		},
		{ threshold: 0.2 } // Adjust the threshold as needed
	);

	if ( swiper ) {
		observer.observe( swiper );
	}
}
