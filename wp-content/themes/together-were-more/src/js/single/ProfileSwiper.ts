import Swiper from 'swiper';
import { A11y, Mousewheel, FreeMode, Pagination } from 'swiper/modules';

// Styles
import 'swiper/scss';
import 'swiper/scss/a11y';
import 'swiper/scss/mousewheel';
import 'swiper/scss/free-mode';
import 'swiper/scss/pagination';
import '../../styles/components/single/swiper.scss';

new ( class ProfileSwiperHandler {
	/**
	 * The Swiper element
	 */
	private swiperEl: HTMLElement;

	/**
	 * The Swiper instance
	 */
	private swiper: Swiper;

	constructor() {
		const swiperEl = document.querySelector<HTMLElement>(
			'#profile-swiper .swiper'
		);
		if ( ! swiperEl ) {
			return;
		}
		this.swiperEl = swiperEl;

		this.initSwiper();
		if ( this.swiper ) {
			// Create Intersection Observer
			const observer = new IntersectionObserver(
				( entries: IntersectionObserverEntry[] ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							if (
								entry.boundingClientRect.top >
								entry.rootBounds!.top
							) {
								this.bounceSwiper();
								this.toggleHeightClass();
							}
						}
					} );
				},
				{
					threshold: 0.7, // Adjust threshold as needed
				}
			);

			observer.observe( this.swiperEl );
		}
	}

	/**
	 * Initializes the Swiper
	 */
	private initSwiper() {
		this.swiper = new Swiper( this.swiperEl, {
			modules: [ A11y, Mousewheel, FreeMode, Pagination ],
			slidesPerView: 'auto',
			direction: 'horizontal',
			spaceBetween: 0,
			autoHeight: false,
			grabCursor: true,
			loop: false,
			freeMode: {
				enabled: true,
				sticky: false,
			},
			mousewheel: {
				enabled: true,
				forceToAxis: true,
			},
			pagination: {
				el: '.profile-swiper-pagination',
				clickable: true,
			},
			on: {
				init: this.toggleHeightClass.bind( this ),
			},
		} );
	}

	/**
	 * An easeInOut function for the bounce effect
	 *
	 * @param t time
	 * @return the time
	 */
	private easeInOut( progress: number ): number {
		return progress < 0.5
			? 4 * progress * progress * progress
			: 1 - ( Math.pow( ( -2 * progress ) + 2, 3 ) / 2 );
	}

	/**
	 * Bounces the swiper to preview the next slide, then resets its position
	 *
	 * @param swiper The swiper instance
	 */
	private bounceSwiper() {
		const start: number | null = null;
		requestAnimationFrame( ( time ) => this.animate( time, start ) );
	}

	/**
	 * Animates the swiper to preview the next slide
	 *
	 * @param time  The time
	 * @param start The start time
	 */
	private animate( time: number, start: number | null ) {
		const duration = 400;
		if ( ! start ) {
			start = time;
		}
		const elapsed = time - start;
		const progress = Math.min( elapsed / duration, 1 );
		const easedProgress = this.easeInOut( progress );
		const translateValue = ( this.swiper.slides[ 0 ].offsetWidth / 2 ) * -1;
		this.swiper.setTranslate( easedProgress * translateValue );

		if ( progress < 1 ) {
			requestAnimationFrame( ( t ) => this.animate( t, start ) );
		} else {
			this.swiper.slidePrev( 400 );
		}
	}

	/**
	 * Fixes a weird edge case with `lite-vimeo`, Swiper and browsers' rendering engines where the video facade doesn't render properly.
	 */
	private toggleHeightClass() {
		const mediaContainer = this.swiperEl.querySelector(
			'figure .media-container'
		);
		if ( ! mediaContainer ) {
			return;
		}
		const browser = navigator.userAgent.toLowerCase();

		const browserIsChrome = browser.includes( 'chrome' );
		if ( browserIsChrome ) {
			// Chrome fix
			mediaContainer.classList.remove( 'h-100' );
		} else {
			// Webkit & Firefox fix
			mediaContainer.classList.toggle( 'h-100' );
		}
	}
} )();
