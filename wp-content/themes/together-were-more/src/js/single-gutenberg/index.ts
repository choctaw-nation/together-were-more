import '../../styles/pages/single-gutenberg.scss';
import handleFadeAnimations from './handleFadeAnimations';
import handleLightboxClicks from './handleLightboxClicks';

document.addEventListener( 'DOMContentLoaded', () => {
	handleFadeAnimations();
	handleLightboxClicks();
} );
