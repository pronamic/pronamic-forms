<?php
/**
 * Plugin Name: Pronamic Forms
 * Plugin URI: https://www.pronamic.eu/plugins/pronamic-forms/
 * Description: Pronamic Forms is a powerful WordPress plugin and library that allows you to create and manage customizable forms, powered by WordPress blocks and new WordPress APIs like the Interactivity and HTML APIs. Easily build forms for donations, orders, and more using Gutenberg blocks, and handle payments seamlessly with the Pronamic Pay platform.
 *
 * Version: 2.0.1
 * Requires at least: 6.7
 * Requires PHP: 8.2
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

declare(strict_types=1);

namespace Pronamic\PronamicForms;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload.
 */
$autoload_path = __DIR__ . '/vendor/autoload_packages.php';

if ( \file_exists( $autoload_path ) ) {
	require_once $autoload_path;
}

/**
 * Bootstrap.
 */
add_action(
	'init',
	function () {
		load_plugin_textdomain( 'pronamic-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);

Plugin::instance();
