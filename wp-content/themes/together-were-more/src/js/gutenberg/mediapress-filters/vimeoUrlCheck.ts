import { ChecklistItem } from './types';
import { select } from '@wordpress/data';

const ignoredStatuses = [ 'draft', 'pending', 'future', 'private' ];

export default function vimeoUrlCheck( item: ChecklistItem ): ChecklistItem {
	if ( item.name !== 'meta_vimeo_url' ) {
		return item;
	}
	const post = select( 'core/editor' ).getCurrentPost();
	const meta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
	const { meta_vimeo_url: vimeoUrl } = meta;
	if ( ! post || ignoredStatuses.includes( post.status ) ) {
		const message = urlIsEmpty( vimeoUrl )
			? 'Vimeo URL is empty, but none is required for now'
			: 'Vimeo URL is set';
		return {
			...item,
			status: 'INFO',
			message,
		};
	}

	if ( urlIsEmpty( vimeoUrl ) ) {
		return {
			...item,
			status: 'BLOCKING',
			message: 'Vimeo URL is required.',
		};
	}
	if ( videoIsUnlisted( vimeoUrl ) ) {
		if (
			! meta.meta_vimeo_custom_thumbnail ||
			meta.meta_vimeo_custom_thumbnail.length === 0
		) {
			return {
				...item,
				status: 'BLOCKING',
				message:
					'Vimeo URL is unlisted but no custom thumbnail has been set!',
			};
		} else {
			return {
				...item,
				status: 'COMPLETED',
				message:
					'(Unlisted) Vimeo URL is set and custom thumbnail is provided',
			};
		}
	}
	return {
		...item,
		status: 'COMPLETED',
		message: 'Vimeo URL is set',
	};
}

function urlIsEmpty( url: string ) {
	return ! url || url.trim().length === 0;
}

function videoIsUnlisted( url: string ): boolean {
	const slug = url.replace( /^https:\/\/vimeo\.com\//, '' ).split( '/' );
	return slug.length === 2;
}
