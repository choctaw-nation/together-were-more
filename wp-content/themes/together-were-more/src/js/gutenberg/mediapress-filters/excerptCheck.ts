import { select } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';
import { ChecklistItem } from './types';

/**
 * Checks if the excerpt is valid
 */
export default function excerptCheck( item: ChecklistItem ): ChecklistItem {
	if ( item.name !== 'excerpt_is_valid' ) {
		return item;
	}
	const excerpt = select( editorStore ).getEditedPostAttribute( 'excerpt' );
	if ( ! excerpt || excerpt.length === 0 ) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Please provide a valid excerpt for the post.',
		};
	}
	if ( excerpt.length > 160 ) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Excerpt must be 160 characters or less.',
		};
	}
	if ( excerpt.length < 120 ) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Excerpt must be at least 120 characters.',
		};
	}

	return {
		...item,
		status: 'COMPLETED',
		message: 'A valid excerpt is provided.',
	};
}
