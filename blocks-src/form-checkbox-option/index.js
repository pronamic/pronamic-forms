/**
 * External dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import {
	PanelBody,
	Path,
	TextControl,
	__experimentalNumberControl as NumberControl,
	__experimentalInputControlPrefixWrapper as InputControlPrefixWrapper,
} from '@wordpress/components';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import renderIcon from '../form-field/util.js';

import metadata from './block.json';

import './style.scss';

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
	 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L631-L646
	 */
	icon: renderIcon(
		<Path
			d="M5.5 10.5H8.5V13.5H5.5V10.5ZM8.5 9H5.5C4.67157 9 4 9.67157 4 10.5V13.5C4 14.3284 4.67157 15 5.5 15H8.5C9.32843 15 10 14.3284 10 13.5V10.5C10 9.67157 9.32843 9 8.5 9ZM12 12.75H20V11.25H12V12.75Z"
		/>
	),

	edit: ( { attributes, setAttributes } ) => {
		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<InspectorControls>
					<PanelBody title={ __( 'Settings', 'pronamic-forms' ) }>
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							autoComplete="off"
							label={ __( 'Value' ) }
							value={ attributes.value }
							onChange={ ( newValue ) => {
								setAttributes( {
									value: newValue,
								} );
							} }
						/>

						<NumberControl
							label={ __( 'Payment amount', 'pronamic-forms' ) }
							onChange={ ( val ) =>
								setAttributes( { paymentAmount: val } )
							}
							value={ attributes.paymentAmount }
							spinControls="none"
							prefix={
								<InputControlPrefixWrapper>
									€ 
								</InputControlPrefixWrapper>
							}
						/>
					</PanelBody>
				</InspectorControls>

				<input
					className="wp-block-pronamic-form-control__element"
					type="checkbox"
					tabIndex="-1"
					checked={ attributes.checked }
				/>

				<RichText
					identifier="label"
					tagName="label"
					value={ attributes.label }
					onChange={ ( val ) => setAttributes( { label: val } ) }
					placeholder={ __( 'Enter label…', 'pronamic-forms' ) }
				/>
			</div>
		);
	},
	save( { attributes } ) {
		const blockProps = useBlockProps.save();

		return (
			<div { ...blockProps }>
				<input
					className="wp-block-pronamic-form-control__element"
					checked={ attributes.checked }
					name={ attributes.name }
					value={ attributes.value }
					type="checkbox"
				/>

				<RichText.Content tagName="label" value={ attributes.label } />
			</div>
		);
	},
} );
