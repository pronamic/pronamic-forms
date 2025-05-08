<?php
/**
 * Payment method blocks controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use Pronamic\WpPayLogos\ImageService;

/**
 * Payment method blocks controller class
 */
final class PaymentMethodBlocksController {
	/**
	 * Setup.
	 *
	 * @return void
	 */
	public function setup() {
		\add_filter( 'get_block_type_variations', $this->get_block_type_variations( ... ), 10, 2 );
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
		$variations = $this->maybe_add_radio_options( $variations, $block_type );
		$variations = $this->maybe_add_radio_field( $variations, $block_type );

		return $variations;
	}

	/**
	 * Get label.
	 * 
	 * @param string $id   ID.
	 * @param string $label Label.
	 * @return string
	 */
	private function get_label( $id, $label ) {
		$image_service = new ImageService();

		$path = "methods/$id/method-$id-640x360.svg";

		$image_path = $image_service->get_path( $path );

		if ( ! is_readable( $image_path ) ) {
			return $label;
		}

		$image_contents = \file_get_contents( $image_path, true );

		$src = 'data:image/svg+xml;base64,' . \base64_encode( $image_contents );

		return \sprintf(
			'%s %s',
			\sprintf(
				'<img alt="" src="%s" style="width: 48px;" class="pronamic-forms-radio-option-image" />',
				\esc_attr( $src ),
			),
			$label
		);
	}

	/**
	 * Get payment methods.
	 * 
	 * @return array
	 */
	private function get_payment_methods() {
		return [
			[
				'id'    => 'bancontact',
				'title' => \__( 'Bancontact payment method', 'pronamic-forms' ),
				'label' => $this->get_label( 'bancontact', \__( 'Bancontact', 'pronamic-forms' ) ),
			],
			[
				'id'    => 'card',
				'title' => \__( 'Card payment method', 'pronamic-forms' ),
				'label' => $this->get_label( 'card', \__( 'Card', 'pronamic-forms' ) ),
			],
			[
				'id'    => 'ideal',
				'title' => \__( 'iDEAL payment method', 'pronamic-forms' ),
				'label' => $this->get_label( 'ideal', \__( 'iDEAL', 'pronamic-forms' ) ),
			],
		];
	}

	/**
	 * Maybe add payment method variations.
	 *
	 * @param array         $variations Variations.
	 * @param WP_Block_Type $block_type Block type.
	 * @return array
	 */
	private function maybe_add_radio_options( $variations, $block_type ) {
		if ( 'pronamic/form-radio-option' !== $block_type->name ) {
			return $variations;
		}

		$methods = $this->get_payment_methods();

		foreach ( $methods as $method ) {
			$name = 'pronamic-form-radio-option-payment-method-' . $method['id'];

			$variations[] = [
				'name'       => $name,
				'title'      => $method['title'],
				'isActive'   => [
					'reference',
					'value',
				],
				'attributes' => [
					'label'     => $method['label'],
					'reference' => 'pronamic_pay_payment_method',
					'value'     => $method['id'],
				],
				'scope'      => [
					'block',
					'insert',
					'transform',
				],
			];
		}

		return $variations;
	}

	/**
	 * Maybe add payment method variations.
	 *
	 * @param array         $variations Variations.
	 * @param WP_Block_Type $block_type Block type.
	 * @return array
	 */
	private function maybe_add_radio_field( $variations, $block_type ) {
		if ( 'pronamic/form-radio-field' !== $block_type->name ) {
			return $variations;
		}

		$inner_blocks = [];

		$methods = $this->get_payment_methods();

		foreach ( $methods as $method ) {
			$inner_blocks[] = [
				'pronamic/form-radio-option',
				[
					'label'     => $method['label'],
					'reference' => 'pronamic_pay_payment_method',
					'value'     => $method['id'],
				],
				[],
			];
		}

		$variations[] = [
			'name'        => 'pronamic-form-radio-field-payment-method',
			'title'       => \__( 'Payment method field', 'pronamic-forms' ),
			'keywords'    => [
				\__( 'payment method', 'pronamic-forms' ),
				\__( 'Bancontact', 'pronamic-forms' ),
				\__( 'Card', 'pronamic-forms' ),
				\__( 'iDEAL', 'pronamic-forms' ),
			],
			'attributes'  => [
				'label'     => \__( 'Payment method', 'pronamic-forms' ),
				'reference' => 'pronamic_pay_payment_method',
				'required'  => true,
			],
			'innerBlocks' => $inner_blocks,
			'example'     => [
				'attributes' => [
					'label' => \__( 'Payment method', 'pronamic-forms' ),
				],
			],
			'scope'       => [ 'block', 'inserter', 'transform' ],
			'isActive'    => [ 'reference' ],
		];

		return $variations;
	}
}
