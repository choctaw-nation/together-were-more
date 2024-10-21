// Intersection Observer to detect when the slider comes into view
export function bounceSwiper(
	containerId: string,
	sliderClass: string,
	animationClass?: string
) {
	const sliderContainer = document.getElementById(
		containerId
	) as HTMLElement;
	const slider = sliderContainer.querySelector( sliderClass ) as HTMLElement;
	const ANIMATION_DURATION = 1000 * 0.75;
	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					const className = animationClass || 'bounce-left';
					slider.classList.add( className );
					// Remove the class after the animation to allow it to re-trigger
					setTimeout( () => {
						slider.classList.remove( 'bounce-left' );
					}, ANIMATION_DURATION );
				}
			} );
		},
		{ threshold: 0.2 } // Adjust the threshold as needed
	);

	if ( slider ) {
		observer.observe( slider );
	}
}
