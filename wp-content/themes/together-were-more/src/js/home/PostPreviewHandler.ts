/**
 * Handles the hover effect for post previews cards.
 */
export default class PostPreviewHandler {
	private postPreviewContainer: HTMLElement | null;

	constructor(containerId: string) {
		this.postPreviewContainer = document.getElementById(containerId);
		this.initEventListeners();
	}

	private initEventListeners() {
		if (!this.postPreviewContainer) {
			return;
		}
		this.postPreviewContainer.addEventListener('mouseover', (ev) =>
			this.handleEvent(ev, 0.15)
		);
		this.postPreviewContainer.addEventListener('mouseout', (ev) =>
			this.handleEvent(ev, 0.5)
		);
	}

	private handleEvent(ev: MouseEvent | FocusEvent, opacity: number) {
		const overlay = this.selectOverlay(ev);
		if (overlay) {
			this.updateOpacity(overlay, opacity);
		}
	}

	private selectOverlay(ev: MouseEvent | FocusEvent): HTMLElement | null {
		const target = ev.target as HTMLElement;
		const postPreviewCard = target.closest(
			'.post-preview-card'
		) as HTMLElement;

		const overlay = postPreviewCard
			? (postPreviewCard.querySelector(
					'.post-preview-card__overlay'
				) as HTMLElement)
			: null;
		return overlay;
	}

	private updateOpacity(overlay: HTMLElement, opacity: number) {
		overlay.style.setProperty('--bs-bg-opacity', opacity.toString());
	}
}
