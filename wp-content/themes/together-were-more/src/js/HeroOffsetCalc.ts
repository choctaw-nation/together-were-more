export default class HeroOffsetCalc {
	constructor() {
		this.calculateOffset();
		window.addEventListener( 'resize', () => this.calculateOffset() );
	}

	private calculateOffset() {
		const wpAdminBar = document.getElementById( 'wpadminbar' );
		const header = document.getElementById( 'site-header' ) as HTMLElement;
		const heroOffset = wpAdminBar
			? wpAdminBar.clientHeight + header.clientHeight
			: header.clientHeight;
		const heroEls = {
			homePage: '.front-page-hero',
			single: '.profile-hero',
		};
		Object.values( heroEls ).forEach( ( heroEl ) => {
			const hero = document.querySelector<HTMLElement>( heroEl );
			if ( hero ) {
				hero.style.setProperty( '--header-height', `${ heroOffset }px` );
			}
		} );
	}
}
