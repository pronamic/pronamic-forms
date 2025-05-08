import { registerBlockType } from '@wordpress/blocks';
import { Icon, PanelBody, Path, TextControl } from '@wordpress/components';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import metadata from './block.json';

import renderIcon from '../form-field/util.js';

import './editor.scss';

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
	 * @see https://github.com/WordPress/dashicons/blob/628951563b9c0f0d293af8e40c9b0b3da5e2880d/svg-min/hidden.svg
	 */
	icon: renderIcon(
		<Path
			d="M17.3 3.3c-.4-.4-1.1-.4-1.6 0l-2.4 2.4c-1.1-.4-2.2-.6-3.3-.6-3.8.1-7.2 2.1-9 5.4.2.4.5.8.8 1.2.8 1.1 1.8 2 2.9 2.7L3 16.1c-.4.4-.5 1.1 0 1.6.4.4 1.1.5 1.6 0L17.3 4.9c.4-.5.4-1.2 0-1.6zm-10.6 9l-1.3 1.3c-1.2-.7-2.3-1.7-3.1-2.9C3.5 9 5.1 7.8 7 7.2c-1.3 1.4-1.4 3.6-.3 5.1zM10.1 9c-.5-.5-.4-1.3.1-1.8.5-.4 1.2-.4 1.7 0L10.1 9zm8.2.5c-.5-.7-1.1-1.4-1.8-1.9l-1 1c.8.6 1.5 1.3 2.1 2.2C15.9 13.4 13 15 9.9 15h-.8l-1 1c.7-.1 1.3 0 1.9 0 3.3 0 6.4-1.6 8.3-4.3.3-.4.5-.8.8-1.2-.3-.3-.5-.7-.8-1zM14 10l-4 4c2.2 0 4-1.8 4-4z"
		/>
	),

	edit: ( { attributes, setAttributes } ) => {
		const { paymentAmount } = attributes;

		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<InspectorControls>
					<PanelBody title={ __( 'Settings', 'pronamic-forms' ) }>
						<TextControl
							autoComplete="off"
							label={ __( 'Payment amount', 'pronamic-forms' ) }
							value={ paymentAmount }
							onChange={ ( newVal ) => {
								setAttributes( {
									paymentAmount: newVal,
								} );
							} }
						/>
					</PanelBody>
				</InspectorControls>

				<div>
					<Icon icon="hidden" /> € { attributes.paymentAmount }
				</div>
			</div>
		);
	},
} );
