class FadeAnimator {
	private FADE_IN_CLASS: string;
	private FADE_UP_CLASS: string;
	private profileSwiperBlockSelector: string;

	private fadeInSelectors: string[];

	private observer: IntersectionObserver;

	constructor() {
		this.FADE_IN_CLASS = 'fade-in-init';
		this.FADE_UP_CLASS = 'fade-up-init';
		this.profileSwiperBlockSelector = `.wp-block-cno-twm-profile-swiper-block`;
		this.fadeInSelectors = [
			'.wp-block-quote > *',
			'.has-script-font-family:not(.wp-block-quote .has-script-font-family)',
			`[data-aos="fade-in"]:not(${ this.profileSwiperBlockSelector } [data-aos="fade-in"])`,
		];
	}

	private initObserver() {
		this.observer = new IntersectionObserver(
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
				threshold: 0.2, // Trigger when 20% of the element is visible
			}
		);
	}

	private addFadeIn( selector: string ) {
		document.querySelectorAll( selector ).forEach( ( element ) => {
			if ( ! element.closest( this.profileSwiperBlockSelector ) ) {
				element.classList.add( this.FADE_IN_CLASS ); // Initial state
				this.observer.observe( element );
			}
		} );
	}

	private addFadeUp( element: Element ) {
		if ( ! element.closest( this.profileSwiperBlockSelector ) ) {
			element.classList.add( this.FADE_UP_CLASS ); // Initial state
			this.observer.observe( element );
		}
	}

	handleFadeAnimations() {
		this.initObserver();
		this.fadeInSelectors.forEach( ( selector ) => {
			this.addFadeIn( selector );
		} );
		const swipeText = document.getElementById( 'swipe-text' );
		if ( swipeText ) {
			swipeText.classList.add( this.FADE_IN_CLASS );
			this.observer.observe( swipeText );
		}

		document
			.querySelectorAll( 'figure.wp-block-image img' )
			.forEach( ( img, index ) => {
				if ( 0 === index ) {
					// Skip the first image
					return;
				}
				this.addFadeUp( img );
			} );
	}
}

export default function handleFadeAnimations() {
	const fadeAnimator = new FadeAnimator();
	fadeAnimator.handleFadeAnimations();
}
