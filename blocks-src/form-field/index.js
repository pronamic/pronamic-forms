/**
 * External dependencies
 */
import { createBlock, registerBlockType } from '@wordpress/blocks';
import {
	CheckboxControl,
	PanelBody,
	Path,
	TextControl,
} from '@wordpress/components';
import {
	useBlockProps,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import { useState } from '@wordpress/element';

import renderIcon from './util.js';

import metadata from './block.json';

import {
	PLACEHOLDER_SUPPORTED_INPUT_TYPES,
	getControlComponent,
} from '../form-control/utils.js';

import './style.scss';

registerBlockType( metadata.name, {
	edit: ( { attributes, setAttributes } ) => {
		const { required } = attributes;

		const blockProps = useBlockProps();

		const control = getControlComponent( attributes, {
			/**
			 * Prefix HTML input type attribute with 'pronamic-' to avoid leaking styling
			 * from `/wp-admin/css/forms.css` in our control input element.
			 *
			 * Changing the type attribute to a non-standard value is not allowed, but for
			 * now it was an easy solution for this problen.
			 *
			 * @see https://github.com/pronamic/pronamic-pay-payments-experimental/issues/60
			 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#input_types
			 */
			type: "pronamic-" + attributes.type,
			onChange: ( event ) => {
				setAttributes( {
					value: event.target.value,
				} );
			},
		} );

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

						{ PLACEHOLDER_SUPPORTED_INPUT_TYPES.includes(
							attributes.type
						) && (
							<TextControl
								__nextHasNoMarginBottom
								__next40pxDefaultSize
								label={ __( 'Placeholder', 'pronamic-forms' ) }
								help={ __(
									'Text that appears in the form element when no value has been entered.',
									'pronamic-forms'
								) }
								value={ attributes.placeholder }
								onChange={ ( value ) => {
									setAttributes( {
										placeholder: value,
									} );
								} }
							/>
						) }
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
							label={ __( 'Value', 'pronamic-forms' ) }
							value={ attributes.value }
							onChange={ ( value ) => {
								setAttributes( {
									value,
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
						tagName="label"
						value={ attributes.label }
						onChange={ ( value ) =>
							setAttributes( { label: value } )
						}
						placeholder={ __( 'Enter label…', 'pronamic-forms' ) }
					/>
				</div>

				{ control }
			</div>
		);
	},

	/**
	 * Save.
	 *
	 * This block internally uses the `pronamic/form-label` and `pronamic/form-control` block.
	 * @param root0
	 * @param root0.attributes
	 * @see https://wordpress.stackexchange.com/questions/415232/how-can-i-render-a-built-in-gutenberg-block-with-innerblocks-outside-of-the-bloc
	 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-blocks/#getsaveelement
	 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-blocks/#getblockcontent
	 */
	save: ( { attributes } ) => {
		const blockProps = useBlockProps.save();

		const controlComponent = getControlComponent( attributes );

		return (
			<div { ...blockProps }>
				<div className="wp-block-pronamic-form-label">
					<RichText.Content
						tagName="label"
						value={ attributes.label }
					/>
				</div>

				<div className="wp-block-pronamic-form-control">
					{ controlComponent }
				</div>
			</div>
		);
	},

	/**
	 * Transforms.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-transforms/
	 */
	transforms: {
		to: [
			{
				type: 'block',
				blocks: [ 'pronamic/form-radio-field' ],
				transform: ( attributes, innerBlocks ) => {
					return createBlock(
						'pronamic/form-radio-field',
						attributes,
						[ createBlock( 'pronamic/form-radio-option' ) ]
					);
				},
			},
		],
	},

	/**
	 * Variations.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/
	 */
	variations: [
		{
			name: 'pronamic-form-field-text',
			title: __( 'Single-line text field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L386-L391
			 */
			icon: renderIcon(
				<Path
					d="M12 7H4V8.5H12V7ZM19.75 17.25V10.75H4.25V17.25H19.75ZM5.75 15.75V12.25H18.25V15.75H5.75Z"
				/>
			),
			attributes: {
				type: 'text',
			},
			example: {
				attributes: {
					label: 'Subject',
					value: 'Text',
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-textarea',
			title: __( 'Multi-line text field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L548-L553
			 */
			icon: renderIcon(
				<Path
					d="M20 5H4V6.5H20V5ZM5.5 11.5H18.5V18.5H5.5V11.5ZM20 20V10H4V20H20Z"
				/>
			),
			attributes: {
				type: 'textarea',
			},
			example: {
				attributes: {
					label: 'Message',
					value: __( 'Multi-line\ntext', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-url',
			title: __( 'URL field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L455-L467
			 */
			icon: renderIcon(
				<>
					<Path
						d="M4.47118 8.5H3V12.9489C3 14.4653 4.14479 15.5 5.94723 15.5C7.74479 15.5 8.88958 14.4653 8.88958 12.9489V8.5H7.4184V12.8059C7.4184 13.688 6.88742 14.265 5.94723 14.265C5.00216 14.265 4.47118 13.688 4.47118 12.8059V8.5Z"
					/>
					<Path
						d="M11.5348 9.62534H12.7867C13.5175 9.62534 13.9754 10.0545 13.9754 10.7221C13.9754 11.404 13.5418 11.8188 12.8014 11.8188H11.5348V9.62534ZM11.5348 12.8631H12.7137L14.0241 15.3808H15.6901L14.2092 12.6485C15.0179 12.3386 15.4855 11.5756 15.4855 10.6935C15.4855 9.33447 14.5599 8.5 12.9426 8.5H10.0636V15.3808H11.5348V12.8631Z"
					/>
					<Path
						d="M21 14.1887H17.9261V8.5H16.4549V15.3808H21V14.1887Z"
					/>
				</>
			),
			attributes: {
				type: 'url',
			},
			example: {
				attributes: {
					label: __( 'Website', 'pronamic-forms' ),
					value: __( 'https://www.example.com/', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-telephone-number',
			title: __( 'Telephone number field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L520-L526
			 */
			icon: renderIcon(
				<Path
					fillRule="evenodd"
					d="M9 5.5H15C15.2761 5.5 15.5 5.72386 15.5 6V18C15.5 18.2761 15.2761 18.5 15 18.5H9C8.72386 18.5 8.5 18.2761 8.5 18V6C8.5 5.72386 8.72386 5.5 9 5.5ZM7 6C7 4.89543 7.89543 4 9 4H15C16.1046 4 17 4.89543 17 6V18C17 19.1046 16.1046 20 15 20H9C7.89543 20 7 19.1046 7 18V6ZM13 16H11V17.5H13V16Z"
				/>
			),
			attributes: {
				type: 'tel',
			},
			example: {
				attributes: {
					label: __( 'Telephone number', 'pronamic-forms' ),
					value: __( '555-0100', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-email',
			title: __( 'Email address field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L431-L437
			 */
			icon: renderIcon(
				<Path
					fillRule="evenodd"
					d="M5.5 8.41665V16C5.5 16.2761 5.72386 16.5 6 16.5H18C18.2761 16.5 18.5 16.2761 18.5 16V8.41633L11.9998 13.9879L5.5 8.41665ZM17.2642 7.5H6.73546L11.9998 12.0123L17.2642 7.5ZM6 6C4.89543 6 4 6.89543 4 8V16C4 17.1046 4.89543 18 6 18H18C19.1046 18 20 17.1046 20 16V8C20 6.89543 19.1046 6 18 6H6Z"
				/>
			),
			attributes: {
				type: 'email',
			},
			example: {
				attributes: {
					label: __( 'Email address', 'pronamic-forms' ),
					value: __( 'john.doe@example.com', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-password',
			title: __( 'Password field', 'pronamic-forms' ),
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
			attributes: {
				type: 'password',
			},
			example: {
				attributes: {
					label: __( 'Password', 'pronamic-forms' ),
					value: 'password',
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'type' ],
		},
		{
			name: 'pronamic-form-field-payment-amount',
			title: __( 'Payment amount field', 'pronamic-forms' ),
			/**
			 * Icon.
			 *
			 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
			 * @see https://github.com/pronamic/wp-pay-core/blob/cc89c297372ebd818cc5e0bae737ac58ba8e74b8/images/src/wp-pay.svg
			 */
			icon: renderIcon(
				<Path
					d="M0 3h20v12h-.75c0-1.79-1.46-3.25-3.25-3.25-1.31 0-2.42.79-2.94 1.91-.25-.1-.52-.16-.81-.16-.98 0-1.8.63-2.11 1.5H0V3zm8.37 3.11c-.06.15-.1.31-.11.47s-.01.33.01.5l.02.08c.01.06.02.14.05.23.02.1.06.2.1.31.03.11.09.22.15.33.07.12.15.22.23.31s.18.17.31.23c.12.06.25.09.4.09.14 0 .27-.03.39-.09s.22-.14.3-.22c.09-.09.16-.2.22-.32.07-.12.12-.23.16-.33s.07-.2.09-.31c.03-.11.04-.18.05-.22s.01-.07.01-.09c.05-.29.03-.56-.04-.82s-.21-.48-.41-.66c-.21-.18-.47-.27-.79-.27-.19 0-.36.03-.52.1-.15.07-.28.16-.38.28-.09.11-.17.25-.24.4zm4.48 6.04v-1.14c0-.33-.1-.66-.29-.98s-.45-.59-.77-.79c-.32-.21-.66-.31-1.02-.31l-1.24.84-1.28-.82c-.37 0-.72.1-1.04.3-.31.2-.56.46-.74.77-.18.32-.27.65-.27.99v1.14l.18.05c.12.04.29.08.51.14.23.05.47.1.74.15.26.05.57.09.91.13.34.03.67.05.99.05.3 0 .63-.02.98-.05.34-.04.64-.08.89-.13.25-.04.5-.1.76-.16l.5-.12c.08-.02.14-.04.19-.06zm3.15.1c1.52 0 2.75 1.23 2.75 2.75s-1.23 2.75-2.75 2.75c-.73 0-1.38-.3-1.87-.77.23-.35.37-.78.37-1.23 0-.77-.39-1.46-.99-1.86.43-.96 1.37-1.64 2.49-1.64zm-5.5 3.5c0-.96.79-1.75 1.75-1.75s1.75.79 1.75 1.75-.79 1.75-1.75 1.75-1.75-.79-1.75-1.75z"
				/>
			),
			attributes: {
				type: 'text',
				reference: 'pronamic-pay-amount',
			},
			example: {
				attributes: {
					label: __( 'Payment amount', 'pronamic-forms' ),
					value: '10',
				},
			},
			scope: [ 'block', 'inserter' ],
			isActive: [ 'type', 'reference' ],
		},
	],
} );
