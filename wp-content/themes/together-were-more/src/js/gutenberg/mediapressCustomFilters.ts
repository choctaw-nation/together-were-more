import { addFilter } from '@wordpress/hooks';
import categoryCheck from './mediapress-filters/categoryCheck';
import excerptCheck from './mediapress-filters/excerptCheck';
import vimeoUrlCheck from './mediapress-filters/vimeoUrlCheck';

const filters = {
	category_is_valid: categoryCheck,
	excerpt_is_valid: excerptCheck,
	vimeo_url_check: vimeoUrlCheck,
};

Object.entries( filters ).forEach( ( [ name, filter ] ) => {
	addFilter( `mediaPress.checklist.item`, `twm/${ name }`, filter );
} );
