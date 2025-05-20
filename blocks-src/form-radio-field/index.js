import { createBlock, registerBlockType } from '@wordpress/blocks';
import {
	CheckboxControl,
	PanelBody,
	Path,
	TextControl,
} from '@wordpress/components';
import {
	InnerBlocks,
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import renderIcon from '../form-field/util.js';

import metadata from './block.json';

import './style.scss';

const TEMPLATE = [ [ 'pronamic/form-radio-option' ] ];

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
	 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/child-blocks.js#L707-L714
	 */
	icon: renderIcon(
		<Path
			d="M4 7.75C4 9.40685 5.34315 10.75 7 10.75C8.65685 10.75 10 9.40685 10 7.75C10 6.09315 8.65685 4.75 7 4.75C5.34315 4.75 4 6.09315 4 7.75ZM20 8.5H12V7H20V8.5ZM20 17H12V15.5H20V17ZM7 17.75C6.17157 17.75 5.5 17.0784 5.5 16.25C5.5 15.4216 6.17157 14.75 7 14.75C7.82843 14.75 8.5 15.4216 8.5 16.25C8.5 17.0784 7.82843 17.75 7 17.75ZM4 16.25C4 17.9069 5.34315 19.25 7 19.25C8.65685 19.25 10 17.9069 10 16.25C10 14.5931 8.65685 13.25 7 13.25C5.34315 13.25 4 14.5931 4 16.25Z"
		/>
	),

	edit: ( { attributes, setAttributes } ) => {
		const { required } = attributes;

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
				</InspectorControls>

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
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-transforms/
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

	/**
	 * Variations.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/
	 */
	variations: [
		{
			name: 'pronamic-form-radio-field-subscription-frequency',
			title: __( 'Subscription frequency choice field', 'pronamic-forms' ),
			keywords: [
				__( 'frequency', 'pronamic-forms' ),
				__( 'interval', 'pronamic-forms' ),
				__( 'recurrence', 'pronamic-forms' ),
				__( 'subscription', 'pronamic-forms' ),
				__( 'Once', 'pronamic-forms' ),
				__( 'Monthly', 'pronamic-forms' ),
				__( 'Yearly', 'pronamic-forms' ),
				__( 'Annual', 'pronamic-forms' ),
			],
			attributes: {
				label: __( 'Frequency', 'pronamic-forms' ),
				reference: 'pronamic_pay_subscription_frequency',
				required: true,
			},
			innerBlocks: [
				[
					'pronamic/form-radio-option',
					{
						label: __( 'Once', 'pronamic-forms' ),
						reference: 'pronamic_pay_subscription_frequency',
						value: 'once',
					}
				],
				[
					'pronamic/form-radio-option',
					{
						label: __( 'Monthly', 'pronamic-forms' ),
						reference: 'pronamic_pay_subscription_frequency',
						value: 'monthly',
					}
				],
				[
					'pronamic/form-radio-option',
					{
						label: __( 'Yearly', 'pronamic-forms' ),
						reference: 'pronamic_pay_subscription_frequency',
						value: 'yearly',
					}
				],
			],
			example: {
				attributes: {
					label: __( 'Frequency', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'reference' ],
		},
	],
} );
