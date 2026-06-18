import { select } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';
import { ChecklistItem } from './types';

/**
 * Checks if the category is "Uncategorized"
 */
export default function categoryCheck(item: ChecklistItem): ChecklistItem {
	if (item.name !== 'category_is_valid') {
		return item;
	}
	const categories = select(editorStore).getEditedPostAttribute('categories');
	if (!categories || categories.length === 0) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Please assign a valid category to the post.',
		};
	}
	if (categories.length > 1) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Please select only one category for the post.',
		};
	}
	const uncategorized = categories.some((category: number) => category === 1);
	if (uncategorized) {
		return {
			...item,
			status: 'BLOCKING',
			message:
				'The post cannot be published with the "Uncategorized" category.',
		};
	}

	return {
		...item,
		status: 'COMPLETED',
		message: 'A valid category is selected.',
	};
}
