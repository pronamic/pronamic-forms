<?php
/**
 * Block patterns controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Block patterns controller class
 */
final class BlockPatternsController {
	/**
	 * Setup.
	 *
	 * @return void
	 */
	public function setup() {
		\add_action( 'init', $this->init( ... ) );
	}

	/**
	 * Init.
	 *
	 * @return void
	 */
	private function init() {
		\register_block_pattern(
			'pronamic/contact-form',
			[
				'title'      => \__( 'Contact form', 'pronamic-forms' ),
				'filePath'   => __DIR__ . '/../patterns/contact-form.php',
				'categories' => [
					'pronamic-forms',
				],
				'keywords'   => [
					'pronamic',
					'form',
					'contact',
				],
				'blockTypes' => [
					'pronamic/forms',
				],
			]
		);

		\register_block_pattern(
			'pronamic/donation-form',
			[
				'title'      => \__( 'Donation form', 'pronamic-forms' ),
				'filePath'   => __DIR__ . '/../patterns/donation-form.php',
				'categories' => [
					'pronamic-forms',
				],
				'keywords'   => [
					'pronamic',
					'form',
					'contact',
					'donation',
					'donate',
				],
				'blockTypes' => [
					'pronamic/forms',
				],
			]
		);

		\register_block_pattern(
			'pronamic/order-form',
			[
				'title'      => \__( 'Order form', 'pronamic-forms' ),
				'filePath'   => __DIR__ . '/../patterns/order-form.php',
				'categories' => [
					'pronamic-forms',
				],
				'keywords'   => [
					'pronamic',
					'form',
					'contact',
					'order',
					'product',
					'checkout',
				],
				'blockTypes' => [
					'pronamic/forms',
				],
			]
		);

		\register_block_pattern(
			'pronamic/product-configurator-form',
			[
				'title'      => \__( 'Product configurator form', 'pronamic-forms' ),
				'filePath'   => __DIR__ . '/../patterns/product-configurator-form.php',
				'categories' => [
					'pronamic-forms',
				],
				'keywords'   => [
					'pronamic',
					'form',
					'contact',
					'order',
					'product',
					'checkout',
					'configurator',
				],
				'blockTypes' => [
					'pronamic/forms',
				],
			]
		);
	}
}
