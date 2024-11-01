import '../../styles/pages/single.scss';
import 'aos/dist/aos.css';
import AOS from 'aos';
import ParallaxController from './ParallaxController';

AOS.init( {
	easing: 'ease-in-out',
	offset: 20,
	duration: 550,
} );

const parallaxController = new ParallaxController();
window.addEventListener( 'resize', () => {
	parallaxController.setParallaxContainerHeights( true );
} );
