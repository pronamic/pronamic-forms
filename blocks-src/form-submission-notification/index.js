import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { Icon } from '@wordpress/components';

import metadata from './block.json';

import './style.scss';

const TEMPLATE = [];

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#icon
	 * @see https://wordpress.github.io/gutenberg/?path=/docs/icons-icon--docs
	 */
	icon: <Icon icon="megaphone" />,

	edit: ( { attributes, clientId, context, isSelected } ) => {
		const blockProps = useBlockProps();

		const result = context[ 'pronamic-forms/submissionResult' ];

		const showInnerBlocks = (
			'' === result
				||
			attributes.type === result
				||
			useSelect(
				( select ) => {
					const { hasSelectedInnerBlock } = select( 'core/block-editor' );
					return isSelected || hasSelectedInnerBlock( clientId, true );
				},
				[ clientId, isSelected ]
			)
		);

		return (
			<div { ...blockProps }>
				{ showInnerBlocks && <InnerBlocks template={ TEMPLATE } /> }
			</div>
		);
	},

	save: () => {
		const blockProps = useBlockProps.save( {} );

		return (
			<div { ...blockProps }>
				<InnerBlocks.Content />
			</div>
		);
	},

	/**
	 * Variations.
	 *
	 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-variations/
	 * @see https://github.com/WordPress/gutenberg/blob/6aad856241e57134b6dfc62b4e9e3ea827c0b935/packages/block-library/src/form-submission-notification/variations.js
	 */
	variations: [
		{
			name: 'pronamic-form-submission-success',
			title: __( 'Form submission success', 'pronamic-forms' ),
			description: __(
				'Success message for form submissions.',
				'pronamic-forms'
			),
			attributes: {
				type: 'success',
				style: {
					color: {
						text: '#345C00',
					},
					elements: {
						link: {
							color: {
								text: '#345C00',
							},
						},
					},
				},
			},
			isDefault: true,
			innerBlocks: [
				[
					'core/paragraph',
					{
						content: __(
							'Your form has been submitted successfully.',
							'pronamic-forms'
						),
					},
				],
			],
			scope: [ 'inserter', 'transform' ],
			isActive: ( blockAttributes ) =>
				! blockAttributes?.type || blockAttributes?.type === 'success',
		},
		{
			name: 'pronamic-form-submission-error',
			title: __( 'Form submission error', 'pronamic-forms' ),
			description: __(
				'Error/failure message for form submissions.',
				'pronamic-forms'
			),
			attributes: {
				type: 'error',
				style: {
					color: {
						text: '#CF2E2E',
					},
					elements: {
						link: {
							color: {
								text: '#CF2E2E',
							},
						},
					},
				},
			},
			isDefault: false,
			innerBlocks: [
				[
					'core/paragraph',
					{
						content: __(
							'There was an error submitting your form.',
							'pronamic-forms'
						),
					},
				],
			],
			scope: [ 'inserter', 'transform' ],
			isActive: ( blockAttributes ) =>
				! blockAttributes?.type || blockAttributes?.type === 'error',
		},
	],
} );
