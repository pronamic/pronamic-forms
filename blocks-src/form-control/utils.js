/**
 * External dependencies
 */
import clsx from 'clsx';

/**
 * Utils.
 *
 * @link https://github.com/WordPress/gutenberg/blob/154f1aaeea73ba1ed2c17373814c8c3620dc9626/packages/block-library/src/form/utils.js
 */
export const PLACEHOLDER_SUPPORTED_INPUT_TYPES = [
	'textarea',
	'text',
	'search',
	'url',
	'tel',
	'email',
	'password',
	'number',
];

export function getControlComponent( attributes, htmlAttributes = {} ) {
	if ( attributes.name ) {
		htmlAttributes.name = attributes.name;
	}

	if ( attributes.required ) {
		htmlAttributes.required = 'required';
	}

	if (
		PLACEHOLDER_SUPPORTED_INPUT_TYPES.includes( attributes.type ) &&
		attributes.placeholder
	) {
		htmlAttributes.placeholder = attributes.placeholder;
	}

	htmlAttributes.className = clsx(
		'wp-block-pronamic-form-control__element',
		htmlAttributes.className
	);

	htmlAttributes.value = attributes.value;

	if ( 'textarea' === attributes.type ) {
		return <textarea { ...htmlAttributes } />;
	}

	if ( ! htmlAttributes.type ) {
		htmlAttributes.type = attributes.type;
	}

	return <input { ...htmlAttributes } />;
}
