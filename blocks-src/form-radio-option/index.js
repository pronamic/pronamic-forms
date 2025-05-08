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
	__experimentalGetBorderClassesAndStyles as getBorderClassesAndStyles,
	__experimentalGetColorClassesAndStyles as getColorClassesAndStyles,
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
	 * @see https://github.com/WordPress/dashicons/blob/628951563b9c0f0d293af8e40c9b0b3da5e2880d/svg-min/hidden.svg
	 */
	icon: renderIcon(
		<Path
			d="M7.5 13.5C6.67157 13.5 6 12.8284 6 12C6 11.1716 6.67157 10.5 7.5 10.5C8.32843 10.5 9 11.1716 9 12C9 12.8284 8.32843 13.5 7.5 13.5ZM4.5 12C4.5 13.6569 5.84315 15 7.5 15C9.15685 15 10.5 13.6569 10.5 12C10.5 10.3431 9.15685 9 7.5 9C5.84315 9 4.5 10.3431 4.5 12ZM12.5 12.75H20.5V11.25H12.5V12.75Z"
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
							label={ __( 'Value', 'pronamic-forms' ) }
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

				<InspectorControls group="advanced">
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

				<input
					className="wp-block-pronamic-form-control__element"
					type="radio"
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
					type="radio"
				/>
				{' '}
				<RichText.Content tagName="label" value={ attributes.label } />
			</div>
		);
	},

	/**
	 * Variations.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/
	 */
	variations: [
		/**
		 * Subscription frequency options.
		 *
		 * @see https://github.com/pronamic/pronamic-pay-payments-experimental/issues/17
		 */
		{
			name: 'pronamic-form-radio-option-subscription-frequency-once',
			title: __( 'One-time payment', 'pronamic-forms' ),
			keywords: [
				__( 'frequency', 'pronamic-forms' ),
				__( 'interval', 'pronamic-forms' ),
				__( 'recurrence', 'pronamic-forms' ),
				__( 'subscription', 'pronamic-forms' ),
				__( 'Once', 'pronamic-forms' ),
			],
			attributes: {
				reference: 'pronamic_pay_subscription_frequency',
				value: 'once',
			},
			example: {
				attributes: {
					label: __( 'Once', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'reference', 'value' ],
		},
		{
			name: 'pronamic-form-radio-option-subscription-frequency-monthly',
			title: __(
				'Monthly payment',
				'pronamic-forms'
			),
			keywords: [
				__( 'frequency', 'pronamic-forms' ),
				__( 'interval', 'pronamic-forms' ),
				__( 'recurrence', 'pronamic-forms' ),
				__( 'subscription', 'pronamic-forms' ),
				__( 'Monthly', 'pronamic-forms' ),
			],
			attributes: {
				reference: 'pronamic_pay_subscription_frequency',
				value: 'monthly',
			},
			example: {
				attributes: {
					label: __( 'Monthly', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'reference', 'value' ],
		},
		{
			name: 'pronamic-form-radio-option-subscription-frequency-yearly',
			title: __(
				'Yearly payment',
				'pronamic-forms'
			),
			keywords: [
				__( 'frequency', 'pronamic-forms' ),
				__( 'interval', 'pronamic-forms' ),
				__( 'recurrence', 'pronamic-forms' ),
				__( 'subscription', 'pronamic-forms' ),
				__( 'Yearly', 'pronamic-forms' ),
				__( 'Annual', 'pronamic-forms' ),
			],
			attributes: {
				reference: 'pronamic_pay_subscription_frequency',
				value: 'yearly',
			},
			example: {
				attributes: {
					label: __( 'Yearly', 'pronamic-forms' ),
				},
			},
			scope: [ 'block', 'inserter', 'transform' ],
			isActive: [ 'reference', 'value' ],
		},
	],
} );
