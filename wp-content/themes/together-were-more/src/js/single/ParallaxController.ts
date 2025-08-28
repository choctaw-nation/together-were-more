import { bootstrapBreakpoints } from '../utilities';

export default class ParallaxController {
	private parallaxElements: NodeListOf<HTMLElement>;

	private observer: IntersectionObserver;

	constructor() {
		const parallaxElements =
			document.querySelectorAll<HTMLElement>('.parallax');
		if (!parallaxElements) {
			return;
		}
		this.parallaxElements = parallaxElements;
		if (window.innerWidth >= bootstrapBreakpoints.lg) {
			this.setParallaxContainerHeights();
			this.handleParallax();
		}
	}

	/**
	 * Set the height of the parallax container elements
	 *
	 * @param reInit - Whether to re-initialize the parallax effect
	 */
	setParallaxContainerHeights(reInit = false) {
		if (window.innerWidth < bootstrapBreakpoints.lg) {
			window.removeEventListener(
				'scroll',
				this.activateParallax.bind(this)
			);
			this.parallaxElements.forEach(this.resetPosition);
			return;
		}
		this.parallaxElements.forEach((element) => {
			const parent = element.closest<HTMLElement>('.parallax-container');
			const img = element.querySelector<HTMLImageElement>('img');
			if (!parent || !img) {
				return;
			}
			parent.style.setProperty(
				'--figure-height',
				`${img.offsetHeight}px`
			);
		});
		if (reInit) {
			this.handleParallax();
		}
	}

	/**
	 * Handle the parallax effect on the given elements
	 */
	private handleParallax() {
		const observerOptions = {
			root: null, // Use the viewport as the root
			rootMargin: '0px',
			threshold: 0.3, // Trigger the observer when x% of the element is visible
		};

		this.observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					window.addEventListener(
						'scroll',
						this.activateParallax.bind(this)
					);
				} else {
					window.removeEventListener(
						'scroll',
						this.activateParallax.bind(this)
					);
					this.parallaxElements.forEach(this.resetPosition);
				}
			});
		}, observerOptions);

		this.parallaxElements.forEach((element) => {
			this.observer.observe(element);
		});
	}

	/**
	 * Activate the parallax effect on the given elements
	 */
	private activateParallax() {
		if (window.innerWidth < bootstrapBreakpoints.lg) {
			return;
		}
		this.parallaxElements.forEach((element) => {
			const speed = 0.5; // Adjust the speed of the parallax effect
			const rect = element.getBoundingClientRect();
			const offsetDistance =
				window.innerHeight / 2 - (rect.top + rect.height / 2); // Calculate the distance from the center of the element to the center of the viewport
			const offset =
				offsetDistance * speed < 0 ? 0 : offsetDistance * speed;
			element.style.transform = `translateY(${offset}px)`;
		});
	}

	/**
	 * Reset the position of the given element
	 *
	 * @param element - The element to reset
	 */
	private resetPosition(element: HTMLElement) {
		element.style.transform = 'translateY(0)';
	}
}
