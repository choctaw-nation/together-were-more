type SiteSearchResult = {
	name: string;
	title: string;
	id: number;
	permalink: string;
	excerpt: string;
	category: 'artists' | 'culture' | 'inspire' | 'competitors';
	pronouns: 'her' | 'his';
};

new ( class SiteSearchHandler {
	private searchInput: HTMLInputElement;
	private searchResults: HTMLUListElement;
	private typingTimer: number;
	private typingDelay: number;

	constructor() {
		this.searchInput = document.getElementById(
			'search-query'
		) as HTMLInputElement;
		this.searchResults = document.getElementById(
			'modal-search-results'
		) as HTMLUListElement;
		this.typingDelay = 250;
		this.typingTimer = 0;
		this.init();
	}

	private init() {
		this.searchInput.addEventListener( 'input', () => this.onInput() );
	}

	private onInput() {
		clearTimeout( this.typingTimer );
		this.searchResults.innerHTML =
			'<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
		this.typingTimer = window.setTimeout(
			() => this.performSearch(),
			this.typingDelay
		);
	}

	private async performSearch() {
		const query = this.searchInput.value;
		if ( query.length < 3 ) {
			return;
		}
		try {
			const response = await fetch(
				`${ window.cnoSiteData.rootUrl }/wp-json/cno/v1/search?s=${ query }`,
				{
					headers: {
						'Content-Type': 'application/json',
					},
				}
			);
			const data = await response.json();
			this.displayResults( data as SiteSearchResult[] );
		} catch ( err ) {
			this.handleError( err );
		}
	}

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
		if ( 2 < results.length ) {
			const moreLink = document.createElement( 'a' );
			moreLink.href = `${ window.cnoSiteData.rootUrl }/?s=${ this.searchInput.value }`;
			moreLink.classList.add(
				'text-uppercase',
				'btn',
				'btn-gray',
				'align-self-center'
			);
			moreLink.textContent = 'View all results';
			this.searchResults.appendChild( moreLink );
		}
	}

	private createListItem( result: SiteSearchResult ): HTMLLIElement {
		const { name, title, id, permalink, excerpt, category } = result;

		const li = document.createElement( 'li' );
		li.id = `post-${ id }`;
		li.classList.add( 'position-relative', 'border-2', 'p-3' );
		li.innerHTML = `<h2>${ name }</h2><p>${ title }</p><p>${ excerpt }</p><a href="${ permalink }" class="stretched-link text-uppercase btn btn-outline-${ this.categoryColor(
			category
		) }">Read Story</a>`;
		return li;
	}

	private categoryColor( category: SiteSearchResult[ 'category' ] ): string {
		const categoryMap = {
			artists: 'gold',
			culture: 'plum',
			inspire: 'violet',
			competitors: 'garnet',
		};
		return categoryMap[ category ];
	}

	private handleError( error: any ) {
		console.error( 'Error:', error );
		this.searchResults.innerHTML = '<li>Error loading results</li>';
	}
} )();
