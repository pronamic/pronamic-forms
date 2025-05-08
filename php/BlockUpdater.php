<?php
/**
 * Block updater
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_Block_Type;
use WP_Block_Type_Registry;

/**
 * Block updater class
 */
class BlockUpdater {
	/**
	 * Update block attributes.
	 *
	 * @param array $parsed_block Parsed block.
	 * @param array $context      Context.
	 * @return array
	 */
	public function update_block_attributes( $parsed_block, $context ) {
		$block_name = $parsed_block['blockName'];

		$block_type = WP_Block_Type_Registry::get_instance()->get_registered( $block_name );

		if ( $this->block_type_supports( $block_type, 'pronamicFormsAutoGenerateName' ) ) {
			$parsed_block = $this->assign_name_attribute( $parsed_block, $context );
		}

		if ( $this->block_type_supports( $block_type, 'pronamicFormsAutoGenerateValue' ) ) {
			$parsed_block = $this->assign_value_attribute( $parsed_block );
		}

		return $parsed_block;
	}

	/**
	 * Block type supports.
	 *
	 * @param WP_Block_Type $block_type Block type.
	 * @param string        $feature    Feature.
	 * @return bool
	 */
	private function block_type_supports( $block_type, $feature ) {
		if ( ! \array_key_exists( $feature, $block_type->supports ) ) {
			return false;
		}

		return ( true === $block_type->supports[ $feature ] );
	}

	/**
	 * Assign name attribute.
	 *
	 * @param array $parsed_block Parsed block.
	 * @param array $context      Context.
	 * @return array
	 */
	private function assign_name_attribute( $parsed_block, $context ) {
		$attributes = $parsed_block['attrs'];

		$name = '';

		if ( \array_key_exists( 'pronamic/form-field-name', $context ) ) {
			$name = $context['pronamic/form-field-name'];
		}

		if ( \array_key_exists( 'name', $attributes ) ) {
			$name = $attributes['name'];
		}

		if ( '' === $name ) {
			$name = \wp_unique_id( 'field-' );
		}

		$attributes['name'] = $name;

		$parsed_block['attrs'] = $attributes;

		return $parsed_block;
	}

	/**
	 * Assign value attribute.
	 *
	 * @param array $parsed_block Parsed block.
	 * @return array
	 */
	private function assign_value_attribute( $parsed_block ) {
		$value = $parsed_block['attrs']['value'] ?? '';

		if ( '' === $value ) {
			$value = \wp_unique_id( 'pronamic-forms-option-' );
		}

		$parsed_block['attrs']['value'] = $value;

		return $parsed_block;
	}

	/**
	 * Update value from input.
	 *
	 * @param array $parsed_block Parsd block.
	 * @return array
	 */
	public function update_value_from_input( $parsed_block ) {
		$input = $this->get_input( $parsed_block );

		if ( null === $input ) {
			return $parsed_block;
		}

		$parsed_block['attrs']['value'] = $input;

		return $parsed_block;
	}

	/**
	 * Update inner content.
	 *
	 * @param string $html         HTML.
	 * @param array  $parsed_block Parsed block.
	 * @return string
	 */
	public function update_inner_content( $html, $parsed_block ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed -- Parameter `$parsed_block` is being used in child classes.
		return $html;
	}

	/**
	 * Get input.
	 *
	 * @param array $parsed_block Parsed block array.
	 * @return string|null
	 */
	protected function get_input( $parsed_block ) {
		$attributes = $parsed_block['attrs'];

		if ( ! \array_key_exists( 'name', $attributes ) ) {
			return null;
		}

		$name = $attributes['name'];

		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Public form.
		if ( ! \array_key_exists( $name, $_POST ) ) {
			return null;
		}

		$type = '';

		if ( \array_key_exists( 'type', $attributes ) ) {
			$type = $attributes['type'];
		}

		return match ( $type ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Public form.
			'textarea' => \sanitize_textarea_field( \wp_unslash( $_POST[ $name ] ) ),
			// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Public form.
			default => \sanitize_text_field( \wp_unslash( $_POST[ $name ] ) ),
		};
	}

	/**
	 * Update textarea value HTML.
	 *
	 * @param string $content HTML.
	 * @param string $value   Textarea value.
	 * @return string
	 */
	protected function update_textarea_value_html( $content, $value ) {
		return \preg_replace_callback(
			'#(<textarea\b[^>]*>)(.*?)(</textarea>)#is',
			fn( $matches ) => $matches[1] . \esc_textarea( $value ) . $matches[3],
			(string) $content
		);
	}
}
