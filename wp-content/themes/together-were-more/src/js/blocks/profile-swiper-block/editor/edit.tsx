import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';
import { useRefEffect } from '@wordpress/compose';
import { useSelect } from '@wordpress/data';

import { Pagination } from 'swiper/modules';

import './editor.scss';

import { innerBlocksArgs } from './constants';

import { SwiperInit } from '../shared/SwiperInit';

export default function Edit( { attributes, setAttributes } ) {
	const paginationColor = {
		'--swiper-pagination-color': `var(--wp--preset--color--${ attributes.paginationColor })`,
	} as Record< string, string >;

	const categoryName = useSelect( ( select ) => {
		const { getEntityRecords } = select( 'core' );
		const post = select( 'core/editor' ).getCurrentPost();
		if ( ! post || ! post.categories || post.categories.length === 0 )
			return null;
		const categories = getEntityRecords( 'taxonomy', 'category', {
			include: post.categories,
		} );
		return categories && categories.length > 0
			? categories[ 0 ].slug
			: null;
	}, [] );

	useEffect( () => {
		if ( ! categoryName ) {
			return;
		}
		setAttributes( { paginationColor: categoryName } );
	}, [ categoryName ] );

	const swiperRef = useRefEffect( ( swiper ) => {
		if ( swiper ) {
			try {
				SwiperInit( swiper, {
					modules: [ Pagination ],
					pagination: {
						clickable: false,
					},

					on: {
						init: ( swiper ) => {
							swiper.disable();
						},
					},
				} );
			} catch ( error ) {
				console.error( 'Swiper initialization failed:', error );
			}
		}
	}, [] );

	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'swiper-wrapper' },
		innerBlocksArgs
	);
	return (
		<>
			<div { ...useBlockProps() }>
				<div className="swiper-row">
					<div className="swiper" ref={ swiperRef }>
						<div { ...innerBlocksProps } />
					</div>
				</div>
				<div className="swiper-row">
					<div
						className="swiper-pagination"
						style={ paginationColor }
					></div>
				</div>
			</div>
		</>
	);
}
