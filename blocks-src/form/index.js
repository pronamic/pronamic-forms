import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { Path } from '@wordpress/components';

import metadata from './block.json';

import renderIcon from '../form-field/util.js';

import './style.scss';

const TEMPLATE = [
	/**
	 * Form submission notifications.
	 *
	 * @see https://github.com/WordPress/gutenberg/blob/6aad856241e57134b6dfc62b4e9e3ea827c0b935/packages/block-library/src/form/edit.js#L15-L25
	 * @see https://github.com/WordPress/gutenberg/blob/6aad856241e57134b6dfc62b4e9e3ea827c0b935/packages/block-library/src/form/utils.js#L6-L39
	 */
	[
		'pronamic/form-submission-notification',
		{
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
		[
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
	],
	[
		'pronamic/form-submission-notification',
		{
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
		[
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
	],
	[
		'pronamic/form-field',
		{
			label: __( 'Name', 'pronamic-forms' ),
			required: true,
		},
	],
	[
		'pronamic/form-field',
		{
			label: __( 'Email', 'pronamic-forms' ),
			required: true,
			type: 'email',
		},
	],
	[
		'pronamic/form-field',
		{
			label: __( 'Subject', 'pronamic-forms' ),
			required: true,
		},
	],
	[
		'pronamic/form-field',
		{
			label: __( 'Message', 'pronamic-forms' ),
			required: true,
			type: 'textarea',
		},
	],
	[
		'core/button',
		{
			tagName: 'button',
			text: __( 'Submit', 'pronamic-forms' ),
			type: 'submit',
		},
	],
];

registerBlockType( metadata.name, {
	/**
	 * Icon.
	 *
	 * @see https://github.com/Automattic/jetpack/blob/04a2033f214d56cbe71914fa933da5ecb0fa6242/projects/packages/forms/src/blocks/contact-form/index.js#L15C14-L51
	 */
	icon: renderIcon(
		<>
			<Path
				fillRule="evenodd"
				clipRule="evenodd"
				d="M18 9H13V7.5H18V9Z"
			/>
			<Path
				fillRule="evenodd"
				clipRule="evenodd"
				d="M18 16.5H13V15H18V16.5Z"
			/>
			<Path
				fillRule="evenodd"
				clipRule="evenodd"
				d="M9.5 7.5H7.5V9.5H9.5V7.5ZM7.5 6H9.5C10.3284 6 11 6.67157 11 7.5V9.5C11 10.3284 10.3284 11 9.5 11H7.5C6.67157 11 6 10.3284 6 9.5V7.5C6 6.67157 6.67157 6 7.5 6Z"
			/>
			<Path
				fillRule="evenodd"
				clipRule="evenodd"
				d="M9.5 14.5H7.5V16.5H9.5V14.5ZM7.5 13H9.5C10.3284 13 11 13.6716 11 14.5V16.5C11 17.3284 10.3284 18 9.5 18H7.5C6.67157 18 6 17.3284 6 16.5V14.5C6 13.6716 6.67157 13 7.5 13Z"
			/>
			<Path
				fillRule="evenodd"
				clipRule="evenodd"
				d="M19 4.5H5C4.72386 4.5 4.5 4.72386 4.5 5V19C4.5 19.2761 4.72386 19.5 5 19.5H19C19.2761 19.5 19.5 19.2761 19.5 19V5C19.5 4.72386 19.2761 4.5 19 4.5ZM5 3C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H5Z"
			/>
		</>
	),

	edit: () => {
		const blockProps = useBlockProps();

		return (
			<div { ...blockProps }>
				<InnerBlocks template={ TEMPLATE } />
			</div>
		);
	},

	save: () => {
		const blockProps = useBlockProps.save( {
			action: '',
			method: 'post',
		} );

		return (
			<form { ...blockProps }>
				<InnerBlocks.Content />
			</form>
		);
	},
} );
