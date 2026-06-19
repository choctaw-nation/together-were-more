import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';
import { icon } from './icon';
import './shared/style.scss';
import Edit from './editor/edit';
import { useInnerBlocksProps, useBlockProps } from '@wordpress/block-editor';

registerBlockType( metadata.name, {
	icon,
	edit: Edit,
	save: ( { attributes } ) => {
		const paginationColor = {
			'--swiper-pagination-color': `var(--wp--preset--color--${ attributes.paginationColor })`,
		} as Record< string, string >;
		return (
			<div { ...useBlockProps.save() } id="profile-swiper">
				<div className="swiper-row">
					<div className="swiper">
						<div
							className="swiper-wrapper"
							{ ...useInnerBlocksProps.save() }
						/>
						<span
							className="font-script position-absolute fs-3 z-3 text-dark"
							id="swipe-text"
							data-aos="fade-in"
							data-aos-offset="200"
							dangerouslySetInnerHTML={ {
								__html: `Swipe &rarr;`,
							} }
						/>
					</div>
				</div>
				<div className="swiper-row">
					<div
						className="swiper-pagination"
						style={ paginationColor }
					/>
				</div>
			</div>
		);
	},
} );
