/**
 * Uses the Mutation Observer API to handle the fade-up animation if/when users click on images so they don't disappear when the lightbox is closed.
 */
export default function handleLightboxClicks() {
	const main = document.querySelector( 'main' );
	const overlay = document.querySelector( '.wp-lightbox-overlay' );
	if ( ! main || ! overlay ) {
		return;
	}

	main.addEventListener( 'click', function( ev ) {
		const target = ev.target as HTMLElement;
		if ( canObserve( target ) ) {
			const targetObserver = new MutationObserver( ( _, obs ) => {
				if (
					target.classList.contains( 'fade-up-init' ) &&
					Array.from( target.classList ).some( ( cls ) =>
						/^wp-image-\d+$/.test( cls )
					) &&
					target.classList.length === 2
				) {
					target.classList.remove( 'fade-up-init' );
					obs.disconnect();
				}
			} );

			targetObserver.observe( target, {
				attributes: true,
				attributeFilter: [ 'class' ],
			} );
			const observer = new MutationObserver( ( _, obs ) => {
				if ( ! overlay.classList.contains( 'active' ) ) {
					target.classList.remove( 'fade-up-init' );
					obs.disconnect();
				}
			} );

			observer.observe( overlay, {
				attributes: true,
				attributeFilter: [ 'class' ],
			} );
		}
	} );
}

/**
 * Checks if the target exists, is an image and has a parent figure with `data-wp-interactive` attributes
 * @param target
 * @return
 */
function canObserve( target: HTMLElement ): boolean {
	const container = target.closest( 'figure' );
	const isInteractive =
		container && container.hasAttribute( 'data-wp-interactive' );
	if ( ! isInteractive ) {
		return false;
	}
	return target && 'IMG' === target.tagName && isInteractive;
}
