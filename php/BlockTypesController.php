<?php
/**
 * Block types controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_HTML_Tag_Processor;

/**
 * Block types controller class
 */
final class BlockTypesController {
	/**
	 * Setup.
	 *
	 * @return void
	 */
	public function setup() {
		\add_action( 'init', $this->init( ... ) );

		\add_filter( 'get_block_type_variations', $this->get_block_type_variations( ... ), 10, 2 );
	}

	/**
	 * Init.
	 *
	 * @return void
	 */
	private function init() {
		\wp_register_block_metadata_collection(
			__DIR__ . '/../blocks',
			__DIR__ . '/../blocks/blocks-manifest.php'
		);

		\register_block_type(
			__DIR__ . '/../blocks/form',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$form_closing_tag_position = \strrpos( $content, '</form>' );

					if ( false === $form_closing_tag_position ) {
						return $content;
					}

					if ( ! \array_key_exists( 'pronamic-forms/hash', $block->context ) ) {
						return $content;
					}

					$hash = $block->context['pronamic-forms/hash'];

					$input_hidden_hash = \sprintf(
						'<input type="hidden" name="pronamic_pay_form_hash" value="%s" />',
						\esc_attr( $hash )
					);

					$content = \substr_replace( $content, $input_hidden_hash, $form_closing_tag_position, 0 );

					return $content;
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-field',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$content = $this->update_control_element( $attributes, $content, $block );

					$processor = new WP_HTML_Tag_Processor( $content );

					if ( 'radio' !== $attributes['type'] ) {
						$control_id = \wp_unique_id( 'wp-block-pronamic-form-control__element-' );

						if ( $processor->next_tag( 'label' ) ) {
							$processor->set_attribute( 'for', $control_id );
						}

						if ( $processor->next_tag( [ 'class_name' => 'wp-block-pronamic-form-control__element' ] ) ) {
							$processor->set_attribute( 'id', $control_id );
						}
					}

					return $processor->get_updated_html();
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-radio-option',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$content = $this->update_control_element( $attributes, $content, $block );

					$processor = new WP_HTML_Tag_Processor( $content );

					$control_id = \wp_unique_id( 'wp-block-pronamic-form-control__element-' );

					if ( $processor->next_tag( [ 'class_name' => 'wp-block-pronamic-form-control__element' ] ) ) {
						$processor->set_attribute( 'id', $control_id );
					}

					if ( $processor->next_tag( 'label' ) ) {
						$processor->set_attribute( 'for', $control_id );
					}

					return $processor->get_updated_html();
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-radio-field'
		);

		\register_block_style(
			[
				'pronamic/form-radio-field',
				'pronamic/form-checkbox-field',
			],
			[
				'name'  => 'button',
				'label' => \__( 'Button', 'pronamic-forms' ),
			]
		);

		\register_block_style(
			[
				'pronamic/form-radio-field',
				'pronamic/form-checkbox-field',
			],
			[
				'name'  => 'toggle-switch',
				'label' => \__( 'Toggle switch', 'pronamic-forms' ),
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-checkbox-option',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$content = $this->update_control_element( $attributes, $content, $block );

					$processor = new WP_HTML_Tag_Processor( $content );

					$control_id = \wp_unique_id( 'wp-block-pronamic-form-control__element-' );

					if ( $processor->next_tag( [ 'class_name' => 'wp-block-pronamic-form-control__element' ] ) ) {
						$processor->set_attribute( 'id', $control_id );
					}

					if ( $processor->next_tag( 'label' ) ) {
						$processor->set_attribute( 'for', $control_id );
					}

					return $processor->get_updated_html();
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-checkbox-field'
		);

		\register_block_type(
			__DIR__ . '/../blocks/hidden-payment-amount'
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-control',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$content = $this->update_control_element( $attributes, $content, $block );

					return $content;
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-label',
			[
				'render_callback' => function ( $attributes, $content, $block ) {
					$processor = new WP_HTML_Tag_Processor( $content );

					if ( $processor->next_tag( 'label' ) ) {
						$for = $processor->get_attribute( 'for' );

						if ( null === $for && \array_key_exists( 'pronamic/form-field-id', $block->context ) ) {
							$field_id = $block->context['pronamic/form-field-id'];

							$for = $field_id . '-input';

							$processor->set_attribute( 'for', $for );
						}
					}

					return $processor->get_updated_html();
				},
			]
		);

		\register_block_type(
			__DIR__ . '/../blocks/form-submission-notification',
			[
				/**
				 * Render callback for form submssion notification.
				 *
				 * @link https://github.com/WordPress/gutenberg/blob/7340783694bdeaa8c4c73030b7a05c83cdcffa44/packages/block-library/src/form-submission-notification/index.php#L9
				 */
				'render_callback' => function ( $attributes, $content, $block ) {
					if ( ! \array_key_exists( 'pronamic-forms/submissionState', $block->context ) ) {
						return '';
					}

					$result = $block->context['pronamic-forms/submissionState'];

					if ( $result !== $attributes['type'] ) {
						return '';
					}

					return $content;
				},
			]
		);

		/**
		 * Script translations.
		 *
		 * @link https://github.com/pronamic/pronamic-pay-payments-experimental/issues/42
		 */
		$block_types = [
			'form',
			'form-checkbox-field',
			'form-checkbox-option',
			'form-control',
			'form-field',
			'form-label',
			'form-radio-field',
			'form-radio-option',
			'form-submission-notification',
			'hidden-payment-amount',
		];

		foreach ( $block_types as $block_type ) {
			\wp_set_script_translations(
				'pronamic-' . $block_type . '-editor-script',
				'pronamic-forms',
				__DIR__ . '/../languages'
			);
		}
	}

	/**
	 * Update control element.
	 *
	 * @param array    $attributes Attributes.
	 * @param string   $content    Content.
	 * @param WP_Block $block      Block.
	 * @return string
	 */
	private function update_control_element( $attributes, $content, $block ) {
		$id = '';

		if ( \array_key_exists( 'id', $attributes ) ) {
			$id = $attributes['id'];
		}

		$processor = new WP_HTML_Tag_Processor( $content );

		if ( $processor->next_tag( [ 'class_name' => 'wp-block-pronamic-form-control__element' ] ) ) {
			$id = (string) $processor->get_attribute( 'id' );

			if ( '' === $id && \array_key_exists( 'pronamic/form-field-id', $block->context ) ) {
				$field_id = $block->context['pronamic/form-field-id'];

				$processor->set_attribute( 'id', $field_id . '-input' );
			}
		}

		return $processor->get_updated_html();
	}

	/**
	 * Get block type variations.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/get_block_type_variations/
	 * @link https://github.com/WordPress/wordpress-develop/blob/6.6/src/wp-includes/class-wp-block-type.php#L608-L616
	 * @param array         $variations Variations.
	 * @param WP_Block_Type $block_type Block type.
	 * @return array
	 */
	private function get_block_type_variations( $variations, $block_type ) {
		$variations = $this->maybe_add_core_button_variations( $variations, $block_type );

		return $variations;
	}

	/**
	 * Maybe add core button variations.
	 *
	 * @param array         $variations Variations.
	 * @param WP_Block_Type $block_type Block type.
	 * @return array
	 */
	private function maybe_add_core_button_variations( $variations, $block_type ) {
		if ( 'core/button' !== $block_type->name ) {
			return $variations;
		}

		$variations[] = [
			'name'       => 'pronamic-form-submit-button',
			'title'      => \__( 'Form submit button', 'pronamic-forms' ),
			'isActive'   => [
				'tagName',
				'type',
			],
			'attributes' => [
				'tagName' => 'button',
				'type'    => 'submit',
			],
			'scope'      => [
				'block',
				'insert',
				'transform',
			],
		];

		return $variations;
	}
}
