<?php
/**
 * Plugin
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

declare(strict_types=1);

namespace Pronamic\PronamicForms;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Instance.
	 *
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Controller.
	 *
	 * @var array
	 */
	private $controllers = [];

	/**
	 * Construct plugin.
	 */
	private function __construct() {
		add_action(
			'init',
			static function () {
				load_plugin_textdomain( 'pronamic-forms', false, dirname( plugin_basename( __DIR__ ) ) . '/languages' );
			}
		);

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

		foreach ( $this->controllers as $controller ) {
			$controller->setup();
		}
	}

	/**
	 * Instance.
	 *
	 * @return self
	 */
	public static function instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
