import { registerBlockType } from '@wordpress/blocks';
import { SelectControl, PanelBody, TextControl } from '@wordpress/components';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import metadata from './block.json';

import './style.scss';

registerBlockType( metadata.name, {
	edit: ( { attributes, setAttributes } ) => {
		const { tagName, content } = attributes;

		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<InspectorControls>
					<PanelBody title={ __( 'Settings', 'pronamic-forms' ) }>
						<SelectControl
							label={ __( 'HTML element', 'pronamic-forms' ) }
							options={ [
								{
									label: __(
										'Default (<label>)',
										'pronamic-forms'
									),
									value: 'label',
								},
								{ label: '<span>', value: 'span' },
							] }
							value={ tagName }
							onChange={ ( value ) =>
								setAttributes( { tagName: value } )
							}
						/>

						{ 'label' === tagName && (
							<TextControl
								autoComplete="off"
								label={ __( 'For', 'pronamic-forms' ) }
								value={ attributes.htmlFor }
								onChange={ ( value ) => {
									setAttributes( { htmlFor: value } );
								} }
							/>
						) }
					</PanelBody>
				</InspectorControls>

				<RichText
					tagName="label"
					value={ attributes.content }
					onChange={ ( val ) => setAttributes( { content: val } ) }
					placeholder={ __( 'Enter label…', 'pronamic-forms' ) }
				/>
			</div>
		);
	},
	save( { attributes } ) {
		const blockProps = useBlockProps.save();

		const htmlFor =
			'label' === attributes.tagName ? attributes.htmlFor : null;

		return (
			<div { ...blockProps }>
				<RichText.Content
					tagName={ attributes.tagName }
					value={ attributes.content }
					for={ '' === htmlFor ? null : htmlFor }
				/>
			</div>
		);
	},
} );
