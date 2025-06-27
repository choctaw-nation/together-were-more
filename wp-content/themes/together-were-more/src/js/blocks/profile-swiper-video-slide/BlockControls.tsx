import { InspectorControls } from '@wordpress/block-editor';
import { Panel, PanelBody, TextareaControl } from '@wordpress/components';
export default function BlockControls( { attributes, setAttributes } ) {
	return (
		<InspectorControls>
			<Panel>
				<PanelBody title="Slide Settings" initialOpen={ true }>
					<TextareaControl
						__nextHasNoMarginBottom
						label="Video Caption"
						placeholder="Enter a short video caption here..."
						value={ attributes.videoCaption }
						onChange={ ( value ) =>
							setAttributes( { videoCaption: value } )
						}
					/>
				</PanelBody>
			</Panel>
		</InspectorControls>
	);
}
