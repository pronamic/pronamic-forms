import { createBlock, registerBlockType } from '@wordpress/blocks';
import {
	CheckboxControl,
	PanelBody,
	Path,
	SelectControl,
	TextControl,
} from '@wordpress/components';
import {
	__experimentalGetBorderClassesAndStyles as getBorderClassesAndStyles,
	__experimentalGetColorClassesAndStyles as getColorClassesAndStyles,
	InnerBlocks,
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import renderIcon from '../form-field/util.js';

import metadata from './block.json';

import './style.scss';

const TEMPLATE = [ [ 'pronamic/form-checkbox-option' ] ];

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
	 * @link https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L661-L692
	 */
	icon: renderIcon(
		<Path
			d="M7.0812 10.1419L10.6001 5.45005L9.40006 4.55005L6.91891 7.85824L5.53039 6.46972L4.46973 7.53038L7.0812 10.1419ZM12 8.5H20V7H12V8.5ZM12 17H20V15.5H12V17ZM8.5 14.5H5.5V17.5H8.5V14.5ZM5.5 13H8.5C9.32843 13 10 13.6716 10 14.5V17.5C10 18.3284 9.32843 19 8.5 19H5.5C4.67157 19 4 18.3284 4 17.5V14.5C4 13.6716 4.67157 13 5.5 13Z"
		/>
	),

	edit: ( { attributes, setAttributes } ) => {
		const { label, required } = attributes;

		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<InspectorControls>
					<PanelBody title={ __( 'Settings', 'pronamic-forms' ) }>
						<CheckboxControl
							__nextHasNoMarginBottom
							label={ __( 'Required', 'pronamic-forms' ) }
							help={ __(
								'Select this option to make the input required.',
								'pronamic-forms'
							) }
							checked={ required }
							onChange={ ( value ) => {
								setAttributes( {
									required: value,
								} );
							} }
						/>
					</PanelBody>

					<InspectorControls group="advanced">
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							autoComplete="off"
							label={ __( 'Name', 'pronamic-forms' ) }
							value={ attributes.name }
							onChange={ ( value ) => {
								setAttributes( {
									name: value,
								} );
							} }
						/>

						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							autoComplete="off"
							label={ __( 'Reference', 'pronamic-forms' ) }
							value={ attributes.reference }
							onChange={ ( value ) => {
								setAttributes( {
									reference: value,
								} );
							} }
						/>
					</InspectorControls>
				</InspectorControls>

				<div className="wp-block-pronamic-form-label">
					<RichText
						tagName="span"
						value={ attributes.label }
						onChange={ ( value ) =>
							setAttributes( { label: value } )
						}
						placeholder={ __( 'Enter label…', 'pronamic-forms' ) }
					/>
				</div>

				<InnerBlocks template={ TEMPLATE } />
			</div>
		);
	},

	save( { attributes } ) {
		const blockProps = useBlockProps.save( {
			className: 'wp-block-pronamic-form-field',
		} );

		return (
			<div { ...blockProps }>
				<div className="wp-block-pronamic-form-label">
					<RichText.Content
						tagName="span"
						value={ attributes.label }
					/>
				</div>

				<div className="wp-block-pronamic-form-radio-field__inner-blocks">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},

	/**
	 * Transforms.
	 *
	 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-transforms/
	 */
	transforms: {
		to: [
			{
				type: 'block',
				blocks: [ 'pronamic/form-field' ],
				transform: ( attributes ) => {
					return createBlock( 'pronamic/form-field', attributes );
				},
			},
		],
	},
} );
