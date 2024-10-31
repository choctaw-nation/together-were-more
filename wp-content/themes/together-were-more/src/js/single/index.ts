import '../../styles/pages/single.scss';
import 'aos/dist/aos.css';
import AOS from 'aos';
import { bootstrapBreakpoints } from '../utilities';

AOS.init( {
	easing: 'ease-in-out',
	offset: 20,
	duration: 550,
} );

document.addEventListener( 'DOMContentLoaded', function () {
	if ( window.innerWidth < bootstrapBreakpoints.lg ) {
		return;
	}
	const parallaxElements = document.querySelectorAll( '.parallax' );

	const observerOptions = {
		root: null, // Use the viewport as the root
		rootMargin: '0px',
		threshold: 0, // Trigger as soon as even one pixel is visible
	};

	const observer = new IntersectionObserver( ( entries ) => {
		entries.forEach( ( entry ) => {
			if ( entry.isIntersecting ) {
				window.addEventListener( 'scroll', handleScroll );
			}
		} );
	}, observerOptions );

	parallaxElements.forEach( ( element ) => {
		observer.observe( element );
	} );

	function handleScroll() {
		parallaxElements.forEach( ( element ) => {
			const speed = 0.5; // Adjust the speed of the parallax effect
			const rect = element.getBoundingClientRect();
			const offsetDistance = window.innerHeight - rect.bottom;
			const offset =
				offsetDistance * speed < 0 ? 0 : offsetDistance * speed;
			element.style.transform = `translateY(${ offset }px)`;
		} );
	}
} );
