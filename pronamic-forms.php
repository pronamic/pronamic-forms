<?php
/**
 * Plugin Name: Pronamic Forms
 * Plugin URI: https://www.pronamic.eu/plugins/pronamic-forms/
 * Description: Pronamic Forms is a powerful WordPress plugin and library that allows you to create and manage customizable forms, powered by WordPress blocks and new WordPress APIs like the Interactivity and HTML APIs. Easily build forms for donations, orders, and more using Gutenberg blocks, and handle payments seamlessly with the Pronamic Pay platform.
 *
 * Version: 1.0.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 *
 * Author: Pronamic
 * Author URI: https://www.pronamic.eu/
 *
 * Text Domain: pronamic-forms
 * Domain Path: /languages/
 *
 * License: GPL-2.0-or-later
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2023 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

/**
 * Autoload
 */
require __DIR__ . '/vendor/autoload_packages.php';

/**
 * Bootstrap.
 */
add_action(
	'init',
	function () {
		load_plugin_textdomain( 'pronamic-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);

$pronamic_forms_plugin = new Pronamic\PronamicForms\Plugin();

$pronamic_forms_plugin->setup();
