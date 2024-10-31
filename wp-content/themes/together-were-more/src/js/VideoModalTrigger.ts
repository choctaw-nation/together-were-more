new ( class VideoModalTrigger {
	/**
	 * The Bootstrap Modal element
	 */
	private modalEl: HTMLElement;

	/**
	 * The triggering button element that opens the modal
	 */
	private trigger: HTMLButtonElement;

	/**
	 * Constructor
	 */
	constructor() {
		this.modalEl = document.getElementById( 'videoModal' ) as HTMLElement;

		if ( this.modalEl ) {
			this.init();
		}
	}

	/**
	 * Wires up the event listener to reset the modal on close
	 */
	public init() {
		this.modalEl.addEventListener( 'show.bs.modal', ( ev ) => {
			this.trigger = ev.relatedTarget as HTMLButtonElement;
		} );

		this.modalEl.addEventListener( 'hide.bs.modal', () => {
			this.rebootLiteVimeoComponent();
		} );
	}

	/**
	 * Reboot the lite-vimeo component when the modal is closed
	 */
	private rebootLiteVimeoComponent() {
		const modalBody = this.modalEl.querySelector(
			'.modal-body'
		) as HTMLElement;
		if ( ! modalBody ) {
			return;
		}

		modalBody.innerHTML = '';
		const liteVimeo = this.generateLiteVideoComponent();
		modalBody.appendChild( liteVimeo );
	}

	/**
	 * Generates the lite-vimeo component
	 *
	 * @returns HTMLElement the lite-vimeo component
	 */
	private generateLiteVideoComponent(): HTMLElement {
		const { videoId, customThumbnail } = this.getAttributesFromTrigger();
		const liteVimeo = document.createElement( 'lite-vimeo' );
		liteVimeo.setAttribute( 'videoid', videoId );
		liteVimeo.setAttribute( 'enableTracking', 'true' );

		if ( customThumbnail ) {
			liteVimeo.setAttribute( 'custom-thumb', customThumbnail );
			liteVimeo.setAttribute( 'unlisted', 'true' );
		}
		return liteVimeo;
	}

	/**
	 * Get the video ID and custom thumbnail from the trigger element
	 */
	private getAttributesFromTrigger() {
		const videoId = this.trigger.getAttribute( 'data-video-id' ) as string;
		const customThumbnail =
			this.trigger.getAttribute( 'data-custom-thumb' );

		return { videoId, customThumbnail };
	}
} )();
