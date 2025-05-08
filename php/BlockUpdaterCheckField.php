<?php
/**
 * Block updater check field
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2024 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\PronamicForms
 */

namespace Pronamic\PronamicForms;

use WP_HTML_Tag_Processor;

/**
 * Block updater check field class
 */
class BlockUpdaterCheckField extends BlockUpdater {
	/**
	 * Update value from input.
	 *
	 * @param array $parsed_block Parsd block.
	 * @return array
	 */
	public function update_value_from_input( $parsed_block ) {
		$input = $this->get_input( $parsed_block );

		if ( null === $input ) {
			return $parsed_block;
		}

		$parsed_block['attrs']['checked'] = ( $input === $parsed_block['attrs']['value'] );

		return $parsed_block;
	}

	/**
	 * Update inner content.
	 *
	 * @param string $html         HTML.
	 * @param array  $parsed_block Parsed block.
	 * @return string
	 */
	public function update_inner_content( $html, $parsed_block ) {
		$processor = new WP_HTML_Tag_Processor( $html );

		if ( $processor->next_tag(
			[
				'tag_name'   => 'input',
				'class_name' => 'wp-block-pronamic-form-control__element',
			]
		) ) {
			$processor->set_attribute( 'name', $parsed_block['attrs']['name'] ?? '' );
			$processor->set_attribute( 'value', $parsed_block['attrs']['value'] ?? '' );
			$processor->set_attribute( 'checked', $parsed_block['attrs']['checked'] ?? false );
		}

		return $processor->get_updated_html();
	}
}
