import { registerBlockType } from '@wordpress/blocks';
import metadata from './block.json';

import './style.scss';
import SwiperVideoSlide from './SwiperVideoSlide';
import BlockControls from './BlockControls';

registerBlockType( metadata.name, {
	edit: ( props ) => {
		return (
			<>
				<BlockControls { ...props } />
				<SwiperVideoSlide
					editorView={ true }
					caption={ props.attributes.videoCaption }
				/>
			</>
		);
	},
	save: ( { attributes } ) => (
		<SwiperVideoSlide
			editorView={ false }
			caption={ attributes.videoCaption }
		/>
	),
} );
