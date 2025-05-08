<?php
/**
 * Block pattern categories controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Block pattern categories controller class
 */
final class BlockPatternCategoriesController {
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
		\register_block_pattern_category(
			'pronamic-forms',
			[
				'label' => \__( 'Pronamic forms', 'pronamic-forms' ),
			]
		);
	}
}
