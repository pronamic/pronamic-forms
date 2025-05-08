<?php
/**
 * Plugin
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Controller.
	 * 
	 * @var array
	 */
	private $controllers = [];

	/**
	 * Construct plugin.
	 */
	public function __construct() {
		$this->controllers = [
			new BlockEditorController(),
			new BlockPatternCategoriesController(),
			new BlockPatternsController(),
			new BlockTypesController(),
			new PayController(),
			new PaymentMethodBlocksController(),
			new PostTypesController(),
			new RenderFormBlockController(),
		];
	}

	/**
	 * Setup.
	 * 
	 * @return void
	 */
	public function setup() {
		foreach ( $this->controllers as $controller ) {
			$controller->setup();
		}
	}
}
