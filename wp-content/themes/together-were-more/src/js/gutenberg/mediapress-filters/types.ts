export interface ChecklistItem {
	message: string;
	status:
		| 'COMPLETED'
		| 'BLOCKING'
		| 'ERROR'
		| 'INFO'
		| 'ERROR'
		| 'NONBLOCKING';
	action?: () => void;
	name: string;
}

export interface Source {
	name: string;
	slug: string;
	type: 'core' | 'custom';
	getResults: ( query: string, context: any ) => Promise< any >;
	supports?: {
		dateRange?: boolean;
		taxonomies?: {
			category?: boolean;
			post_tag?: boolean;
		};
	};
	context: string;
}
