<?php
/**
 * Block editor controller
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Block editor controller class
 * 
 * @link https://github.com/WordPress/wordpress-develop/blob/50af37a9083f003f8e98d089091d2cc428797cc5/src/wp-includes/block-editor.php#L78-L86
 * @phpstan-type BlockCategory array{ slug: string, title: string, icon: string }
 */
final class BlockEditorController {
	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		\add_filter( 'block_categories_all', $this->block_categories_all( ... ) );
	}

	/**
	 * Block categories all.
	 * 
	 * @link https://github.com/WordPress/wordpress-develop/blob/50af37a9083f003f8e98d089091d2cc428797cc5/src/wp-includes/block-editor.php#L78-L86
	 * @param BlockCategory[] $categories Categories.
	 * @return BlockCategory[]
	 */
	private function block_categories_all( $categories ) {
		$categories[] = [
			'slug'  => 'pronamic-forms',
			'title' => \__( 'Pronamic Forms', 'pronamic-forms' ),
			'icon'  => 'feddback',
		];

		return $categories;
	}
}
