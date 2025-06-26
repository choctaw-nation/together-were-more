import { Fragment } from 'react/jsx-runtime';
import getTheCategoryColor from '../utilities/getTheCategoryColor';

export default function SwiperBlock( { attributes } ) {
	const paginationStyle = {
		'--swiper-pagination-color': getTheCategoryColor(
			attributes.category_name
		),
	} as Record< string, string >;
	return (
		<Fragment>
			<section>
				{ /* <img src="" class="position-absolute top-0 start-0 w-100 h-100"  aria-hidden="true" /> */ }
				<p>Hello from the editor!</p>
			</section>
			<div className="container">
				<div className="row">
					<div className="col-12 position-relative">
						<div
							className="profile-swiper-pagination swiper-pagination"
							style={ paginationStyle }
						/>
					</div>
				</div>
			</div>
		</Fragment>
	);
}
