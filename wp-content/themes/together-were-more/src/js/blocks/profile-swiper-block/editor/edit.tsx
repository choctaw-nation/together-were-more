import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';

import { useEffect, useRef } from '@wordpress/element';
import Swiper from 'swiper';
import { Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import { innerBlocksArgs } from './constants';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( {} );
	const swiperRef = useRef( null );
	useEffect( () => {
		if ( swiperRef.current ) {
			try {
				new Swiper( swiperRef.current, {
					modules: [ Pagination ],
					slidesPerView: 'auto',
					direction: 'horizontal',
					spaceBetween: 0,
					autoHeight: false,
					pagination: {
						el: '.swiper-pagination',
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
	}, [ swiperRef ] );

	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'swiper-wrapper' },
		innerBlocksArgs
	);
	return (
		<>
			<div { ...blockProps }>
				<div className="swiper-row">
					<div className="swiper" ref={ swiperRef }>
						<div { ...innerBlocksProps } />
					</div>
				</div>
				<div className="swiper-row">
					<div className="swiper-pagination"></div>
				</div>
			</div>
		</>
	);
}
