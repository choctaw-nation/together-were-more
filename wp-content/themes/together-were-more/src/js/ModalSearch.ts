type SiteSearchResult = {
	name: string;
	title: string;
	id: number;
	permalink: string;
	excerpt: string;
	category: 'artists' | 'culture' | 'inspirational' | 'competitors';
};

new ( class SiteSearchHandler {
	/**
	 * Search input element.
	 */
	private searchInput: HTMLInputElement;

	/**
	 * Search results element.
	 */
	private searchResults: HTMLUListElement;

	/**
	 * Timer for typing delay.
	 */
	private typingDelayTimerID: number;

	/**
	 * Delay for typing before search is performed.
	 */
	private typingDelay: number;

	/**
	 * Site search modal element.
	 */
	private siteSearchModal: HTMLDivElement;

	/**
	 * Primary color for the site.
	 */
	private primaryColor: string;

	constructor() {
		this.searchInput = document.getElementById(
			'search-query'
		) as HTMLInputElement;
		this.searchResults = document.getElementById(
			'modal-search-results'
		) as HTMLUListElement;

		this.siteSearchModal = document.getElementById(
			'site-search'
		) as HTMLDivElement;

		this.primaryColor = this.siteSearchModal.dataset.primaryColor!;
		this.typingDelay = 350;
		this.typingDelayTimerID = 0;
		this.siteSearchModal.addEventListener( 'shown.bs.modal', () =>
			this.setSearchFocus()
		);
		this.searchInput.addEventListener( 'input', () => this.onInput() );
	}

	/**
	 * Set focus on the search input.
	 */
	private setSearchFocus() {
		this.searchInput.focus();
	}

	/**
	 * Callback for input event on search input.
	 */
	private onInput() {
		const query = this.searchInput.value;
		if ( 0 === query.length ) {
			this.searchResults.innerHTML = '';
			return;
		}
		if ( query.length < 3 ) {
			this.searchResults.innerHTML =
				'You must type at least 3 characters.';
			return;
		}
		clearTimeout( this.typingDelayTimerID );
		this.searchResults.innerHTML = `<div class="spinner-border text-${ this.primaryColor }" role="status"><span class="sr-only">Loading...</span></div>`;
		this.typingDelayTimerID = window.setTimeout(
			() => this.performSearch(),
			this.typingDelay
		);
	}

	/**
	 * Perform search for query via WordPress Rest API.
	 */
	private async performSearch() {
		const query = this.searchInput.value;
		if ( query.length < 3 ) {
			return;
		}
		try {
			const response = await fetch(
				`${ window.cnoSiteData.rootUrl }/wp-json/cno/v1/search?s=${ query }`
			);
			const data = await response.json();
			this.displayResults( data as SiteSearchResult[] );
		} catch ( err ) {
			this.handleError( err );
		}
	}

	/**
	 * Display search results in the search results element.
	 * @param results The search results to display.
	 * @returns void
	 */
	private displayResults( results: SiteSearchResult[] ) {
		this.searchResults.innerHTML = '';
		if ( ! results || ! results.length ) {
			this.searchResults.innerHTML = '<p>No results found.</p>';
			return;
		}
		const ul = document.createElement( 'ul' );
		ul.classList.add( 'list-unstyled', 'm-0', 'p-0' );
		results.forEach( ( result, index ) => {
			if ( 2 <= index ) return;
			const li = this.createListItem( result );
			ul.appendChild( li );
		} );
		this.searchResults.appendChild( ul );
		if ( 3 <= results.length ) {
			const moreLink = document.createElement( 'a' );
			moreLink.href = `${ window.cnoSiteData.rootUrl }/?s=${ this.searchInput.value }`;
			moreLink.classList.add(
				'text-uppercase',
				'btn',
				`btn-${ this.primaryColor }`,
				'align-self-center'
			);
			moreLink.textContent = 'View all results';
			this.searchResults.appendChild( moreLink );
		}
	}

	/**
	 * Create a list item element for a search result.
	 * @param result The search result to create a list item for.
	 * @returns HTMLLIElement
	 */
	private createListItem( result: SiteSearchResult ): HTMLLIElement {
		const { name, title, id, permalink, excerpt, category } = result;
		const li = document.createElement( 'li' );
		li.id = `post-${ id }`;
		li.classList.add( 'position-relative', 'border-2', 'p-3' );
		li.innerHTML = `<h2 class="text-${ this.categoryColor(
			category
		) } mb-0 text-uppercase fs-3">${ name }</h2><p class="mb-2 text-uppercase">${ title }</p><p>${ excerpt }</p><a href="${ permalink }" class="stretched-link text-uppercase btn btn-${ this.categoryColor(
			category
		) }">Read Story</a>`;
		return li;
	}

	/**
	 * Get the color for a category.
	 * @param category The category to get the color for.
	 * @returns string
	 */
	private categoryColor( category: SiteSearchResult[ 'category' ] ): string {
		const categoryMap = {
			artists: 'gold',
			culture: 'plum',
			inspirational: 'violet',
			competitors: 'garnet',
		};
		return categoryMap[ category ];
	}

	/**
	 * Handle an error.
	 * @param error The error to handle.
	 * @returns void
	 */
	private handleError( error: any ) {
		console.error( 'Error:', error );
		this.searchResults.innerHTML = '<p>Error loading results</p>';
	}
} )();
