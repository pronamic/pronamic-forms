<?php
/**
 * Block updater form field
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_HTML_Tag_Processor;

/**
 * Block updater form field class
 */
class BlockUpdaterFormField extends BlockUpdater {
	/**
	 * Update inner content.
	 *
	 * @param string $html         HTML.
	 * @param array  $parsed_block Parsed block.
	 * @return string
	 */
	public function update_inner_content( $html, $parsed_block ) {
		$type = $parsed_block['attrs']['type'] ?? '';

		$processor = new WP_HTML_Tag_Processor( $html );

		if ( $processor->next_tag(
			[
				'class_name' => 'wp-block-pronamic-form-control__element',
			]
		) ) {
			$processor->set_attribute( 'name', $parsed_block['attrs']['name'] ?? '' );

			if ( 'textarea' !== $type ) {
				$processor->set_attribute( 'value', $parsed_block['attrs']['value'] ?? '' );
			}
		}

		$html = $processor->get_updated_html();

		if ( 'textarea' === $type ) {
			$html = $this->update_textarea_value_html( $html, $parsed_block['attrs']['value'] ?? '' );
		}

		return $html;
	}
}
